<?php

namespace App\Http\Controllers;

use App\Models\thong_tin_chu_tro;
use Illuminate\Http\Request;

class ThongTinChuTroController extends Controller
{
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $row = thong_tin_chu_tro::find($id);

        if ($row) {
            $row->delete(); // Xóa bản ghi
            $response = ['status' => 'success', 'message' => 'Xóa thành công.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Không tìm thấy bản ghi.'];
        }

        return response()->json($response);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        thong_tin_chu_tro::create([
            'hoten' => $request->input('hoTen'),
            'gioitinh'=> $request->input('sex'),
            'SDT'=> $request->input('SDT'),
        ]);
        $response = ['status' => 'success', 'message' => 'Dữ liệu đã được lưu thành công.'];
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(thong_tin_chu_tro $thong_tin_chu_tro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(thong_tin_chu_tro $thong_tin_chu_tro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, thong_tin_chu_tro $thong_tin_chu_tro)
    {
        $cc = thong_tin_chu_tro::find($request->input('id'));
        $cc->hoten = $request->input('hoTen');
        $cc->SDT = $request->input('SDT');
        $cc->gioitinh = $request->input('sex');
        $cc->save();
        $response = ['status' => 'success', 'message' => 'Dữ liệu đã được lưu thành công.'];
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(thong_tin_chu_tro $thong_tin_chu_tro)
    {
        //
    }
}
