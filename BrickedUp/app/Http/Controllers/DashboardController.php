<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Set;
use App\Models\SetPrice;
use DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index() {
        // Check if user has a pre-defined layout
        $userID = auth()->user()->id;
        
        // $layout = DB::table('user_dashboard_layouts')->where('user_id', '=', $userID)->get();
        // if($layout->isEmpty()) {
        //     // Get Element IDs
        //     $marketShareID = DB::table('dashboard_elements')->where('name', '=', 'marketshare')->get()->id;
        //     $priceUpdatesID = DB::table('dashboard_elements')->where('name', '=', 'price_updates')->get()->id;
        //     $setPricesID = DB::table('dashboard_elements')->where('name', '=', 'set_prices')->get()->id;
        //     // Insert a base layout
        //     DB::table('user_dashboard_layouts')->insert(
        //         [
        //             'user_id' => $userID,
        //             'element_id' => $marketShareID,
        //             'style' => 'gridRow: 1 / 4; gridColumn: 1 / 7'
        //         ],
        //         [
        //             'user_id' => $userID,
        //             'element_id' => $priceUpdatesID,
        //             'style' => 'gridRow: 1 / 6; gridColumn: 7 / 10'
        //         ],
        //         [
        //             'user_id' => $userID,
        //             'element_id' => $setPricesID,
        //             'style' => 'gridRow: 4 / 6; gridColumn: 1 / 7'
        //         ]
        //     );
        // }



        $sets = Set::with('theme')->get();
        $setPrices = SetPrice::orderBy('record_date', 'desc')->get();

        return view('home', ['setPrices' => $setPrices, 'sets' => $sets]);
    }

    public function editDashboard() {
        return view('edit-dashboard');
    }
}
