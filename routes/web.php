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
Route::post('/upload', [FileController::class, 'store'])->middleware('auth');

// share & download file
Route::get('/file/{token}', [FileController::class, 'show']);
Route::get('/download/{token}', [FileController::class, 'download']);

// delete file
Route::delete('/file/{id}', [FileController::class, 'destroy']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/test', function (){
    return  view('welcome');
});














require __DIR__.'/auth.php';
