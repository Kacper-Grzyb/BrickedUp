<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    public function review() 
    {
        return $this->hasMany(Review::class);
    }

    public function favouriteSet() 
    {
        return $this->belongsToMany(User::class);
    }

    public function theme() 
    {
        return $this->belongsTo(Theme::class);
    }

    public function subtheme() 
    {
        return $this->belongsTo(Subtheme::class);
    }

    public function availability() 
    {
        return $this->belongsTo(Availability::class);
    }
}
