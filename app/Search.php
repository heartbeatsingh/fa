<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'search';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'lati', 'longi'];

    public function pictures() {
        return $this->hasMany('App\Picture', 'user_id')->select(['pic', 'order_no', 'user_id'])->orderBy('order_no', 'asc');
    }

    public function answers() {
        return $this->hasMany('App\Ansqus', 'user_id')->select(['question_id', 'answer', 'user_id'])->orderBy('question_id', 'asc');
    }

    public function users() {
        return $this->hasMany('App\User', 'id')->select(['first_name', 'last_name', 'age', 'gender' ,'workplace', 'education', 'about','id as user_id','last_active'])->where(['status' => TRUE]);
    }

}
