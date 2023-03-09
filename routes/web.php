<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'AuthController@loginView')->name('login.view');
Route::get('/confirmation', 'AuthController@confirmation')->name('confirmation.view');
Route::post('/login', 'AuthController@login')->name('login');
Route::get('/register', 'AuthController@registerView')->name('register.view');
Route::post('/register', 'AuthController@register')->name('register');
Route::post('logout', 'AuthController@logout')->name('logout');

//Admin
Route::group(['namespace' => 'Admin', 'middleware' => 'admin', 'prefix' => 'admin'], function () {

    //Main
    Route::get('/dashboard', 'MainController@dashboard')->name('admin.dashboard');

    //Delivery Boy
    Route::group(['namespace' => 'DeliveryBoy', 'prefix' => 'delivery/boy'], function () {
        Route::get('create', 'DeliveryBoyController@create')->name('admin.create.delivery.boy');
        Route::post('store', 'DeliveryBoyController@store')->name('admin.store.delivery.boy');
        Route::get('list', 'DeliveryBoyController@list')->name('admin.delivery.boy.list');
        Route::get('edit/{id}', 'DeliveryBoyController@edit')->name('admin.delivery.boy.edit');
        Route::put('update/{id}', 'DeliveryBoyController@update')->name('admin.delivery.boy.update');
        Route::delete('delete/{id}', 'DeliveryBoyController@delete')->name('admin.delivery.boy.delete');
    });

    //Store
    Route::group(['namespace' => 'Store', 'prefix' => 'store'], function () {
        Route::get('list', 'StoreController@list')->name('admin.store.list');
    });

    //Notification
    Route::group(['namespace' => 'Notification', 'prefix' => 'read'], function () {
        Route::get('notification/request/{id}', 'NotificationController@maskAsRead')->name('admin.read.notification');
    });

    //Delivery Requests
    Route::group(['namespace' => 'DeliveryRequest', 'prefix' => 'delivery-request'], function () {
        Route::get('list', 'DeliveryRequestController@list')->name('admin.get.delivery.request.list');
        Route::post('assign/delivery/boy', 'DeliveryRequestController@assignDeliveryBoy')->name('admin.assign.delivery.boy');
    });

});

//Delivery Boy
Route::group(['namespace' => 'DeliveryBoy', 'middleware' => 'deliveryBoy', 'prefix' => 'delivery/boy'], function () {
    Route::get('/dashboard', 'MainController@dashboard')->name('deliveryBoy.dashboard');

    //Notification
    Route::group(['namespace' => 'Notification'], function () {
        Route::get('read/notification/{id}', 'NotificationController@maskAsRead')->name('delivery.boy.read.notification');
    });

    //Delivery Requests
    Route::group(['namespace' => 'DeliveryRequest', 'prefix' => 'delivery-request'], function () {
        Route::get('list', 'DeliveryRequestController@list')->name('delivery.boy.get.delivery.request.list');
        Route::post('/{id}/change/status', 'DeliveryRequestController@changeStatus')->name('delivery.request.change.status');
    });

});

//Store
Route::group(['namespace' => 'Store', 'middleware' => 'store', 'prefix' => 'store'], function () {
    Route::get('/dashboard', 'MainController@dashboard')->name('store.dashboard');

    //Notification
    Route::group(['namespace' => 'Notification'], function () {
        Route::get('read/notification/{id}', 'NotificationController@maskAsRead')->name('store.read.notification');
        Route::post('/send-notification', 'NotificationController@sendDeliveryRequest')->name('send.request.notification');

    });

    //Delivery Requests
    Route::group(['namespace' => 'DeliveryRequest', 'prefix' => 'delivery-request'], function () {
        Route::get('list', 'DeliveryRequestController@list')->name('store.get.delivery.request.list');
    });
});

