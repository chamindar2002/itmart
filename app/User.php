<?php

namespace Allison;

use Allison\models\HasRoles;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, HasRoles;

    /**
     * The database table used by the model.
     *
     * #
     */
    protected $table = 'users';

/**
 * The attributes that are mass assignable.
 *
 * @var array
 */
    //protected $fillable = ['name', 'email', 'password'];
    protected $fillable = ['first_name', 'last_name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function owns($related)
    {
        return $this->id == $related->user_id;
    }

    public function roles()
    {
        return $this->belongsToMany('Allison\models\Role');
    }

    public function fbProfile()
    {
        return $this->hasOne('Allison\models\FbProfile');
    }
    
    public function fbAdAccount()
    {
        return $this->hasOne('Allison\models\FbAd\AdAccount');
    }
}
