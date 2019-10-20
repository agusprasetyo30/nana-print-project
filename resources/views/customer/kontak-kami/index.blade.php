@extends('customer.layouts.app')

@section('page-title', 'Transaksi Print')

@section('css-tambahan')
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/styles/contact_styles.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/styles/contact_responsive.css') }}">
@endsection

@section('content')
<!-- Contact Info -->

<div class="contact_info">
   <div class="container">
      <div class="row">
         <div class="col-lg-10 offset-lg-1">
            <div class="contact_info_container d-flex flex-lg-row flex-column justify-content-between align-items-between">

               <!-- Contact Item -->
               <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                  <div class="contact_info_image"><img src="{{ asset('assets/customer/images/contact_1.png') }}" alt=""></div>
                  <div class="contact_info_content">
                     <div class="contact_info_title">Phone</div>
                     <div class="contact_info_text">(0341) 123 456</div>
                  </div>
               </div>

               <!-- Contact Item -->
               <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                  <div class="contact_info_image"><img src="{{ asset('assets/customer/images/contact_2.png') }}" alt=""></div>
                  <div class="contact_info_content">
                     <div class="contact_info_title">Email</div>
                     <div class="contact_info_text">nanaprint@gmail.com</div>
                  </div>
               </div>

               <!-- Contact Item -->
               <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                  <div class="contact_info_image"><img src="{{ asset('assets/customer/images/contact_3.png') }}" alt=""></div>
                  <div class="contact_info_content">
                     <div class="contact_info_title">Address</div>
                     <div class="contact_info_text">Jalan Raya Poncokusumo No.12 Kab.Malang</div>
                  </div>
               </div>

            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('js-tambahan')
   <script src="{{ asset('assets/customer/js/contact_custom.js') }}"></script>
@endsection