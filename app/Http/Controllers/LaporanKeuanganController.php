<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Item_order;
use App\Print_order;
use App\Helpers\LaporanKeuangan;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class LaporanKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

        $data = LaporanKeuangan::getItemOrderData();

        $total = LaporanKeuangan::getItemOrderData()->count();

        // set current page
        $currentPage = Paginator::resolveCurrentPage();

        $perPage = 5;

        // generate pagination
        $currentResults = $data->slice(($currentPage - 1) * $perPage, $perPage)->all(); 

        $results = new LengthAwarePaginator($currentResults, $total, $perPage);

        dd($data, $total, $currentPage, $currentResults ,$results);

        // $coba = get_object_vars(LaporanKeuangan::getTotalPrice());
        $obj = LaporanKeuangan::getTotalPrice(); 
        $obj1 = LaporanKeuangan::getMonth(); 
        $obj2 = LaporanKeuangan::getYear(); 

        for ($i=0; $i < count($obj); $i++) { 
            echo convertBulan($obj1[$i]) . " " . $obj2[$i];
        }
        // dd($obj[0]);

        // $print_orders = DB::table('print_orders')
        //     ->select(DB::raw("sum(total_price) as total_price , type, status, MONTH(created_at) as month,
        //             YEAR(created_at) as YEAR"))
        //     ->groupBy('type', 'status', 'month', 'year')
        //     ->having('status', 'FINISH')
        //     ->having('type', 'PRINT')
        //     ->get();
        // ->having('month', 1)
        // ->having('year', 2019)

        // $photo_orders = DB::table('print_orders')
        //     ->select(DB::raw("sum(total_price) as total_price , type, status, MONTH(created_at) as month,
        //             YEAR(created_at) as YEAR"))
        //     ->groupBy('type', 'status', 'month', 'year')
        //     ->having('status', 'FINISH')
        //     ->having('type', 'PHOTO')
        //     ->get();

        } catch (\Exception $e) {
            //throw $th;
        }

        return view('admin.laporan-keuangan.index');        
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
