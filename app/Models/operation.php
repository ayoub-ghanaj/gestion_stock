<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class operation extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'description','type','ammount','cargo_id','id'];
    protected $table = 'operation';

    public function get_gara_opr($garage)
    {
        $operations = DB::table('operation')
            ->join('users', 'users.id', '=', 'operation.user_id')
            ->join('cargo', 'cargo.id', '=', 'operation.cargo_id')
            ->join('garage', 'garage.id', '=', 'cargo.garage_id')
            ->select('operation.*','users.name','users.id','users.image','cargo.cargo_name','cargo.cargo_logo')
            ->where([['garage.id', '=', $garage],['cargo.cargo_status' ,'=' ,'1']])
            ->orderBy('operation.id', 'DESC')
            ->get();
            return $operations;
        }
        public function get_cargo_opr($cargo)
        {
            $operations = DB::table('operation')
            ->join('users', 'users.id', '=', 'operation.user_id')
            ->join('cargo', 'cargo.id', '=', 'operation.cargo_id')
            ->join('garage', 'garage.id', '=', 'cargo.garage_id')
            ->select('operation.*','users.name','users.id','users.image','cargo.cargo_name','cargo.cargo_logo')
            ->where([['cargo.id', '=', $cargo],['cargo.cargo_status' ,'=' ,'1']])
            ->orderBy('operation.id', 'DESC')
            ->get();
        return $operations;
    }
}
