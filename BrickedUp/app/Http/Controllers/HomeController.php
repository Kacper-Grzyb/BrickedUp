<?php

namespace App\Http\Controllers;

use App\Models\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;

class HomeController extends Controller
{
    public function home()
        {
            $sets = Set::take(10)->get(); // Fetch all sets or apply necessary filters
            return view('home', compact('sets'));
        }
}
