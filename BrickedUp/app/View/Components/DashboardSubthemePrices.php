<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardSubthemePrices extends Component
{
    public $favouriteSubthemeValues;
    public $style;

    public function __construct($favouriteSubthemeValues, $style)
    {
        $this->favouriteSubthemeValues = $favouriteSubthemeValues;
        $this->style = $style;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard-subtheme-prices');
    }
}
