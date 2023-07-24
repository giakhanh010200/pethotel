<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Admin extends Model
{
    protected $table = 'admin';
    public $fillable = [
        'id',
        'name',
        'email',
        'password',
        'level'
    ];
    public $timestamps = false;
    public function check_login(){
        $array = DB::select("select * from $this->table where email = ? or name = ? and password = ?",[$this->email,$this->name,$this->password]);
        return $array;
    }
}
