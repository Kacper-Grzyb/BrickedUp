<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetSelectedForChart extends Model
{
    public function chart() 
    {
        return $this->belongsTo(Chart::class);
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function set() 
    {
        return $this->belongsTo(Set::class);
    }
}
