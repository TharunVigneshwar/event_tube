<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\EventSubscription;
use App\Models\User;

class EventSubscriptionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::VIEW_ANY_EVENT_SUBSCRIPTIONS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, EventSubscription $eventSubscription): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::VIEW_EVENT_SUBSCRIPTIONS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::CREATE_EVENT_SUBSCRIPTIONS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EventSubscription $eventSubscription): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::UPDATE_EVENT_SUBSCRIPTIONS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EventSubscription $eventSubscription): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::DELETE_EVENT_SUBSCRIPTIONS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, EventSubscription $eventSubscription): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::RESTORE_EVENT_SUBSCRIPTIONS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, EventSubscription $eventSubscription): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::FORCE_DELETE_EVENT_SUBSCRIPTIONS)) {
            return true;
        }

        return false;
    }
}
