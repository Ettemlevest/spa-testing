<?php

namespace App\Common\Observers;

use App\Common\Models\User;

class UserObserver
{
    /**
     * Prevent admin/super user updating
     *
     * @param \App\Common\Models\User $user
     * @return boolean
     */
    public function updating(User $user)
    {
        if ($user->id === config('common.superuser_id', 99) && Auth::id() !== config('common.superuser_id', 99))
            return false;

        if ($user->id === config('common.superuser_id', 100) && (Auth::id() !== config('common.superuser_id', 100) || Auth::id() !== config('common.superuser_id', 99)))
            return false;
    }

    /**
     * Prevent accidental admin/super user deletion
     * Handle the user "deleting" event.
     *
     * @param  \App\Common\Models\User  $user
     * @return boolean
     */
    public function deleting(User $user)
    {
        if ($user->id === config('common.superuser_id', 100) || $user->id === config('common.superuser_id', 99))
            return false;
    }
}
