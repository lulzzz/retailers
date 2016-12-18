<?php

Route::group(['middleware' => 'web'], function () {

    Route::get(
        'signup',
        'InstalledAppController@index'
    )->name('carter.signup');

    Route::match(['get', 'post'],
        'install',
        'InstalledAppController@create'
    )->name('carter.install');

    Route::get(
        'register',
        'RegisteredUsersController@create'
    )->name('carter.register');

    Route::get(
        'embedded/plans',
        'RecurringChargesController@index'
    )->name('carter.plans');

    Route::match(['get', 'post'],
        'embedded/plans/create',
        'RecurringChargesController@create'
    )->name('carter.plan.create');

    Route::get(
        'activate',
        'RecurringChargesController@update'
    )->name('carter.activate');

    Route::get(
        'embedded/login',
        'AuthorizedUsersController@create'
    )->name('carter.login');

    Route::get(
        'embedded/dashboard',
        'DashboardController@index'
    )->name('carter.dashboard');

    Route::get(
        'app/expired',
        'ExpiredSessionsController@index'
    )->name('carter.expired');

});

Route::group(['prefix' => 'webhooks'], function () {

    Route::post(
        'app/uninstalled',
        'WebhooksController@uninstall'
    )->name('carter.uninstall');

});
