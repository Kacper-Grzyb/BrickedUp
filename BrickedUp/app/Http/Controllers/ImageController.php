<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\CacheClearer\ChainCacheClearer;


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

        if (Cache::has($cacheKey)) {
            logger("Cache hit for {$imageName}");
        };

        $mimeType = File::mimeType(public_path("img/{$imageName}"));

        return response($image, 200)->header('Content-Type', $mimeType);
    }

    public function preloadImages()
    {
        $imagesPath = public_path('img');
        $images = File::allFiles($imagesPath);

        foreach($images as $image) {
            $imageName = $image->getFilename();
            $cacheKey = 'image_' . $imageName;

            Cache::remember($cacheKey, 3600, function() use ($image) {
                return File::get($image->getPathname());
            });
        }

        logger("Image {$imageName} has been cached ma nigga");
    }
}
