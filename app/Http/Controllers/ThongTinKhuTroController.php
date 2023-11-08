<?php

namespace App\Http\Controllers;

use App\Models\thong_tin_khu_tro;
use Illuminate\Http\Request;

class ThongTinKhuTroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $location = thong_tin_khu_tro::find($id);

        if ($location) {
            $location->delete(); // Xóa bản ghi
            $response = ['status' => 'success', 'message' => 'Xóa thành công.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Không tìm thấy bản ghi.'];
        }

        return response()->json($response);
    }
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(thong_tin_khu_tro $thong_tin_khu_tro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(thong_tin_khu_tro $thong_tin_khu_tro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, thong_tin_khu_tro $thong_tin_khu_tro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(thong_tin_khu_tro $thong_tin_khu_tro)
    {
        //
    }
}
