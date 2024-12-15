<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceAlert extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'set_name',
        'target_price'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
