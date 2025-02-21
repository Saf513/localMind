<?php

namespace App\Models;

class Admin extends BaseUser
{
    protected $table = 'admins';

    protected $fillable = [
        'name',
        'email',
        'password',
        'access_level',
        'department',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->user_type = 'admin';
        });
    }

    public function hasAccessLevel($level)
    {
        return $this->access_level >= $level;
    }
}
