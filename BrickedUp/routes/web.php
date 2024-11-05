<?php

use Illuminate\Support\Facades\Route;


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

Route::get('/home', function() {
    return view('home');
});