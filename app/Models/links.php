<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class links extends Model
{
    use HasFactory;
    protected $fillable = ['garage_id', 'user_id','role','title','role','rank'];
    protected $table = 'links';
    public function data($garage){
        $links = DB::table('links')
                        ->join('users', 'users.id', '=', 'links.user_id')
                        ->select('links.*','users.name','users.email','users.image')
                        ->where('links.garage_id', '=', "$garage")
                        ->orderBy('created_at','desc')
                        ->get();
        return $links;
    }
    public function user_data($garage,$user){
        $links = DB::table('links')
                        ->join('users', 'users.id', '=', 'links.user_id')
                        ->select('links.*','users.name','users.email','users.image')
                        ->where([['links.garage_id', '=', "$garage"],['links.user_id','=' ,$user]])
                        ->orderBy('created_at','desc')
                        ->get();
        return $links;
    }
}
