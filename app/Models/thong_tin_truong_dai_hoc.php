<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thong_tin_truong_dai_hoc extends Model
{
    use HasFactory;
    protected $table = 'thong_tin_truong_dai_hoc';
    public $timestamps = false;

    protected $fillable = [
        'tentruong',
        'toadoGPS',
        'icon',
        'id_diachi'
    ];
    function diachi()
    {
        return $this->belongsTo(diachi::class, 'id_diachi', 'id');
    }

}
