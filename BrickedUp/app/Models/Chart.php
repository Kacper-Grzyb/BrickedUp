<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    public function setSelectedForCharts() 
    {
        return $this->hasMany(SetSelectedForChart::class);
    }
}
