<?php

namespace App\View\Components;

use App\Models\Set;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use DB;

class Navbar extends Component
{
    public $sets;
    public $currentPage;

    /**
     * Create a new component instance.
     */
    public function __construct($currentPage)
    {
        $this->currentPage = $currentPage;
        // Always make sure the total width of elements in the navbar is larger than the website screen width
        // for the scrollbar animation to function correctly
        $sets = Set::select('*')->limit(20)->get();
        $this->sets = $sets;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar', ['sets' => $this->sets]);
    }
}
