<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Str;

/**
 *
 */
class CoursePolicy
{
    /**
     * @param $user
     * @param $ability
     * @return false|void
     */
    public function before($user, $ability)
    {
        $ability = 'courses-' . Str::slug($ability, '-');
        if (!$user->hasPermissionTo($ability)) {
            return false;
        }
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Course $courses): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Course $courses): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Course $courses): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Course $courses): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Course $courses): bool
    {
        return true;
    }
}
