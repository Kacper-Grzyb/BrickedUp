<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Set;
use App\Models\FavouriteSet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use DB;

class FavoriteSetsController extends Controller
{
    public function view()
    {
        $userId = auth()->id();

        $sets = Set::with('setImage')
            ->leftJoin('favourite_sets', function ($join) use ($userId) {
                $join->on('sets.set_number', '=', 'favourite_sets.set_number')
                     ->where('favourite_sets.user_id', '=', $userId);
            })
            ->select('sets.*', 'favourite_sets.set_number as is_favorite')
            ->orderByRaw('CASE WHEN favourite_sets.set_number IS NOT NULL THEN 0 ELSE 1 END') // Favorites first
            ->orderBy('sets.set_number')   
            ->get();

        //debug because aaaaaaaa
        //dd($sets->toArray());

        return view('favorite-sets', compact('sets'));
    }

    public function addToFavorites(Request $request)
    {
        $userId = Auth::id();
        $setNumber = $request->set_number;
        
        if (!$setNumber) {
            \Log::error('Set number is missing in the request.', ['user_id' => $userId, 'set_number' => $setNumber]);
            return response()->json(['success' => false, 'message' => 'Set number is required'], 400);
        }

        FavouriteSet::firstOrCreate([
            'user_id' => $userId,
            'set_number' => $request->set_number,
        ]);

        return response()->json(['success' => true]);
    }

    public function removeFromFavorites(Request $request)
    {
        $userId = Auth::id();

        FavouriteSet::where([
            'user_id' => $userId,
            'set_number' => $request->set_number,
        ])->delete();

        return response()->json(['success' => true]);
    }
}