<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function index(){
        $files = File::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);
        return view('dashboard', ['files' => $files]);
    }

    public function upload(){
        return view('files.upload');
    }

    public function show($token){
        $file = File::where('token', $token)->firstOrFail();
        return view('files/file', ['file' => $file]);
    }

    public function store(Request $request){
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf,zip,txt|max:10240',
        ]);
        
        $file = $request->file('file');

        $path = $file->store('files', 'local');

        if (!$path) {
            throw new \Exception("File upload failed");
        }

        $model = File::create([
            'user_id' => Auth::id(),
            'original_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'file_size' => $file->getSize(),
            'token' => Str::random(20),
        ]);

        return back()->with('link', url('/file/' . $model->token));
    }

    public function download($token)
    {
        $file = File::where('token', $token)->firstOrFail();
        // dd($file->file_path);
        return Storage::disk('local')->download($file->file_path);
    }

    public function destroy($id){
        $file = File::where('id', $id)
           ->where('user_id', auth()->id())
           ->firstOrFail();
        // dd($file->file_path);
        Storage::disk('local')->delete($file->file_path);


        $file->delete();

        
        return back()->with('success', 'File deleted successfully.');
    }
}
