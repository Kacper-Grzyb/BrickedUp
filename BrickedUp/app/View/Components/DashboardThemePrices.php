<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardThemePrices extends Component
{
    public $favouriteThemeValues;
    public $style;

    public function __construct($favouriteThemeValues, $style)
    {
        $this->favouriteThemeValues = $favouriteThemeValues;
        $this->style = $style;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard-theme-prices');
    }
}
