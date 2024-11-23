<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\LegoSetController;
use App\Models\SetPrice;
use App\Http\Controllers\SetController;

Route::get('/', function () {
    return view('landing_page/landing');
});

Route::get('/features', function () {
    return view('landing_page/features');
});

require __DIR__ . '/auth.php'; 

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->middleware(['verified'])->name('home');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/set-details', function () {
        return view('set-details');
    });

    Route::get('/settings', function () {
        return view('settings');
    });

    Route::get('full-graph', [SetController::class, 'fullGraph'])->name('full-graph');

    Route::controller(FileUploadController::class)->group(function () {
        Route::get('/upload-data', 'showUploadForm')->name('form');
        Route::post('/upload-data', 'upload')->name('upload');
    });
});
