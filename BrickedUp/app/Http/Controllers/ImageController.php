<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;


class ImageController extends Controller
{
    public function show($imageId)
    {
        $cacheKey = 'image_' . $imageId;
        
        $image = Cache::remember($cacheKey, 3600, function () use ($imageId) {
            $imagePath = "images/{$imageId}.jpg"; 

            if (!Storage::exists($imagePath)) {
                abort(404, "Image not found");
            }

            return Storage::get($imagePath);
        });

        return response($image, 200)->header('Content-Type', 'image/jpeg');
    }
}
