<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;


class ImageController extends Controller
{
    public function show($imageName)
    {
        $cacheKey = 'image_' . $imageName;
        
        $image = Cache::remember($cacheKey, 3600, function () use ($imageName) {
            $imagePath = public_path("img/{$imageName}"); 

            if (!File::exists($imagePath)) {
                abort(404, "Image not found");
            }

            return File::get($imagePath);
        });

        $mimeType = File::mimeType(public_path("img/{$imageName}"));

        return response($image, 200)->header('Content-Type', $mimeType);
    }
}
