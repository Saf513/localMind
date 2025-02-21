<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\RegularUser;
use App\Models\Admin;

class QuestionPolicy
{
    public function update($user, Question $question)
    {
        return $user->id === $question->user_id || $user instanceof Admin;
    }

    public function delete($user, Question $question)
    {
        return $user->id === $question->user_id || $user instanceof Admin;
    }

    public function favorite($user, Question $question)
    {
        return true; // Tout utilisateur connecté peut mettre en favori
    }
}
