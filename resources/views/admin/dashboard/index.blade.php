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
    {{-- <div class="col-md-12"> --}}
        <div class="col-lg-4 col-sm-12">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $jml_user }}</h3>
                    <p>Pelanggan + Admin</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-people"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>12</h3>
                    <p>Menu</p>
                </div>
                <div class="icon">
                    <i class="ion ion-document-text"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>12</h3>
                    <p>Menu</p>
                </div>
                <div class="icon">
                    <i class="ion ion-document-text"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    {{-- </div> --}}

</div>
<div class="box">
    <div class="box-body">
        Belum ada ide untuk menampilkan data apa
    </div>
</div>
@endsection
