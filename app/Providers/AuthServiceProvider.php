<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;


use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


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
    public function boot(): void{
        $this->registerPolicies();

        Gate::before(function ($user, $ability){
            return $user->hasRole('admin') ? true : null;
        });

        // Permission::registerModel();

        // Role::registerModel();

    }
}