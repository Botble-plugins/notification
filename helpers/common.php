<?php

use Botble\Notification\Facades\NotificationHelper;

if (! function_exists('get_notification_setting')) {
    function get_notification_setting(string $key, bool|int|string|null $default = ''): array|int|string|null
    {
        return setting(NotificationHelper::getSettingPrefix() . $key, $default);
    }
}

