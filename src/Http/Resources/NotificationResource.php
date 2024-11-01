<?php

namespace Botble\Notification\Http\Resources;

use Botble\Notification\Models\Notification;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Notification
 */
class NotificationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'url' => $this->url,
            'notified' => $this->notified,
            'read' => $this->read,
        ];
    }
}
