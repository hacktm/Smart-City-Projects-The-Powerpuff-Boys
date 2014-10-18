<?php

Route::group(['prefix' => 'api/v1', 'namespace' => 'SpreadOut\Http\Controllers\Api'], function ()
{
    Route::group(['prefix' => 'person'], function ()
    {
        Route::get('token', 'AuthController@personToken');
        Route::get('register', 'AuthController@registerPerson');
    });

    Route::group(['prefix' => 'search'], function ()
    {
        Route::get('branch', 'SearchController@branch');
    });
});
