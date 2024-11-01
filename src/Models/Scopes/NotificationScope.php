<?php

namespace Botble\Notification\Models\Scopes;

trait NotificationScope
{
    public function scopeAuth($query)
    {
        $query
            ->where([
                ['notifiable_type', get_class(auth()->user())],
                ['notifiable_id', auth()->user()->id],
            ]);
    }

    public function scopeRead($query, $read)
    {
        $query->where('read', $read);
    }
}
