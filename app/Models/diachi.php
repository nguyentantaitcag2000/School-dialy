<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class diachi extends Model
{
    use HasFactory;
    protected $table = 'diachi';
    public $timestamps = false;
    protected $fillable = [
        'sonha',
        'tenduong',
        'tenxa',
        'tenhuyen',
        'tentinh',
    ];
}
