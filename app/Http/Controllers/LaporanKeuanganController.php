<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Item_order;
use App\Print_order;
use App\Helpers\LaporanKeuangan;

class LaporanKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // try {

        $month = $request->get('month') ? $request->get('month') : null;
        $year = $request->get('year') ? $request->get('year') : null;

        $item_order_data = LaporanKeuangan::getItemOrderData($month, $year);
        $totalPage = 5;
        $number = numberPagination($totalPage);

        $order_item = customPagination($item_order_data, $item_order_data->count(), $totalPage);
        
        $print_order_data = LaporanKeuangan::getPrintOrderData($month, $year);
        $photo_order_data = LaporanKeuangan::getPhotoOrderData($month, $year);


        // } catch (\Exception $e) {
            //throw $th;
        // }

        return view('admin.laporan-keuangan.index', compact('number', 'order_item', 'print_order_data', 'photo_order_data'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
