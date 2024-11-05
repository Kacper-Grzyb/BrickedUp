<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    public function set() 
    {
        return $this->hasMany(Set::class);
    }

    public function favouriteTheme() 
    {
        return $this->hasMany(FavouriteTheme::class);
    }
}
