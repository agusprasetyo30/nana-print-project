@extends('admin.layouts.app')

@section('page-title', 'Transaksi ATK')

@section('admin-role', 'admin')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-book"></i> Transaksi ATK</a></li>
        <li class="active">Home</li>
    </ol>
@endsection

@push('css')
    <style>
        .blink{
            background: #470000 !important;
            border: 1px solid black;
            color: white;
        }
    </style>
@endpush

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
                            action="{{ route('order-atk.index') }}">
                            <div class="input-group" style="margin: 5px">
                                <input name="keyword" type="text"
                                    value="{{ Request::get('keyword') }}" class="form-control"
                                        placeholder="Cari berdasarkan nama customer">

                                    <div class="input-group-btn">
                                        <input type="submit" value="Search" class="btn btn-primary">
                                    </div>
                            </div>
                            <input type="hidden" name="status" value="{{ Request::get('status') }}">
                        </form>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <ul class="nav nav-pills nav-justified nav-card-header-pills">
                            <li class=" nav-item
                                {{ Request::path() == 'admin/order-atk'
                                    && Request::get('status') == null ? 'active' : '' }}">
                                <a href="{{ route('order-atk.index') }}"
                                    class="nav-link"><b>ALL</b> <br>({{ $order_item->count() }})</a>
                            </li>
                            <li class="nav-item
                                {{ Request::get('status') == 'CART' ? 'active' : '' }}">
                                <a href="{{ route('order-atk.index', ['status' => 'CART']) }}"
                                    class="nav-link"><b>CART</b> <br>({{ $order_item->where("status", "=", "CART")->count() }})</a>
                            </li>
                            <li class="nav-item
                                {{ Request::get('status') == 'SUBMIT' ? 'active' : '' }}">
                                <a href="{{ route('order-atk.index', ['status' => 'SUBMIT']) }}"
                                    class="nav-link"><b>SUBMIT</b> <br>({{ $order_item->where("status", "=", "SUBMIT")->count() }})</a>
                            </li>
                            <li class="nav-item
                                {{ Request::get('status') == 'PROCESS' ? 'active' : '' }}">
                                <a href="{{ route('order-atk.index', ['status' => 'PROCESS']) }}"
                                    class="nav-link"><b>PROCESS</b> <br>({{ $order_item->where("status", "=", "PROCESS")->count() }})</a>
                            </li>
                            <li class="nav-item
                                {{ Request::get('status') == 'FINISH' ? 'active' : '' }}">
                                <a href="{{ route('order-atk.index', ['status' => 'FINISH']) }}"
                                    class="nav-link"><b>FINISH</b> <br>({{ $order_item->where("status", "=", "FINISH")->count() }})</a>
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
                                <td>{{ $numberOrders++ }}.</td>
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
                                    <div class="btn-group-sm">
                                            <a role="button" data-toggle="modal" data-target="#show-item-order-modal-{{ $item->id }}" data-backdrop="static" class="btn btn-success btn-sm" 
                                                item-id = {{ $item->id }} >Show</a>                                            
                                            <a class="btn btn-warning btn-sm"
                                                data-toggle="modal" data-target="#edit-status-modal" data-backdrop="static"
                                                    data-order-atk-status={{ $item->status }} data-order-atk-id={{ $item->id }}>Edit</a>
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
                                {{ $orders->appends(Request::all())->links() }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@include('admin.transaksi-atk.edit_status_modal')

@foreach ($orders as $data)
    @include('admin.transaksi-atk.show_item_model')
@endforeach

    
@push('js')
    <script>
        $('#edit-status-modal').on('show.bs.modal', function (event) {
            
            var timer = null;
            var button = $(event.relatedTarget)
            var status = button.data('order-atk-status')
            var id = button.data('order-atk-id')

            var modal = $(this)
            modal.find('.modal-body #order_atk_id').val(id)

            timer = setInterval(function() {
                
                if (status == "CART") {
                    buttonCartEnabled()
                    $('#status-cart').toggleClass('blink')
                    
                } else if (status == "SUBMIT") {
                    $('#status-submit').toggleClass('blink')
                    buttonCartEnabled()
                    buttonSubmitEnabled()

                } else if (status == "PROCESS") {
                    $('#status-process').toggleClass('blink')
                    buttonCartEnabled()
                    buttonSubmitEnabled()
                    buttonProcessEnabled()

                } else if (status == "FINISH") {
                    $('#status-finish').toggleClass('blink')
                    buttonCartEnabled()
                    buttonSubmitEnabled()
                    buttonProcessEnabled()
                    buttonFinishEnabled()
                }

            } ,500);

            function buttonCartEnabled()
            {
                $('#status-cart').addClass('disabled')                
            }

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
                $('#status-cart').removeClass('disabled')
                $('#status-cart').removeClass('blink')
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
