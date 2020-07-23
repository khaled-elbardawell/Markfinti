<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname','address','photo','phone','email', 'password','position','identity','role','manger_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    //  local scop function
    public function scopeSelection($query)
    {
        return $query->select('id', 'fname', 'lname','address','photo','phone','email', 'password','position','identity');
    }

    public function clientinfo()
    {
        return $this->hasOne('App\InfoClient','user_id', 'id');
    }


     public function clients(){
        return $this->hasMany("App\User",'manger_id');
     }

    public function manger(){
        return $this->belongsTo("App\User",'manger_id');
    }

    public function notes(){
        return $this->hasMany("App\Notes",'sender_id');
    }




}
