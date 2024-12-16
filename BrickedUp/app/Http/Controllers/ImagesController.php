<?php

namespace App\Http\Controllers;

use App\Models\Set;
use Illuminate\Http\Request;


class ImagesController extends Controller
{
    public function setImages()
    {
        $sets = Set::with(['setImage', 'thumbnail'])->orderBy('set_number')->get();
        //debug because aaaaaaaa
        //dd($sets->toArray());

        return view('profile.profile', compact('sets'));
    }

    public function thumbnail()
    {
        $sets = Set::with('setImage')->orderBy('set_number')->get();
        return view('explore', compact('sets'));
    }

}