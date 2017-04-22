<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use App\Http\Controllers\Auth\PermissionController;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @param GateContract $gate
     * @param PermissionController $permissionController
     * @return void
     */
    public function boot(GateContract $gate, PermissionController $permissionController)
    {
        $this->registerPolicies();
    }
}


// todo:  refactoring this controller, and remove the codes which are not used to keep the code clean.
//public function boot(GateContract $gate, PermissionController $permissionController)
//{
//    $this->registerPolicies();
    //$gate->before(function ($user, $ability) {
//    return $user->isSuperAdmin();
//});
//
//
//if (Schema::hasTable('permissions')) {
//    foreach ($permissionController->getPermissions() as $permission) {
//        $gate->define($permission->name, function ($user) use ($permission) {
//            return $user->hasRole($permission->roles);
//        });
//    }
//}
//
//$gate->define('behave-sales', function () {
//    if (!auth()->check()) {
//        return false;
//    }
//
//    return auth()->user()->isAnActivatedSales();
//});
//}




