<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopAddress extends Model
{
    use HasFactory;
    protected $table = 'shop_address';
    public $fillable = [
        'address',
        'open',
        'close',
        'map_place'
    ];
    public $timestamps = false;
}
