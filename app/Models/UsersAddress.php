<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersAddress extends Model
{
    use HasFactory;
    protected $table = 'users_address';
    public $fillable = [
        'id',
        'user_id',
        'name',
        'phone',
        'address',
    ];
    public $timestamps = false;
}
