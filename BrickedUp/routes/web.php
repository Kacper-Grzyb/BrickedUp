<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\LegoSetController;
use App\Http\Controllers\SetsDataController;

Route::get('/', function () {
    return view('landing_page/landing');
});

Route::get('/features', function () {
    return view('landing_page/features');
});

Route::get('/search-legosets', [LegoSetController::class, 'search'])->name('legosets.search');


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

    Route::get('/full-graph', function () {
        return view('full-graph');
    });

    Route::get('/explore-view', function () {
        return view('explore');
    })->name('explore-view');

    Route::get('/explore-view', [SetsDataController::class, 'index'])->name('explore-view');


    Route::get('/upload-data', [FileUploadController::class, 'showUploadForm'])->name('form');
    Route::post('/receive-data', [FileUploadController::class, 'receiveData'])->name('receiveData');
    Route::post('/process-upload', [FileUploadController::class, 'uploadData'])->name('uploadData');

    Route::get('/download-csv-template', [FileUploadController::class, 'downloadCsvTemplate'])->name('downloadCsvTemplate');

});

