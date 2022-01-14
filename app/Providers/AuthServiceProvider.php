<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Services\PermissionsCheckAccess;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('QLDT', function (User $user) {
          return $user->checkPermissionAccess('QLDT');
        });

        Gate::define('Teachers', function (User $user) {
            return $user->checkPermissionAccess('Teachers');
          });
        //floder services class PermissionsCheckAccess
        // $gateandPolicy = new PermissionsCheckAccess();
        // $gateandPolicy->setGatePolicyAccess();
    }
}
