<?php

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
//============== User ===============

Route::get('/','User\IndexController@index');
Route::get('about','User\StaticPageController@about');
Route::get('blog','User\BlogController@index');

Route::get('doctors','User\DoctorController@index');
Route::get('doctors/dept-wise/{id}/{slug}','User\DoctorController@department_wise');
Route::get('doctors/appointment/{id}/{slug}','User\DoctorController@appointment_page');
Route::post('doctor/appointment','User\DoctorController@get_appointment');

Route::get('products','User\ProductController@index');
Route::get('all_products','User\ProductController@all_product');
Route::get('cat_wise_product/{id}','User\ProductController@cat_wise_product');
Route::get('product/search','User\ProductController@itemSearch');

Route::get('product/bid','User\ProductController@bid');


Route::get('product/details/{id}','User\ProductController@single_product');

Route::get('contact','User\ContactController@index');
Route::get('blog/single','User\BlogController@single_blog');


//========== Temp Orders==============
Route::get('add_cart', 'User\ProductCartController@add_cart');
Route::get('show_cart', 'User\ProductCartController@show_cart');
Route::get('remove_cart', 'User\ProductCartController@remove_cart');
Route::get('show_cart', 'User\ProductCartController@show_cart');
Route::get('get_temp_order', 'User\ProductCartController@get_temp_order');


Route::get('product/cart','User\ProductCartController@index');
Route::post('product/cart/update','User\ProductCartController@cart_update');
Route::get('product/cart/del/{id}','User\ProductCartController@cart_item_del');

//========== Temp Orders==============


//============== /User ==============

Route::group(['middleware' => 'auth'], function () {

    //------------- BID ----------------------
    Route::get('product/single/bid/{id}','User\ProductController@single_bid');
    Route::post('product/bid/save','User\ProductController@bid_save');
    //------------- BID ----------------------

    //------------- CheckOut------------------
    Route::get('product/checkout','User\ProductCartController@checkout');
    Route::post('product/confirm/checkout','User\ProductCartController@confirm_checkout');
    //------------- CheckOut------------------

    //------------- Profile -------------
    Route::get('customer/profile/{profile}','User\ProfileController@index');
    Route::post('customer/profile/update','User\ProfileController@update');
    Route::post('customer/profile/password','User\ProfileController@change_pass');
    Route::get('customer/invoice/{id}','User\ProductCartController@invoice');
    //------------- Profile -------------

    Route::group(['middleware' => 'admin'], function () {

     Route::get('admin','Admin\DashboardController@index');

/*----------- Appointment -----------*/
    Route::get('appointment/list/new','Admin\AppointmentController@index');
    Route::get('appointment/list/check/{id}','Admin\AppointmentController@check');
    Route::get('appointment/del/{id}','Admin\AppointmentController@del');
    Route::get('appointment/list/checked','Admin\AppointmentController@checked');
/*----------- Appointment -----------*/

/*----------- Doctors -------------*/
    Route::get('doctors/list','Admin\DoctorController@index');
    Route::post('doctors/save','Admin\DoctorController@store');
    Route::post('doctors/edit','Admin\DoctorController@edit');
    Route::get('doctors/del/{id}','Admin\DoctorController@del');
/*----------- /Doctors ------------*/

/*----------- Department -------------*/
    Route::get('doctors/department/list','Admin\DepartmentController@index');
    Route::post('doctors/department/save','Admin\DepartmentController@store');
    Route::post('doctors/department/edit','Admin\DepartmentController@edit');
    Route::get('doctors/department/del/{id}','Admin\DepartmentController@del');
/*----------- /Department ------------*/

//----------- Orders --------------*/
    Route::get('order/new','Admin\Orders\PendingController@index');
    Route::get('order/overview/{id}','Admin\Orders\OrderInvoiceController@index');
    Route::get('order/invoice/{id}','Admin\Orders\OrderInvoiceController@invoice');

    Route::get('order/process','Admin\Orders\PendingController@process');
    Route::get('order/process/change/{id}','Admin\Orders\PendingController@process_order');

    Route::get('order/complete','Admin\Orders\PendingController@complete');
    Route::get('order/complete/change/{id}','Admin\Orders\PendingController@complete_order');

    Route::get('order/cancel','Admin\Orders\PendingController@cancel');
    Route::get('order/cancelled/{id}','Admin\Orders\PendingController@cancelled');
//----------- Orders --------------*/


/*----------- product -------------*/
    Route::get('product/list','Admin\Product\ProductController@index');
    Route::post('product/save','Admin\Product\ProductController@save');
    Route::post('product/edit','Admin\Product\ProductController@edit');
    Route::get('product/item/del/{id}','Admin\Product\ProductController@del');

    Route::get('product/item/bidable/{id}','Admin\Product\ProductController@bidable');
    Route::get('product/item/bid/start/{id}','Admin\Product\ProductController@start_bid');
    Route::get('product/item/bid/stop/{id}','Admin\Product\ProductController@stop_bid');
    Route::get('product/item/allbid','Admin\Product\ProductController@allBiddle');
        /*----------- /product ------------*/
/*----------- Food Cat -------------*/
    Route::get('product/category','Admin\Product\CategoryController@index');
    Route::post('product/category/save','Admin\Product\CategoryController@save');
    Route::post('product/category/edit','Admin\Product\CategoryController@edit');
    Route::get('product/category/del/{id}','Admin\Product\CategoryController@del');
/*----------- /Food cat ------------*/

//========== Customers ===============
Route::get('admin/list','Admin\Customer\CustomerController@admin');
Route::post('admin/list','Admin\Customer\CustomerController@make');
Route::get('customer/list','Admin\Customer\CustomerController@index');
Route::get('customer/overview/{id}','Admin\Customer\CustomerController@overview');
//========== Customers ===============

    });
});
Auth::routes();
Auth::routes(['verify' => true]);


Route::get('gen_session', 'User\IndexController@gen_session');//Unique Session Generate
Route::get('remove_session', 'User\IndexController@remove_session');//Unique Session Remove
Route::get('/home', 'HomeController@index')->name('home');
