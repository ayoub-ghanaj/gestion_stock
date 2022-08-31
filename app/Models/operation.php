<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class operation extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'description','type','ammount','cargo_id','id','bill_id'];
    protected $table = 'operation';

    public function get_gara_opr($wearhouse,$bill)
    {
        $operations = DB::table('operation')
            ->join('users', 'users.id', '=', 'operation.user_id')
            ->join('operation', 'operation.id', '=', 'operation.bill_id')
            ->join('cargo', 'cargo.id', '=', 'operation.cargo_id')
            ->join('wearhouse', 'wearhouse.id', '=', 'cargo.wearhouse_id')
            ->select('operation.*','users.name','users.id','users.image','cargo.cargo_name','cargo.cargo_logo')
            ->where([['wearhouse.id', '=', $wearhouse],['cargo.cargo_status' ,'=' ,'1'],['bill.id','=',"$bill"]])
            ->orderBy('operation.id', 'DESC')
            ->get();
            return $operations;
        }
        public function get_cargo_opr($cargo)
        {
            $operations = DB::table('operation')
            ->join('users', 'users.id', '=', 'operation.user_id')
            ->join('cargo', 'cargo.id', '=', 'operation.cargo_id')
            ->join('wearhouse', 'wearhouse.id', '=', 'cargo.wearhouse_id')
            ->select('operation.*','users.name','users.id','users.image','cargo.cargo_name','cargo.cargo_logo')
            ->where([['cargo.id', '=', $cargo],['cargo.cargo_status' ,'=' ,'1']])
            ->orderBy('operation.id', 'DESC')
            ->get();
        return $operations;
    }
        public function bill_ops($bill)
        {
            $operations = DB::table('operation')
            ->join('cargo', 'cargo.id', '=', 'operation.cargo_id')
            ->select('operation.*','cargo.cargo_name','cargo.cargo_logo','cargo.cargo_price')
            ->where([['operation.bill_id', '=', $bill],['cargo.cargo_status' ,'=' ,'1']])
            ->orderBy('operation.id', 'DESC')
            ->get();
        return $operations;
    }
}
