<?php

namespace App\Http\Controllers;

use App\Models\diachi;
use App\Models\thong_tin_chu_tro;
use App\Models\thong_tin_khu_tro;
use App\Models\thong_tin_truong_dai_hoc;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function addLocation(Request $request) {
        $locationType = $request->input('type');
        $response = ['status' => 'error', 'message' => 'Có lỗi xảy ra khi lưu dữ liệu.'];
    
        if ($locationType === 'truonghoc') {
            $diachi = diachi::create([
                'tenduong' => $request->input('tenDuong'),
                'tenxa' => $request->input('tenXa'),
                'tenhuyen' => $request->input('tenHuyen'),
                'tentinh' => $request->input('tenTinh')
            ]);
          
            try{
                thong_tin_truong_dai_hoc::create([
                    'tentruong' => $request->input('nameTruong'),
                    'toadoGPS' => $request->input('lat') . ',' . $request->input('lng'),
                    'id_diachi' => $diachi->id,
                ]);
                $response = ['status' => 'success', 'message' => 'Dữ liệu đã được lưu thành công.'];
            }catch(Exception $e)
            {
                $response = ['status'=> 'error','message'=> $e->getMessage()];
            }
      

            
        } else {
            $diachi = diachi::create([
                'tenduong' => $request->input('tenDuong'),
                'tenxa' => $request->input('tenXa'),
                'tenhuyen' => $request->input('tenHuyen'),
                'tentinh' => $request->input('tenTinh'),
                'sonha' => $request->input('soNha')
            ]);
            $chutro = thong_tin_chu_tro::create([
                'hoten' => $request->input('hoTen'),
                'gioitinh'=> $request->input('sex'),
                'SDT'=> $request->input('SDT'),
            ]);
            $location = new thong_tin_khu_tro;
            $location->hoten = $request->input('nameTro');
            $location->toadoGPS = $request->input('lat') . ',' . $request->input('lng');
            $location->loaiphong = $request->input('loaiphong');
            $location->id_diachi = $diachi->id;
            $location->id_chutro = $chutro->id;

            
            if ($location->save()) {
                $response = ['status' => 'success', 'message' => 'Dữ liệu đã được lưu thành công.'];
            }
        }
    
        return response()->json($response);
    }
    public function updateLocationTro(Request $request) {
        $locationType = $request->input('type');
        $response = ['status' => 'error', 'message' => 'Có lỗi xảy ra khi lưu dữ liệu.'];
    
        
        
        
        $location = thong_tin_khu_tro::find($request->input('id'));
        $location->hoten = $request->input('nameTro');
        $location->toadoGPS = $request->input('toadoGPS');
        $location->loaiphong = $request->input('loaiphong');
        $location->id_tinhtrang = $request->input('id_tinhtrang');
        
        if ($location->save()) {
            $diachi = diachi::find($request->input('id_diachi'));
            $diachi->tenduong = $request->input('tenDuong');
            $diachi->tenxa = $request->input('tenXa');
            $diachi->tenhuyen =$request->input('tenHuyen');
            $diachi->tentinh =$request->input('tenTinh');
            $diachi->sonha =$request->input('soNha');
            if($diachi->save())
            {
                $chutro = thong_tin_chu_tro::find($request->input('id_chutro'));
                $chutro->hoten = $request->input('hoTen');
                $chutro->gioitinh = $request->input('sex');
                $chutro->SDT = $request->input('SDT');
                if($chutro->save()){
                    $response = ['status' => 'success', 'message' => 'Dữ liệu đã được lưu thành công.'];
                }
            }
                
        }
        
    
        return response()->json($response);
    }
    public function updateLocationTruong(Request $request) {
        $locationType = $request->input('type');
        $response = ['status' => 'error', 'message' => 'Có lỗi xảy ra khi lưu dữ liệu.'];
    
        
        
        
        $location = thong_tin_truong_dai_hoc::find($request->input('id'));
        $location->tentruong = $request->input('nameTruong');
        $location->toadoGPS = $request->input('toadoGPS');
        
        if ($location->save()) {
            $diachi = diachi::find($request->input('id_diachi'));
            $diachi->tenduong = $request->input('tenDuong');
            $diachi->tenxa = $request->input('tenXa');
            $diachi->tenhuyen =$request->input('tenHuyen');
            $diachi->tentinh =$request->input('tenTinh');
            $diachi->sonha =$request->input('soNha');
            if($diachi->save())
                $response = ['status' => 'success', 'message' => 'Dữ liệu đã được lưu thành công.'];
        }
        
    
        return response()->json($response);
    }
    
}
