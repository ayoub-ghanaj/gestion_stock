<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class employers extends Model
{
    use HasFactory;
    protected $fillable = ['wearhouse_id', 'user_id','role','title','role','rank'];
    protected $table = 'employers';
    public function data($wearhouse){
        $employers = DB::table('employers')
                        ->join('users', 'users.id', '=', 'employers.user_id')
                        ->select('employers.*','users.name','users.email','users.image')
                        ->where('employers.wearhouse_id', '=', "$wearhouse")
                        ->orderBy('created_at','desc')
                        ->get();
        return $employers;
    }
    public function user_data($wearhouse,$user){
        $employers = DB::table('employers')
                        ->join('users', 'users.id', '=', 'employers.user_id')
                        ->select('employers.*','users.name','users.email','users.image')
                        ->where([['employers.wearhouse_id', '=', "$wearhouse"],['employers.user_id','=' ,$user]])
                        ->orderBy('created_at','desc')
                        ->get();
        return $employers;
    }
}
