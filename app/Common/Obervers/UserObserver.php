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
        if ($user->id === env('SUPERUSER_ID', 99) && Auth::id() !== env('SUPERUSER_ID', 99))
            return false;

        if ($user->id === env('ADMINUSER_ID', 100) && (Auth::id() !== env('ADMINUSER_ID', 100) || Auth::id() !== env('SUPERUSER_ID', 99)))
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
        if ($user->id === env('ADMINUSER_ID', 100) || $user->id === env('SUPERUSER_ID', 99))
            return false;
    }
}
