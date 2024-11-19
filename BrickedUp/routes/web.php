<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\SettingsController;

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

    Route::get('/profile', [ProfileController::class, 'view'])->name('profile');

    Route::get('/set-details', function () {
        return view('set-details');
    });

    Route::get('/settings', [SettingsController::class, 'show'])->name('settings');
    Route::patch('/update-favourite-sets', [ProfileController::class, 'updateFavouriteSets'])->name('profile.update-favourite-sets');
    Route::patch('/update-favourite-themes', [ProfileController::class, 'updateFavouriteThemes'])->name('profile.update-favourite-themes');
    Route::patch('/update-favourite-subthemes', [ProfileController::class, 'updateFavouriteSubthemes'])->name('profile.update-favourite-subthemes');
    
    Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/edit-profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/edit-profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/full-graph', function () {
        return view('full-graph');
    });

    Route::controller(FileUploadController::class)->group(function () {
        Route::get('/upload-data', 'showUploadForm')->name('form');
        Route::post('/upload-data', 'upload')->name('upload');
    });
});
