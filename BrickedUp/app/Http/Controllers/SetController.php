<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Set;
use DB;
use Illuminate\Support\Facades\Log;

class SetController extends Controller
{
    public function fullGraph()
    {
        $sets = Set::with('theme')->get();
        return view('full-graph', compact('sets'));
    }

}
