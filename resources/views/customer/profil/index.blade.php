@extends('customer.layouts.app')

@section('page-title', 'Profile')

@section('css-tambahan')
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/styles/cart_styles.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/styles/cart_responsive.css') }}">
@endsection

@push('css')
   <style>
      .data-profil {
         display: block;
         margin-bottom: 30px;
      }

      .data-profil label {
         font-size: 15px;
      }

      .data-profil h4 {
         font-size: 24px;
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
                  <div class="cart_items">
                     <div class="cart_list mb-1 p-3">
                        <div class="row p-3">
                           <div class="col-md-4">
                              <img src="{{ asset('storage/' . Auth::user()->avatar) }}" width="100%">
                           </div>
                           <div class="col-md-4 ">
                              <div class="data-profil ">
                                 <label>Nama</label>
                                 <h4>{{ Auth::user()->name }}</h4>
                              </div>
                              <div class="data-profil">
                                 <label>Username</label>
                                 <h4>{{ Auth::user()->username }}</h4>
                              </div>
                              <div class="data-profil">
                                 <label>Email</label>
                                 <h4>{{ Auth::user()->email }}</h4>
                              </div>
                              <div class="data-profil">
                                 <label>Nomer Telepon</label>
                                 <h4>{{ Auth::user()->phone }}</h4>
                              </div>
                           </div>
                           <div class="col-md-4" style="border-left: 1px solid #d8d4d4">
                              <div class="data-profil">
                                 <label>Alamat</label>
                                 <h4>{{ Auth::user()->address }}</h4>
                              </div>
                              <div class="data-profil">
                                 <label>Tanggal Daftar</label>
                                 <h4>{{ date('d F Y H:i', strtotime(\Auth::user()->updated_at)) }}</h4>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div>
                        <a href="#" class="btn btn-primary btn-block mt-2">Update Profile</a>
                     </div>
                  </div>
               {{--  --}}
               <div class="cart_buttons">
                  {{-- <a class="button cart_button_checkout" href="{{ route('customer.checkout', $data_cart[0]->id) }}">Checkout</a> --}}
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection