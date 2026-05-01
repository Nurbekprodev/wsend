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
    private function getFilesByToken($token)
    {
        return File::where('token', $token)->get();
    }

    private function generateToken($length = 20)
    {
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz123456789';

        $token = '';
        $max = strlen($chars) - 1;

        for ($i = 0; $i < $length; $i++) {
            $token .= $chars[random_int(0, $max)];
        }

        return $token;
    }

    public function index(Request $request)
    {
        $query = File::where('user_id', Auth::id());

        if ($request->search) {
            $query->where('original_name', 'like', '%' . $request->search . '%');
        }

        if ($request->type) {
            $query->where('type', $request->type);
        }

        if ($request->sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($request->sort == 'largest') {
            $query->orderBy('file_size', 'desc');
        } elseif ($request->sort == 'smallest') {
            $query->orderBy('file_size', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $files = $query->paginate(6);

        return view('dashboard', compact('files'));
    }

    public function upload()
    {
        return view('files.upload');
    }

    public function show($token)
    {
        $files = $this->getFilesByToken($token);

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

    public function unlock(Request $request, $token)
    {
        $files = $this->getFilesByToken($token);

        if ($files->isEmpty()) {
            abort(404);
        }

        $baseFile = $files->first();

        if (!empty($baseFile->password)) {
            if (!Hash::check($request->password, $baseFile->password)) {
                return back()->with('password', 'Incorrect password. Please try again.');
            }
        }

        return view('files.file', compact('files'));
    }

    public function store(Request $request)
    {
        $guestToken = null;

        if (!auth()->check()) {
            $guestToken = $request->cookie('guest_token');

            if (!$guestToken) {
                $guestToken = Str::random(40);
            }
        }

        $validator = Validator::make($request->all(), [
            'files' => 'required|array',
            'files.*' => 'required|file|max:10240',
            'expires_in' => 'required|integer|in:1,3,7',
            'max_downloads' => 'nullable|integer|min:1|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->toArray()
            ], 422);
        }

        $files = $request->file('files');

        do {
            $token = $this->generateToken(20);
        } while (File::where('token', $token)->exists());

        $days = (int) $request->expires_in;
        $max_downloads = $request->max_downloads ?: null;

        $blocked = [
            'exe','bat','cmd','sh','php','js',
            'msi','dll','com','scr','vbs','jar'
        ];

        $limit = auth()->check()
            ? 200 * 1024 * 1024
            : 100 * 1024 * 1024;

        if (auth()->check()) {
            $currentUsage = File::where('user_id', auth()->id())
                ->where(function ($q) {
                    $q->whereNull('expires_at')
                      ->orWhere('expires_at', '>', now());
                })
                ->sum('file_size');
        } else {
            $currentUsage = File::where('guest_token', $guestToken)
                ->where(function ($q) {
                    $q->whereNull('expires_at')
                      ->orWhere('expires_at', '>', now());
                })
                ->sum('file_size');
        }

        $newUploadSize = collect($files)->sum(fn($file) => $file->getSize());

        if ($currentUsage + $newUploadSize > $limit) {
            return response()->json([
                'errors' => [
                    'files' => [
                        auth()->check()
                            ? 'Storage limit exceeded.'
                            : "You've reached 100MB. Sign up for more space."
                    ]
                ]
            ], 422);
        }

        foreach ($files as $file) {

            $ext = strtolower($file->getClientOriginalExtension());
            $mime = $file->getMimeType();

            if (
                in_array($ext, $blocked) ||
                str_contains($mime, 'application/x-msdownload') ||
                str_contains($mime, 'executable')
            ) {
                return response()->json([
                    'errors' => ['files' => ["File type ($ext) is not allowed"]]
                ], 422);
            }

            $path = $file->store('files', config('filesystems.default'));

            File::create([
                'user_id' => auth()->id(),
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

        if (!auth()->check()) {
            return $response->cookie('guest_token', $guestToken, 60 * 24 * 7);
        }

        return $response;
    }

    public function download($token)
    {
        $files = $this->getFilesByToken($token);

        if ($files->isEmpty()) {
            return response()->view('files.errors.not-found', [], 404);
        }

        $baseFile = $files->first();

        if ($baseFile->expires_at && now()->greaterThan($baseFile->expires_at)) {
            return response()->view('files.errors.expired', compact('baseFile'), 410);
        }

        if ($baseFile->max_downloads && $baseFile->downloads >= $baseFile->max_downloads) {
            return response()->view('files.errors.limit-reached', compact('baseFile'), 403);
        }

        $disk = config('filesystems.default');

        if ($files->count() == 1) {
            File::where('token', $token)->increment('downloads');

            return Storage::disk($disk)->download(
                $baseFile->file_path,
                $baseFile->original_name
            );
        }

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

        $added = 0;

        foreach ($files as $file) {
            $fullPath = Storage::disk($disk)->path($file->file_path);

            if (file_exists($fullPath)) {
                $zip->addFile($fullPath, uniqid() . '_' . $file->original_name);
                $added++;
            }
        }

        if ($added === 0) {
            abort(404, "No valid files found");
        }

        $zip->close();

        File::where('token', $token)->increment('downloads');

        return response()->download($zipPath)->deleteFileAfterSend(true);
    }

    public function destroy($id)
    {
        $file = File::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        Storage::disk(config('filesystems.default'))->delete($file->file_path);

        $file->delete();

        return back()->with('success', 'File deleted successfully.');
    }
}