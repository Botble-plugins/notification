<?php

namespace Botble\Notification\Http\Requests\Settings;

use Botble\Base\Rules\OnOffRule;
use Botble\Support\Http\Requests\Request;

class NotificationSettingRequest extends Request
{
    public function rules(): array
    {


        return apply_filters(NOTIFICATION_SETTING_REQUEST,
        [
            'is_enabled_email_notification' => $onOffRule = new OnOffRule(),
            'is_enabled_firebase_notification' => $onOffRule,
            'notification_firebase_apikey' => ['nullable', 'string']
        ]);
    }
}
