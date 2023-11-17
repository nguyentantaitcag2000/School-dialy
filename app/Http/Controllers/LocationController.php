<?php

namespace App\Http\Controllers;

use App\Models\diachi;
use App\Models\thong_tin_chu_tro;
use App\Models\thong_tin_khu_tro;
use App\Models\thong_tin_truong_dai_hoc;
use Exception;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class LocationController extends Controller
{
    public function addLocation(Request $request) {
        $locationType = $request->input('type');
        $base64Data = $request->input('icon');
        $response = ['status' => 'error', 'message' => 'Có lỗi xảy ra khi lưu dữ liệu.'];
        
        if ($locationType === 'truonghoc') {
            $diachi = diachi::create([
                'tenduong' => $request->input('tenDuong'),
                'tenxa' => $request->input('tenXa'),
                'tenhuyen' => $request->input('tenHuyen'),
                'tentinh' => $request->input('tenTinh')
            ]);
          
            try{
                $location = new thong_tin_truong_dai_hoc();
                $location->tentruong = $request->input('nameTruong');
                $location->toadoGPS = $request->input('lat') . ',' . $request->input('lng');
                $location->id_diachi = $diachi->id;
                $this->cropIcon($base64Data, $location);

                $location->save();
                
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
         
            $location = new thong_tin_khu_tro;
            $location->hoten = $request->input('nameTro');
            $location->toadoGPS = $request->input('lat') . ',' . $request->input('lng');
            $location->loaiphong = $request->input('loaiphong');
            $location->id_diachi = $diachi->id;
            $location->id_chutro = $request->input('chuTro');

            
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
                $response = ['status' => 'success', 'message' => 'Dữ liệu đã được lưu thành công.'];
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
        // Lấy dữ liệu base64 từ request
        $base64Data = $request->input('icon');
        if($base64Data != "")
        {
            $this->cropIcon($base64Data, $location);
        }
        

        
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
    private function cropIcon($base64Data, $location )
    {
        // Decode base64 thành dữ liệu ảnh
        $image = Image::make($base64Data);

        // Crop ảnh về kích thước 50x50px
        $image->fit(50, 50);

        // Lưu ảnh đã crop vào CSDL hoặc thực hiện các thao tác khác
        $location->icon = $image->encode('data-url')->encoded;
    }
    
}
