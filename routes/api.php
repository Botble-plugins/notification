<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['api', 'auth:sanctum', 'authed'],
    'prefix' => 'api/v1/notifications',
    'namespace' => 'Botble\Notification\Http\Controllers\Apis'
], function () {
    Route::get('/', 'NotificationController@index');
    Route::post('/', 'NotificationController@store');
    Route::put('/{notification}', 'NotificationController@readNotification');
    Route::delete('/{notification}', 'NotificationController@destroy');
});
