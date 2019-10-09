@extends('admin.layouts.app')

@section('page-title', 'Transaksi ATK')

@section('admin-role', 'admin')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-book"></i> Transaksi ATK</a></li>
        <li class="active">Home</li>
    </ol>
@endsection

@section('content')
<div class="row">
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
                    <div class="col-md-6 col-xs-12">
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
                    <div class="col-md-4 col-xs-12">
                        <ul class="nav nav-pills nav-justified nav-card-header-pills">
                            <li class=" nav-item
                                {{ Request::path() == 'admin/order-atk'
                                    && Request::get('status') == null ? 'active' : '' }}">
                                <a href="{{ route('users.index') }}"
                                    class="nav-link"><b>ALL</b> (10)</a>
                            </li>
                            <li class="nav-item
                                {{ Request::get('role') == 'admin' ? 'active' : '' }}">
                                <a href="{{ route('users.index', ['role' => 'admin']) }}"
                                    class="nav-link"><b>CART</b> (5)</a>
                            </li>
                            <li class="nav-item
                                {{ Request::get('role') == 'customer' ? 'active' : '' }}">
                                <a href="{{ route('users.index', ['role' => 'customer']) }}"
                                    class="nav-link"><b>SUBMIT</b> (0)</a>
                            </li>
                            <li class="nav-item
                                {{ Request::get('role') == 'customer' ? 'active' : '' }}">
                                <a href="{{ route('users.index', ['role' => 'customer']) }}"
                                    class="nav-link"><b>PROCESS</b> (3)</a>
                            </li>
                            <li class="nav-item
                                {{ Request::get('role') == 'customer' ? 'active' : '' }}">
                                <a href="{{ route('users.index', ['role' => 'customer']) }}"
                                    class="nav-link"><b>FINISH</b> (2)</a>
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
                            <th style="vertical-align: middle" width="100px">Status</th>
                            <th style="vertical-align: middle" width="150px">Customer</th>
                            <th style="vertical-align: middle" width="100px">Total Price</th>
                            <th style="vertical-align: middle" width="150px">Jumlah beli</th>
                            <th style="vertical-align: middle" width="100px">Status Pengiriman</th>
                            <th style="vertical-align: middle" width="50px">Tanggal Transaksi</th>
                            <th style="vertical-align: middle" width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    @if ($item->status == 'CART')
                                        <a href=""> <span class="label label-danger">{{ $item->status }}</span></a>
                                    @elseif($item->status == 'SUBMIT')
                                        <a href=""> <span class="label label-primary">{{ $item->status }}</span></a>
                                    @elseif($item->status == 'PROCESS')
                                        <a href=""> <span class="label label-warning">{{ $item->status }}</span></a>
                                    @elseif($item->status == 'FINISH')
                                        <a href=""> <span class="label label-success">{{ $item->status }}</span></a>
                                    @endif
                                </td>
                                <td>
                                    {{ $item->user->name }}
                                    <br>
                                    <small>( {{ $item->user->email }} )</small>
                                </td>
                                <td>
                                    {{ toRupiah($item->total_price) }}
                                </td>
                                <td>
                                    {{ $item->item->count() }} item
                                </td>
                                <td>
                                    @if ($item->sending_status == "KIRIM")
                                        <span class="label label-success">{{ $item->sending_status }}</span>
                                    @elseif ($item->sending_status == "AMBIL")
                                        <span class="label label-warning">{{ $item->sending_status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="label label-info">{{ date('d F Y', strtotime($item->created_at)) }}</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                            <a role="button" data-toggle="modal" data-target="#show-item-order-modal-{{ $item->id }}" data-backdrop="static" class="btn btn-success btn-sm" 
                                                item-id = {{ $item->id }} >Show</a>                                            
                                            <a class="btn btn-warning btn-sm"
                                                data-toggle="modal" data-target="#edit-status-modal" data-backdrop="static">Edit</a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
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

@include('admin.transaksi-atk.edit_status_modal')

@foreach ($order_item as $data)
    @include('admin.transaksi-atk.show_item_model')
@endforeach

    
@push('js')
@endpush

@endsection
