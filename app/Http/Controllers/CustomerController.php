<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Print_order;
use App\Item;
use App\Category;
use App\Paper;

class CustomerController extends Controller
{
    /**
     * Menampilkan form registrasi
     *
     */
    public function registration()
    {
        return view('auth.registration');
    }

    /**
     * Menampilkan form transaksi foto
     *
     */
    public function orderTransactionPhotoForm()
    {
        return view('customer.transaksi-photo.index');
    }

    /**
     * Menampilkan form transaksi foto
     *
     */
    public function orderTransactionPrintForm()
    {
        $papersPrint = Paper::where("type", "=", "PRINT")->get();

        return view('customer.transaksi-print.index', compact('papersPrint'));
    }

    /**
     * Proses penyimpanan data transaksi print customer
     *
     */
    public function orderTransactionPrintProcess(Request $request)
    {
        $idUser = Auth::user()->id;
        $namaUser = Auth::user()->name;

        $id_kertas = $request->get('ambil_id');
        $jml_beli = $request->get('jumlah');
        $jml_total_beli = $request->get('jumlah_total');
        $total_keseluruhan = array_sum($request->get('jumlah_total'));
        $deskripsi = $request->get('description'); 

        $fileRequest = $request->file('file');
        
        $print_order = new Print_order;
        
        $pivot = [];

        for ($i=0; $i < count($id_kertas); $i++) {
            array_push($pivot, ['quantity' => $jml_beli[$i], 'total_quantity_price' => $jml_total_beli[$i]]);
        }
        $sync = array_combine($id_kertas, $pivot);

        $print_order->user_id = $idUser;
        $print_order->total_price = $total_keseluruhan;
        $print_order->file = saveFileTransaksi($fileRequest, $namaUser, 'print-orders');
        $print_order->description = $deskripsi;
        $print_order->type = "PRINT";
        $print_order->status = "SUBMIT";

        $print_order->save();

        // Mengisi data relasi
        $print_order->paper()->sync($sync);

        // return redirect()
            // ->route('item.index')
            // ->with('status', 'Item successfully add');
    }


    /**
     * Menampilkan form kontak kami
     *
     */
    public function contactUs()
    {
        return view('customer.kontak-kami.index');
    }

    /**
     * Menampilkan Dashboard customer
     *
     */
    public function dashboardCustomer()
    {
        // $data = Auth::user();
        // dd($data->name);

        $items = Item::where("status", "=", "SHOW")->get();

        return view('customer.dashboard.index', compact('items'));
    }


    /**
     * Menampilkan produk yang dijual
     *
     */
    public function productData()
    {
        $categories = Category::with('items')->get();

        $items = Item::where("status", "=", "SHOW")->paginate(10);
        
        $itemsCount = Item::where("status", "=", "SHOW")->count();

        return view('customer.product.index', compact('categories', 'items', 'itemsCount'));
    }

}
