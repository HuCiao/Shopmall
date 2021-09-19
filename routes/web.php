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
Route::get('/', 'PagesController@root')->name('root');

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
});



