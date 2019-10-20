@extends('customer.layouts.app')

@section('page-title', 'Transaksi Print')

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
            <div class="cart_title text-center bg-primary p-3" style="color: white; font-weight: bold">Transaksi Print</div>
         </div>
         <div class="col-lg-12 p-3 ">
            <form action="{{ route('customer.order-print') }}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="row justify-content-center">
                  <div class="col-md-6 bg-danger p-4">
                     <div class="form-group">
                        <label for="cover" for="alamat" style="color: white; font-size: 18px">File</label>
                        <input type="file" name="file" class="form-control" />
                     </div>
                     <div class="form-group">
                        <label for="alamat" style="color: white; font-size: 18px">Deskripsi</label>
                        <textarea name="alamat" id="alamat" cols="30" rows="3" name="alamat"
                           placeholder="Deskripsi..." class="form-control"></textarea>
                     </div>
                     <input type="submit" name="submit" value="Simpan" class="btn btn-success btn-block"
                              style="padding-left: 50px; padding-right: 50px" />
                  </div>
                  <div class="col-md-4 bg-primary" id="tampung">
                     <div class="row">
                        <div class="col-md-12">
                           <a style="color: white; cursor: pointer" id="btn-add-input-data" 
                              class="btn btn-success mt-1 float-right">Tambah</a>
                        </div>
                     </div>
                     <div class="p-2 m-3 bg-danger abc" id="input-data1">
                        <div class="form-group">
                           <label for="jenis kertas" for="jenis kertas" style="color: white; font-size: 20px">Jenis Kertas</label>
                           <label style="color: white; float: right" id="nomer"></label>

                           <select name="kertas[]" id="kertas1" class="form-control" style="margin-left: 0px;" dir="auto"
                              onchange="reply_click(this.id)">
                              
                              <option value="" disabled selected>Pilih Kertas</option>
                              @foreach ($papersPrint as $paper)
                                 <option value="{{ $paper->price }}">{{ $paper->name }}&nbsp;---&nbsp;<b>{{ toRupiah($paper->price) }}</b></option>
                              @endforeach
                           </select>
                           <input type="text" name="coba1" id="coba1"
                              value="{{ empty('coba') ? 'a' : 'b' }}">
                        </div>
                        <div class="form-group">
                           <label for="jumlah total" for="jumlah total" style="color: white; font-size: 20px">Jumlah</label>
                           <input type="number" name="jumlah_total[]" placeholder="Jumlah Total..." value=0
                              class="form-control" />
                        </div>
                        <div class="form-group">
                           <label for="jumlah" for="jumlah" style="color: white; font-size: 20px">Jumlah Total</label>
                           <input type="jumlah" name="jumlah[]" placeholder="Jumlah" class="form-control" value=0 readonly/>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>   
@endsection

@section('js-tambahan')
   <script src="{{ asset('assets/customer/js/cart_custom.js') }}"></script>     
@endsection

@push('js')
<script>
      var nomer_id;
      var nomer = 1

      
      $(function () {
         $('#input-data .form-group #nomer').html(nomer)

         $('#btn-add-input-data').click(function() {
            nomer = nomer + 1;

            var dataDiv = document.getElementById('input-data1')
            
            const div = document.createElement('div');

            div.className = `p-2 m-3 bg-danger abc` ;

            div.innerHTML = 
            `
            <div class="form-group">
               <label for="jenis kertas" for="jenis kertas" style="color: white; font-size: 20px">Jenis Kertas</label>
               <label style="color: white; float: right" id="nomer">`+ nomer +`</label>

               <select name="kertas[]" id="kertas`+nomer+`" class="form-control" style="margin-left: 0px;" dir="auto"
                  onchange="reply_click(this.id)">
                  <option value="" disabled selected>Pilih Kertas</option>
                  @foreach ($papersPrint as $paper)
                     <option value="{{ $paper->price }}" >{{ $paper->name }}&nbsp;---&nbsp;<b>{{ toRupiah($paper->price) }}</b></option>
                  @endforeach
               </select>
               <input type="text" name="coba" id="coba`+nomer+`"
                  value="{{ empty('coba') ? 'a' : 'b' }}">
            </div>
            <div class="form-group">
               <label for="jumlah total" for="jumlah total" style="color: white; font-size: 20px">Jumlah</label>
               <input type="number" name="jumlah_total[]" placeholder="Jumlah Total..." value=0
                  class="form-control" />
            </div>
            <div class="form-group">
               <label for="jumlah" for="jumlah" style="color: white; font-size: 20px">Jumlah Total</label>
               <input type="jumlah" name="jumlah[]" placeholder="Jumlah" class="form-control" value=0 readonly/>
            </div>
            `;

            var x = document.getElementById('tampung').appendChild(div)
            x.setAttribute("id", "input-data"+nomer)

            $('#tampung .form-group select').change(function() {
               console.log("INI ID LHO : " + data_id);
               console.log("Mencoba TAMBAH");
               console.log('#input-data select#kertas'+data_id);

               var e = document.getElementById('kertas'+data_id);
               var strUser = e.options[e.selectedIndex].value;
               console.log(strUser);

               document.getElementById('coba'+data_id).value = strUser;

               console.log("Uwaw tambah" + nomer);
            });

            

         })

            $('#tampung #input-data1 .form-group select').change(function() {
               console.log("INI ID LHO : " + data_id);
               console.log("Mencoba TIDAK TAMBAH");

               var e = document.getElementById('kertas'+data_id);
               var strUser = e.options[e.selectedIndex].value;

               document.getElementById('coba'+data_id).value = strUser;

            });

         });
      
      var ambil_id_coba = document.getElementsByName("coba1")[0].id
      var ambil_nomer_id = ambil_id_coba.charAt(ambil_id_coba.length - 1)
      console.log(ambil_nomer_id);

   function reply_click(select_id)
   {
      data_id =  select_id.charAt(select_id.length - 1);
   }
   </script>
   
@endpush