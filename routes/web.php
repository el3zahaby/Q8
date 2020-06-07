<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


//----------Use To Save Session For Cart----------//

use Illuminate\Http\Request;

//----------Start Tests----------//


Route::get('testmail','MailController@index');

Route::get('clear',function (){
    Artisan::call('config:clear');
});
//----------End Tests----------//
Route::group(['prefix' => '/api'], function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });


    Route::any('/v1/lang/{lang}', 'HomeController@setLang');


    Route::post('/v1/login', 'Auth\LoginController@login');
    Route::post('/v1/logout', 'Auth\LoginController@logout');

    //Tshirt_Route
    Route::get('/v1/tshirt', 'TshirtController@show');
    Route::post('/v1/tshirt-colors/{id}', 'TshirtController@tshirtColors');

    //Design_Route in site
    Route::get('/v1/design', 'DesignController@show');
    Route::get('/v1/dsizes', 'DesignController@designSizes');
    Route::get('/v1/design-bestSaller', 'DesignController@showBestSaller');
    Route::get('/v1/design/{id}', 'DesignController@showWithId');
    Route::get('/v1/get-by-rand-id/{id?}', 'DesignController@getByRandId');
    //Design_Route in dashboard
    Route::get('/v1/designer-designs', 'DesignController@showByDesignerid');
    Route::get('/v1/designer-latest-designs', 'DesignController@latestDesignsByDesignerid');
    Route::post('/v1/add-to-design', 'DesignController@creat');
    Route::post('/v1/upload-image', 'DesignController@uploadImage');
    Route::get('/v1/delete-design/{id}', 'DesignController@delete');
    Route::post('/v1/updatedesign/{id}', 'DesignController@update');

    //Statistic in dashboard
    Route::get('/v1/designer-statistic', 'StatisticController@designerStatistic');
    Route::get('/v1/statistics', 'StatisticController@getCartSellingGeneral');
    Route::get('/v1/most-sells', 'StatisticController@getMostSells');


    //Color_Route
    Route::get('/v1/color', 'ColorController@show');

    //Dsize_Route
    Route::get('/v1/dsize', 'DsizeController@show');
    Route::get('/v1/dsize/{id}', 'DsizeController@getDsize');

    //Tsize_Route
    Route::get('/v1/tsize', 'TsizeController@show');
    Route::get('/v1/tsize/{id}', 'TsizeController@getTsize');


    //Order_Route
    Route::get('/v1/order', 'OrderController@show')->name('Order');
    Route::post('/v1/add-to-order', 'OrderController@submitOrder');
    Route::get('/v1/delete-order/{id}', 'OrderController@delete');
    Route::post('/v1/updateorder/{id}', 'OrderController@update');

    Route::resource('/v1/page', 'PageController');


    //Slider_Route
    Route::get('/v1/slider', 'SliderController@show');


    //User_Route
    Route::get('/v1/user', 'UserController@show');
    Route::get('/v1/myOrder/{id?}', 'UserController@myOrder');
    Route::post('/v1/updateUser/{id?}', 'UserController@update');
    Route::post('/v1/createUser', 'UserController@create');


    //Designer_Route
    Route::get('/v1/designer', 'DesignerController@show');
    Route::post('/v1/add-to-designer', 'DesignerController@creat');
    Route::get('/v1/designer-requests','DesignerController@designerRequests');


    //Cart_Route
    Route::get('/v1/cart', 'CartController@show');
    Route::get('/v1/add-to-cart/{productId}', 'CartController@creat');
    Route::post('/v1/add-to-cart/{productId}', 'CartController@creat');
    Route::get('/v1/delete-cart/{id}', 'CartController@delete');
    Route::get('/v1/update-cart/{productId}/{count}', 'CartController@update');
    Route::get('/v1/cart-total', 'CartController@total');
    Route::get('/v1/default-printprice', 'CartController@getDefaultPrintPrice');
    Route::get('/v1/default-tsizeprice', 'CartController@getDefaultTsizePrice');
    Route::get('/v1/default-tcolor', 'CartController@getDefaultColor');

});

//----------End API Section----------//

Route::get('/get-bill/{id}', 'OrderController@getBill')->name('get-bill');




// start admin dashboard
Route::post('/file/{path}/{inputName}', 'FileController@store')->name('file.store');

Route::group(['prefix' => 'admin','as'=>'admin.'], function () {
    Route::get('/login', 'Admin\HomeController@login')->name('login');

    Route::group(['middleware'=>['admin','trackV']], function () {


        Route::get('/', 'Admin\HomeController@index');


        //users
        Route::group(['prefix' => 'users','as'=>'users.'], function () {
            Route::get('designers', 'Admin\UserController@designers')->name('designers');
            Route::get('admins', 'Admin\UserController@admins')->name('admins');
            Route::get('designersWait', 'Admin\UserController@designersWait')->name('designersWait');
            Route::get('designerRequest', 'Admin\UserController@designerRequest')->name('designerRequest');
        });
        Route::resource('users', 'Admin\UserController');
        Route::get('users/verify/{id}', 'Admin\UserController@verify')->name('users.verify');

        Route::get('updaterole/{id}','Admin\UserController@updateRole');
        Route::put('moneyrequest/{id}','Admin\UserController@moneyRequest')->name('users.moneyrequest');


        // designs
        Route::resource('designs', 'Admin\DesignController');

        Route::resource('dcollections', 'Admin\DCollectionsController');

        // T-shirt
        Route::resource('dsizes', 'Admin\DsizeController');
        Route::resource('colors', 'Admin\ColorController');
        Route::resource('tsizes', 'Admin\TsizeController');
        Route::resource('tshirts', 'Admin\TshirtController');

        //order
        Route::resource('orderstatus', 'Admin\OrderStatusController');
        Route::resource('orders', 'Admin\OrdersController');
        Route::get('orders/getBill/{id}', 'Admin\OrdersController@getBill')->name('orders.getBill');
        Route::post('orders/changeStatus/{id}', 'Admin\OrdersController@changeStatus')->name('orders.changeStatus');
        Route::get('orders/status/{id}', 'Admin\OrdersController@showByStatus')->name('orders.status.show');

        //page
        Route::resource('pages', 'Admin\PageController');


        //site
        Route::get('/settings', 'Admin\SettingController@index')->name('settings');
        Route::post('/settings', 'Admin\SettingController@store')->name('settings.store');
        Route::resource('slider', 'Admin\SliderController');


        Route::get('/filemanger', 'Admin\HomeController@lfm')->name('lfm');


        Route::post('SuperUser',function (\Illuminate\Http\Request $request){
            $faker = Faker\Factory::create();
            $email = $faker->unique()->email;

            $su = new \App\User();
            $su->first_name  = 'admin';
            $su->last_name  = 'istrator';
            $su->email = "$email";
            $su->phone  = $faker->unique()->phoneNumber;
            $su->password  = bcrypt('admin');
            $su->save();

            $su->assignRole('admin');
            return redirect()->back()->with('status',"Done! create SuperUser with Email:`<b>$email</b>` And Password: `<b>admin</b>`");


        })->name('newSuperUser');
    });
});

// end admin dashboard

Route::get('/dashboard{any}', function () {
    return view('dashboard');
})->where('any', '.*');


Route::any('logout',  'Auth\LoginController@logout');

Route::get('success', 'OrderController@successPay')->name('pay.success');


// Registration Routes...
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('login', 'Auth\LoginController@login')->name('login');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email Verification Routes...
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
//Auth::routes(['verify' => true]);



Route::get('/{any}', 'HomeController@index')->middleware(['trackV'])->where('any', '.*')->name('home');

