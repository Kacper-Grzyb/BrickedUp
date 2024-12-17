<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PriceAlert;
use Illuminate\Support\Facades\Auth;

class PriceAlertController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'setNumber' => 'required|numeric|min:0',
            'targetPrice' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated.'
            ], 401);
        }

        $priceAlert = PriceAlert::create([
            'user_id' => Auth::id(),
            'set_number' => $validated['setNumber'],
            'target_price' => $validated['targetPrice'],
        ]);

        if ($priceAlert) {
            return response()->json([
                'success' => true,
                'message' => 'Price alert has been set successfully.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to set price alert.'
            ], 500);
        }
    }
}