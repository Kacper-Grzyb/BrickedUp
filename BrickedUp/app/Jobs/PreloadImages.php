<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class PreloadImages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle()
    {
        $imagesPath = public_path('img');
        $images = File::allFiles($imagesPath);

        foreach ($images as $image) {
            $imageName = $image->getFilename();
            $cacheKey = 'image_' . $imageName;

            Cache::remember($cacheKey, 3600, function () use ($image) {
                return File::get($image->getPathname());
            });
        }
    }
}
