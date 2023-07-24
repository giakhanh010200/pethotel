<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;
    public $table = 'users';
    public $fillable = [
        'id',
        'username',
        'email',
        'password',
        'avatar',
        'level'
    ];
    public $timestamps = false;
    public function check_login(){
        $array = DB::select("select * from $this->table where email = ? or username = ? and password = ?",[$this->email,$this->name,$this->password]);
        return $array;
    }
}
