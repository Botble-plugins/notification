<?php

namespace Botble\Notification\Forms\Settings;

use Botble\Base\Forms\Fields\OnOffField;
use Botble\Notification\Http\Requests\Settings\NotificationSettingRequest;
use Botble\Setting\Forms\SettingForm;

class NotificationSettingForm extends SettingForm
{
    public function setup(): void
    {
        parent::setup();

        $this
        ->setSectionTitle(trans('plugins/notification::notification.setting.title'))
        ->setSectionDescription(trans('plugins/notification::notification.setting.description'))
        ->setValidatorClass(NotificationSettingRequest::class)
        ->add('is_enabled_email_notification', OnOffField::class, [
            'label' => trans('plugins/notification::notification.setting.form.email_notification'),
            'value' => get_notification_setting('is_enabled_email_notification', false),
        ])
        ->add('is_enabled_firebase_notification', OnOffField::class, [
            'label' => trans('plugins/notification::notification.setting.form.firebase_notification'),
            'value' => get_notification_setting('is_enabled_firebase_notification', false),
            'attr' => [
                'data-bb-toggle' => 'collapse',
                'data-bb-target' => '.notification-firebase-apikey',
            ],
        ])
        ->add('open_notification_firebase_apikey', 'html', [
            'html' => sprintf(
                '<fieldset class="form-fieldset notification-firebase-apikey" style="display: %s;" data-bb-value="1">',
                get_notification_setting('is_enabled_firebase_notification', false) ? 'block' : 'none'
            ),
        ])
        ->add('notification_firebase_apikey', 'text', [
            'label' => trans('plugins/notification::notification.setting.form.firebase_apikey'),
            'value' => get_notification_setting('notification_firebase_apikey', null),
            'help_block' => [
                'text' => trans('plugins/notification::notification.setting.form.firebase_apikey'),
            ],
        ])
        ->add('close_notification_firebase_apikey', 'html', [
            'html' => '</fieldset>',
        ]);
    }
}
