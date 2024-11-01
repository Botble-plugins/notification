<?php

return [
    [
        'name' => 'Notifications',
        'flag' => 'notification.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'notification.create',
        'parent_flag' => 'notification.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'notification.edit',
        'parent_flag' => 'notification.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'notification.destroy',
        'parent_flag' => 'notification.index',
    ],
];
