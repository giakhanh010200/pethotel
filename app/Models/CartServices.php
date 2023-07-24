<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartServices extends Model
{
    use HasFactory;
    protected $table = 'cart_services';
    public $fillable = [
        'id',
        'cart_id',
        'user_id',
        'pet_id',
        'total_pet',
        'user_name',
        'user_email',
        'user_phone',
        'service_id',
        'service_name',
        'service_price',
    ];
    public $timestamps = false;
    public function users()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
    public function pets()
    {
        return $this->belongsTo(Pet::class, 'pet_id');
    }
}
