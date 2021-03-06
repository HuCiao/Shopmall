<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * 商城首页
 * 如果一个未验证邮箱的用户尝试访问一个配置了 verified 中间件的路由，就会提示该用户邮箱未激活。
 */
//Route::get('/', 'PagesController@root')->name('root')->middleware('verified');
//Route::get('/', 'PagesController@root')->name('root');

// 启用邮箱相关验证路由
Auth::routes(['verify' => true]);

// auth 中间件代表需要登录，verified中间件代表需要经过邮箱验证
Route::group(['middleware' => ['auth', 'verified']], function() {
    //收货地址列表页面
    Route::get('user_addresses', 'UserAddressesController@index')->name('user_addresses.index');

    //新增、修改收货地址页面
    Route::get('user_addresses/create', 'UserAddressesController@create')->name('user_addresses.create');

    //保存新增的地址信息
    Route::post('user_addresses', 'UserAddressesController@store')->name('user_addresses.store');

    //修改收货地址页面
    Route::get('user_addresses/{user_address}', 'UserAddressesController@edit')->name('user_addresses.edit');

    //修改收货地址信息
    Route::put('user_addresses/{user_address}', 'UserAddressesController@update')->name('user_addresses.update');

    //删除收货地址信息
    Route::delete('user_addresses/{user_address}', 'UserAddressesController@destroy')->name('user_addresses.destroy');

    //收藏商品
    Route::post('products/{product}/favorite', 'ProductsController@favor')->name('products.favor');
    //取消收藏
    Route::delete('products/{product}/favorite', 'ProductsController@disfavor')->name('products.disfavor');
    //收藏商品列表页面
    Route::get('products/favorites', 'ProductsController@favorites')->name('products.favorites');

    //添加商品到购物车
    Route::post('cart', 'CartController@add')->name('cart.add');
    //购物车界面
    Route::get('cart', 'CartController@index')->name('cart.index');
    //商品移出购物车
    Route::delete('cart/{sku}', 'CartController@remove')->name('cart.remove');

    //购物车下订单
    Route::post('orders', 'OrdersController@store')->name('orders.store');

    //订单表页面
    Route::get('orders', 'OrdersController@index')->name('orders.index');
    //订单详情页面
    Route::get('orders/{order}', 'OrdersController@show')->name('orders.show');

    //订单支付路由
    Route::get('payment/{order}/alipay', 'PaymentController@payByAlipay')->name('payment.alipay');
    //支付宝前端回调
    Route::get('payment/alipay/return', 'PaymentController@alipayReturn')->name('payment.alipay.return');

    //收货路由
    Route::post('orders/{order}/received', 'OrdersController@received')->name('orders.received');

    //评论界面
    Route::get('orders/{order}/review', 'OrdersController@review')->name('orders.review.show');
    //保存评论
    Route::post('orders/{order}/review', 'OrdersController@sendReview')->name('orders.review.store');
    //退款
    Route::post('orders/{order}/apply_refund', 'OrdersController@applyRefund')->name('orders.apply_refund');
});

//支付后端回调确认
Route::post('payment/alipay/notify', 'PaymentController@alipayNotify')->name('payment.alipay.notify');

Route::redirect('/', '/products')->name('root');

Route::get('products', 'ProductsController@index')->name('products.index');


Route::get('products', 'ProductsController@index')->name('products.index');

//展示商品详情页
Route::get('products/{product}', 'ProductsController@show')->name('products.show');






