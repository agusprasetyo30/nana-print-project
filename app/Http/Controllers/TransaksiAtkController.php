<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item_order;

class TransaksiAtkController extends Controller
{
    /**
     * Menampilkan data dari Transaksi ATK
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->get('status') ? $request->get('status') : '';
        $numberOrders = numberPagination(5);

        $orders = Item_order::with('item')
            ->where("status", "LIKE","%$status%")
            ->whereHas("user", function ($query) use ($request) {
                $query->where("name", "LIKE", "%{$request->get('keyword')}%");
            })->paginate(5);
        
        $order_item = Item_order::with('user')
            ->with('item')
            ->get();

        return view('admin.transaksi-atk.index', compact('orders', 'order_item', 'numberOrders'));
    }

    /**
     * Mengedit status transaksi ATK.
     */
    public function updateStatus(Request $request)
    {
        $id = $request->get('order_atk_id');
        $status = $request->get('btn-status');

        $item_order = Item_order::findOrFail($id);
        $item_order->status = $status;

        $item_order->save();

        return redirect()
            ->route('order-atk.index')
            ->with('status', 'Status Order ATK successfully updated');
    }
}
