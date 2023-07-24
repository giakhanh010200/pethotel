<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todos extends Model
{
    use HasFactory;
    protected $table = 'todos';
    public $fillable = [
        'id',
        'admin_up',
        'notes',
        'check',
        'upload_time',
        'start_time',
        'end_time',
        'done_time',
        'admin_do'
    ];
    public $timestamps = false;
}
