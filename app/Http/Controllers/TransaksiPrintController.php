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
    public function index(Request $request)
    {
        $numberOrders = numberPagination(5);

        $type = $request->get('type');
        $status = $request->get('status');

        $orders = Print_order::with('paper')
                ->where("type", "LIKE", "%$type%")
                ->where("status", "LIKE", "%$status%")
                ->whereHas("user", function ($query) use ($request) {
                    $query->where("name", "LIKE", "%{$request->get('keyword')}%");
                })->paginate(5);
        
        
        
        $print_orders = Print_order::with('paper')
                ->with('user')
                ->paginate(5);

        $ordersA = Print_order::with('paper')
            ->with('user')->get();
        
        return view('admin.transaksi-print.index', compact('orders', 'numberOrders', 'print_orders'));
    }

    /**
     * Download file transaksi print
    */
    public function downloadFile($id)
    {
        $order_atk = Print_order::findOrFail($id);

        return Storage::download('public/' . $order_atk->file);
    }

    /**
     * Update status transaksi print
    */
    public function updateStatus(Request $request)
    {
        $id = $request->get('order_print_id');
        $status = $request->get('btn-status');

        $print_order = Print_order::findOrFail($id);
        $print_order->status = $status;

        $print_order->save();

        return redirect()
            ->route('order-print.index')
            ->with('status', 'Status Order Print successfully updated');
    }
}
