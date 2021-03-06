@extends('customer.layouts.app')

@section('page-title', 'Transaksi Foto')

@section('css-tambahan')
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/styles/cart_styles.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/styles/cart_responsive.css') }}">
@endsection

@push('css')
   <style>
      .tambah-data-print {
         background: #0e8ce4;
      }

      .form-control {
         color: black;
      }
   </style>
@endpush

@section('content')
<!-- Transaksi Foto -->

<div class="cart_section">
   <div class="container" style="background: white; padding: 20px">
      <div class="row justify-content-center">
         <div class="cart_container" style="width: 100%">
            <div class="cart_title text-center p-3" style="color: black; font-weight: bold">
               Transaksi Print Foto
            </div>
         </div>
         <div class="col-lg-12 p-3 ">
            <form action="{{ route('customer.order-photo') }}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="row justify-content-center">
                  <div class="col-md-6 p-4" style="background: #f5f5f5; border-right: 1px solid #bababa">
                     <div class="form-group">
                        <label for="cover" for="alamat" style="color: black; font-size: 15px">File</label>
                        <input type="file" name="file" class="form-control" />
                        <small>File required : .zip, .rar, .pdf</small>

                     </div>
                     <div class="form-group">
                        <label for="description" style="color: black; font-size: 15px">Deskripsi</label>
                        <textarea name="description" id="description" cols="30" rows="3" name="alamat"
                           placeholder="Deskripsi data file..." class="form-control"></textarea>
                     </div>
                     <input type="submit" name="submit" value="Simpan" class="btn btn-success btn-block"
                              style="padding-left: 50px; padding-right: 50px; cursor: pointer" {{ \Auth::user() ? '' : 'disabled' }}/>
                  </div>
                  <div class="col-md-4" id="tampung" style="background: #f5f5f5">
                     <div class="row">
                        <div class="col-md-12">
                           <a style="color: white; cursor: pointer" id="btn-add-input-data" 
                              class="btn btn-success mt-1 float-right">Tambah Data Print</a>
                        </div>
                     </div>
                     <div class="p-2 m-3 tambah-data-print" id="input-data1">
                        <div class="form-group">
                           <label for="jenis kertas" for="jenis kertas" style="color: white; font-size: 20px">Jenis Kertas</label>
                           <label style="color: white; float: right" id="nomer">1</label>

                           <select name="kertas[]" id="kertas1" class="form-control" style="margin-left: 0px;" dir="auto"
                              onchange="reply_click(this.id)">
                              
                              <option value="" disabled selected>Pilih Kertas</option>
                              @foreach ($papersPrint as $paper)
                                 <option value="{{ $paper->price }}" data-value="{{ $paper->id }}">{{ $paper->name }}&nbsp;---&nbsp;<b>{{ toRupiah($paper->price) }}</b></option>
                              @endforeach
                           </select>
                           <input type="hidden" name="harga_kertas1" id="harga_kertas1"
                              value="{{ empty('harga_kertas1') ? 'a' : 'b' }}">
                           
                           <input type="hidden" name="ambil_id[]" id="ambil_id1"
                              value="zero">
                        </div>
                        <div class="form-group">
                           <label for="jumlah" for="jumlah" style="color: white; font-size: 20px">Jumlah</label>
                           <input type="number" name="jumlah[]" placeholder="Jumlah..." value=0 onFocus="mulaihitung();" onBlur="stophitung();"
                              class="form-control" id="jumlah1" min="1"/>
                        </div>
                        <div class="form-group">
                           <label for="jumlah_total" style="color: white; font-size: 20px">Jumlah Total</label>
                           <input type="text" name="jumlah_total[]" placeholder="Jumlah Total" class="form-control" value=0 readonly
                              id="jumlah_total1"/>
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
      var data_id = 1;
      var harga_kertas;
      var nomer = 1

      
      $(function () {
         $('#input-data .form-group #nomer').html(nomer)

         $('#btn-add-input-data').click(function() {
            nomer = nomer + 1;

            var dataDiv = document.getElementById('input-data1')
            
            const div = document.createElement('div');

            div.className = `p-2 m-3 tambah-data-print` ;

            div.innerHTML = 
            `
            <div class="form-group">
               <label for="jenis kertas" for="jenis kertas" style="color: white; font-size: 20px">Jenis Kertas</label>
               <label style="color: white; float: right" id="nomer">`+ nomer +`</label>

               <select name="kertas[]" id="kertas`+nomer+`" class="form-control" style="margin-left: 0px;" dir="auto"
                  onchange="reply_click(this.id)">
                  <option value="" disabled selected>Pilih Kertas</option>
                  @foreach ($papersPrint as $paper)
                     <option value="{{ $paper->price }}" data-value="{{ $paper->id }}">{{ $paper->name }}&nbsp;---&nbsp;<b>{{ toRupiah($paper->price) }}</b></option>
                  @endforeach
               </select>
               <input type="hidden" name="harga_kertas" id="harga_kertas`+nomer+`"
                  value="{{ empty('coba') ? 'a' : 'b' }}">

               <input type="hidden" name="ambil_id[]" id="ambil_id`+nomer+`"
                  value="zero">
            </div>
            <div class="form-group">
               <label for="jumlah" for="jumlah" style="color: white; font-size: 20px">Jumlah</label>
               <input type="number" name="jumlah[]" placeholder="Jumlah..." value=0 onFocus="mulaihitung();" onBlur="stophitung();"
                  class="form-control" min=1 id="jumlah`+nomer+`"/>
            </div>
            <div class="form-group">
               <label for="jumlah_total" style="color: white; font-size: 20px">Jumlah Total</label>
               <input type="text" name="jumlah_total[]" placeholder="Jumlah Total" class="form-control" value=0 readonly
                  id="jumlah_total`+nomer+`"/>
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

               document.getElementById('harga_kertas'+data_id).value = strUser;

               hitung()
               harga_kertas = document.getElementById('harga_kertas'+data_id).value;

               var ambil_id = $('#tampung #input-data'+data_id+' .form-group select option[value="' + $(this).val() + '"]').data('value');
               document.getElementById('ambil_id'+data_id).value = ambil_id;
            });
         })

            $('#tampung #input-data1 .form-group select').change(function() {
               console.log("INI ID LHO : " + data_id);
               console.log("Mencoba TIDAK TAMBAH");

               var e = document.getElementById('kertas'+data_id);
               var strUser = e.options[e.selectedIndex].value;

               document.getElementById('harga_kertas'+data_id).value = strUser;

               hitung()
               harga_kertas = document.getElementById('harga_kertas1').value

               var ambil_id = $('#tampung #input-data1 .form-group select option[value="' + $(this).val() + '"]').data('value');
               document.getElementById('ambil_id'+data_id).value = ambil_id;

            });

         });

   function reply_click(select_id)
   {
      data_id =  select_id.charAt(select_id.length - 1);
   }

   function mulaihitung() {
      interval = setInterval("hitung()", 1);
   }

   function hitung() {
      jumlah = document.getElementById('jumlah'+data_id).value;
      hitung_data = jumlah * harga_kertas

      document.getElementById('jumlah_total'+data_id).value = hitung_data;
   }

   function stophitung() {
      clearInterval(interval);
   }
   </script>
   
@endpush