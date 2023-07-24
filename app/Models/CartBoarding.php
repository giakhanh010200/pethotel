<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartBoarding extends Model
{
    use HasFactory;
    protected $table = 'cart_boarding';
    public $fillable = [
        'id',
        'cart_id',
        'boarding_id',
        'boarding_price',
        'boarding_name',
        'user_id',
        'user_name',
        'user_phone',
        'user_email',
        'start_date',
        'end_date',
        'total_pet',
        'total_price',
        'created_at',
        'status',
        'pet_id',
        'store_id',
        'store_add',
        'pet_name'

    ];
    public $timestamps = false;
}
