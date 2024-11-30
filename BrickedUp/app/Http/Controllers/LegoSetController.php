<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Set;

class LegoSetController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $results = Set::whereRaw('LOWER(set_name) LIKE ?', ['%' . strtolower($query) . '%'])->limit(10)->get();

        return response()->json($results);
    }
}