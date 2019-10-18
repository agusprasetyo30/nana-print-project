@extends('customer.layouts.app')

@section('page-title', 'Login')

@section('css-tambahan')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/styles/cart_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer/styles/cart_responsive.css') }}">
@endsection

@section('content')
<div class="cart_section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 p-3 bg-primary">
                <div class="cart_container">
                    <div class="cart_title text-center" style="color: white; font-weight: bold">Form Register</div>
                    <div class="m-3" <form action="contact.php" method="POST">
                        <div class="form-group">
                            <label for="nama" style="color: white; font-size: 20px">Nama</label>
                            <input type="text" name="nama" id="nama" placeholder="Nama lengkap..."
                                        class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="username" style="color: white; font-size: 20px">Username</label>
                            <input type="text" name="username" placeholder="Username..." class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="alamat" style="color: white; font-size: 20px">Alamat</label>
                            <textarea name="alamat" id="alamat" cols="30" rows="3" name="alamat"
                                            placeholder="Alamat Lengkap..." class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="no-telepon" for="alamat" style="color: white; font-size: 20px">No Telepon</label>
                            <input type="text" name="no-telepon" placeholder="No-Telepon..." class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="cover" for="alamat" style="color: white; font-size: 20px">Avatar</label>
                            <input type="file" name="avatar" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="email" for="alamat" style="color: white; font-size: 20px">Email</label>
                            <input type="email" name="email" placeholder="Your email..." class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="password" for="alamat" style="color: white; font-size: 20px">Password</label>
                            <input type="password" name="password" placeholder="Password..." class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="password" for="alamat" style="color: white; font-size: 20px">Confirm
                                Password</label>
                            <input type="password" name="password" placeholder="Password..." class="form-control" />
                        </div>

                        <input type="submit" name="submit" value="Daftar" class="btn btn-success btn-block"
                                    style="padding-left: 50px; padding-right: 50px" />
                        </form>
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