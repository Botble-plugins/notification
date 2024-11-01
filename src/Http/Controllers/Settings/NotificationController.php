<?php

namespace Botble\Notification\Http\Controllers\Settings;

use Botble\Base\Forms\FormBuilder;
use Botble\Currency\Facades\CurrencyHelper;
use Botble\Currency\Forms\Settings\CurrencySettingForm;
use Botble\Currency\Http\Requests\Settings\CurrencySettingRequest;
use Botble\Currency\Services\StoreCurrenciesService;
use Botble\Notification\Facades\NotificationHelper;
use Botble\Notification\Forms\Settings\NotificationSettingForm;
use Botble\Notification\Http\Requests\Settings\NotificationSettingRequest;
use Botble\Notification\Models\Notification;
use Botble\Notification\Services\NotificationService;
use Botble\Setting\Http\Controllers\SettingController;

class NotificationController extends SettingController
{
    public function index()
    {
        $this->pageTitle(trans('plugins/notification::notification.setting.title'));

        app(NotificationService::class)->store([
            'title' => 'Notification Email',
            'body' => 'Notification Email',
            'url' => 'http://localhost/Iqstats/public/index.php/admin',
            'notifiable_id' => auth()->user()->id,
            'notifiable_type' => get_class(auth()->user())
        ]);

        return NotificationSettingForm::create()->renderForm();
    }

    public function update(NotificationSettingRequest $request)
    {
        return $this->performUpdate($request->validated(), NotificationHelper::getSettingPrefix());
    }
}
