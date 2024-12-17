<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function review() 
    {
        return $this->hasMany(Review::class);
    }

    public function favouriteSet() 
    {
        return $this->hasMany(FavouriteSet::class);
    }

    public function favouriteTheme() 
    {
        return $this->belongsToMany(FavouriteTheme::class, 'favourite_themes', 'user_id', 'theme_id');
    }

    public function favouriteSubtheme() 
    {
        return $this->belongsToMany(FavouriteSubtheme::class, 'favourite_subthemes', 'user_id', 'subtheme_id');
    }

    public function setSelectedForCharts() 
    {
        return $this->hasMany(SetSelectedForChart::class);
    }

    public function dashboardLayouts() {
        return $this->hasMany(UserDashboardLayout::class);
    }
}
