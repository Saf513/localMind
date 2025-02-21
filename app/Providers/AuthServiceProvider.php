<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Question;
use App\Models\Response;
use App\Policies\QuestionPolicy;
use App\Policies\ResponsePolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Question::class => QuestionPolicy::class,
        Response::class => ResponsePolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}