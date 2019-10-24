@extends('customer.layouts.app')

@section('page-title', 'Dashboard')

@section('css-tambahan')
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/styles/main_styles.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/styles/responsive.css') }}">
@endsection

@push('css')
   <style>
      .welcome {
         color: black;
         margin: 20px 0px;
         background: lightblue;
         padding: 20px;
         font-size: 20px;
         border-radius: 5px;
      }
   </style>
@endpush

@section('content')
<!-- Banner -->

<div class="banner">
   <div class="banner_background"
         style="background-image:url({{ asset('assets/customer/images/banner_background.jpg') }})"></div>
   <div class="container fill_height">
         <div class="row fill_height">
            <div class="banner_product_image"><img src="{{ asset('assets/customer/images/fc.png') }}" alt="">
               
            </div>
            <div class="col-lg-5 offset-lg-4 fill_height">
               <div class="banner_content">
                     <h1 class="banner_text">NANA Print & ATK</h1>
                     <div class="banner_product_name">Siap melayani anda</div>
                     @auth
                        <p class="welcome shadow-sm">Selamat Datang {{ \Auth::user()->name }}</p>
                     @else
                        <div class="button banner_button"><a href="{{ route('registration') }}">Join</a></div>
                     @endauth
               </div>
            </div>
         </div>
   </div>
</div>

<div class="new_arrivals"  style="background: white">
      <div class="container">
            <div class="row" >
               <div class="col" >
                  <div class="tabbed_container">
                        <div class="tabs clearfix tabs-right">
                           <div class="new_arrivals_title">Daftar ATK</div>
                           <ul class="clearfix">
                              <li class="active">Featured</li>
                           </ul>
                           <div class="tabs_line"><span></span></div>
                        </div>
                        <div class="row mt-3">
                           <div class="col-lg-12" style="z-index:1;">

                              <!-- Product Panel -->
                              <div class="product_panel panel active">
                                    <div class="arrivals_slider slider">

                                    @foreach ($items as $item)
                                       <!-- Slider Item -->
                                       <div class="arrivals_slider_item">
                                          <div class="border_active"></div>
                                          <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                                   <img src="{{ asset('storage/' . $item->cover) }}"
                                                         alt="{{ $item->name }}" width="160px" height="160px"></div>
                                                   
                                                <div class="product_content">
                                                   <div class="product_price">{{ toRupiah($item->price) }}</div>
                                                   <div class="product_name">
                                                      <div><a href="product.html">{{ $item->name }}</a></div>
                                                   </div>
                                                   <div class="product_extras">
                                                      <button class="product_cart_button active" onclick="location.href='{{ route('show-product', $item->id) }}'">View Details</button>
                                                   </div>
                                                </div>
                                          </div>
                                       </div>
                                    @endforeach
                                    </div>
                                    <div class="arrivals_slider_dots_cover"></div>
                              </div>

                           </div>
                        </div>
                  </div>
               </div>
            </div>
      </div>
   </div>
@endsection

@section('js-tambahan')
   <script src="{{ asset('assets/customer/js/custom.js') }}"></script> 
@endsection