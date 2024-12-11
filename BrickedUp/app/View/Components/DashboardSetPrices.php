<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardSetPrices extends Component
{
    public $favouriteSetPriceRecords;
    public $style;

    public function __construct($favouriteSetPriceRecords, $style)
    {
        $this->favouriteSetPriceRecords = $favouriteSetPriceRecords;
        $this->style = $style;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard-set-prices');
    }
}
