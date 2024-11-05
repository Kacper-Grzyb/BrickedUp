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
        return $this->belongsToMany(User::class, 'favourite_sets');
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

    public function setsSelectedForCharts() 
    {
        return $this->belongsToMany(User::class, 'sets_selected_for_charts')->withPivot('user_id');
    }

    public function setLink() 
    {
        return $this->hasMany(SetLink::class);
    }
    
    public function setImage() 
    {
        return  $this->hasMany(SetLink::class);
    }

    public function setPrice() 
    {
        return $this->hasMany(SetPrice::class);
    }

    public function reviews() 
    {
        return $this->hasMany(Review::class);
    }
}
