<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtheme extends Model
{
    public function set() 
    {
        return $this->hasMany(Set::class);
    }

    public function favouriteSubtheme() 
    {
        return $this->hasMany(FavouriteSubtheme::class);
    }
}
