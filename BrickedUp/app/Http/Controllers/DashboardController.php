<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Set;
use App\Models\SetPrice;
use App\Models\DashboardElement;
use App\Models\UserDashboardLayout;
use DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index() {
        // Check if user has a pre-defined layout
        $userID = auth()->user()->id;
        
        $layout = DB::table('user_dashboard_layouts')->where('user_id', '=', $userID)->get();
        if($layout->isEmpty()) {
            // Get Element IDs
            $themeMarketshare = DB::table('dashboard_elements')->where('name', '=', 'theme-marketshare')->first();
            $setPriceTable = DB::table('dashboard_elements')->where('name', '=', 'set-price-table')->first();
            $setPrices = DB::table('dashboard_elements')->where('name', '=', 'set-prices')->first();
            $themePrices = DB::table('dashboard_elements')->where('name', '=', 'theme-prices')->first();
            $subthemePrices = DB::table('dashboard_elements')->where('name', '=', 'subtheme-prices')->first();
            // Insert a base layout
            DB::table('user_dashboard_layouts')->insert(
                [
                    'user_id' => $userID,
                    'element_id' => $themeMarketshare->id,
                    'style' => 'grid-row: 1 / 6; grid-column: 1 / 5'
                ]
            );

            DB::table('user_dashboard_layouts')->insert(
                [
                    'user_id' => $userID,
                    'element_id' => $setPriceTable->id,
                    'style' => 'grid-row: 1 / 6; grid-column: 5 / 11'
                ]
            );

            DB::table('user_dashboard_layouts')->insert(
                [
                    'user_id' => $userID,
                    'element_id' => $setPrices->id,
                    'style' => 'display: none'
                ]
            );

            DB::table('user_dashboard_layouts')->insert(
                [
                    'user_id' => $userID,
                    'element_id' => $themePrices->id,
                    'style' => 'display: none'
                ]
            );

            DB::table('user_dashboard_layouts')->insert(
                [
                    'user_id' => $userID,
                    'element_id' => $subthemePrices->id,
                    'style' => 'display: none'
                ]
            );
        }



        $sets = Set::with('theme')->get();
        $setPrices = SetPrice::with('set')->orderBy('record_date', 'desc')->get();
        $layout = UserDashboardLayout::where('user_id', '=', $userID)->with('element')->get();

        $setPricesStyle = collect($layout)->first(function($item) {
            return $item['element']['name'] === 'set-prices';
        })->style;
        $themePricesStyle = collect($layout)->first(function($item) {
            return $item['element']['name'] === 'theme-prices';
        })->style;
        $subthemePricesStyle = collect($layout)->first(function($item) {
            return $item['element']['name'] === 'subtheme-prices';
        })->style;
        $themeMarketshareStyle = collect($layout)->first(function($item) {
            return $item['element']['name'] === 'theme-marketshare';
        })->style;
        $setPriceTableStyle = collect($layout)->first(function($item) {
            return $item['element']['name'] === 'set-price-table';
        })->style;

        $favouriteSetPriceRecords = DB::table('favourite_sets')
                                  ->where('user_id', '=', $userID)
                                  ->join('set_prices', 'favourite_sets.set_number', '=', 'set_prices.set_number')
                                  ->select('set_prices.*')
                                  ->orderBy('set_prices.record_date')
                                  ->get();

        $favouriteThemeValues = DB::table('favourite_themes')
                                    ->where('user_id', '=', $userID)
                                    ->join('themes', 'favourite_themes.theme_id', '=', 'themes.id')
                                    ->join('sets', 'favourite_themes.theme_id', '=', 'sets.theme_id')
                                    ->join('set_prices', 'sets.set_number', '=', 'set_prices.set_number')
                                    ->select('themes.theme', DB::raw('SUM(set_prices.price) as value'))
                                    ->groupBy('themes.theme')
                                    ->get();

        $favouriteSubthemeValues = DB::table('favourite_subthemes')
                                    ->where('user_id', '=', $userID)
                                    ->join('subthemes', 'favourite_subthemes.subtheme_id', '=', 'subthemes.id')
                                    ->join('sets', 'favourite_subthemes.subtheme_id', '=', 'sets.subtheme_id')
                                    ->join('set_prices', 'sets.set_number', '=', 'set_prices.set_number')
                                    ->select('subthemes.subtheme', DB::raw('SUM(set_prices.price) as value'))
                                    ->groupBy('subthemes.subtheme')
                                    ->get();
        

        return view('home', ['setPrices' => $setPrices, 
                             'sets' => $sets,
                             'setPricesStyle' => $setPricesStyle,
                             'themePricesStyle' => $themePricesStyle,
                             'subthemePricesStyle' => $subthemePricesStyle,
                             'themeMarketshareStyle' => $themeMarketshareStyle,
                             'setPriceTableStyle' => $setPriceTableStyle,
                             'favouriteSetPriceRecords' => $favouriteSetPriceRecords, 
                             'favouriteThemeValues' => $favouriteThemeValues,
                             'favouriteSubthemeValues' => $favouriteSubthemeValues
        ]);
    }

    public function editDashboard() {
        $elements = DashboardElement::get();

        return view('edit-dashboard', ['dashboardElements' => $elements]);
    }
    
    public function saveLayout(Request $request) {
        $layout = json_decode($request->input('dashboardLayout'), true);
        $elements = DB::table('dashboard_elements')->get();
        $elementDictionary = [];
        foreach($elements as $element) {
            $rowBegin = -1;
            $rowEnd = -1;
            $colBegin = -1;
            $colEnd = -1;
            for($r = 0; $r < count($layout); $r++)
            {
                for($c = 0; $c < count($layout[$r]); $c++) 
                {
                    if($layout[$r][$c] == $element->name) 
                    {
                        $elementDictionary[$element->id] = true;
                        if($rowBegin == -1) $rowBegin = $r;
                        if($rowEnd < $r) $rowEnd = $r;
                        if($colBegin == -1) $colBegin = $c;
                        if($colEnd < $c) $colEnd = $c;
                    }
                }
            }

            $userID = auth()->user()->id;
            $style = 'display: none';
            if(isset($elementDictionary[$element->id])) 
            {
                $style = 'grid-row: ' . $rowBegin+1 . ' / ' . $rowEnd+2 . '; grid-column:' . $colBegin+1 . ' / ' . $colEnd+2;
            }
            $record = DB::table('user_dashboard_layouts')->where('user_id', '=', $userID)->where('element_id', '=', $element->id)->get();

            if($record->isEmpty()) 
            {
                DB::table('user_dashboard_layouts')->insert(
                    [
                        'user_id' => $userID,
                        'element_id' => $element->id,
                        'style' => $style
                    ]
                );
            }
            else 
            {
                DB::table('user_dashboard_layouts')->where('user_id', '=', $userID)->where('element_id', '=', $element->id)->update(
                    [
                        'user_id' => $userID,
                        'element_id' => $element->id,
                        'style' => $style
                    ]
                );
            }
        }

        return Redirect::route('settings')->with('status', 'Dashboard layout saved successfully!');
    }

    public function resetLayout() {
        $userID = auth()->user()->id;
        // Remove the existing styles
        DB::table('user_dashboard_layouts')->where('user_id', $userID)->delete();

        // Get Element IDs
        $themeMarketshare = DB::table('dashboard_elements')->where('name', '=', 'theme-marketshare')->first();
        $setPriceTable = DB::table('dashboard_elements')->where('name', '=', 'set-price-table')->first();
        $setPrices = DB::table('dashboard_elements')->where('name', '=', 'set-prices')->first();
        $themePrices = DB::table('dashboard_elements')->where('name', '=', 'theme-prices')->first();
        $subthemePrices = DB::table('dashboard_elements')->where('name', '=', 'subtheme-prices')->first();
        // Insert a base layout
        DB::table('user_dashboard_layouts')->insert(
            [
                'user_id' => $userID,
                'element_id' => $themeMarketshare->id,
                'style' => 'grid-row: 1 / 6; grid-column: 1 / 5'
            ]
        );

        DB::table('user_dashboard_layouts')->insert(
            [
                'user_id' => $userID,
                'element_id' => $setPriceTable->id,
                'style' => 'grid-row: 1 / 6; grid-column: 5 / 11'
            ]
        );

        DB::table('user_dashboard_layouts')->insert(
            [
                'user_id' => $userID,
                'element_id' => $setPrices->id,
                'style' => 'display: none'
            ]
        );

        DB::table('user_dashboard_layouts')->insert(
            [
                'user_id' => $userID,
                'element_id' => $themePrices->id,
                'style' => 'display: none'
            ]
        );

        DB::table('user_dashboard_layouts')->insert(
            [
                'user_id' => $userID,
                'element_id' => $subthemePrices->id,
                'style' => 'display: none'
            ]
        );


        return Redirect::route('settings')->with('status', 'Dashboard layout reset successfully!');
    }
}
