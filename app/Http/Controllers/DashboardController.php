<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Item;
use App\Print_order;
use App\Item_order;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jml_user = count(User::all());
        $jml_item = count(Item::all());
        $jml_transaksi_print = count(Print_order::where("status", "=", "FINISH")->get());
        $jml_transaksi_atk = count(Item_order::where("status", "=", "FINISH")->get());

        return view('admin.dashboard.index', compact('jml_user', 'jml_item', 'jml_transaksi_print', 'jml_transaksi_atk'));
    }
}
