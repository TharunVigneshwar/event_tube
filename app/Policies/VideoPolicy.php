<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\User;
use App\Models\Video;

class VideoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {

        if ($user->hasPermissionTo(PermissionEnum::VIEW_ANY_VIDEOS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Video $video): bool
    {

        if ($user->hasPermissionTo(PermissionEnum::VIEW_VIDEOS)) {
            return true;
        }

        return false;

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::CREATE_VIDEOS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Video $video): bool
    {

        if ($user->hasPermissionTo(PermissionEnum::UPDATE_VIDEOS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Video $video): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::DELETE_VIDEOS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Video $video): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::RESTORE_VIDEOS)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Video $video): bool
    {
        if ($user->hasPermissionTo(PermissionEnum::FORCE_DELETE_VIDEOS)) {
            return true;
        }

        return false;
    }
}
