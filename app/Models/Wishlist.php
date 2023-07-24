<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $table = 'wishlist';
    public $fillable = [
        'id',
        'user_id',
        'product_id',
    ];
    public $timestamps = false;
}
