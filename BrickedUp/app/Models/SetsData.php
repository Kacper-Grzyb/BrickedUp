<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetsData extends Model
{
    use HasFactory;

    protected $table = 'sets';

    protected $fillable = [
        'set_number',
        'set_name',
        'theme_id',
        'subtheme_id',
        'release_date',
        'retired_date',
        'availability_id',
        'piece_count',
        'minifigures',
        'retail_price',
        'popularity'
    ];

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    public function availability()
    {
        return $this->belongsTo(Availability::class, 'availability_id');
    }

}
