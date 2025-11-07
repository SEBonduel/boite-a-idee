<?php

namespace App\Providers;

use App\Models\Idea;
use App\Policies\IdeaPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Idea::class => IdeaPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
    