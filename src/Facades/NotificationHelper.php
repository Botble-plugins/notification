<?php

namespace Botble\Notification\Facades;

use Botble\Notification\Supports\NotificationHelper as BaseNotificationHelper;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string|null getSettingPrefix()
 *
 * @see \Botble\Notification\Supports\NotificationHelper
 */
class NotificationHelper extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return BaseNotificationHelper::class;
    }
}
