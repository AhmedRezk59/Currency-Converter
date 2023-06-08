<?php

use Core\Router\Route;

Route::middleware('VerifyCSRFToken', function () {
    Route::get('/', 'HomeController@index');
    Route::put('/rates/update', 'HomeController@update');
    Route::get('/rates-converter', 'ConversionController@index');
    Route::post('/convert', 'ConversionController@convert');
    Route::get('/latest-conversions', 'ConversionController@getLatestConversions');
});
