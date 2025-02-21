<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RegularUser extends BaseUser
{
    protected $table = 'regular_users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'last_latitude',
        'last_longitude',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'last_latitude' => 'float',
        'last_longitude' => 'float',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->user_type = 'regular';
        });
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'user_id');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class, 'user_id');
    }

    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'favorites', 'user_id')
                    ->withTimestamps();
    }

    public function updateLocation($latitude, $longitude)
    {
        $this->update([
            'last_latitude' => $latitude,
            'last_longitude' => $longitude,
        ]);
    }
   
}
