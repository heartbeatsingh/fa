<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable,
        CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'gender', 'email', 'lati', 'longi', 'zip_code', 'about'];
    
    protected $hidden = [];
    
    public function pictures() {
        return $this->hasMany('App\Picture')->select(['pic', 'order_no', 'user_id'])->orderBy('order_no', 'asc');
    }

    public function answers() {
        return $this->hasMany('App\Ansqus')->select(['question_id', 'answer', 'user_id'])->orderBy('question_id', 'asc');
    }
    public function flopers() {
        return $this->hasMany('App\Flop')->select(['user_id', 'like_dislike_id']);
    }
    public function users() {
        return $this->hasMany('App\User', 'id')->select(['first_name', 'last_name', 'age', 'gender' ,'workplace', 'education', 'about','id as user_id','last_active'])->where(['status' => TRUE,'role' => 1]);
    }
    
    function getProfile($validateArr) {
        extract($validateArr['data']);
        return User::select(['first_name', 'last_name', 'age', 'workplace', 'education', 'about', 'status as profile_status', 'id', 'token', 'last_active'])->where(['id' => $userId, 'token' => $token])->first();
    }

}
