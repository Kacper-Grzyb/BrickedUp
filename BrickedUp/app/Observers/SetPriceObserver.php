<?php

namespace App\Observers;

use App\Models\SetPrice;
use App\Models\PriceAlert;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;

class SetPriceObserver
{
    public function created(SetPrice $setPrice)
    {
        $this->checkPriceAlerts($setPrice);
    }

    public function updated(SetPrice $setPrice)
    {
        $this->checkPriceAlerts($setPrice);
    }

    protected function checkPriceAlerts(SetPrice $setPrice)
    {
        $triggeredAlerts = PriceAlert::where('set_number', $setPrice->set_number)
            ->where(function($query) use ($setPrice) {
                $query->where('target_price', '<=', $setPrice->price)
                      ->orWhere('target_price', '>=', $setPrice->price);
            })
            ->get();
    

        foreach ($triggeredAlerts as $alert) {
            Notification::create([
                'user_id' => $alert->user_id,
                'message' => "The price for set #{$alert->set_number} has reached your target of \${$alert->target_price}. Current price: \${$setPrice->price}.",
                'read' => false,
            ]);

            Log::info("Notification created for user_id: {$alert->user_id} for set_number: {$alert->set_number}");

            $alert->delete();
        }
    }
}
