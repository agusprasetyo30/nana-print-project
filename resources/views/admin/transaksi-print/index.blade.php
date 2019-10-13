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

        .blink{
            background: #470000 !important;
            border: 1px solid black;
            color: white;
        }

        .nav-pills > li.active-type > a {
            background: sienna;
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
                            action="{{ route('order-print.index') }}">
                            <div class="input-group" style="margin: 5px">
                                <input name="keyword" type="text"
                                    value="{{ Request::get('keyword') }}" class="form-control"
                                        placeholder="Cari berdasarkan nama">

                                    <div class="input-group-btn">
                                        <input type="submit" value="Search" class="btn btn-primary">
                                    </div>
                                <input type="hidden" name="status" value="{{ Request::get('status') }}">
                                <input type="hidden" name="type" value="{{ Request::get('type') }}">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3 col-xs-6">
                        <ul class="nav nav-pills nav-justified nav-card-header-pills">
                            <li class="nav-item
                                {{ Request::path() == 'admin/order-print'
                                    && Request::get('type') == null ? 'active-type' : '' }}">
                                <a href="{{ route('order-print.index') }}"
                                    class="nav-link"><b>ALL</b> <br>({{ $print_orders->count() }})</a>
                            </li>
                            <li class="nav-item
                                {{ Request::get('type') == 'PRINT' ? 'active-type' : '' }}">
                                <a href="{{ route('order-print.index', ['status' => Request::get('status') ? Request::get('status') : '' ,'type' => 'PRINT']) }}"
                                    class="nav-link"><b>PRINT</b> <br>({{ $print_orders->where("type", "=", "PRINT")->count() }})</a>
                            </li>
                            <li class="nav-item
                                {{ Request::get('type') == 'PHOTO' ? 'active-type' : '' }}" >
                                <a href="{{ route('order-print.index', ['status' => Request::get('status') ? Request::get('status') : '' , 'type' => 'PHOTO']) }}"
                                    class="nav-link"><b>PHOTO</b> <br>({{ $print_orders->where("type", "=", "PHOTO")->count() }})</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-1" style="padding: 0px; width: 20px"></div>
                    <div class="col-md-3 col-xs-6 ">
                        <ul class="nav nav-pills nav-justified nav-card-header-pills">
                            <li class=" nav-item
                                {{ Request::get('status') == "SUBMIT" ? 'active' : '' }}" >
                                <a href="{{ route('order-print.index', ['status' => 'SUBMIT', 'type' => Request::get('type') ? Request::get('type') : '']) }}"
                                    class="nav-link"><b>SUBMIT</b> <br>({{ $orders->where("status", "=", "SUBMIT")->count() }})</a>
                            </li>
                            <li class="nav-item
                                {{ Request::get('status') == 'PROCESS' ? 'active' : '' }}">
                                <a href="{{ route('order-print.index', ['status' => 'PROCESS', 'type' => Request::get('type') ? Request::get('type') : '']) }}"
                                    class="nav-link"><b>PROCESS</b> <br>({{ $orders->where("status", "=", "PROCESS")->count() }})</a>
                            </li>
                            <li class="nav-item
                                {{ Request::get('status') == 'FINISH' ? 'active' : '' }}" >
                                <a href="{{ route('order-print.index', ['status' => 'FINISH', 'type' => Request::get('type') ? Request::get('type') : '']) }}"
                                    class="nav-link"><b>FINISH</b> <br>({{ $orders->where("status", "=", "FINISH")->count() }})</a>
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
                        @foreach ($orders as $data)                            
                        
                            <tr>
                                <td>{{ $numberOrders++ }}</td>
                                <td>{{ $data->user->name }} <br> 
                                    <small>{{ $data->user->email }}</small>
                                </td>
                                <td>
                                    {{ toRupiah($data->total_price) }}
                                </td>
                                <td>
                                    <a href="#" class="jumlah-item"
                                        data-toggle="modal" data-target="#show-print-order-modal-{{ $data->id }}" data-backdrop="static">{{ $data->paper->count() }} Items</a>
                                </td>
                                <td>
                                    @if ($data->type == "PRINT")
                                        <span class="label label-danger">PRINT</span>
                                    @elseif ($data->type == "PHOTO")
                                        <span class="label label-info">PHOTO</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status == "SUBMIT")
                                        <span class="label label-primary">SUBMIT</span>
                                    @elseif ($data->status == "PROCESS")
                                        <span class="label label-warning">PROCESS</span>
                                    @elseif ($data->status == "FINISH")
                                        <span class="label label-success">FINISH</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="label label-info">{{ date('d F Y', strtotime($data->created_at)) }}</span>
                                </td>
                                <td>
                                    <div class="btn-group-sm">
                                        <a href="{{ route('order-print.download', $data->id ) }}" class="btn btn-primary btn-sm" >Download</a>
                                        <a href="#" class="btn btn-warning btn-sm"
                                            data-toggle="modal" data-target="#edit-status-modal" data-backdrop="static"
                                            data-order-print-status={{ $data->status }} data-order-print-id={{ $data->id }}>Edit</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @empty($data)
                            <tr>
                                <td colspan="8">
                                    Tidak ada data
                                </td>
                            </tr>
                        @endempty                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10">
                                {{-- Pagination --}}
                                {{$orders->appends(Request::all())->links()}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@include('admin.transaksi-print.edit_status_modal')

@foreach ($orders as $data)
    @include('admin.transaksi-print.show_print_model')
@endforeach

@push('js')
<script>
        $('#edit-status-modal').on('show.bs.modal', function (event) {
            
            var timer = null;
            var button = $(event.relatedTarget)
            var status = button.data('order-print-status')
            var id = button.data('order-print-id')

            console.log(id);
            var modal = $(this)
            modal.find('.modal-body #order_print_id').val(id)


            timer = setInterval(function() {
                if (status == "SUBMIT") {
                    $('#status-submit').toggleClass('blink')
                    buttonSubmitEnabled()

                } else if (status == "PROCESS") {
                    $('#status-process').toggleClass('blink')
                    buttonSubmitEnabled()
                    buttonProcessEnabled()

                } else if (status == "FINISH") {
                    $('#status-finish').toggleClass('blink')
                    buttonSubmitEnabled()
                    buttonProcessEnabled()
                    buttonFinishEnabled()
                }

            } ,500);

            function buttonSubmitEnabled()
            {
                $('#status-submit').addClass('disabled')
            }

            function buttonProcessEnabled()
            {
                $('#status-process').addClass('disabled')
            }

            function buttonFinishEnabled()
            {
                $('#status-finish').addClass('disabled')
            }

            function disabledButtonStatus() 
            {
                $('#status-submit').removeClass('disabled')
                $('#status-submit').removeClass('blink')
                $('#status-process').removeClass('disabled')
                $('#status-process').removeClass('blink')
                $('#status-finish').removeClass('disabled')
                $('#status-finish').removeClass('blink')
            }

            $('#dataClose').click(function() {
                clearInterval(timer)
                disabledButtonStatus()
            });
        })
    </script>
@endpush

@endsection
