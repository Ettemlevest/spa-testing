<?php

namespace App\Observers;

use App\User;

class UserObserver
{
    /**
     * Prevent accidental admin user deletion
     * Handle the user "deleting" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleting(User $user)
    {
        if ($user->id === 100)
            return false;
    }
}
