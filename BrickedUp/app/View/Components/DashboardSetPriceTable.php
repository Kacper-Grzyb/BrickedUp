<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardSetPriceTable extends Component
{
    public $setPrices;
    public $displayAmount;
    public $style;

    public function __construct($setPrices, $displayAmount, $style)
    {
        $this->setPrices = $setPrices;
        $this->displayAmount = $displayAmount;
        $this->style = $style;
    }

    public function render(): View|Closure|string
    {
        return view('components.dashboard-set-price-table');
    }
}
