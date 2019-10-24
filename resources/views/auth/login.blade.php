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
                    <div class="cart_title text-center" style="color: white; font-weight: bold">Login</div>
                    <div class="m-3"> 
                    @if (session()->has('login.failed'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{ session('login.failed') }}
                        </div>
                    @endif
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama" style="color: white; font-size: 20px">Email</label>
                            <input type="Email" name="email" id="email" placeholder="Masukan E-mail"
                                class="form-control" autofocus=on/>
                        </div>
                        <div class="form-group">
                            <label for="password" for="alamat" style="color: white; font-size: 20px">Password:</label>
                            <input type="password" name="password" placeholder="Masukan Password" class="form-control" />
                        </div>

                        <input type="submit" name="submit" value="Login" class="btn btn-success btn-block"
                            style="padding-left: 50px; padding-right: 50px; cursor: pointer" />
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