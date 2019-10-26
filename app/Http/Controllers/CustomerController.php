<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\Print_order;
use App\Item_order;
use App\Item;
use App\Category;
use App\Paper;
use App\User;
use Illuminate\Support\Facades\Hash;

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

    public function saveRegistration(Request $request)
    {
        $avatar = $request->file('avatar');

        $data = new User;

        $data->name = $request->get('nama');
        $data->username = $request->get('username');
        $data->email = $request->get('email');
        $data->password = Hash::make($request->get('password'));
        $data->address = $request->get('alamat');
        $data->phone = $request->get('no-telepon');
        $data->status = "ACTIVE";
        if ($avatar)
        {
            $avatar_path = saveOriginalPhoto($avatar, $data->username, 'user-avatars');

            $data->avatar = $avatar_path;

        } else {

            $data->avatar = "";
        }

        $data->save();

        $data->assignRole("customer");
        // dd($request);

        return redirect()
            ->route('login')
            ->with('status', 'Registrasi akun sukses');
    }

    /**
     * Menampilkan form transaksi foto
     *
     */
    public function orderTransactionPhotoForm()
    {
        $papersPrint = Paper::where("type", "=", "PHOTO")->get();

        return view('customer.transaksi-photo.index', compact('papersPrint'));
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
        
        // Untuk menampung data pivot
        $pivot = [];

        // Mengisi data array pivot
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

        return redirect()
            ->route('customer.dashboard')
            ->with('status', 'Transaksi Print Data Sukses');
    }

    /**
     * Proses penyimpanan data transaksi print customer
     *
     */
    public function orderTransactionPhotoProcess(Request $request)
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
        
        // Untuk menampung data pivot
        $pivot = [];

        // Mengisi data array pivot
        for ($i=0; $i < count($id_kertas); $i++) {
            array_push($pivot, ['quantity' => $jml_beli[$i], 'total_quantity_price' => $jml_total_beli[$i]]);
        }
        
        $sync = array_combine($id_kertas, $pivot);

        $print_order->user_id = $idUser;
        $print_order->total_price = $total_keseluruhan;
        $print_order->file = saveFileTransaksi($fileRequest, $namaUser, 'print-orders');
        $print_order->description = $deskripsi;
        $print_order->type = "PHOTO";
        $print_order->status = "SUBMIT";

        $print_order->save();

        // Mengisi data relasi
        $print_order->paper()->sync($sync);

        return redirect()
            ->route('customer.dashboard')
            ->with('status', 'Transaksi Print Foto Data Sukses');
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
     * Menampilkan form/data history transaksi
     *
     */
    public function historyPrint($id)
    {
        // $data = Print_order::where("user_id", "=", $id)->get();
        $print_orders = DB::table('print_orders')
            ->where("user_id", "=", $id)
            ->orderBy("id", "DESC")
            ->get();

        return view('customer.history.index_print', compact('print_orders'));
    }

    /**
     * Menampilkan form/data history transaksi ATK
     * 
     */
    public function historyAtk($id)
    {
        return view('customer.history.index_atk');        
    }

    /**
     * Menampilkan Dashboard customer
     *
     */
    public function dashboardCustomer()
    {
        $items = Item::where("status", "=", "SHOW")->get();
        

        return view('customer.dashboard.index', compact('items'));
    }


    /**
     * Menampilkan produk yang dijual
     *
     */
    public function productData(Request $request)
    {
        $keyword = $request->get('keyword') ? $request->get('keyword') : '';
    
        $categories = Category::with('items')->get();

        $items = Item::where("status", "=", "SHOW")
            ->where("stock", ">", 0)
            ->where("name", "LIKE", "%$keyword%")
            ->whereHas("categories", function ($query) use ($request) {
                $query->where("name", "LIKE", "%{$request->get('category')}%");
            })->paginate(10);
        
        $itemsCount = Item::where("status", "=", "SHOW")->count();

        return view('customer.product.index', compact('categories', 'items', 'itemsCount'));
    }

    /**
     * Menampilkan produk data
     *
     */
    public function showProductData($id)
    {
        $product = Item::with('categories')
            ->where('id', '=', $id)
            ->get();

        // dd($product);
        return view('customer.product.item_product', compact('product'));
    }

    /**
     * Memasukan data ke cart/keranjang
     * 
     */

    public function cart(Request $request)
    {
        $id_item = $request->get('id_item');
        $quantity = $request->get('quantity');
        $pivot = [];
        $id_order = [];

        // Mengecek apakah sudah melakukan cart sebelumnya atau tidak

        $cek = Item_order::where("user_id", "=", \Auth::user()->id)
            ->where("status", "=", "CART")->get();

        // Jika data tidak ada
        if ($cek->isEmpty()) {
            
            $data = new Item_order;

            $data->user_id = \Auth::user()->id;

            $data->save();

            array_push($pivot, ['item_id' => $id_item ,'quantity' => $quantity]);
            array_push($id_order, $data->id);

            $sync = array_combine($id_order, $pivot);

            $data->item()->sync($sync);
            
            
        } else {
            // Jika cart sudah ada

            $data_order = Item_order::with('item')
                ->where("user_id", "=", \Auth::user()->id)
                ->where("status", "=", "CART")->get(); 
        
            $ambil_id_order = $data_order[0]->id;

            array_push($pivot, ['item_id' => $id_item ,'quantity' => $quantity]);
            array_push($id_order, $ambil_id_order);

            $sync = array_combine($id_order, $pivot);

            $data_order[0]->item()->attach($sync);
            
        }

        return redirect()
            ->route('customer.dashboard')
            ->with('status', 'Tambah keranjang berhasil');
    }

    /**
     * Menampilkan data cart/keranjang
     *
     */
    public function showCart()
    {
        // $data_cart = [];
        $data_cart = Item_order::with('item')
            ->where("user_id", "=", \Auth::user()->id)
            ->where("status", "=", "CART")
            ->get();
        

        if (empty($data_cart[0]) || $data_cart[0]->item->count() == 0) {
            $status = "KOSONG";
        } else {
            $status = "BERISI";
        }

        // dd($data_cart[0]->item);
        // dd($data[0]->item[0]->pivot->quantity);

        return view('customer.cart.index', compact('data_cart', 'status'));
    }

    /**
     * Menghapus data cart berdasarkan ID
     *
     */
    public function deleteCart($id)
    {
        $data_order = Item_order::with('item')
            ->where("user_id", "=", \Auth::user()->id)
            ->where("status", "=", "CART")->get();

        $data_order[0]->item()->detach($id);
        
        return redirect()
            ->route('customer.show-cart')
            ->with('status', 'Hapus keranjang berhasil');
    }

    /**
     * Checkout data keranjang
     * 
     */

    public function showCheckout($id)
    {
        $data_cart = Item_order::with('item')
            ->where("user_id", "=", \Auth::user()->id)
            ->where("status", "=", "CART")->get();

        return view('customer.cart.checkout', compact('data_cart'));
    }

    /**
     * Membuat transaksi ATK
     * 
     */
    
    public function makeTransaction(Request $request)
    {
        $id = $request->get('id_order');
        $total_price = $request->get('total_price');
        $sending_status = $request->get('sending_status');

        $data_cart = Item_order::findOrFail($id);

        $data_cart->total_price = $total_price;
        $data_cart->sending_status = $sending_status;
        $data_cart->status = "SUBMIT";

        $data_cart->save();

        return redirect()
            ->route('customer.history-atk', \Auth::user()->id)
            ->with('status', 'Berhasil membuat pesanan');
    }
}
