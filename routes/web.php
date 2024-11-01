<?php

use Botble\Base\Facades\AdminHelper;
use Illuminate\Support\Facades\Route;

AdminHelper::registerRoutes(function () {
    Route::group([
        'prefix' => 'settings/notifications',
        'as' => 'settings.notification.',
        'namespace' => 'Botble\Notification\Http\Controllers\Settings'
    ], function () {
        Route::get('/', [
            'as' => 'index',
            'uses' => 'NotificationController@index'
        ]);

        Route::put('/', [
            'as' => 'update',
            'uses' => 'NotificationController@update'
        ]);
    });
});
