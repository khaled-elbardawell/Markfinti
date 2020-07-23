<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
         'App\User' => 'App\Policies\managerPolicy',
         'App\Project' => 'App\Policies\projectPolicy',
         'App\Report' => 'App\Policies\reportPolicy',
         'App\Progress' => 'App\Policies\progressPolicy',
         'App\Service' => 'App\Policies\servicePolicy',
         'App\TypeReport' => 'App\Policies\typereportPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


    }
}
