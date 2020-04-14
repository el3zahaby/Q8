<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property mixed first_name
 * @property mixed last_name
 */
class User extends Authenticatable
{
    use Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'name', 'email', 'password',
//    ];
     protected $guarded=[];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(){
        return $this->hasAnyRole(['super-admin', 'admin']);
    }

    public function isDesigner($string = false){
        $cond = $this->hasAnyRole(['designer']);

        if ($string){
            $cond= ($cond) ?'YES':"NO";
        }

        return $cond;
    }

    public function locations()
    {
        return $this->belongsTo('App\Location');
    }

    public function getFullNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }
    public function getRoleAttribute(){
//        return $this->first_name . ' ' . $this->last_name;
        return $this->getRoleNames()[0] ?? null;
    }
}
