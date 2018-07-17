<?php

namespace App\App\Common\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Database table name for the model.
     *
     * @var string
     */
    protected $table = 'cfg_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'last_name', 'first_name', 'email', 'password', 'status_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * Determine if current user is IT Support
     *
     * @return boolean
     */
    public function isITSupport()
    {
        return $this->id === env('ADMIN_ID', 99) ? true : false;
    }
}
