<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PriceAlert;
use App\Models\Notifications;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class CheckPriceAlerts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'price-alerts:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check all price alerts and notify users if conditions are met';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //I have to create a function to get the current price
        $currentPrices = $this->getCurrentPrices();

        $priceAlerts = PriceAlert::all();

        foreach ($priceAlerts as $alert){
            $setName = $alert->set_name;
            $targetPrice = $alert->target_price;

            if(!isset($currentPrices[$setName])){
                Log::warning("Current price for set '{$setName}' not found.");
                continue;
            }

            $currentPrice = $currentPrices[$setName];

            if ($currentPrice >= $targetPrice){
                Notification::create([
                    'user_id' => $alert->user_id,
                    'message' => "Your price alert for '{$setName}' has been triggered! Current price: $" . number_format($currentPrice, 2),
                ]);

                $alert->delete();
            }
        }

        $this->info('Price alerts checked successfully.');

        return 0;
    }

    protected function getCurrentPrices()
    {
        // Example data
        return [
            'Cloud City' => 6000.00,
            'Another Set' => 500.00,
            // Add more sets and their current prices
        ];
    }
}
