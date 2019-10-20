@extends('customer.layouts.app')

@section('page-title', 'Transaksi Photo')

@section('css-tambahan')
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/styles/cart_styles.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/styles/cart_responsive.css') }}">
@endsection

@section('content')
<!-- Transaksi Foto -->

<div class="cart_section">
   <div class="container">
      <div class="row justify-content-center">
         <div class="cart_container">
            <div class="cart_title text-center bg-primary p-3" style="color: white; font-weight: bold">Transaksi
               Foto</div>
         </div>
         <div class="col-lg-12 p-3 ">
            <div class="row justify-content-center">
               <div class="col-md-6 bg-danger p-4">
                  <div class="form-group">
                     <label for="cover" for="alamat" style="color: white; font-size: 18px">File</label>
                     <input type="file" name="avatar" class="form-control" />
                  </div>
                  <div class="form-group">
                     <label for="alamat" style="color: white; font-size: 18px">Deskripsi</label>
                     <textarea name="alamat" id="alamat" cols="30" rows="3" name="alamat"
                                 placeholder="Deskripsi..." class="form-control"></textarea>
                  </div>
                  <input type="submit" name="submit" value="simpan" class="btn btn-success"
                           style="padding-left: 50px; padding-right: 50px" />
               </div>
               <div class="col-md-4 bg-primary">
                  <div class="row">
                     <div class="col-md-12">
                        <input type="submit" name="submit" value="tambah"
                                 class="btn btn-success mt-1 float-right" />
                     </div>
                  </div>
                  <div class="p-2 m-3 bg-danger">

                     <div class="form-group">
                        <label for="jenis kertas" for="jenis kertas" style="color: white; font-size: 20px">Jenis
                           Kertas</label>
                        <select name="kertas" id="" class="form-control" style="margin-left: 0px;">
                           <option value="">Pilih Kertas</option>
                           <option value="">Kertas A4</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="jumlah" for="jumlah" style="color: white; font-size: 20px">Jumlah</label>
                        <input type="jumlah" name="jumlah" placeholder="Jumlah..." class="form-control" />
                     </div>
                     <div class="form-group">
                        <label for="jumlah total" for="jumlah total" style="color: white; font-size: 20px">Jumlah
                           Total</label>
                        <input type="jumlah total" name="jumlah total" placeholder="Jumlah Total..."
                                 class="form-control" />
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
   <script src="{{ asset('assets/customer/js/cart_custom.js') }}"></script>     
@endsection