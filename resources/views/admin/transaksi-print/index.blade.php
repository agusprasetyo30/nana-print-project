@extends('admin.layouts.app')

@section('page-title', 'Transaksi Print & Foto')

@section('admin-role', 'admin')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-print"></i> Transaksi Print & Foto</a></li>
        <li class="active">Home</li>
    </ol>
@endsection

@push('css')
    <style>
        .jumlah-item {
            color: black;
        }

        .jumlah-item:hover {
            transition: 0.3s all;
            color: white;
            background: black;
            padding: 5px;
            border-radius: 5px;
        }

        .jumlah-item:focus {
            border-radius: 5px;
            background: black;
            padding: 5px;
            color: white;
        }

    </style>
@endpush

@section('content')
<div class="row ">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>        
                        {{session('status')}}
                    </div>
                @endif
                <hr>
                <div class="row">
                    <div class="col-md-5 col-xs-12">
                        <form
                            action="{{ route('users.index') }}">
                            <div class="input-group" style="margin: 5px">
                                <input name="keyword" type="text"
                                    value="{{ Request::get('keyword') }}" class="form-control"
                                        placeholder="Cari berdasarkan nama">

                                    <div class="input-group-btn">
                                        <input type="submit" value="Search" class="btn btn-primary">
                                    </div>
                                <input type="hidden" name="role" value="{{ Request::get('role') }}">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3 col-xs-6">
                        <ul class="nav nav-pills nav-justified nav-card-header-pills">
                            <li class=" nav-item
                                {{ Request::path() == 'admin/order-atk'
                                    && Request::get('status') == null ? 'active' : '' }}" style="background: sienna; ">
                                <a href="{{ route('users.index') }}"
                                    class="nav-link" style="color: white"><b>ALL</b> <br>(10)</a>
                            </li>
                            <li class="nav-item
                                {{ Request::get('role') == 'admin' ? 'active' : '' }}">
                                <a href="{{ route('users.index', ['role' => 'admin']) }}"
                                    class="nav-link"><b>PRINT</b> <br>(5)</a>
                            </li>
                            <li class="nav-item
                                {{ Request::get('role') == 'customer' ? 'active' : '' }}" >
                                <a href="{{ route('users.index', ['role' => 'customer']) }}"
                                    class="nav-link"><b>PHOTO</b> <br>(0)</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-1" style="padding: 0px; width: 20px"></div>
                    <div class="col-md-3 col-xs-6 ">
                        <ul class="nav nav-pills nav-justified nav-card-header-pills">
                            <li class=" nav-item
                                {{ Request::path() == 'admin/order-atk'
                                    && Request::get('status') == null ? 'active' : '' }} active" >
                                <a href="{{ route('users.index') }}"
                                    class="nav-link"><b>SUBMIT</b> <br>(10)</a>
                            </li>
                            <li class="nav-item
                                {{ Request::get('role') == 'admin' ? 'active' : '' }}">
                                <a href="{{ route('users.index', ['role' => 'admin']) }}"
                                    class="nav-link"><b>PROCESS</b> <br>(5)</a>
                            </li>
                            <li class="nav-item
                                {{ Request::get('role') == 'customer' ? 'active' : '' }}" >
                                <a href="{{ route('users.index', ['role' => 'customer']) }}"
                                    class="nav-link"><b>FINISH</b> <br>(0)</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-hover table-bordered table-align-middle text-center">
                    <thead>
                        <tr>
                            <th style="vertical-align: middle" width="10px">#</th>
                            <th style="vertical-align: middle" width="100px">Nama Customer</th>
                            <th style="vertical-align: middle" width="100px">Total transaksi (Rp)</th>
                            <th style="vertical-align: middle" width="150px">Jumlah</th>
                            <th style="vertical-align: middle" width="80px">Type</th>
                            <th style="vertical-align: middle" width="80px">Status</th>
                            <th style="vertical-align: middle" width="50px">Tanggal Transaksi</th>
                            <th style="vertical-align: middle" width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Agus Prasetyo <br> 
                                <small>agusprasetyo1889@gmail.com</small>
                            </td>
                            <td>
                                Rp. 15.000
                            </td>
                            <td>
                                <a href="#" class="jumlah-item"
                                    data-toggle="modal" data-target="#show-print-order-modal" data-backdrop="static">2 Items</a>
                            </td>
                            <td>
                                <span class="label label-info">PRINT</span>
                            </td>
                            <td>
                                <span class="label label-primary">SUBMIT</span>
                            </td>
                            <td>
                                <span class="label label-info">{{ date('d F Y', strtotime(Carbon\Carbon::now())) }}</span>
                            </td>
                            <td>
                                <div class="btn-group-sm">
                                    <a href="#" class="btn btn-primary btn-sm" >Download</a>
                                    <a href="#" class="btn btn-warning btn-sm"
                                        data-toggle="modal" data-target="#edit-status-modal" data-backdrop="static">Edit</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10">
                                {{-- Pagination --}}
                                {{-- {{$users->appends(Request::all())->links()}} --}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@include('admin.transaksi-print.edit_status_modal')
@include('admin.transaksi-print.show_print_model')

@push('js')
@endpush

@endsection
