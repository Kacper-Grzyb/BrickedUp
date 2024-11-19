<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;

class SettingsController extends Controller
{
    public function show() 
    {
        $userID = auth()->user()->id;
        $sets = DB::table('sets')->select('set_number', 'set_name')->get();
        $favouriteSets = DB::table('favourite_sets')->where('user_id', '=', $userID)->get();
        $themes = DB::table('themes')->select("*")->get();
        $favouriteThemes = DB::table('favourite_themes')->where('user_id', '=', $userID)->get();
        $subthemes = DB::table('subthemes')->select("*")->get();
        $favouriteSubthemes = DB::table('favourite_subthemes')->where('user_id', '=', $userID)->get();

        $favouriteSetNames = DB::table('sets')
                                ->select('set_name', 'sets.set_number')
                                ->join('favourite_sets', 'sets.set_number', '=', 'favourite_sets.set_number')
                                ->where('favourite_sets.user_id', '=', $userID)
                                ->get();
        $favouriteThemeNames = DB::table('themes')
                                ->select('theme')
                                ->join('favourite_themes', 'id', '=', 'favourite_themes.theme_id')
                                ->where('favourite_themes.user_id', '=', $userID)
                                ->get();
        $favouriteSubThemeNames = DB::table('subthemes')
                                ->select('subtheme')
                                ->join('favourite_subthemes', 'id', '=', 'favourite_subthemes.subtheme_id')
                                ->where('favourite_subthemes.user_id', '=', $userID)
                                ->get();

        return view('settings', ['sets' => $sets, 'favouriteSets' => $favouriteSets,
                                 'themes' => $themes, 'favouriteThemes' => $favouriteThemes,
                                 'subthemes' => $subthemes, 'favouriteSubthemes' => $favouriteSubthemes,
                                 'favouriteSetNames' => $favouriteSetNames,
                                 'favouriteThemeNames' => $favouriteThemeNames,
                                 'favouriteSubthemeNames' => $favouriteSubThemeNames
                                ]);
    }
}
