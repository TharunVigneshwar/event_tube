<?php

namespace App\Enums;

enum PermissionEnum: string
{
    // Videos
    const VIEW_ANY_VIDEOS = 'viewAny videos';

    const VIEW_VIDEOS = 'view videos';

    const CREATE_VIDEOS = 'create videos';

    const UPDATE_VIDEOS = 'updte videos';

    const DELETE_VIDEOS = 'delete videos';

    const RESTORE_VIDEOS = 'restore videos';

    const FORCE_DELETE_VIDEOS = 'forceDelete videos';

    // likes
    const VIEW_ANY_LIKES = 'viewAny likes';

    const VIEW_LIKES = 'view likes';

    const CREATE_LIKES = 'create likes';

    const UPDATE_LIKES = 'updte likes';

    const DELETE_LIKES = 'delete likes';

    const RESTORE_LIKES = 'restore likes';

    const FORCE_DELETE_LIKES = 'forceDelete likes';

    // views
    const VIEW_ANY_VIEWS = 'viewAny views';

    const VIEW_VIEWS = 'view views';

    const CREATE_VIEWS = 'create views';

    const UPDATE_VIEWS = 'updte views';

    const DELETE_VIEWS = 'delete views';

    const RESTORE_VIEWS = 'restore views';

    const FORCE_DELETE_VIEWS = 'forceDelete views';

    // events
    const VIEW_ANY_EVENTS = 'viewAny events';

    const VIEW_EVENTS = 'view events';

    const CREATE_EVENTS = 'create events';

    const UPDATE_EVENTS = 'updte events';

    const DELETE_EVENTS = 'delete events';

    const RESTORE_EVENTS = 'restore events';

    const FORCE_DELETE_EVENTS = 'forceDelete events';

    // event subscriptions

    const VIEW_ANY_EVENT_SUBSCRIPTIONS = 'viewAny event subscriptions';

    const VIEW_EVENT_SUBSCRIPTIONS = 'view event subscriptions';

    const CREATE_EVENT_SUBSCRIPTIONS = 'create event subscriptions';

    const UPDATE_EVENT_SUBSCRIPTIONS = 'update event subscriptions';

    const DELETE_EVENT_SUBSCRIPTIONS = 'delete event subscriptions';

    const RESTORE_EVENT_SUBSCRIPTIONS = 'restore event subscriptions';

    const FORCE_DELETE_EVENT_SUBSCRIPTIONS = 'forceDelete event subscriptions';

    // users
    const VIEW_ANY_USERS = 'viewAny users';

    const VIEW_USERS = 'view users';

    const CREATE_USERS = 'create users';

    const UPDATE_USERS = 'updte users';

    const DELETE_USERS = 'delete users';

    const RESTORE_USERS = 'restore users';

    const FORCE_DELETE_USERS = 'forceDelete users';

    // roles
    const VIEW_ANY_ROLES = 'viewAny roles';

    const VIEW_ROLES = 'view roles';

    const CREATE_ROLES = 'create roles';

    const UPDATE_ROLES = 'updte roles';

    const DELETE_ROLES = 'delete roles';

    const RESTORE_ROLES = 'restore roles';

    const FORCE_DELETE_ROLES = 'forceDelete roles';

    // permissions
    const VIEW_ANY_PERMISSIONS = 'viewAny permissions';

    const VIEW_PERMISSIONS = 'view permissions';

    const CREATE_PERMISSIONS = 'create permissions';

    const UPDATE_PERMISSIONS = 'updte permissions';

    const DELETE_PERMISSIONS = 'delete permissions';

    const RESTORE_PERMISSIONS = 'restore permissions';

    const FORCE_DELETE_PERMISSIONS = 'forceDelete permissions';
}
