<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $location = 'print-orders';

        $file = $request->file('file');
        $name = 'Uwaw' . \Carbon\Carbon::now()->format('Y-m-dH:i:s') . '.' . $file->getClientOriginalExtension();

        $file->storeAs('public/'. $location , $name);
        
        return dd($location .'/'. $name);

        // dd($request->get('kertas') ,$request->get('ambil_id'), $request->get('jumlah'), $request->get('jumlah_total') ,array_sum($request->get('jumlah_total')));
    }


    // Menampilkan form kontak kami
    public function contactUs()
    {
        return view('customer.kontak-kami.index');
    }

    // Dashboard customer
    public function dashboardCustomer()
    {
        // $data = Auth::user();
        // dd($data->getRoleNames());

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
