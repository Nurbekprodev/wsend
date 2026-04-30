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

        $files = $query->paginate(6);

        return view('dashboard', compact('files'));
    }

    public function upload(){
        return view('files.upload');
    }

    public function show($token)
    {
        $files = File::where('token', $token)->get();

        if ($files->isEmpty()) {
            return response()->view('files.errors.not-found', [], 404);
        }

        $baseFile = $files->first();

        if ($baseFile->expires_at && now()->greaterThan($baseFile->expires_at)) {
            return response()->view('files.errors.expired', compact('baseFile'), 410);
        }

        if ($baseFile->password) {
            return view('files.password', compact('files'));
        }

        return view('files.file', compact('files'));
    }

    // Unlock
    public function unlock(Request $request, $token)
    {
        $files = File::where('token', $token)->get();

        if ($files->isEmpty()) {
            abort(404);
        }

        $baseFile = $files->first();

        // password check (group-based)
        if (!empty($baseFile->password)) {
            if (!Hash::check($request->password, $baseFile->password)) {
                return back()->with('password', 'Incorrect password. Please try again.');
            }
        }

        return view('files.file', compact('files'));
    }

    // store
    public function store(Request $request)
    {
        // assign gueat token
        $guestToken = null;

        // check if user is guest
        if(!auth()->check()){
            $guestToken = $request->cookie('guest_token');

            if(!$guestToken){
                $guestToken = Str::random(40);
            }
        }


        // accept files
        $files = $request->file('files');
        // one token for all files
        $token = Str::random(20);
        $days = (int) $request->expires_in;
        $max_downloads = $request->max_downloads ?: null;

        $validator = Validator::make($request->all(), [
            'files' => 'required|array',
            'files.*' => 'required|file|max:10240',
            'expires_in' => 'required|integer|in:1,3,7',
            'max_downloads' => 'nullable|integer|min:1|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // blocked file types
        $blocked = [
            'exe','bat','cmd','sh','php','js',
            'msi','dll','com','scr','vbs','jar'
        ];   


        // STORAGE LIMIT LOGIC
        // Apply limit (guest -> 100MB, user -> 200MB)
        $limit = auth()->check()
            ? 200 * 1024 * 1024
            : 100 * 1034 * 1024;

        // current file size
        if(auth()->check()){
            $currentUsage = File::where('user_id', auth()->id())
                ->where(function ($q) {
                    $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
                })
                ->sum('file_size');
        }else{
            $currentUsage = File::where('guest_token', $guestToken)
                ->where(function ($q) {
                    $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
                })
                ->sum('file_size');
        }

        // new upload size (Block if exceeds)
        $newUploadSize = collect($files)->sum(function ($file){
            return $file->getSize();
        });

        // check limit
        if($currentUsage + $newUploadSize > $limit){
            if(auth()->check()){
                return response()->json([
                    'error' => 'Storage limit exceeded.'
                ], 422);
            }else{
                return response()->json([
                    'error' => "You've reached 100MB. Sign up for more space."
                ], 422);
            }

        }


        // SAVE FILES
        foreach ($files as $file) {

            $ext = strtolower($file->getClientOriginalExtension());

            if (in_array($ext, $blocked)) {
                return response()->json([
                    'error' => "File type .$ext is not allowed"
                ], 422);
            }

            $path = $file->store('files', 'local');

            File::create([
                'user_id' => auth()->user() ? auth()->id() : null,
                'original_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'file_size' => $file->getSize(),
                'token' => $token,
                'expires_at' => now()->addDays($days),
                'max_downloads' => $max_downloads,
                'password' => $request->password ? bcrypt($request->password) : null,
                'guest_token' => $guestToken,
            ]);
        }


        $response = response()->json([
            'url' => url('/file/' . $token)
        ]);

        if(!auth()->check()){
            return $response->cookie('guest_token', $guestToken, 60 * 24 * 7  );     // 7 days
        }

        return $response;
    }

    public function download($token)
    {
        $files = File::where('token', $token)->get();
        $tempDir = storage_path('app/temp');

        if ($files->isEmpty()) {
            return response()->view('files.errors.not-found', [], 404);
        }

        $baseFile = $files->first(); 

        // expiry check
        if ($baseFile->expires_at && now()->greaterThan($baseFile->expires_at)) {
            return response()->view('files.errors.expired', compact('baseFile'), 410);
        }
        // downloads count check
        if ($baseFile->max_downloads && $baseFile->downloads >= $baseFile->max_downloads) {
            return response()->view('files.errors.limit-reached', compact('baseFile'), 403);
        }


        if ($files->count() == 1) {
            // increment after each download
            $baseFile->increment('downloads');

            return Storage::disk('local')->download($baseFile->file_path, $baseFile->original_name);
        }else {
            // create zip only if valid
            $zipName = Str::random(20) . '.zip';
            $zipPath = $tempDir . '/' . $zipName;

            if (!file_exists($tempDir)) {
                mkdir($tempDir, 0777, true);
            }

            $zip = new \ZipArchive();

            if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== TRUE) {
                abort(500, 'ZIP creation failed');
            }
            
            // counter
            $added = 0;
            foreach ($files as $file) {

                $fullPath = Storage::disk('local')->path($file->file_path);

                if (file_exists($fullPath)) {
                    $zip->addFile($fullPath, uniqid() . '_' . $file->original_name);
                    $added ++;
                }
            }

            // if file empty abort
            if ($added === 0) {
                abort(404, "No valid files found");
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
