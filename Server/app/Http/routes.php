<?php

/** Auth */
Route::group(['namespace' => 'SpreadOut\Http\Controllers\Api'], function ()
{
    Route::post('users/authentication', 'AuthController@personToken');
    Route::delete('users/authentication/{token}', 'AuthController@personLogout');
});

/** Api */
Route::group(['prefix' => 'api/v1', 'namespace' => 'SpreadOut\Http\Controllers\Api'], function ()
{
    Route::group(['prefix' => 'person'], function ()
    {
        Route::any('token', 'AuthController@personToken');
        Route::any('register', 'AuthController@registerPerson');
        Route::get('ticket', 'TicketController@create');
    });

    Route::group(['prefix' => 'company'], function ()
    {
        Route::get('token', 'AuthController@companyToken');
        Route::any('register', 'AuthController@registerCompany');
    });

    Route::group(['prefix' => 'search'], function ()
    {
        Route::get('branch', 'SearchController@branch');
        Route::get('company', 'SearchController@company');
        Route::get('tag', 'SearchController@tag');
        Route::get('county', 'SearchController@county');
        Route::get('city', 'SearchController@city');
    });
});

