<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class cargo extends Model
{
    protected $fillable = ['id','cargo_count', 'cargo_name','garage_id','cargo_price','cargo_price','cargo_logo','cargo_status'];
    protected $table = 'cargo';
    use HasFactory;
    public function data($garage){
        $cargos = DB::table('cargo')
            ->select('cargo.*')
            ->where('cargo.garage_id', '=', "$garage")
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
            ->join('garage', 'garage.id', '=', 'cargo.garage_id')
            ->join('links', 'links.garage_id', '=', 'garage.id')
            ->join('users', 'users.id', '=', 'links.user_id')
            ->select('users.id')
            ->where('cargo.id', '=', "$cargo")
            ->get();
        return $users;
    }
    public function getadminsusers($cargo){
        $users = DB::table('cargo')
            ->join('garage', 'garage.id', '=', 'cargo.garage_id')
            ->join('links', 'links.garage_id', '=', 'garage.id')
            ->join('users', 'users.id', '=', 'links.user_id')
            ->select('users.id')
            ->where([['cargo.id', '=', "$cargo"],["links.rank" , "<=" , "2"]])
            ->get();
        return $users;
    }
}
