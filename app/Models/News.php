<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class News extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $table = 'news';
    public $fillable = [
        'id',
        'title',
        'content',
        'thumbnail',
        'created_at',
        'updated_at'
    ];
    public $timestamps = false;
}
