<?php

Route::group(['middleware' => 'web'], function () {

    Route::get('signup', 'ShopifyAppController@showSignupForm')->name('carter.signup');

    Route::match(['get', 'post'], 'install', 'ShopifyAppController@install')->name('carter.install');

    Route::get('register', 'ShopifyUserController@register')->name('carter.register');

    Route::get('embedded/plans', 'RecurringChargeController@index')->name('carter.plans');

    Route::match(['get', 'post'], 'embedded/plans/create', 'RecurringChargeController@create')->name('carter.plan.create');

    Route::get('activate', 'RecurringChargeController@update')->name('carter.activate');

    Route::get('embedded/login', 'ShopifyUserController@login')->name('carter.login');

    Route::get('embedded/dashboard', 'DashboardController@index')->name('carter.dashboard');

    Route::get('embedded/expired', 'ShopifyUserController@expired')->name('carter.expired');

});

Route::group(['prefix' => 'webhook/shopify'], function () {

    Route::post('uninstall', 'WebhookController@uninstall')->name('carter.uninstall');

});
