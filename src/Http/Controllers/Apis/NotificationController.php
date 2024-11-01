<?php

namespace Botble\Notification\Http\Controllers\Apis;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Notification\Http\Resources\NotificationResource;
use Botble\Notification\Models\Notification;
use Botble\Notification\Services\NotificationService;
use Illuminate\Http\Request;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;

#[Group("Notifications", "APIs for managing Notifications")]
#[Authenticated]
class NotificationController extends BaseController
{
    public function index(Request $request, NotificationService $notificationService)
    {
        $notifications = $notificationService->getAll($request->all(), true);

        return $this
                ->httpResponse()
                ->setData(NotificationResource::collection($notifications))
                ->withDeletedSuccessMessage()
                ->toApiResponse();
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();

        return $this
            ->httpResponse()
            ->withDeletedSuccessMessage()
            ->toApiResponse();
    }

    public function readNotification(Notification $notification)
    {
        $notification->read = 1;
        $notification->save();

        return $this
            ->httpResponse()
            ->withUpdatedSuccessMessage()
            ->toApiResponse();
    }
}
