<?php

namespace App\Providers;

use Acme\Auth\LaravelSocialiteGateway;
use Acme\Auth\SocialiteGateway;
use App\Models\Tag;
use App\Models\SystemConfig;
use App\Models\Marketing\Faq;
use App\Models\Product\AddOn;
use App\Models\Product\Group;
use App\Models\Authorization\Role;
use App\Models\Product\AddOnOption;
use App\Models\Product\GroupCategory;
use Illuminate\Support\ServiceProvider;
use App\Models\Product\GroupSubCategory;
use App\Models\Authorization\Permission;
use App\Http\Controllers\Admin\NewsController;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /***  Left Menu Show 設定***/
        view()->composer(['admin.layouts.default'], function ($view) {
            $view->with('left_menu_show', session('left_menu_show'));
        });
    }

    /**
     * Register any application services.
     *view()->composer(['admin.layouts.default'], function ($view) {
    $view->with('left_menu_show', session('left_menu_show'));
    });
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
    }
}


















///***  Left Menu Show 設定***/
//        /*** News list on the right side*****/
//        view()->composer(['frontEnd.partials._newsRightSide'], function ($view) {
//            $view->with('hotNewss', NewsController::getHotNewslist());
//            $view->with('recentNewss', NewsController::getRecentNewslist());
//        });
//
//        /***  關鍵字****/
//        view()->composer(['admin.videos._form', 'admin.talk._form'], function ($view) {
//            $view->with('tags', Tag::lists('name', 'id'));
//        });
//
//        /***  權限清單****/
//        view()->composer(['admin.auth.role._form'], function ($view) {
//            $view->with('permissionList', Permission::generatePermissionListWithCat());
//        });
//
//        /***  使用者管理****/
//        view()->composer(['admin.user._form'], function ($view) {
//            $view->with('roleList', Role::getRoleList());
//        });
//
//
//        /**** 系列產品管理******/
//        view()->composer([
//            'admin.product.group.production._form',
//            'admin.product.group._form',
//            'admin.product.group.create',
//            'admin.product.group._groupSearch'], function ($view) {
//            $view->with('add_ons', AddOn::lists('title', 'id'));
//            $view->with('categories', GroupCategory::lists('title', 'id'));
//            $view->with('subCategories', GroupSubCategory::where('group_category_id', 1)->lists('title', 'id'));
//        });
//
//        view()->composer(['admin.product.group.mgnt_navbar'], function ($view) {
//            $view->with('group_category_list', GroupCategory::getGroupCategoryList());
//        });
//
//        /***** 加工配件管理*******/
//        view()->composer(['admin.product.addOn._form'], function ($view) {
//            $view->with('add_on_option_list', AddOnOption::lists('title', 'id'));
//        });
//
//        view()->composer(['admin.product.addOn._form'], function ($view) {
//            $view->with('add_on_options', AddOnOption::lists('title', 'id'));
//        });
//
//        /******* 產品管理*******/
//        view()->composer(['admin.product.product._form', 'admin.product.product.create', 'admin.product.product._productSearch'], function ($view) {
//            $view->with('group_list', Group::getGroupList());
//            $view->with('search_group_list', Group::getGroupList());
//        });
//
//        /******* 常見問題管理*******/
//        view()->composer(['admin.faq._faqSearch', 'frontEnd.customerServices.faqList'], function ($view) {
//            $view->with('faqCat_list', Faq::getCatList());
//        });

//        /**  前台管理**********************/
//        /** **  產品清單   *****/
//        view()->composer(['frontEnd.products.partials._groupSelectionList'], function ($view) {
//            $view->with('groupCategories_forSelection', GroupCategory::all());
//        });
//
//
//        $this->app->bind(SocialiteGateway::class, function () {
//            return new LaravelSocialiteGateway;
//        });


