<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', [FileController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// upload
Route::get('/upload', [FileController::class, 'upload']);
Route::post('/upload', [FileController::class, 'store'])
    ->middleware('auth')
    ->middleware('throttle:10,1'); // rate limit (10 uploads per minut per IP)

// share & download file
Route::get('/file/{token}', [FileController::class, 'show']);

Route::post('file/{token}', [FileController::class, 'unlock']);

Route::get('/download/{token}', [FileController::class, 'download'])
    ->middleware('throttle:50,1'); // rate limit (50 downloads per minut per IP)

// delete file
Route::delete('/file/{id}', [FileController::class, 'destroy']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/test', function (){
    return  view('test');
});














require __DIR__.'/auth.php';
