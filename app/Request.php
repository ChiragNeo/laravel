<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Request extends Model
{
    public $field_name;
   
    protected $table = 'request';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'parent_id', 'user_id','fields','status','field_name',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
