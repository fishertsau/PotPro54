<?php
/**
 * model binding into route
 */
//Route::model('user', 'App\User');


/**** 靜態內容 ****/
Route::group(['middleware' => ['web']], function () {
    //首頁
    Route::get('/', ['as' => 'home', 'uses' => 'FrontEnd\HomeController@home']);

    //關於我們
    Route::get('aboutUs', 'FrontEnd\SiteContentController@aboutUs');

    //日常瓦斯節能   //節能鍋原理
    Route::get('gasSavingInLivingEnvironment', 'FrontEnd\SiteContentController@lifeGasSaving')->name('siteContent.gasSaving');
    Route::get('gasSavingDesignPrinciple', 'FrontEnd\SiteContentController@gasSavingDesignPrinciple')->name('siteContent.gasSavingDesignPrinciple');

    //聯絡我們
    Route::get('contactUs', 'FrontEnd\ContactUsController@showContactForm');
    Route::post('contactUs', ['as' => 'sendContactUsForm', 'uses' => 'FrontEnd\ContactUsController@sendContactMessage']);

    //服務條款
    Route::get('terms/{ref}', 'FrontEnd\SiteContentController@showTerms');
});

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {
    /*網站內容設定*/
//    Route::resource('siteContent', 'Admin\SiteContentController');
});


/**** 成為經銷商 ****/
Route::group(['middleware' => ['web']], function () {
    //成為經銷商
    Route::get('becomeReseller', 'FrontEnd\ResellerController@becomeReseller');
//    Route::post('becomeReseller', 'FrontEnd\ResellerController@applyForReseller');
});


/**** 影音中心/影音管理 ****/
Route::group(['middleware' => ['web']], function () {
    Route::resource('videos', 'FrontEnd\VideosController');
});

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {
    Route::get('/videos', 'Admin\VideosController@index')->name('admin.videoIndex');
    Route::post('/videos', 'Admin\VideosController@store')->name('admin.videoCreate');
    Route::get('videos/create', 'Admin\VideosController@create')->name('admin.videoCreateForm');
    Route::get('/videos/{video}', 'Admin\VideosController@show');
    Route::post('videos', 'Admin\VideosController@store');
    Route::post('videos/list/paginated', 'Admin\VideosController@getList');

//    Route::get('video/{id}/delete', array('as' => 'admin.video.delete', 'uses' => 'Admin\VideoController@getDelete'));
//    Route::get('video/{id}/confirm-delete', array('as' => 'admin.video.confirm-delete', 'uses' => 'Admin\VideoController@getModalDelete'));
});


/**** 產品管理 ****/
Route::group(['middleware' => ['web']], function () {
    //產品介紹
//    Route::resource('/group', 'FrontEnd\GroupController');
//    Route::post('/product/favorite/{action}/{id}', 'FrontEnd\GroupController@addProductToFavorite');
//    Route::get('/product/search', 'FrontEnd\GroupController@productSearch');
//    Route::get('/product/{slug}', 'FrontEnd\GroupController@productDetail');
//    Route::get('/product', 'FrontEnd\GroupController@productList');
});


Route::group(['prefix' => 'admin', 'middleware' => ['web']], function () {

    Route::group(['prefix' => 'product'], function () {
        //單一產品
        Route::get('products/{product}/edit', 'Admin\Product\ProductController@edit')->name('admin.products.edit');
        Route::post('products/list', 'Admin\Product\ProductController@getList')->name('admin.products.list');
        Route::get('products/create', 'Admin\Product\ProductController@create')->name('admin.products.create');
        Route::put('products/{product}', 'Admin\Product\ProductController@update')->name('admin.products.update');
        Route::post('products', 'Admin\Product\ProductController@store')->name('admin.products.store');
        Route::get('products', 'Admin\Product\ProductController@index')->name('admin.products.index');
        Route::get('products/{product}', 'Admin\Product\ProductController@show')->name('admin.products.show');

//        Route::get('/product/listExcel', ['as' => 'productExcelFile', 'uses' => 'Admin\Product\ProductController@makeExcelList']);
//        Route::get('/product/{id}/delete', array('as' => 'admin.product.product.delete', 'uses' => 'Admin\Product\ProductController@getDelete'));
//        Route::get('/product/{id}/confirm-delete', array('as' => 'admin.product.product.confirm-delete', 'uses' => 'Admin\Product\ProductController@getModalDelete'));


        //產品系列
        Route::get('groups/{group}/edit', 'Admin\Product\GroupController@edit')->name('admin.groups.edit');
        Route::get('groups/create', 'Admin\Product\GroupController@create')->name('admin.groups.create');
        Route::post('groups', 'Admin\Product\GroupController@store')->name('admin.groups.store');
        Route::get('groups', 'Admin\Product\GroupController@index')->name('admin.groups.index');
        Route::put('groups/{group}', 'Admin\Product\GroupController@update')->name('admin.groups.update');
        Route::get('groups/{group}', 'Admin\Product\GroupController@show')->name('admin.groups.show');
        Route::post('groups/list', 'Admin\Product\GroupController@getList')->name('admin.groups.list');

//        Route::get('/group/production/setting/{group}', 'Admin\Product\GroupController@productionSetting');
//        Route::patch('/group/production/setting/{group}', 'Admin\Product\GroupController@updateProductionSetting');
//        Route::get('/group/list', 'Admin\Product\GroupController@makeList');
//        Route::resource('/group', 'Admin\Product\GroupController');

        //加工配件
        Route::get('addons/{addon}/edit', 'Admin\Product\AddOnController@edit')->name('admin.addons.edit');
        Route::get('addons/create', 'Admin\Product\AddOnController@create')->name('admin.addons.create');
        Route::post('addons', 'Admin\Product\AddOnController@store')->name('admin.addons.store');
        Route::get('addons', 'Admin\Product\AddOnController@index')->name('admin.addons.index');
        Route::put('addons/{addon}', 'Admin\Product\AddOnController@update')->name('admin.addons.update');
        Route::get('addons/{addon}', 'Admin\Product\AddOnController@show')->name('admin.addons.show');


        //加工配件選項
        Route::get('addonOptions/{addOnOption}/edit', 'Admin\Product\AddOnOptionController@edit')->name('admin.addonOptions.edit');
        Route::get('addonOptions/create', 'Admin\Product\AddOnOptionController@create')->name('admin.addonOptions.create');
        Route::post('addonOptions', 'Admin\Product\AddOnOptionController@store')->name('admin.addonOptions.store');
        Route::get('addonOptions', 'Admin\Product\AddOnOptionController@index')->name('admin.addonOptions.index');
        Route::put('addonOptions/{addOnOption}', 'Admin\Product\AddOnOptionController@update')->name('admin.addonOptions.update');
        Route::get('addonOptions/{addOnOption}', 'Admin\Product\AddOnOptionController@show')->name('admin.addonOptions.show');

//        Route::resource('/addOnOption', 'Admin\Product\AddOnOptionController');
//        Route::get('/addOnOption/{id}/delete', array('as' => 'admin.product.addOnOption.delete', 'uses' => 'Admin\Product\AddOnOptionController@getDelete'));
//        Route::get('/addOnOption/{id}/confirm-delete', array('as' => 'admin.product.addOnOption.confirm-delete', 'uses' => 'Admin\Product\AddOnOptionController@getModalDelete'));
    });
});


/**** 購物車管理 ****/
Route::group(['middleware' => ['web']], function () {
    Route::post('cart', 'FrontEnd\Cart\CartController@store')->name('cart.addProduct');
    Route::delete('cart/{rowId}/delete', 'FrontEnd\Cart\CartController@destroy')->name('cart.removeItem');

    //配件設定
    Route::get('addOn/edit', 'FrontEnd\Cart\AddOnController@edit');
//    Route::post('addOn/update', 'FrontEnd\Cart\AddOnController@update');
    Route::post('addOn', 'FrontEnd\Cart\AddOnController@store')->name('cart.addAddon');
});


/**** 通路管理 ****/
Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {
    Route::get('channels/{userId}/edit', 'Admin\Channel\ChannelController@edit')->name('admin.channels.edit');
    Route::get('channels', 'Admin\Channel\ChannelController@index')->name('admin.channels.index');
    Route::get('channels/create', 'Admin\Channel\ChannelController@create')->name('admin.channels.create');
    Route::post('channels', 'Admin\Channel\ChannelController@store')->name('admin.channels.store');
    Route::put('channels/{userId}', 'Admin\Channel\ChannelController@update')->name('admin.channels.update');
//    Route::get('sales/listSimple', 'Admin\Channel\SalesController@makeListSimple');
//    Route::get('sales/list', 'Admin\Channel\SalesController@makeList');
//    Route::resource('sales', 'Admin\Channel\SalesController');
});



/******** 前台管理  frontEnd  API **********************/
Route::group(['middleware' => ['web']], function () {
    //用戶管理
    Route::get('my-account', 'FrontEnd\UserController@show');
    Route::resource('user', 'FrontEnd\UserController');

    //經銷專區
    Route::get('sales/order/list', 'FrontEnd\Sales\SalesOrderController@makeList');
    Route::get('sales/example/list', 'FrontEnd\Sales\SalesExampleController@makeList');
    Route::resource('sales/example', 'FrontEnd\Sales\SalesExampleController');
    Route::resource('sales', 'FrontEnd\Sales\SalesAccountController');


    //訂單與控制
    Route::get('order', 'FrontEnd\Cart\OrderController@index');
    Route::post('order', 'FrontEnd\Cart\OrderController@store');



    //案例管理
    Route::resource('/example', 'FrontEnd\ExampleController');

    //最新消息
    Route::resource('news', 'FrontEnd\NewsController');

    //演講與推廣
    Route::resource('talk', 'FrontEnd\TalkController');

    //常見問題
    Route::get('faq', 'FrontEnd\FaqController@index');

});


/******** 後臺管理  Administrator  API **********************/
Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {

    Route::get('/', array('as' => 'dashboard', 'uses' => 'Admin\HomeController@showDashboard'));

    /* 系統設定 */
    Route::get('/systemConfig', 'Admin\System_configsController@editSystemConfig');
    Route::post('/systemConfig', 'Admin\System_configsController@update');

    /* 待辦事項*/
    Route::resource('todo', 'Admin\TodoController');
    Route::get('todo/command/{todo}/{action}', 'Admin\TodoController@processCommand');

    /*訂單管理*/
    Route::get('order/listExcel', 'Admin\OrderController@makeExcelList');
    Route::get('order/list', 'Admin\OrderController@makeList');
    Route::get('order/nextMove/{action}/{order}', ['as' => 'orderNextMove', 'uses' => 'Admin\OrderController@nextMoveForm']); //get the form needed for next action
    Route::post('order/nextMove/{action}/{order}', 'Admin\OrderController@nextMove'); //post the form to take steps for the action
    Route::resource('order', 'Admin\OrderController');

    /* 常見問題 */
    Route::get('faq/list', 'Admin\FaqController@makeList');
    Route::resource('faq', 'Admin\FaqController');
    Route::get('faq/{id}/delete', array('as' => 'admin.faq.delete', 'uses' => 'FaqController@getDelete'));
    Route::get('faq/{id}/confirm-delete', array('as' => 'admin.faq.confirm-delete', 'uses' => 'FaqController@getModalDelete'));


    /*消息廣告管理*/
    Route::get('news/list', 'Admin\NewsController@makeNewsList');
    Route::resource('news', 'Admin\NewsController');
    Route::get('news/{news}/delete', array('as' => 'admin.news.delete', 'uses' => 'Admin\NewsController@getDelete'));
    Route::get('news/{news}/confirm-delete', array('as' => 'admin.news.confirm-delete', 'uses' => 'Admin\NewsController@getModalDelete'));

    /*演講與推廣管理*/
    Route::resource('talk', 'Admin\TalkController');
    Route::get('talk/{id}/delete', array('as' => 'admin.talk.delete', 'uses' => 'Admin\TalkController@getDelete'));
    Route::get('talk/{id}/confirm-delete', array('as' => 'admin.talk.confirm-delete', 'uses' => 'Admin\TalkController@getModalDelete'));

    /*節能案例管理*/
    Route::get('example/list', 'Admin\Example\ExampleController@makeList');
    Route::resource('example', 'Admin\Example\ExampleController');
    Route::get('example/{id}/delete', array('as' => 'admin.example.delete', 'uses' => 'Admin\Example\ExampleController@getDelete'));
    Route::get('example/{id}/confirm-delete', array('as' => 'admin.example.confirm-delete', 'uses' => 'Admin\Example\ExampleController@getModalDelete'));


    # User Management
    Route::group(array('prefix' => 'user'), function () {
        Route::get('profile/{user}', ['as' => 'userProfile', 'uses' => 'Admin\UserController@personalProfile']);
        Route::post('profile/{user}', ['as' => 'updateUserProfile', 'uses' => 'Admin\UserController@updatePersonalInfo']);
        Route::get('list', 'Admin\UserController@makeUserList');
        Route::get('listSimple', 'Admin\UserController@makeUserListSimple');

        Route::get('{userId}/confirm-delete', array('as' => 'confirm-delete/user', 'uses' => 'Admin\UserController@getModalDelete'));
        Route::get('{userId}/restore', array('as' => 'restore/user', 'uses' => 'Admin\UserController@getRestore'));
    });
    Route::resource('user', 'Admin\UserController');

    /** ajax功能 ****/
    Route::get('ajax/{command}/{data?}', 'Admin\AjaxController@getHandler');
    Route::post('ajax/{command}/{data?}', 'Admin\AjaxController@postHandler');
});

Route::group(['middleware' => ['web']], function () {
    # Error pages should be shown without requiring login
    Route::get('404', function () {
        return View('admin/404');
    });
    Route::get('500', function () {
        return View::make('admin/500');
    });

    /*** 控制 Left Menu [功能區] 是否關閉或開啟****/
    Route::post('adminLeftMenuShowOrHideSetting', 'Admin\AjaxController@changeLeftMenuVisibilitySetting');
});


/**************綜合功能  ********************/
Route::group(['middleware' => 'web'], function () {
    /** 圖片處理 **/
    //主要圖片
//    Route::patch('/coverPhoto/{table}/{id}', 'PhotoController@saveCoverPhotoAjax');
    Route::post('/coverPhoto/{table}/{id}', 'PhotoController@saveCoverPhotoAjax');
    Route::delete('/coverPhoto/{table}/{id}/{field?}', 'PhotoController@deleteCoverPhoto');

    //一般圖片
    Route::post('photos/{model}/{id}', ['as' => 'store_single_photo_route', 'uses' => 'PhotoController@store']);//儲存圖片
    Route::delete('/photo/{id}', 'PhotoController@destroy');//刪除圖片

    /** ajax功能 ****/
    Route::get('/addOnOption/getAddOnOptionSetting', 'Admin\Product\AddOnOptionController@getAddOnOptionSettingArray');
    Route::get('/getGroupSubCategoryList', 'Admin\Product\GroupController@getGroupSubCategoryList');
});


/************ Auth Controller *******************/
Route::group(['middleware' => 'web',
    ['except' => ['confirmEmail']]], function () {
    Auth::routes();
//    Route::auth();
    // Authentication Routes...
//    Route::get('login', 'Auth\AuthController@showLoginForm');
//    Route::post('login', 'Auth\AuthController@login');
//    Route::get('logout', 'Auth\AuthController@getLogout');

    // Email Confirmation Routes...
//    Route::get('email/confirm/{token}', ['as' => 'confirmEmail', 'uses' => 'Auth\EmailConfirmationController@confirmEmail']);
//    Route::get('email/confirm', ['as' => 'showEmailConfirmForm', 'uses' => 'Auth\EmailConfirmationController@showEmailConfirm']);
//    Route::post('email/confirm', 'Auth\EmailConfirmationController@sendEmailVerificationLinkEmail');
//
//    // Registration Routes...
//    Route::get('register', 'Auth\AuthController@showRegistrationForm');
//    Route::post('register', 'Auth\AuthController@register');
//
//    // Password Reset Routes...
//    Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
//    Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
//    Route::post('password/reset', 'Auth\PasswordController@reset');

    # Socialite Login/Register
    Route::get('/auth/socialite/callback/{socialUser}', 'Auth\SocialiteAuthController@handleProviderCallback');
    Route::get('/auth/socialite/{service}', 'Auth\SocialiteAuthController@redirectToProvider');

    # Lock Screen
    Route::get('/admin/lockscreen', 'Auth\LockScreenController@getLockScreen');
    Route::post('/admin/lockscreen', 'Auth\LockScreenController@postLockScreen');

    #password reset
    Route::post('/passwordreset', 'Auth\PasswordController@passwordreset');

    Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
        # Role Management
        Route::group(array('prefix' => 'role'), function () {
            Route::post('/storeList', ['as' => 'storeRoleList', 'uses' => 'Auth\RoleController@saveListToStorage']);
            Route::get('/listByCat', ['as' => 'roleListByCat', 'uses' => 'Auth\RoleController@indexByCat']);
            Route::get('{roleId}/confirm-delete', array('as' => 'confirm-delete/role', 'uses' => 'Auth\RoleController@getModalDelete'));
        });
        Route::resource('/role', 'Auth\RoleController');

        Route::group(array('prefix' => 'permission'), function () {
            Route::post('storeList', ['as' => 'storePermissionList', 'uses' => 'Auth\PermissionController@saveListToStorage']);
            Route::get('/listByCat', ['as' => 'permissionListByCat', 'uses' => 'Auth\PermissionController@indexByCat']);
            Route::get('{id}/delete', array('as' => 'admin.permission.delete', 'uses' => 'Auth\PermissionController@getDelete'));
            Route::get('{id}/confirm-delete', array('as' => 'admin.permission.confirm-delete', 'uses' => 'Auth\PermissionController@getModalDelete'));
        });
        # Permission Management
        Route::resource('/permission', 'Auth\PermissionController');
    });
});