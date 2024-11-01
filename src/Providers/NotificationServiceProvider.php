<?php

namespace Botble\Notification\Providers;

use Botble\ACL\Models\User;
use Botble\Api\Facades\ApiHelper;
use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Facades\EmailHandler;
use Botble\Base\Facades\PanelSectionManager;
use Botble\Base\PanelSections\PanelSectionItem;
use Botble\Notification\Facades\NotificationHelper;
use Botble\Notification\Http\Middlewares\AuthRedirect;
use Botble\Notification\Models\Notification;
use Botble\Setting\PanelSections\SettingCommonPanelSection;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Events\RouteMatched;

class NotificationServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('NotificationHelper', NotificationHelper::class);
    }

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/notification')
            ->loadHelpers()
            ->loadAndPublishTranslations()
            ->loadAndPublishConfigurations(['permissions', 'general', 'email'])
            ->loadRoutes()
            ->loadAndPublishViews()
            ->loadMigrations();


        if (class_exists('ApiHelper') && ApiHelper::enabled()){
            $this->loadRoutes(['api']);
        }

        $this->app['events']->listen(RouteMatched::class, function () {
            $router = $this->app['router'];
            $router->aliasMiddleware('authed', AuthRedirect::class);

            $emailConfig = config('plugins.notification.email', []);

            EmailHandler::addTemplateSettings(NOTIFICATION_MODULE_SCREEN_NAME, $emailConfig);
        });

        $this->registerNotificationPanelSettingsSection();
    }

    protected function registerNotificationPanelSettingsSection()
    {
        PanelSectionManager::default()->beforeRendering(function () {
            PanelSectionManager::registerItem(
                SettingCommonPanelSection::class,
                fn () => PanelSectionItem::make('bp_notifications_settings')
                    ->setTitle(trans('plugins/notification::notification.setting.title'))
                    ->withIcon('ti ti-language')
                    ->withDescription(trans('plugins/notification::notification.setting.description'))
                    ->withPriority(100)
                    ->withRoute('settings.notification.index')
            );
        });
    }
}
