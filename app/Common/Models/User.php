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
    protected $with = [];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'status'
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
    public function isSuper()
    {
        return $this->id === (int)config('common.superuser_id', 99) ? true : false;
    }

    /**
     * Determine if current user is the first user
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->id === (int)config('common.adminuser_id', 100) ? true : false;
    }

    /**
     * Get the status of the User
     *
     * @return string
     */
    public function getStatusAttribute()
    {
        return Status::where('id', $this->attributes['status_id'])->first()->description;
    }

    /**
     * Set the user's status.
     *
     * @param string $value
     */
    public function setStatusAttribute(string $value)
    {
        $this->attributes['status_id'] = Status::where('description', $value)->firstOrFail()->id;
    }
}
