<?php

namespace App\Http\Controllers;

use App\Models\Set;
use App\Models\SetImage;
use App\Models\SetPrice;
use App\Models\Subtheme;
use App\Models\Theme;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;

use function Laravel\Prompts\alert;

class SetDetailCon extends Controller
{
    public function Detail($set_number)
    {
        $set = Set::where('set_number', $set_number)->first();
        $prices = SetPrice::where('set_number', $set_number)->first();
        $theme = Theme::where('theme', $set->theme->theme ?? 'None')->first();
        $subtheme = Subtheme::where('subtheme', $set->subtheme->subtheme ?? 'None')->first();
        $image = SetImage::where('set_number', $set_number->set_image ?? 'no image found')->first();

        return view('set-details', ["setdetail" => $set, "prices" => $prices, "theme" => $theme, "subtheme" => $subtheme]);
    }
}
