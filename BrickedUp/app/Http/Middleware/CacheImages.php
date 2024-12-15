<?php
namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\ImageController;
use App\Jobs\PreloadImages;

class CacheImages
{
    public function handle($request, Closure $next)
    {
        PreloadImages::dispatch();
        return $next($request);
    }
}
