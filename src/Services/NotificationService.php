<?php
namespace Botble\Notification\Services;

use Botble\Notification\Facades\NotificationHelper;
use Botble\Notification\Models\Notification;

class NotificationService
{
    public function __construct(public Notification $notification)
    {}

    public function store(array $data)
    {
        $notification = $this->notification->create($data);
        return $notification;
    }

    public function sendEmailNotification(Notification $notification, $userEmailColumn = 'email')
    {
        if(get_notification_setting('is_enabled_email_notification', false))
        {
            return NotificationHelper::sendNotificationEmail($notification, $userEmailColumn);
        }

        return false;
    }

    public function getAll(array $filters, $paginated = false)
    {
        $notifications = $this->notification->query()
                            ->auth()
                            ->when(isset($filters['read']), fn($q, $read) => $q->read($filters['read']));

        return $paginated ?
                $notifications->paginate($filters['per_page'] ?? 10)
                : $notifications->get();
    }
}
