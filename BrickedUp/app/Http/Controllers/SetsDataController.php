<?php

namespace App\Http\Controllers;
use App\Models\SetsData;
use Illuminate\Http\Request;

class SetsDataController extends Controller
{
    public function index()
    {
        $sets = SetsData::with('theme', 'availability')
            ->select(['set_number', 'set_name', 'retired_date', 'piece_count', 'retail_price', 'theme_id', 'availability_id'])
            ->paginate(10);  

        
        
        return view('explore', compact('sets'));
    }


}
