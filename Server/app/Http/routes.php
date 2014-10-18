<?php

Route::group(['prefix' => 'api/v1', 'namespace' => 'SpreadOut\Http\Controllers\Api'], function ()
{
    Route::group(['prefix' => 'person'], function ()
    {
        Route::any('token', 'AuthController@personToken');
        Route::any('register', 'AuthController@registerPerson');
    });

    Route::group(['prefix' => 'company'], function ()
    {
        Route::get('token', 'AuthController@companyToken');
        Route::any('register', 'AuthController@registerCompany');
    });

    Route::group(['prefix' => 'search'], function ()
    {
        Route::get('branch', 'SearchController@branch');
    });
});
