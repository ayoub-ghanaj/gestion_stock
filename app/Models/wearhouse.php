<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class wearhouse extends Model
{
    use HasFactory;

    protected $fillable = ['wearhouse_name', 'wearhouse_title','creator_id','wearhouse_logo','status'];
    protected $table = 'wearhouse';

    public function scopeFilter($query, array $filters) {

    }
    public function joinedata($user){
        $users = DB::table('wearhouse')
            ->join('employers', 'employers.wearhouse_id', '=', 'wearhouse.id')
            ->join('users', 'users.id', '=', 'employers.user_id')
            ->select('employers.*', 'wearhouse.*','users.name')
            ->where('users.id', '=', "$user")
            ->get();
        return $users;
    }
    public function joinedataapi($user){
        $users = DB::table('wearhouse')
            ->join('employers', 'employers.wearhouse_id', '=', 'wearhouse.id')
            ->join('users', 'users.id', '=', 'employers.user_id')
            ->select('employers.*', 'wearhouse.*','users.name')
            ->where([['users.id', '=', "$user"],['wearhouse.status','!=' , '0']])
            ->get();
        return $users;
    }
    public function getusers($wearhouse){
        $users = DB::table('wearhouse')
            ->join('employers', 'employers.wearhouse_id', '=', 'wearhouse.id')
            ->join('users', 'users.id', '=', 'employers.user_id')
            ->select('users.id')
            ->where('wearhouse.id', '=', "$wearhouse")
            ->get();
        return $users;
    }
    public function getadminsusers($wearhouse){
        $users = DB::table('wearhouse')
            ->join('employers', 'employers.wearhouse_id', '=', 'wearhouse.id')
            ->join('users', 'users.id', '=', 'employers.user_id')
            ->select('users.id')
            ->where([['wearhouse.id', '=', "$wearhouse"],["employers.rank" , "<=" , "2"]])
            ->get();
        return $users;
    }
}
