<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_type','is_verify','parent_id','education'
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //Function to get User type
    public static function getUserType($id){
        
        $user = User::findOrFail($id);
        // if($user->user_type == '1'){
        //     return 'Supervisor';
        // }else if($user->user_type == '2'){
        //     return 'Worker';
        // }else if($user->user_type = '3'){
        //     return 'Manager';
        // }else{
        //     return 'Admin';
        // }
        
        switch ($user->user_type) {
            case 1:
                return 'Supervisor';
                break;
            case 2:
                return 'Worker';
                break;
            case 3:
                return 'Manager';
                break;
            default:
                return 'Admin';
        }

    }

    
}
