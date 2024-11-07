<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouriteSubtheme extends Model
{
    public function subtheme() 
    {
        return $this->belongsTo(Subtheme::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
