<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\ThongTinTruongDaiHocController;
use App\Models\thong_tin_chu_tro;
use App\Models\thong_tin_khu_tro;
use App\Models\thong_tin_loai_phong;
use App\Models\thong_tin_truong_dai_hoc;
use App\Models\tinhtrang;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    $thong_tin_truong_dai_hoc = thong_tin_truong_dai_hoc::with('diachi')->get();
    $thong_tin_khu_tro = thong_tin_khu_tro::with('diachi')->with('tinhtrang')->with('chutro')->with('loaiPhong')->get();
    // $x = $thong_tin_khu_tro[0]['diachi'];
    // $y = $thong_tin_truong_dai_hoc[0]->diachi;
    $thong_tin_loai_phong = thong_tin_loai_phong::get();
    $thong_tin_chu_tro = thong_tin_chu_tro::with('nhaTro')->get();
    $tinhtrang = tinhtrang::get();
    return view('welcome',[
        'thong_tin_truong_dai_hoc' => $thong_tin_truong_dai_hoc,
        'thong_tin_khu_tro' => $thong_tin_khu_tro,
        'thong_tin_loai_phong' => $thong_tin_loai_phong,
        'thong_tin_chu_tro' => $thong_tin_chu_tro,
        'tinhtrang' => $tinhtrang,
    ]);
});
