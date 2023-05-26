<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        Gate::define('admin-1', function(User $user){
            return $user->admin == 1;
        });

        Gate::define('admin-2', function(User $user){
            return $user->admin == 2;
        });

        Gate::define('admin-3', function(User $user){
            return $user->admin == 3;
        });

        Gate::define('manager-users', function (User $user) {
            return $user->admin == 1 || $user->admin == 2;
        });

        Gate::define('manager-lawyer', function(User $user){
            return $user->admin == 1 || $user->admin == 2 || $user->admin == 3;
        });

        Gate::define('restrict-page', function(User $user){
            return $user->admin != 3;
        });
    }
}
