<?php

namespace App\Http\Controllers;

use App\Models\thong_tin_truong_dai_hoc;
use Illuminate\Http\Request;

class ThongTinTruongDaiHocController extends Controller
{
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $location = thong_tin_truong_dai_hoc::find($id);

        if ($location) {
            $location->delete(); // Xóa bản ghi
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
        return view('home');
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
    public function show(thong_tin_truong_dai_hoc $thong_tin_truong_dai_hoc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(thong_tin_truong_dai_hoc $thong_tin_truong_dai_hoc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, thong_tin_truong_dai_hoc $thong_tin_truong_dai_hoc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(thong_tin_truong_dai_hoc $thong_tin_truong_dai_hoc)
    {
        //
    }
}
