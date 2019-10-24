@extends('customer.layouts.app')

@section('page-title', 'History')

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
   </style>
@endpush

@section('content')
<div class="cart_section">
   <div class="container">
      <div class="row">
         <div class="col-lg-10 offset-lg-1">
            <div class="cart_container">
               <div class="cart_title">History Transaksi Print</div>
               <div class="cart_items">
                  @foreach ($print_orders as $data)
                     <ul class="cart_list mb-1">
                        <li class="cart_item clearfix">
                           <div class="cart_item_image">
                              @if ($data->type == "PRINT")
                                 <img src="https://cdn0.iconfinder.com/data/icons/print-7/24/Print_Button_printer-512.png" alt="Contoh" width="100%" height="100%"> 
                              @elseif($data->type == "PHOTO")
                                 <img src="https://icon-library.net/images/image-icon/image-icon-4.jpg" alt="Contoh" width="100%" height="100%"> 
                              @endif
                           </div>
                           <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between" style="text-align: center">
                              <div class="cart_item_name cart_info_col">
                                 <div class="cart_item_title">Total Transaksi</div>
                                 <div class="cart_item_text">{{ toRupiah($data->total_price) }}</div>
                              </div>
                              <div class="cart_item_quantity cart_info_col">
                                 <div class="cart_item_title">Tanggal Transaksi</div>
                                 <div class="cart_item_text">{{ date('d F Y', strtotime($data->created_at)) }}</div>
                              </div>

                              <div class="cart_item_total cart_info_col" style="text-align:center">
                                 <div class="cart_item_title">Jenis</div>
                                 <div class="cart_item_text jenis {{ $data->type == "PRINT" ? "print" : "foto"  }}">{{ $data->type }}</div>
                              </div>
                              <div class="cart_info_col">
                                 <div class="cart_item_title">Status</div>
                                    @if ($data->status == "SUBMIT")
                                       <div class="cart_item_text bg-primary status">
                                          {{ $data->status }}
                                       </div>
                                    @elseif($data->status == "PROCESS")
                                       <div class="cart_item_text bg-warning status">
                                          {{ $data->status }}
                                       </div>
                                    @elseif($data->status == "FINISH")
                                       <div class="cart_item_text bg-success status">
                                          {{ $data->status }}
                                       </div>
                                    @endif
                              </div>
                           </div>
                        </li>
                     </ul>
                  @endforeach
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('js-tambahan')
   <script src="{{ asset('assets/customer/js/cart_custom.js') }}"></script>     
@endsection