<?php

namespace App\Common\Observers;

use App\Common\Models\User;

class UserObserver
{
    /**
     * Prevent accidental admin user deletion
     * Handle the user "deleting" event.
     *
     * @param  \App\Common\Models\User  $user
     * @return void
     */
    public function deleting(User $user)
    {
        if ($user->id === env('ADMIN_ID', 99))
            return false;
    }
}
