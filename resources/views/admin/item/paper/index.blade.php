@extends('admin.layouts.app')

@section('page-title', 'Manajemen Kertas')

@section('admin-role', 'admin')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('item.index') }}"><i class="ion ion-ios-book"></i> Item</a></li>
        <li class="active">Kertas</li>
    </ol>
@endsection

@push('css')
@endpush

@section('content')
<div class="row">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible" style="margin: 14px">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>        
            {{session('status')}}
        </div>  
    @endif
    <div class="col-md-4 col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                Input Data Kertas
            </div>
            <div class="box-body">
                <form action="{{ route('paper.store') }}" method="post">
                    @csrf
                    <div class="box-body">
                        <label for="name">Nama Kertas</label>
                        <input type="text" class="form-control" 
                            name="name" id="name" autofocus=on autocomplete="off"
                            placeholder="Masukan nama kertas"
                            required> <br>

                        <label for="price">Harga</label>
                        <input type="number" class="form-control" 
                            name="price" id="price" autofocus=on
                            placeholder="Masukan Harga" min="0" value="0" 
                            required> <br>

                        <label for="type">Tipe Kertas</label>
                        <select name="type" id="type" class="form-control">
                            <option value="" selected disabled>Pilih tipe kertas</option>
                            <option value="PRINT">PRINT</option>
                            <option value="PHOTO">PHOTO</option>
                        </select>

                        <div style="text-align: right; margin-top: 10px;">
                            <input type="submit" class="btn btn-success" value="Simpan">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-xs-12">
        <div class="box box-warning">
            <div class="box-header">
                Daftar tipe kertas
            </div>

            <div class="row">
                <div class="col-md-6 col-xs-12">            
                    <form action="{{ route('paper.index') }}" style="margin: 5px">
                        <div class="input-group">
                            <input name="keyword" type="text"
                                value="{{ Request::get('keyword') }}" class="form-control"
                                    placeholder="Cari berdasarkan nama"
                                    autocomplete="off">
                                    
                            <div class="input-group-btn">
                                <input type="submit" value="Search" class="btn btn-primary">
                            </div>
                        </div>
                        <input type="hidden" name="type" value="{{ Request::get('type') }}">
                    </form>
                </div>
                <div class="col-md-6 col-xs-12">
                    <ul class="nav nav-pills nav-justified nav-card-header-pills">
                        <li class=" nav-item {{ Request::path() == 'admin/item/paper' && 
                            Request::get('type') == null ? 'active' : '' }}">
                            <a href="{{ route('paper.index') }}"
                                class="nav-link">ALL</a>
                        </li>
                        <li class="nav-item
                            {{ Request::get('type') == 'PRINT' ? 'active' : '' }}">
                            <a href="{{ route('paper.index', ['type' => 'PRINT']) }}"
                                class="nav-link">PRINT</a>
                        </li>
                        <li class="nav-item
                            {{ Request::get('type') == 'PHOTO' ? 'active' : '' }}">
                            <a href="{{ route('paper.index', ['type' => 'PHOTO']) }}"
                                class="nav-link">PHOTO</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table id="category-table" class="table table-striped table-hover table-bordered table-align-middle text-center">
                    <thead>
                        <tr>
                            <th style="vertical-align: middle" width="10px">#</th>
                            <th style="vertical-align: middle" width="250px">Nama Kertas</th>
                            <th style="vertical-align: middle" width="100px">Harga</th>
                            <th style="vertical-align: middle" width="100px">Tipe Kertas</th>
                            <th style="vertical-align: middle" width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($data['paper'] as $paper)
                        <tr>
                            <td>{{ $numberPaper++ }}.</td>
                            <td>{{ $paper->name }}</td>
                            <td>{{ toRupiah($paper->price) }}</td>
                            <td>
                                @if ($paper->type == "PRINT")
                                    <span class="label label-success">PRINT</span>
                                @elseif($paper->type == "PHOTO")
                                    <span class="label label-warning">PHOTO</span>                                        
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <form action="{{ route('paper.delete', $paper->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        
                                        <a class="btn btn-warning btn-sm"
                                            data-toggle="modal" data-target="#edit-paper-modal" data-backdrop="static"
                                            data-paper-name="{{ $paper->name }}" data-paper-price="{{ $paper->price }}"
                                            data-paper-type="{{ $paper->type }}" data-paper-id="{{ $paper->id }}">Edit</a>
                                        
                                        <input type="submit" onclick="return confirm('Apakah anda ingin menghapus jenis kertas ini ?')" 
                                        class="btn btn-danger btn-sm" value="Hapus">
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach 
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10" id="category-table">
                                {{ $data['paper']->appends(Request::all())->links() }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@include('admin.item.paper.edit_paper_modal')

@push('js')
    <script>
        $('#edit-paper-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var paper_id = button.data('paper-id')
            var paper_name = button.data('paper-name')
            var paper_price = button.data('paper-price')
            var paper_type = button.data('paper-type')

            console.log(paper_id, paper_name, paper_price, paper_type);

            var modal = $(this)
            modal.find('.modal-body #name').val(paper_name)
            modal.find('.modal-body #price').val(paper_price)
            modal.find('.modal-body #paper_id').val(paper_id)

            $(document).ready(() => { 
                $('#type option[value=' + paper_type + ']').attr('selected', 'selected'); 
            });
        });
    </script>
@endpush

@endsection