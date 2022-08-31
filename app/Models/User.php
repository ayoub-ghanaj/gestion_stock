<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function apidata($name , $wearhouse){
        $users = DB::table('users')
            ->select('users.name','users.id','users.image')
            ->where('users.name', 'LIKE', "%".$name."%")
            ->whereNotIn('users.id', DB::table('employers')->select('user_id')->where('wearhouse_id' ,'=', $wearhouse)->pluck('user_id')->toArray())
            ->get();
        return $users;
    }
}
