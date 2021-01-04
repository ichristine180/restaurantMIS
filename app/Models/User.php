<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'roleid',
        'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
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
    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function userRole($roles){
        $userRoles = [];
        $role = '';
        foreach ($roles as $role) {
           $users= $role->pivot->role_id;
           $name= Role::find($users)->name;
           array_push($userRoles, $name);
        }
        if(in_array('Managing Director',$userRoles)){
            $role = 'Managing Director';
        }elseif(in_array('Manager',$userRoles)){
            $role = 'Manager';
        }
        elseif(in_array('Supervisor',$userRoles)){
            $role = 'Supervisor';
        }elseif(in_array('Cashier',$userRoles)){
            $role = 'Cashier';
        }
        else{
            $role = 'Waiter';
        }
        return $role;
    }
}
