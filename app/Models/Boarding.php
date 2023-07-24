<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boarding extends Model
{
    use HasFactory;
    protected $table = 'boarding';
    public $fillable = [
        'id',
        'name',
        'price',

    ];
    public $timestamps = false;
}
