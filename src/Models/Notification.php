<?php

namespace Botble\Notification\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Models\BaseModel;
use Botble\Notification\Models\Scopes\NotificationScope;
use Botble\Notification\Services\NotificationService;

class Notification extends BaseModel
{
    use NotificationScope;

    protected $table = 'bp_notifications';

    protected $fillable = [
        'notifiable_id',
        'notifiable_type',
        'title',
        'body',
        'url',
        'read',
        'notified',
    ];

    protected $casts = [
        'title' => SafeContent::class,
        'body' => SafeContent::class,
    ];

    public static function booted()
    {
        static::created(function($model){
            app(NotificationService::class)->sendEmailNotification($model);
        });
    }
    
    public function notifiable()
    {
        return $this->morphTo();
    }
}
