<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\ThongTinChuTroController;
use App\Http\Controllers\ThongTinKhuTroController;
use App\Http\Controllers\ThongTinTruongDaiHocController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/add-chuTro', [ThongTinChuTroController::class, 'store']);
Route::post('/update-chuTro', [ThongTinChuTroController::class, 'update']);
Route::post('/add-location', [LocationController::class, 'addLocation']);
Route::post('/update-location-tro', [LocationController::class, 'updateLocationTro']);
Route::post('/update-location-truong', [LocationController::class, 'updateLocationTruong']);
Route::post('/tro/delete-location', [ThongTinKhuTroController::class, 'delete']);
Route::post('/delete-chuTro', [ThongTinChuTroController::class, 'delete']);
Route::post('/truong/delete-location', [ThongTinTruongDaiHocController::class, 'delete']);
