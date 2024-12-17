<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LegoSetController;
use App\Http\Controllers\SetsDataController;
use App\Http\Controllers\SetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\FavoriteSetsController;

Route::get('/', function () {
    return view('landing_page/landing');
});

Route::get('/features', function () {
    return view('landing_page/features');
});

Route::get('/search-legosets', [LegoSetController::class, 'search'])->name('legosets.search');


require __DIR__ . '/auth.php'; 

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['verified'])->name('home');
    Route::get('/edit-dashboard', [DashboardController::class, 'editDashboard'])->name('dashboard.edit');
    Route::post('/save-layout', [DashboardController::class, 'saveLayout'])->name('dashboard.save-layout');
    
    Route::get('/favorite-sets', [FavoriteSetsController::class, 'view'])->name('favorite-sets');
    Route::post('/favorite-sets/favorites/add', [FavoriteSetsController::class, 'addToFavorites'])->name('favorite-sets.favorites.add');
    Route::post('/favorite-sets/favorites/remove', [FavoriteSetsController::class, 'removeFromFavorites'])->name('favorite-sets.favorites.remove');

    Route::get('/profile', [ProfileController::class, 'view'])->name('profile');
    Route::post('/profile/favorites/add', [ProfileController::class, 'addToFavorites'])->name('profile.favorites.add');
    Route::post('/profile/favorites/remove', [ProfileController::class, 'removeFromFavorites'])->name('profile.favorites.remove');


    Route::get('/search-legosets', [LegoSetController::class, 'search'])->name('legosets.search');
    
    Route::get('/set-details', function () {
        return view('set-details');
    });

    Route::get('/settings', [SettingsController::class, 'show'])->name('settings');
    Route::patch('/update-favourite-sets', [ProfileController::class, 'updateFavouriteSets'])->name('profile.update-favourite-sets');

    Route::post('/update-favourite-themes', [ProfileController::class, 'updateFavouriteThemes'])
        ->name('profile.update-favourite-themes');

    Route::post('/update-favourite-subthemes', [ProfileController::class, 'updateFavouriteSubthemes'])
        ->name('profile.update-favourite-subthemes');
    //Route::patch('/update-favourite-themes', [ProfileController::class, 'updateFavouriteThemes'])->name('profile.update-favourite-themes');
    //Route::patch('/update-favourite-subthemes', [ProfileController::class, 'updateFavouriteSubthemes'])->name('profile.update-favourite-subthemes');
    
    Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/edit-profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/edit-profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('full-graph', [SetController::class, 'fullGraph'])->name('full-graph');

    Route::get('/explore-view', function () {
        return view('explore');
    })->name('explore-view');

    Route::get('/explore-view', [SetsDataController::class, 'index'])->name('explore-view');

    Route::get('/upload-data', [FileUploadController::class, 'showUploadForm'])->name('form');
    Route::post('/receive-data', [FileUploadController::class, 'receiveData'])->name('receiveData');
    Route::post('/process-upload', [FileUploadController::class, 'uploadData'])->name('uploadData');
    Route::post('/generate-price-data', [FileUploadController::class, 'generateSetPriceDummyData'])->name('generateSetPriceData');

    Route::get('/download-csv-template', [FileUploadController::class, 'downloadCsvTemplate'])->name('downloadCsvTemplate');

});

