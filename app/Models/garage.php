<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class garage extends Model
{
    use HasFactory;

    protected $fillable = ['garage_name', 'garage_title','creator_id','garage_logo','status'];
    protected $table = 'garage';

    public function scopeFilter($query, array $filters) {

    }
    public function joinedata($user){
        $users = DB::table('garage')
            ->join('links', 'links.garage_id', '=', 'garage.id')
            ->join('users', 'users.id', '=', 'links.user_id')
            ->select('links.*', 'garage.*','users.name')
            ->where('users.id', '=', "$user")
            ->get();
        return $users;
    }
    public function joinedataapi($user){
        $users = DB::table('garage')
            ->join('links', 'links.garage_id', '=', 'garage.id')
            ->join('users', 'users.id', '=', 'links.user_id')
            ->select('links.*', 'garage.*','users.name')
            ->where([['users.id', '=', "$user"],['garage.status','!=' , '0']])
            ->get();
        return $users;
    }
    public function getusers($garage){
        $users = DB::table('garage')
            ->join('links', 'links.garage_id', '=', 'garage.id')
            ->join('users', 'users.id', '=', 'links.user_id')
            ->select('users.id')
            ->where('garage.id', '=', "$garage")
            ->get();
        return $users;
    }
    public function getadminsusers($garage){
        $users = DB::table('garage')
            ->join('links', 'links.garage_id', '=', 'garage.id')
            ->join('users', 'users.id', '=', 'links.user_id')
            ->select('users.id')
            ->where([['garage.id', '=', "$garage"],["links.rank" , "<=" , "2"]])
            ->get();
        return $users;
    }
}
