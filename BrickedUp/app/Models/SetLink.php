<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetLink extends Model
{
    public function set() 
    {
        return $this->belongsTo(Set::class);
    }
}
