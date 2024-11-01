<?php

namespace Botble\Notification\Supports;

use Botble\Base\Facades\EmailHandler;
use Botble\Notification\Models\Notification;
use Exception;
use Illuminate\Support\Facades\Log;

class NotificationHelper
{
    public function getSettingPrefix()
    {
        return config('plugins.notification.general.prefix');
    }

    public function sendNotificationEmail(Notification $notification, $column = 'email')
    {
        EmailHandler::setModule(NOTIFICATION_MODULE_SCREEN_NAME)
                        ->setType('plugins')
                        ->setVariableValues([
                            'name' => $notification->notifiable->name,
                            'body' => $notification->body,
                            'url' => $notification->url,
                        ]);

        $template = 'notifiy-email';
        $content = EmailHandler::prepareData(EmailHandler::getTemplateContent($template));

        try{
            EmailHandler::send(
                $content,
                $notification->title,
                $notification->notifiable->{$column},
                [],
                true
            );

            $notification->notified = 1;
            $notification->save();
        }catch(Exception $e){
            Log::error('Notification Email Error! = '.$e->getMessage());
            return false;
        }

    }
}
