<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class cargo extends Model
{
    protected $fillable = ['id','cargo_count', 'cargo_name','wearhouse_id','cargo_price','cargo_price','cargo_logo','cargo_status'];
    protected $table = 'cargo';
    use HasFactory;
    public function data($wearhouse){
        $cargos = DB::table('cargo')
            ->select('cargo.*')
            ->where('cargo.wearhouse_id', '=', "$wearhouse")
            ->get();
        return $cargos;
    }
    public function onedata($cargo){
        $cargos = DB::table('cargo')
            ->select('cargo.*')
            ->where('cargo.id', '=', "$cargo")
            ->get();
        return $cargos;
    }
    public function getusers($cargo){
        $users = DB::table('cargo')
            ->join('wearhouse', 'wearhouse.id', '=', 'cargo.wearhouse_id')
            ->join('employers', 'employers.wearhouse_id', '=', 'wearhouse.id')
            ->join('users', 'users.id', '=', 'employers.user_id')
            ->select('users.id')
            ->where('cargo.id', '=', "$cargo")
            ->get();
        return $users;
    }
    public function getadminsusers($cargo){
        $users = DB::table('cargo')
            ->join('wearhouse', 'wearhouse.id', '=', 'cargo.wearhouse_id')
            ->join('employers', 'employers.wearhouse_id', '=', 'wearhouse.id')
            ->join('users', 'users.id', '=', 'employers.user_id')
            ->select('users.id')
            ->where([['cargo.id', '=', "$cargo"],["employers.rank" , "<=" , "2"]])
            ->get();
        return $users;
    }
}
