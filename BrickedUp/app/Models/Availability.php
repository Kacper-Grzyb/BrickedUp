<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    protected $table = 'availability';
    public function set() 
    {
        return $this->hasMany(Set::class);
    }
}
