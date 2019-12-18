@extends('customer.layouts.app')

@section('page-title', 'Keranjang')

@section('css-tambahan')
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/styles/cart_styles.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/styles/cart_responsive.css') }}">
@endsection

@push('css')
   <style>
      .template {
         margin-top: 10px; 
         padding: 20px; 
         background: white;
      }

      .judul_template {
         font-size: 23px; 
         color: #0e8ce4; 
         font-weight: 500;
      }

      .nama-telepon {
         font-weight: 500;
         font-size: 15px;
      }

      .alamat {
         font-size: 15px;
      }

      .judul_produk {
         margin-bottom: 10px;
      }

      .data_produk {
         padding: 40px 0px;
      }

      .total_price {
         color: #0e8ce4;
         font-size: 25px;
         margin-left: 10px;
         font-weight: 500;
      }

      .buat_pesanan {
         cursor: pointer;
      }

      .buat_pesanan:hover {
         transition: 0.3s all;
         padding-right: 50px;
         padding-left: 50px;
      }
   </style>
@endpush

@section('content')
<div class="cart_section" style="padding-top: 50px; padding-bottom: 50px">
   <div class="container">
      <div class="row">
         <div class="col-lg-10 offset-lg-1" style=" padding: 20px">
            <div class="cart_container">
               <div class="cart_title">Checkout Barang</div>
               
               <div class="template">
                  <div class="judul_template">
                     Alamat Customer
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-3">
                        <div class="nama-telepon">{{ \Auth::user()->name }}</div> 
                        <div class="nama-telepon">( {{ \Auth::user()->phone }} )</div>
                     </div>
                     <div class="col-md-8 alamat">{{ \Auth::user()->address }}</div>
                  </div>
                  <hr>
               </div>
               <div class="template">
                  <div class="row">
                        <div class="col-md-6 judul_template">
                           Produk Dipesan
                        </div>
                        <div class="col-md-2 text-center" style="padding-top: 7.5px; padding-bottom: 7.5px">
                           Harga Satuan
                        </div>
                        <div class="col-md-2 text-center" style="padding-top: 7.5px; padding-bottom: 7.5px">
                           Jumlah
                        </div>
                        <div class="col-md-2 text-center" style="padding-top: 7.5px; padding-bottom: 7.5px">
                           Subtotal
                        </div>
                  </div>
                        <div class="mt-1 mb-1">&nbsp;</div>
                  <form action="{{ route('customer.checkout', $data_cart[0]->id) }}" method="post">
                  @csrf
                  <div class="row">                        
                     @foreach ($data_cart[0]->item as $data)
                        <div class="col-md-6 mb-2">
                           <img src="{{ asset('storage/' . $data->cover) }}" alt="{{ $data->name }}" width="80" height="100"> 
                           <span>{{ $data->name }}</span>
                        </div>
                        <div class="col-md-2 text-center data_produk mb-2">
                           <span> {{ toRupiah($data->price) }} </span>
                        </div>
                        <div class="col-md-2 text-center data_produk mb-2" >
                           <span> {{ $data->pivot->quantity }} </span>
                        </div>
                        <div class="col-md-2 text-center data_produk mb-2" >
                           <span> {{ toRupiah($data->price * $data->pivot->quantity) }} </span>
                        </div>
                        <input type="hidden" name="id_item[]" value="{{ $data->id }}">
                        <input type="hidden" name="stok_asal[]" value="{{ $data->stock }}">
                        <input type="hidden" name="stok_beli[]" value="{{ $data->pivot->quantity }}">
                     @endforeach
                  </div>
                  <hr>
                  <div class="row">
                     <div class="col-md-12 pt-2 pb-2" style="text-align: right">
                        Total Pesanan ({{ $data_cart[0]->item->count() }} Produk) : <span class="total_price"> {{ toRupiah($data_cart[0]->total_price) }} </span> 
                     </div>
                  </div>
               </div>

               <div class="template">
                  <div class="judul_template">
                     Jenis Pengiriman
                  </div>
                  
                     <label for="jenis"></label>
                     <select name="sending_status" id="jenis" class="form-control" style="color: black" required>
                        <option value="" selected disabled>Pilih Jenis Pengiriman</option>
                        <option value="AMBIL">AMBIL</option>
                        <option value="KIRIM">KIRIM</option>
                     </select>
                     <div class="row">
                        <div class="col-md-12 pt-2 pb-2" style="text-align: right">
                           <div>Sub Total : <span class="total_price"> {{ toRupiah($data_cart[0]->total_price) }} </span></div>
                           <div style="margin-right: 62px">Diskon (%) : <span class="total_price"> 10 % </span></div>
                           <hr>
                           <div>Total Pembayaran : <span class="total_price"> {{ toRupiah($data_cart[0]->total_price) }} </span></div>
                           coba : {{ $coba }}
                           <input type="submit" class="btn btn-primary mt-2 mb-2 buat_pesanan" value="Buat Pesanan">
                        </div>
                     </div>
                     <input type="hidden" name="id_order" value="{{ $data_cart[0]->id }}">
                     <input type="hidden" name="total_price" value="{{ $data_cart[0]->total_price }}">
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection