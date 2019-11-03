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
         margin-bottom: 20px;
      }

      .data-profil label {
         font-size: 15px;
      }

      .form-control {
         color: black;
         /* font-size: 24px; */
      }

      input[type=submit] {
         cursor: pointer;
      }
   </style>
@endpush

@section('content')
<div class="cart_section" style="padding-top: 50px; padding-bottom: 50px">
   <div class="container" style="background: white; padding: 20px">
      <div class="row">
         <div class="col-lg-10 offset-lg-1">
            <div class="cart_title">Edit Profil</div>
            <div class="cart_container">
               <div class="cart_items" style="margin-top: 20px">
                  <div class="cart_list mb-1 p-3">
                     <h4><i class="fa fa-user"></i> Data Profil Customer</h4>
                     <hr>
                     <form action="{{ route('customer.update-profile', $data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row p-3">
                           <div class="col-md-4">
                              <img src="{{ asset('storage/' . Auth::user()->avatar) }}" width="100%" height="100%">
                           </div>
                           <div class="col-md-4 ">
                              <div class="data-profil ">
                                 <label for="email">Email</label>
                                 <input type="text" 
                                    name="email" id="email"
                                    class="form-control" value="{{ $data->email }}" readonly>
                              </div>
                              <div class="data-profil">
                                 <label for="name">Nama</label>
                                 <input type="text" 
                                    name="name" id="name"
                                    class="form-control" value="{{ $data->name }}"
                                    autofocus=on required>
                              </div>
                              <div class="data-profil">
                                 <label for="username">Username</label>
                                 <input type="text" 
                                    name="username" id="username"
                                    class="form-control" value="{{ $data->username }}"
                                    autofocus=on required>
                              </div>
                              <div class="data-profil">
                                 <label for="phone">Nomer Telepon</label>
                                 <input type="text" 
                                    name="phone" id="phone"
                                    class="form-control" value="{{ $data->phone }}"
                                    autofocus=on onkeypress="return isNumberKey(event)" required>
                              </div>
                           </div>
                           <div class="col-md-4" style="border-left: 1px solid #d8d4d4">
                              <div class="data-profil">
                                 <label for="address">Alamat</label>
                                 <textarea name="address" id="address" 
                                    class="form-control" cols="30" rows="4">{{ $data->address }}</textarea>
                              </div>
                              <div class="data-profil">
                                 <label for="avatar">Foto Profil</label>
                                 <input type="file" name="avatar" id="avatar"
                                    class="form-control">
                                 <small>Kosongkan jika tidak ingin merubah foto profil</small>
                              </div>
                              <div class="data-profil">
                                 <input type="submit" class="btn btn-primary btn-block" value="Update Profil"
                                    title="Simpan perubahan data profil">
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="cart_list mt-3 p-3" >
                     <h4><i class="fa fa-lock"></i> Ubah Password</h4>
                     <hr>
                     <form action="{{ route('customer.change-password', \Auth::user()->id) }}" method="post">
                        <div class="row p-3">
                           @csrf
                           <div class="col-sm-4">
                              <div>
                                 <h5>Password Lama</h5>
                                 <input type="password" name="old_password" class="form-control"
                                    placeholder="Masukan Password lama" required>
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div>
                                 <h5>Password Baru</h5>
                                 <input type="password" name="password" class="form-control"
                                    placeholder="Password Baru (Min 8 Karakter)" required>
                                 
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div>
                                 <h5>Konfirmasi Password Baru</h5>
                                 <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Konfirmasi Password Baru" required>
                              </div>
                           </div>
                        </div>
                        <div class="row p-3">
                           <div class="col-sm-12">
                              <input type="submit" class="btn btn-primary" value="Ubah Password" 
                              title="Simpan password baru pengguna">
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@push('js')
   <script>
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
         } else {
            return true;
         }
      }
   </script>
@endpush