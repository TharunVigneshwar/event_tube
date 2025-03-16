<?php

namespace App\Enums;

enum RolesEnum: string
{
    //user
    const USER_USER = 'User User';

    const USER_MANAGER = 'User Manager';

    const USER_ADMIN = 'User Admin';

    //Role
    const ROLE_USER = 'Role User';

    const ROLE_MANAGER = 'Role Manager';

    const ROLE_ADMIN = 'Role Admin';

    // Permission
    const PERMISSION_USER = 'Permission User';

    const PERMISSION_MANAGER = 'Permission Manager';

    const PERMISSION_ADMIN = 'Permission Admin';

    // Video
    const VIDEO_USER = 'Video User';

    const VIDEO_MANAGER = 'Video Manager';

    const VIDEO_ADMIN = 'Video Admin';

    //view
    const VIEW_USER = 'View User';

    const VIEW_MANAGER = 'View Manager';

    const VIEW_ADMIN = 'View Admin';

    //like
    const LIKE_USER = 'Like User';

    const LIKE_MANAGER = 'Like Manager';

    const LIKE_ADMIN = 'Like Admin';

    //Event
    const EVENT_USER = 'Event User';

    const EVENT_MANAGER = 'Event Manager';

    const EVENT_ADMIN = 'Event Admin';

    //Event Subscription

    const EVENT_SUBSCRIPTION_USER = 'Event Subscription User';

    const EVENT_SUBSCRIPTION_MANAGER = 'Event Subscription Manager';

    const EVENT_SUBSCRIPTION_ADMIN = 'Event Subscription Admin';

    //Suoer Admin
    const SUPER_ADMIN = 'Super Admin';

    // othes

    const STUDENT = 'Student';

    const FACULTY = 'Faculty';

    const MANAGER = 'Manager';
}
