<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('admin-access', function ($user) {
            return $user->role === 1;
        });
        Gate::define('staff-access', function ($user) {
            return $user->role === 0;
        });
        Gate::define('incharge-access', function ($user) {
            return $user->role === 2;
        });
    }
}
