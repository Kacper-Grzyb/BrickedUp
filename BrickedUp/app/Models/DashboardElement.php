<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardElement extends Model
{
    use HasFactory;

    public function usedInLayout() {
        return $this->hasMany(UserDashboardLayout::class);
    }
}
