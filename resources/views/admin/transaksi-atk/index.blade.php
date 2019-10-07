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
                Judul
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-hover table-bordered table-align-middle text-center">
                    <thead>
                        <tr>
                            <th style="vertical-align: middle" width="10px">#</th>
                            <th style="vertical-align: middle" width="100px">Status</th>
                            <th style="vertical-align: middle" width="150px">Customer</th>
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
                                    <a href=""> <span class="label label-danger">{{ $item->status }}</span></a>
                                </td>
                                <td>
                                    {{ $item->user->name }}
                                </td>
                                <td>
                                    {{ $item->item->count() }} item
                                </td>
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
                                            <a href="#" class="btn btn-warning btn-sm">Edit</a>
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

@foreach ($order_item as $data)
    @include('admin.transaksi-atk.show_item_model')
@endforeach

@push('js')

@endpush

@endsection
