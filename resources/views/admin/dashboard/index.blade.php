@extends('admin.layouts.app')

@section('page-title', 'Dashboard')

@section('admin-role', 'admin')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Dashboard</a></li>
        <li class="active">Home</li>
    </ol>
@endsection

@section('content')
<div class="row">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>        
            {{session('status')}}
        </div>
    @endif
    {{-- <div class="col-md-12"> --}}
        <div class="col-lg-6 col-sm-12">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $jml_user }}</h3>
                    <p>Pelanggan + Admin</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-people"></i>
                </div>
                <a href="{{ route('users.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $jml_item }}</h3>
                    <p>Item ATK</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-paper"></i>
                </div>
                <a href="{{ route('item.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $jml_transaksi_atk }}</h3>
                    <p>Transaksi ATK</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-document"></i>
                </div>
                <a href="{{ route('order-atk.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $jml_transaksi_print }}</h3>
                    <p>Transaksi Print & foto</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-printer"></i>
                </div>
                <a href="{{ route('order-print.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    {{-- </div> --}}

</div>
@endsection
