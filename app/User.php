<?php

namespace App;

//use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //use Notifiable;

    public function getRole(){
        return Role::where('id', $this->roleID)->first()->role;
    }
    public function getUserAvatar(){
        return Profile::where('id', $this->profileID)->first()->avatar;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'userIP', 'profileID', 'roleID'
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
