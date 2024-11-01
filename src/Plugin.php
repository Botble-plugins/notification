<?php

namespace Botble\Notification;

use Illuminate\Support\Facades\Schema;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove(): void
    {
        Schema::dropIfExists('Notifications');
        Schema::dropIfExists('Notifications_translations');
    }
}
