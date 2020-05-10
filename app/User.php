<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property mixed first_name
 * @property mixed last_name
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable,HasRoles;
    public function scopeNotHaveRole(Builder $query): Builder
    {
        $roles = Role::all();
        $users = User::all();
        $roledUsers = collect();
        foreach ($roles as $role){
            foreach ($role->users as $user) {
                $roledUsers->push($user);
            }
        }

        return $query->whereNotIn('id', $roledUsers->pluck('id'));
    }



    protected $appends = ['is_designer'];
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
    public function getIsDesignerAttribute($string = false){
        $cond = $this->hasAnyRole(['designer']);

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


    public static function boot(){
        parent::boot();

        static::creating(function($table)
        {
            $first =  User::first();
            if(!$first){
                $table->id = config('app.firstId');
            }
        });
    }

}
