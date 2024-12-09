<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PriceUpdates extends Component
{
    public $setPrices;
    public $style;

    public function __construct($setPrices, $style)
    {
        $this->setPrices = $setPrices;
        $this->style = $style;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.price-updates');
    }
}
