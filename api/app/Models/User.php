<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, SoftDeletes;

    protected $table = 'users';

    protected $fillable = ['username', 'first_name', 'last_name', 'email', 'phone', 'password'];

    protected $hidden = ['password', 'remember_token', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['deleted_at'];

    //relations

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'This action is unauthorized.');
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
              if ($this->hasRole($role)) {
                return true;
              }
            }
        } else {
            if ($this->hasRole($roles)) {
              return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function cart()
    {
    	return $this->belongsToMany('App\Models\Product', 'cart', 'user_id', 'product_id');
    }

    //mutators

    public function setFirstNameAttribute($name)
    {
        $this->attributes['first_name'] = ucwords($name);
    }

    public function setLastNameAttribute($name)
    {
        $this->attributes['last_name'] = ucwords($name);
    }

    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = \Hash::make($pass);
    }

}
