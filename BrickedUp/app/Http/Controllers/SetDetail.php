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

class SetDetail extends Controller
{
    public function SetDetail($set_number)
    {
        $set = Set::where('set_number', $set_number)->first();
        $lastPrice = SetPrice::where('set_number', $set_number)->first();
        $theme = Theme::where('theme', $set->theme->theme ?? 'None')->first();
        $subtheme = Subtheme::where('subtheme', $set->subtheme->subtheme ?? 'None')->first();
        $image = SetImage::where('set_number', $set_number)->value('image_data');
        $prices = SetPrice::where('set_number', $set_number)->orderBy('record_date')->get(['record_date', 'price']);

        return view('set-details', ["setdetail" => $set, "prices" => $prices, "theme" => $theme, "subtheme" => $subtheme, "image" => $image, "lastPrice" => $lastPrice]);
    }
}
