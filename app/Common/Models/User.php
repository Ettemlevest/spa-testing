<?php

namespace App\Common\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasRoles, HasApiTokens;

    /**
     * Database table name for the model.
     *
     * @var string
     */
    protected $table = 'cfg_users';

    /**
     * Set default guard for the model.
     *
     * @var string
     */
    protected $guard_name = 'api';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'last_name', 'first_name', 'email', 'password', 'status_id'
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'status_id'
    ];

    /**
     * Determine if current user is IT Support
     *
     * @return boolean
     */
    public function isSuperUser()
    {
        return $this->id === config('common.superuser_id', 99) ? true : false;
    }

    /**
     * Determine if current user is the first user
     *
     * @return boolean
     */
    public function isAdminUser()
    {
        return $this->id === config('common.adminuser_id', 100) ? true : false;
    }

    /**
     * Get the status of the User
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo('App\Common\Models\Status')->select(['id', 'description']);
    }
}
