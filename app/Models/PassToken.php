<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassToken extends Model
{
    protected $table = 'pass_token';
    public $fillable = [
        'email',
        'token',
        'created_at',
    ];
    public $timestamps = false;
}
