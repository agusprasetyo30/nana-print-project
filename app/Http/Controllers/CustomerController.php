<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;
use App\Paper;

class CustomerController extends Controller
{
    // Menampilkan form registrasi
    public function registration()
    {
        return view('auth.registration');
    }

    // Menampilkan form transaksi foto
    public function orderTransactionPhotoForm()
    {
        return view('customer.transaksi-photo.index');
    }

    // Menampilkan form transaksi foto
    public function orderTransactionPrintForm()
    {
        $papersPrint = Paper::where("type", "=", "PRINT")->get();

        return view('customer.transaksi-print.index', compact('papersPrint'));
    }

    public function orderTransactionPrintProcess(Request $request)
    {
        // dd($request->file('file'));
        
        dd($request->get('kertas') ,$request->get('ambil_id'), $request->get('jumlah') ,array_sum($request->get('jumlah_total')));
    }


    // Menampilkan form kontak kami
    public function contactUs()
    {
        return view('customer.kontak-kami.index');
    }

    // Dashboard customer
    public function dashboardCustomer()
    {
        $items = Item::where("status", "=", "SHOW")->get();

        return view('customer.dashboard.index', compact('items'));
    }


    // Menampilkan produk yang dijual
    public function productData()
    {
        $categories = Category::with('items')->get();

        $items = Item::where("status", "=", "SHOW")->paginate(10);
        
        $itemsCount = Item::where("status", "=", "SHOW")->count();

        return view('customer.product.index', compact('categories', 'items', 'itemsCount'));
    }

}
