<?php

namespace App\Policies;

use App\Models\Response;
use App\Models\RegularUser;
use App\Models\Admin;

class ResponsePolicy
{
    public function update($user, Response $response)
    {
        return $user->id === $response->user_id || $user instanceof Admin;
    }

    public function delete($user, Response $response)
    {
        return $user->id === $response->user_id || 
               $user->id === $response->question->user_id || 
               $user instanceof Admin;
    }
}