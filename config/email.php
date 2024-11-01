<?php

return [
    'name' => 'Notification',
    'description' => 'Config email templates for Notification',
    'templates' => [
        'notifiy-email' => [
            'title' => 'New Notification',
            'description' => 'Notification Email',
            'subject' => 'New Event Notification',
            'can_off' => false,
            'variables' => [
                'name' => 'Name',
                'body' => 'Body',
                'url' => 'url'
            ],
        ],
    ],
];
