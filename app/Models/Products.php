<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    public $fillable = [
        'id',
        'category_id',
        'pet_id',
        'name',
        'thumbnail',
        'description',
        'sale_price',
        'import_price',
        'quantity',
        'serial',
        'manufacturer',
    ];
    public $timestamps = false;
}
