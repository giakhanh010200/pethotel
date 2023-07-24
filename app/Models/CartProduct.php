<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;
    protected $table = 'cart_product';
    public $fillable = [
        'id',
        'cart_id_render',
        'user_id',
        'user_name',
        'user_address',
        'user_phone',
        'product_id',
        'product_name',
        'product_price',
        'product_thumbnail',
        'quantity',
        'total_prices',
        'status',
        'created_at',
        'payment_at',
    ];
    public $timestamps = false;
}
