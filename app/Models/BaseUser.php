<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

 class BaseUser extends Authenticatable
{
    protected $primaryKey = 'id'; // Si votre colonne de clé primaire est "id"

    use HasApiTokens, Notifiable,HasFactory;
    public function getKey()
    {
        return $this->attributes['id']; // Si votre clé primaire est 'id'
    }
    
    protected $table = 'base_users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
