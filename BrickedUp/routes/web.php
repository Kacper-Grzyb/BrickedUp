<?php

use Illuminate\Support\Facades\Route;

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