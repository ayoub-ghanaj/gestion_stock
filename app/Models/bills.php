<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class bills extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'description','title','bill_price','wearhouse_id','id','company_name','type'];
    protected $table = 'bill';

    public function list($wearhouse){
        $list = DB::table('bill')
            ->join('wearhouse', 'wearhouse.id', '=', 'bill.wearhouse_id')
            ->join('users', 'users.id', '=', 'bill.user_id')
            ->select('bill.*','users.name')
            ->where('wearhouse.id', '=', "$wearhouse")
            ->get();
        return $list;
    }
    public function data($wearhouse){
        $list = DB::table('bill')
            ->join('wearhouse', 'wearhouse.id', '=', 'bill.wearhouse_id')
            ->join('users', 'users.id', '=', 'bill.user_id')
            ->select('bill.*','users.name')
            ->where('wearhouse.id', '=', "$wearhouse")
            ->get();
        return $list;
    }
}


