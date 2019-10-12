<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Print_order;
use Illuminate\Support\Facades\Storage;

class TransaksiPrintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $numberOrders = numberPagination(5);

        $orders = Print_order::with('paper')
                ->with('user')
                ->paginate(5);
        
        $item_orders = Print_order::with('paper')
                ->with('user')
                ->paginate(5);

        $ordersA = Print_order::with('paper')
            ->with('user')->get();
        
        return view('admin.transaksi-print.index', compact('orders', 'numberOrders'));
    }

    public function downloadFile($id)
    {
        $order_atk = Print_order::findOrFail($id);

        return Storage::download('public/' . $order_atk->file);
    }
}
