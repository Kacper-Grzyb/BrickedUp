<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouriteSet extends Model
{
    protected $fillable = ['user_id', 'set_number'];
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = ['user_id', 'set_number'];

    public function set()
    {
        return $this->belongsTo(Set::class, 'set_number', 'set_number');
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
