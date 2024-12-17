<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Set;
use App\Models\SetPrice;
use App\Models\SetImage;
use App\Models\Theme;
use App\Models\Subtheme;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SetController extends Controller
{
    public function fullGraph()
    {
        // Define a unique cache key
        $cacheKey = 'full_graph_sets_with_prices';

        // Attempt to retrieve data from cache
        $sets = Cache::remember($cacheKey, now()->addMinutes(10), function () {
            return Set::with([
                'theme', 
                'subtheme', 
                'availability',
                'prices' => function($query) {
                    $query->orderBy('record_date', 'asc'); // Ensure chronological order
                }
            ])->get();
        });

        return view('full-graph', compact('sets'));
    }
}
