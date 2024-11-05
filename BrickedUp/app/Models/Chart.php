<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    public function setsSelectedForCharts() 
    {
        return $this->belongsToMany(User::class, 'sets_selected_for_charts')->withPivot('chart_id');
    }
}
