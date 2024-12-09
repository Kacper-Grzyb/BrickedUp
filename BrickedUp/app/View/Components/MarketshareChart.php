<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MarketshareChart extends Component
{
    public $sets;
    public $style;

    public function __construct($sets, $style)
    {   
        $this->sets = $sets;
        $this->style = $style;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.marketshare-chart');
    }
}
