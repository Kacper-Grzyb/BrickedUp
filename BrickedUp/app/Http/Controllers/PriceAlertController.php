<?php

namespace App\Http\Controller;

use Illuminate\Http\Request;
use App\Models\PriceAlert;
use Illuminate\Support\Facades\Auth;

class PriceAlertController extends Controller
{
    public function store(Request $request)
    {

        $validated = $request->validate([
            'setName' => 'required|string|max:255',
            'targetPrice' => 'required|numeric|min:0',
        ]);

        $priceAlert = PriceAlert::create([
            'user_id' => Auth()::id(),
            'set_name' => $validated['setName'],
            'target_price' => $validated['targetPrice'],
        ]);

        if ($priceAlert){
            Notification::create([
                'user_id' => Auth::id(),
                'message' => "Price alert set for \"{$validated['setName']}\" at {$validated['targetPrice']}",
                'read' => false,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Price alert has been set successfully and a notification has been created.'
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Failed to set price alert.'
            ], 500);
        }
    }
}