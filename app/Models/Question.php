<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'user_id', 
        'title', 
        'content', 
        'latitude', 
        'longitude', 
        'location_name'
    ];
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    
    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Méthode pour formater la localisation
    public function getFormattedLocationAttribute()
    {
        if ($this->latitude && $this->longitude) {
            return $this->location_name ?? 
                   "Lat: {$this->latitude}, Lon: {$this->longitude}";
        }
        return 'Localisation non spécifiée';
    }
}