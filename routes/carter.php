<?php

Route::group(['middleware' => 'web'], function () {

    Route::get(
        'shopify/signup',
        'InstalledAppController@index'
    )->name('carter.signup');

    Route::match(['get', 'post'],
        'shopify/install',
        'InstalledAppController@create'
    )->name('carter.install');

    Route::get(
        'shopify/register',
        'RegisteredUsersController@create'
    )->name('carter.register');

    Route::get(
        'shopify/embedded/plans',
        'RecurringChargesController@index'
    )->name('carter.plans');

    Route::match(['get', 'post'],
        'shopify/embedded/plans/create',
        'RecurringChargesController@create'
    )->name('carter.plan.create');

    Route::get(
        'activate',
        'RecurringChargesController@update'
    )->name('carter.activate');

    Route::get(
        'shopify/embedded/login',
        'AuthorizedUsersController@create'
    )->name('carter.login');

    Route::get(
        'shopify/app/expired',
        'ExpiredSessionsController@index'
    )->name('carter.expired');

});

Route::group(['prefix' => 'webhooks'], function () {

    Route::post(
        'app/uninstalled',
        'WebhooksController@uninstall'
    )->name('carter.uninstall');

});
