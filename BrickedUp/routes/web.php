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

Route::get('/', function () { 
    return view('landing_page/landing');
});

Route::get('/features', function () { 
    return view('landing_page/features');
});