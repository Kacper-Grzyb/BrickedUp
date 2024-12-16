<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Set;


class SetImage extends Model
{
    public function set()
    {
        return $this->belongsTo(Set::class, 'set_number', 'set_number');
    }
}
