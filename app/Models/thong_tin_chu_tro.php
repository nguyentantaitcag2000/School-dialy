<?php

namespace App\Models;

use App\Http\Controllers\ThongTinKhuTroController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thong_tin_chu_tro extends Model
{
    use HasFactory;
    protected $table = 'thong_tin_chu_tro';
    public $timestamps = false;

    protected $fillable = [
        'hoten',
        'gioitinh',
        'SDT',
    ];
    function nhaTro()
    {
        return $this->hasMany(thong_tin_khu_tro::class, 'id_chutro', 'id');
    }

}
