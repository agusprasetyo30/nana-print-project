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
               <div class="cart_title">History Transaksi ATK</div>
               <div class="cart_items">
                  @foreach ($item_orders as $data)
                  <div class="cart_list p-3 mb-3">
                     <div class="d-inline" >
                        <div class="d-inline" style="font-size: 20px; margin-bottom: 10px; font-weight: 500; ">
                           Detail Pesanan
                        </div>
                        {{-- process = warning ; finish = success --}}
                        @if ($data->status == "SUBMIT")
                           <div class="d-inline float-right status-transaksi bg-primary">
                              {{ $data->status }}
                           </div>

                        @elseif($data->status == "PROCESS")
                           <div class="d-inline float-right status-transaksi bg-warning">
                              {{ $data->status }}
                           </div>

                        @elseif($data->status == "FINISH")
                           <div class="d-inline float-right status-transaksi bg-success">
                              {{ $data->status }}
                           </div>
                        @endif
                     </div>
                     <hr>
                     <div class="row">
                        <div class="col-md-5" style="border-right: 1px solid #d8d4d4">
                           <div>
                              ID Transaksi
                           </div>
                           <div class="blue-color">
                              {{ $data->id }}
                           </div>
                           <div>
                              Tanggal Transaksi
                           </div>
                           <div class="blue-color">
                              {{ date('d F Y H:i', strtotime($data->updated_at)) }} WIB
                           </div>
                           <div>
                              Status Pengiriman
                           </div>
                           <div class="blue-color ">
                              {{ $data->sending_status }}
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
                              @foreach ($data->item as $data_item)
                                 <div class="col-md-7">
                                    <div class="row">
                                       <div class="col-md-4 col-sm-4">
                                          <img src="{{ asset('storage/' . $data_item->cover) }}" 
                                             alt="" width="70px" height="60px">
                                       </div>
                                       <div class="col-md-8 col-sm-8 p-0 mb-2" style="border-right: 1px solid #d8d4d4; ">
                                          <div class="nama-item">{{ $data_item->name }}</div>
                                          <small>{{ $data_item->pivot->quantity }} Items x {{ toRupiah($data_item->price) }}</small>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-5 harga-item">
                                    {{ toRupiah($data_item->price * $data_item->pivot->quantity) }}
                                 </div>
                              @endforeach
                           </div>
                           
                           <hr>
                           <div class="row">
                              <div class="col-md-7" style="border-right: 1px solid #d8d4d4">
                                 Total harga ({{ $data->TotalQuantity }} items)
                              </div>
                              <div class="col-md-5 total-harga-item">
                                 {{ toRupiah($data->total_price) }}
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  @endforeach

                  @empty($data)
                     <ul class="cart_list">
                        <li class="cart_item clearfix text-center">
                           Transaksi ATK Kosong
                        </li>
                     </ul>
                  @endempty
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection