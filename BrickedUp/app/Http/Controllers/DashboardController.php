<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Set;
use App\Models\SetPrice;
use App\Models\DashboardElement;
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
            $marketShareEl = DB::table('dashboard_elements')->where('name', '=', 'marketshare')->first();
            $priceUpdatesEl = DB::table('dashboard_elements')->where('name', '=', 'price_updates')->first();
            $setPricesEl = DB::table('dashboard_elements')->where('name', '=', 'set_prices')->first();
            // Insert a base layout
            DB::table('user_dashboard_layouts')->insert(
                [
                    'user_id' => $userID,
                    'element_id' => $marketShareEl->id,
                    'style' => 'gridRow: 1 / 4; gridColumn: 1 / 7'
                ],
                [
                    'user_id' => $userID,
                    'element_id' => $priceUpdatesEl->id,
                    'style' => 'gridRow: 1 / 6; gridColumn: 7 / 10'
                ],
                [
                    'user_id' => $userID,
                    'element_id' => $setPricesEl->id,
                    'style' => 'gridRow: 4 / 6; gridColumn: 1 / 7'
                ]
            );
        }



        $sets = Set::with('theme')->get();
        $setPrices = SetPrice::with('set')->orderBy('record_date', 'desc')->get();

        return view('home', ['setPrices' => $setPrices, 'sets' => $sets]);
    }

    public function editDashboard() {
        $elements = DashboardElement::get();

        return view('edit-dashboard', ['dashboardElements' => $elements]);
    }
    
    public function saveLayout(Request $request) {
        $layout = json_decode($request->input('dashboardLayout'), true);
        $elements = DB::table('dashboard_elements')->get();
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
                        if($rowBegin == -1) $rowBegin = $r;
                        if($rowEnd < $r) $rowEnd = $r;
                        if($colBegin == -1) $colBegin = $c;
                        if($colEnd < $c) $colEnd = $c;
                    }
                }
            }

            $userID = auth()->user()->id;
            $record = DB::table('user_dashboard_layouts')->where('user_id', '=', $userID)->where('element_id', '=', $element->id)->get();
            if($record->isEmpty()) 
            {
                DB::table('user_dashboard_layouts')->insert(
                    [
                        'user_id' => $userID,
                        'element_id' => $element->id,
                        'style' => 'gridRow: {$rowBegin} / {$rowEnd+1}; gridColumn: {$colBegin} / {$colEnd+1}'
                    ]
                );
            }
            else 
            {
                DB::table('user_dashboard_layouts')->where('user_id', '=', $userID)->where('element_id', '=', $element->id)->update(
                    [
                        'user_id' => $userID,
                        'element_id' => $element->id,
                        'style' => 'gridRow:' . $rowBegin . '/' . $rowEnd+1 . '; gridColumn:' . $colBegin . '/' . $colEnd+1 . ';'
                    ]
                );
            }
        }

        return Redirect::route('settings')->with('status', 'Dashboard layout saved successfully!');
    }
}
