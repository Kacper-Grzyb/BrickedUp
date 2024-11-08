<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth/login');
});

Route::get('/signup', function () {
    return view('auth/signup');
});

Route::get('/set-details', function() {
    return view('set-details');
});

Route::get('/settings', function() {
    return view('settings');
});

Route::get('/', function () { 
    return view('landing_page/landing');
});

Route::get('/features', function () { 
    return view('landing_page/features');
});

Route::get('/upload-data', [FileUploadController::class, 'showUploadForm'])->name('form');
Route::post('/upload-data', [FileUploadController::class, 'upload'])->name('upload');