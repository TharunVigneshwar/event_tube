<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class PermissionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::VIEW_ANY_PERMISSIONS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Permission $permission): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::VIEW_PERMISSIONS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::CREATE_PERMISSIONS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Permission $permission): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::UPDATE_PERMISSIONS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Permission $permission): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::DELETE_PERMISSIONS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Permission $permission): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::RESTORE_PERMISSIONS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Permission $permission): bool
    {

        if ($user->hasPermissionTo(PermissionEnum::FORCE_DELETE_PERMISSIONS)) {
            return true;
        }

        return false;
    }
}
