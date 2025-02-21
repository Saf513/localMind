<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['user_id', 'question_id'];

    public function user()
    {
        return $this->belongsTo(RegularUser::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
