@extends('customer.layouts.app')

@section('page-title', 'Keranjang')

@section('css-tambahan')
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/styles/cart_styles.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/styles/cart_responsive.css') }}">
@endsection

@push('css')
   <style>
      .status {
         /* background: forestgreen; */
         color: white;
         padding: 2px 10px;
         border-radius: 5px;
      }

      .jenis {
         color: white;
         padding: 2px 10px;
         border-radius: 5px;
      }

      .print {
         background: blue;
      }

      .foto {
         background: darkgoldenrod;
      }

      .keranjang_kosong {
         padding: 50px 0px;
         margin-top: 20px;
         background: lightslategrey;
         text-align: center;
      }
   </style>
@endpush

@section('content')
<div class="cart_section" style="padding-top: 50px; padding-bottom: 50px">
   <div class="container" style="background: white; padding: 20px">
      <div class="row">
         <div class="col-lg-10 offset-lg-1">
            <div class="cart_container">
               <div class="cart_title">Keranjang</div>
               @if ($status == "BERISI")
                  <div class="cart_items">
                     @foreach ($data_cart[0]->item as $data)
                        <ul class="cart_list mb-1">
                           <li class="cart_item clearfix">
                              <div class="cart_item_image">
                                 <img src="{{ asset('storage/' . $data->cover) }}" alt="Contoh" width="100%" height="100%"> 
                              </div>
                              <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between" style="text-align: center">
                                 <div class="cart_item_name cart_info_col">
                                    <div class="cart_item_title">Nama Barang</div>
                                    <div class="cart_item_text">{{ $data->name }}</div>
                                 </div>
                                 <div class="cart_item_quantity cart_info_col">
                                    <div class="cart_item_title">Harga barang</div>
                                    <div class="cart_item_text">{{ toRupiah($data->price) }}</div>
                                 </div>
                                 <div class="cart_item_quantity cart_info_col">
                                    <div class="cart_item_title">Jumlah beli</div>
                                    <div class="cart_item_text">{{ $data->pivot->quantity }} Items</div>
                                 </div>
                                 <div class="cart_item_total cart_info_col" style="text-align:center">
                                    <div class="cart_item_title">Sub Total</div>
                                    <div class="cart_item_text">{{ $data->price * $data->pivot->quantity }}</div>
                                 </div>
                                 <div class="cart_info_col">
                                    <div class="cart_item_title">Status</div>
                                    <div class="cart_item_text ">
                                       <a class="btn btn-danger btn-sm" style="cursor: pointer" 
                                          href="{{ route('customer.delete-cart', $data->id) }}">HAPUS</a>
                                    </div>
                                 </div>
                              </div>
                           </li>
                        </ul>
                     @endforeach
                  </div>
                     

               <!-- Order Total -->
               <div class="order_total">
                  <div class="order_total_content text-md-right">
                     <div class="order_total_title">Order Total:</div>
                     <div class="order_total_amount">{{ toRupiah($data_cart[0]->totalprice) }}</div>
                  </div>
               </div>
               {{--  --}}
               <div class="cart_buttons">
                  <a class="button cart_button_checkout" href="{{ route('customer.checkout', $data_cart[0]->id) }}">Checkout</a>
               </div>
               
               @elseif($status = "KOSONG")
                  <div style="padding-top: 50px;">
                     <ul class="cart_list">
                        <li class="cart_item clearfix text-center">
                           Keranjang kosong
                        </li>
                     </ul>
                  </div>
               @endif
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('js-tambahan')
   <script src="{{ asset('assets/customer/js/cart_custom.js') }}"></script>     
@endsection