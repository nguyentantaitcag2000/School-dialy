<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thong_tin_khu_tro extends Model
{
    use HasFactory;
    protected $table = 'thong_tin_khu_tro';
    public $timestamps = false;
    protected $fillable = [
        'hoten',
        'toadoGPS',
        'loaiphong', // 2 hoặc 1
        'id_diachi'
    ];

    function diachi()
    {
        return $this->belongsTo(diachi::class, 'id_diachi', 'id');
    }
    function tinhtrang()
    {
        return $this->belongsTo(tinhtrang::class, 'id_tinhtrang', 'id');
    }
    function chutro()
    {
        return $this->belongsTo(thong_tin_chu_tro::class, 'id_chutro', 'id');
    }
    function loaiPhong()
    {
        return $this->belongsTo(thong_tin_loai_phong::class, 'loaiphong', 'id');
    }
    
}
