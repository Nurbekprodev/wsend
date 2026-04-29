<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
public function index(Request $request)
    {
        $query = File::where('user_id', Auth::id());

        if ($request->search) {
            $query->where('original_name', 'like', '%' . $request->search . '%');
        }

        if ($request->type) {
            $query->where('type', $request->type);
        }

        // SORT (only ONE active order)
        if ($request->sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($request->sort == 'largest') {
            $query->orderBy('file_size', 'desc');
        } elseif ($request->sort == 'smallest') {
            $query->orderBy('file_size', 'asc');
        } else {
            $query->orderBy('created_at', 'desc'); // default newest
        }

        $files = $query->paginate(8);

        return view('dashboard', compact('files'));
    }

    public function upload(){
        return view('files.upload');
    }

    public function show($token)
    {
        $file = File::where('token', $token)->first();

        if (!$file) {
            return response()->view('files.errors.not-found', [], 404);
        }

        if ($file->expires_at && now()->greaterThan($file->expires_at)) {
            return response()->view('files.errors.expired', compact('file'), 410);
        }

        if ($file->password) {
            return view('files.password', compact('file'));
        }

        return view('files.file', compact('file'));
    }

    // Unlock
    public function unlock(Request $request, $token)
    {
        $file = File::where('token', $token)->firstOrFail();

        if (!Hash::check($request->password, $file->password)) {
            return back()->with('password', 'Wrong password');
        }

        return view('files.file', compact('file'));
    }

    // store
    public function store(Request $request)
    {
        // accept files
        $files = $request->file('files');
        // one token for all files
        $token = Str::random(20);
        $days = (int) $request->expires_in;
        $max_downloads = $request->max_downloads ?: null;

        $validator = Validator::make($request->all(), [
            'files' => 'required|array',
            'files.*' => 'required|file|mimetypes:image/jpeg,image/png,application/pdf,application/zip,text/plain|max:10240',
            'expires_in' => 'required|integer|in:1,3,7',
            'max_downloads' => 'nullable|integer|min:1|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }


        foreach($files as $file){
            $path = $file->store('files', 'local');

            // create file
            $model = File::create([
                'user_id' => auth()->user() ? auth()->id() : null,
                'original_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'file_size' => $file->getSize(),
                'token' => $token,  
                'expires_at' => now()->addDays($days),
                'max_downloads' => $max_downloads,
                'password' => $request->password ? bcrypt($request->password) : null,
            ]);


        }

        return response()->json([
            'url' => url('/file/' . $model->token)
        ]);
    }

    public function download($token)
    {
        $files = File::where('token', $token)->get();
        $tempDir = storage_path('app/temp');

        if ($files->isEmpty()) {
            return response()->view('files.errors.not-found', [], 404);
        }

        if ($files->count() == 1) {

            $file = $files->first();

            // expiry check
            if ($file->expires_at && now()->greaterThan($file->expires_at)) {
                return response()->view('files.errors.expired', compact('file'), 410);
            }

            // downloads count check
            if ($file->max_downloads && $file->downloads >= $file->max_downloads) {
                return response()->view('files.errors.limit-reached', compact('file'), 403);
            }

            // increment after each download
            $file->increment('downloads');

            return Storage::disk('local')->download($file->file_path, $file->original_name);
        }else {

            $firstFile = $files->first();

            // expiry check FIRST
            if ($firstFile->expires_at && now()->greaterThan($firstFile->expires_at)) {
                return response()->view('files.errors.expired', ['file' => $firstFile], 410);
            }

            // download limit check FIRST
            if ($firstFile->max_downloads && $firstFile->downloads >= $firstFile->max_downloads) {
                return response()->view('files.errors.limit-reached', ['file' => $firstFile], 403);
            }

            // create zip only if valid
            $zipName = Str::random(20) . '.zip';
            $tempDir = storage_path('app/temp');
            $zipPath = $tempDir . '/' . $zipName;

            if (!file_exists($tempDir)) {
                mkdir($tempDir, 0777, true);
            }

            $zip = new \ZipArchive();

            if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== TRUE) {
                abort(500, 'ZIP creation failed');
            }

            foreach ($files as $file) {

                $fullPath = Storage::disk('local')->path($file->file_path);

                if (file_exists($fullPath)) {
                    $zip->addFile($fullPath, $file->original_name);
                }
            }

            $zip->close();

            foreach ($files as $file) {
                $file->increment('downloads');
            }

            return response()->download($zipPath)->deleteFileAfterSend(true);
        }
}

    public function destroy($id){
        $file = File::where('id', $id)
           ->where('user_id', auth()->id())
           ->firstOrFail();
      
        Storage::disk('local')->delete($file->file_path);


        $file->delete();

        
        return back()->with('success', 'File deleted successfully.');
    }
}
