<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Event;
use App\Models\User;

class EventPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::VIEW_ANY_EVENTS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Event $event): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::VIEW_EVENTS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::CREATE_EVENTS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Event $event): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::UPDATE_EVENTS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Event $event): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::DELETE_EVENTS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Event $event): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::RESTORE_EVENTS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Event $event): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::FORCE_DELETE_EVENTS)) {
            return true;
        }

        return false;
    }
}
