@extends('customer.layouts.app')

@section('page-title', 'Produk ATK')

@section('css-tambahan')
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/styles/product_styles.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/styles/product_responsive.css') }}">
@endsection

@push('css')
   <style>
      .category{
         color: white;
         padding: 2px 5px;
         margin-right: 5px;
         border-radius: 2px;
      }

      .harga-barang {
         margin: 10px 0px;
         background: #f7f7f7;
         width: 100%;
         padding: 10px 0px;
      }

      .deskripsi {
         margin: 10px 0px 30px 0px;
      }
   </style>
@endpush

@section('content')
<!-- Single Product -->

<div class="single_product" style="padding-top: 50px; padding-bottom: 50px">
   <div class="container" style="background: white; padding: 20px">
      <div class="row">
         <!-- Selected Image -->
         <div class="col-lg-5 order-lg-2 order-1">
            <div class="image_selected"><img src="{{ asset('storage/' . $product[0]->cover ) }}" width="100%" height="100%"></div>
         </div>

         <!-- Description -->
         <div class="col-lg-5 order-3">
            <div class="product_description">
               <div class="order_info d-flex flex-row">
                  <form action="{{ route('customer.cart') }}" method="POST">
               <div class="product_category">
                  @foreach ($product[0]->categories as $category)
                  <span class="category bg-success">{{ $category->name }}</span>
                  @endforeach
               </div>
               <div class="product_name">{{ $product[0]->name }}</div>
               <div class="product_price harga-barang" style="margin-top: 0px">
                  {{ toRupiah($product[0]->price) }}
               </div>
               <div class="product_text deskripsi">
                  <p>{{ $product[0]->description }}</p>
               </div>
                     @csrf

                     <div class="clearfix" style="z-index: 1000;">

                        <!-- Product Quantity -->
                        <div class="product_quantity clearfix">
                           <span>Quantity: </span>
                           <input id="quantity" type="text" pattern="[0-9]*" value="1" name="quantity">
                           <div class="quantity_buttons">
                              <div id="tambah" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
                              <div id="kurang" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
                           </div>
                           
                        </div>
                     </div>
                        <input type="hidden" name="id_item" value="{{ $product[0]->id }}">
                     <div>
                        <p>Jumlah stok : {{ $product[0]->stock }} item</p>
                     </div>                        
                        <div class="button_container">
                           @auth
                              <button type="submit" class="btn btn-primary btn-lg" style="cursor: pointer" {{ \Auth::user()->getRoleNames()[0] == "admin" ? 'disabled' : '' }}>
                                 Tambahkan ke keranjang
                              </button>
                           @else
                              <button type="submit" class="btn btn-primary btn-lg" disabled>
                                 Tambahkan ke keranjang
                              </button>
                           @endauth

                        </div>
                  </form>
               </div>
            </div>
         </div>

      </div>
   </div>
</div>
@endsection

@section('js-tambahan')
   <script src="{{ asset('assets/customer/plugins/Isotope/isotope.pkgd.min.js') }}"></script>
   <script src="{{ asset('assets/customer/plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>
   <script src="{{ asset('assets/customer/js/shop_custom.js') }}"></script> 
@endsection

@push('js')
   <script>
         $(function() {

            $('#tambah').click(function() {
               jumlah = document.getElementById('quantity').value;
               
               if (parseInt(jumlah) < '{{ $product[0]->stock }}') {
                  hitung = parseInt(jumlah) + 1
               }

               document.getElementById('quantity').value = hitung
            })

            $('#kurang').click(function() {
               jumlah = document.getElementById('quantity').value;

               if (parseInt(jumlah) > 1) {
                  hitung = parseInt(jumlah) - 1
               }

               document.getElementById('quantity').value = hitung
            })

         })


   </script>
@endpush