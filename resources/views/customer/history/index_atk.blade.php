@extends('customer.layouts.app')

@section('page-title', 'History Pesanan ATK')

@section('css-tambahan')
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/styles/cart_styles.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/styles/cart_responsive.css') }}">
@endsection

@push('css')
   <style>
      .blue-color {
         font-size: 18px;
         color: #0e8ce4;
         font-weight: 500;
         margin-bottom: 10px;
      }

      .nama-item {
         color: #0e8ce4;
         font-size: 15px;
         font-weight: 400;
      }

      .harga-item {
         color: #0e8ce4;
         font-size: 15px;
         font-weight: 500;
         padding-top: 15px;
         padding-bottom: 15px;
         margin-bottom: 18px;
      }

      .total-harga-item {
         color: #0e8ce4;
         font-size: 15px;
         font-weight: 500;
      }

      .status-transaksi {
         font-size: 18px;
         padding: 5px 10px;
         background: #0e8ce4;
         color: white;
         border-radius: 5px; 
      }
   </style>
@endpush

@section('content')
<div class="cart_section" style="padding-top: 50px; padding-bottom: 50px">
   <div class="container" style="background: white; padding: 20px">
      <div class="row">
         <div class="col-lg-10 offset-lg-1">
            <div class="cart_container">
               <div class="cart_title">History Transaksi Print</div>
               <div class="cart_items">
                  {{-- @foreach ($print_orders as $data) --}}
                     <div class="cart_list p-3">
                        <div class="d-inline" >
                           <div class="d-inline" style="font-size: 20px; margin-bottom: 10px; font-weight: 500; ">
                              Detail Pesanan
                           </div>
                           <div class="d-inline float-right status-transaksi">
                              SUBMIT
                           </div>
                        </div>
                        <hr>
                        <div class="row">
                           <div class="col-md-5" style="border-right: 1px solid #d8d4d4">
                              <div>
                                 Nomer Transaksi
                              </div>
                              <div class="blue-color">
                                 Nomer Transaksi
                              </div>
                              <div>
                                 Nomer Transaksi
                              </div>
                              <div class="blue-color">
                                 15 Oktober 2019 09:10 WIB
                              </div>
                              <div>
                                 Status Pengiriman
                              </div>
                              <div class="blue-color">
                                 AMBIL
                              </div>
                           </div>
                           <div class="col-md-7">
                              <div class="row" >
                                 <div class="col-md-7">
                                    Daftar Produk
                                 </div>
                                 <div class="col-md-5 mb-2">
                                    Harga Barang
                                 </div>
                                 <div class="col-md-7">
                                    <div class="row">
                                       <div class="col-md-4">
                                          <img src="https://ecs7.tokopedia.net/img/cache/700/product-1/2018/11/6/41815146/41815146_ccfd5b96-b7fe-4a63-a051-c330efbab2e1_580_716.jpg" 
                                             alt="" width="100%" height="60px">
                                       </div>
                                       <div class="col-md-8 p-0 mb-2" style="border-right: 1px solid #d8d4d4; ">
                                          <div class="nama-item">Pensil 2B</div>
                                          <small>2 Items x Rp. 10.000</small>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-5 harga-item">
                                    Rp. 20000
                                 </div>
                              </div>
                              
                              <hr>
                              <div class="row">
                                 <div class="col-md-7" style="border-right: 1px solid #d8d4d4">
                                    Total harga (2 items)
                                 </div>
                                 <div class="col-md-5 total-harga-item">
                                    Rp. 50.000
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection