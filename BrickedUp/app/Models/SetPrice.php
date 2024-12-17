<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetPrice extends Model
{
    // Disable timestamps
    public $timestamps = false;

    protected $primaryKey = 'set_number';

    public $incrementing = false;

    protected $keyType = 'string';

    // Define fillable fields if required
    protected $fillable = ['set_number', 'record_date', 'price'];

    public function set() 
    {
        return $this->belongsTo(Set::class, 'set_number', 'set_number');
    }    
}
