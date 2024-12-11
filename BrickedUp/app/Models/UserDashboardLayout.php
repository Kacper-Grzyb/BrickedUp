<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDashboardLayout extends Model
{
    use HasFactory;

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function element() 
    {
        return $this->belongsTo(DashboardElement::class);
    }
}
