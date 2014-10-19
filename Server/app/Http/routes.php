<?php

/** Auth */

Route::group(['namespace' => 'SpreadOut\Http\Controllers\Api'], function () {

    /** Private Api */

    Route::post('users/authentication', 'AuthController@personToken');
    Route::delete('users/authentication/{token}', 'AuthController@personLogout');

    Route::group(['prefix' => 'api/v1'], function () {
        Route::group(['prefix' => 'person'], function () {
            Route::post('token', 'AuthController@personToken');
            Route::post('register', 'AuthController@registerPerson');
            Route::get('tickets', 'TicketController@list');
            Route::post('tickets', 'TicketController@create');
        });

        Route::group(['prefix' => 'company'], function () {
            Route::get('token', 'AuthController@companyToken');
            Route::any('register', 'AuthController@registerCompany');
        });

        Route::group(['prefix' => 'search'], function () {
            Route::get('branch', 'SearchController@branch');
            Route::get('company', 'SearchController@company');
            Route::get('tag', 'SearchController@tag');
            Route::get('county', 'SearchController@county');
            Route::get('city', 'SearchController@city');
            Route::get('ticket', 'SearchController@ticket');
        });
    });

    /** Public Api */

    Route::group(['prefix' => ''], function ()
    {

    });
});
