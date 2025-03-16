<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\User;
use App\Models\View;

class ViewPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::VIEW_ANY_VIEWS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, View $view): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::VIEW_VIEWS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::CREATE_VIEWS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, View $view): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::UPDATE_VIEWS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, View $view): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::DELETE_VIEWS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, View $view): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::RESTORE_VIEWS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, View $view): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::FORCE_DELETE_VIEWS)) {
            return true;
        }

        return false;
    }
}
