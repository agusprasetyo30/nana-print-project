@extends('admin.layouts.app')

@section('page-title', 'Manajemen Barang')

@section('admin-role', 'admin')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('item.index') }}"><i class="ion ion-ios-book"></i> Item</a></li>
        <li class="active">Home</li>
    </ol>
@endsection

@push('css')
    <style>
        .stock {
            padding: 5px;
            background: darkslategray;
            color: white;
            cursor: pointer;
            border-radius: 3px;
        }

        .stock:hover {
            padding: 7px;
            color: darkgrey;
            transition: 0.3s all;            
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
                            action="{{ route('item.index') }}">
                            <div class="input-group" style="margin: 5px">
                                <input name="keyword" type="text"
                                    value="{{ Request::get('keyword') }}" class="form-control"
                                        placeholder="Cari berdasarkan nama"
                                        autocomplete="off">

                                    <div class="input-group-btn">
                                        <input type="submit" value="Search" class="btn btn-primary">
                                    </div>
                                {{-- <input type="hidden" name="role" value="{{ Request::get('role') }}"> --}}
                            </div>
                        </form>
                        <a href="{{ route('paper.index') }}" class="btn btn-info btn-sm" style="margin: 5px">
                                <span class="fa fa-plus"></span> Tambah Tipe Kertas</a>
                    </div>
                    <div class="col-md-6 col-xs-12" style="text-align: right; margin-top: 5px">
                        <a data-toggle="modal" data-target="#category-modal" data-backdrop="static" class="btn btn-success">
                            <span class="fa fa-plus"></span> Tambah Kategori Barang</a>
                            
                        <a data-toggle="modal" data-target="#add-item-modal" data-backdrop="static"
                            class="btn btn-success">
                            <span class="fa fa-plus"></span> Tambah Barang</a>
                    </div>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-hover table-bordered table-align-middle text-center">
                    <thead>
                        <tr>
                            <th style="vertical-align: middle" width="10px">#</th>
                            <th style="vertical-align: middle" width="250px">Nama</th>
                            <th style="vertical-align: middle" width="150px">Kategori</th>
                            <th style="vertical-align: middle" width="150px">Deskripsi</th>
                            <th style="vertical-align: middle" width="100px">Harga</th>
                            <th style="vertical-align: middle" width="50px">Stok</th>
                            <th style="vertical-align: middle" width="70px">Status</th>
                            <th style="vertical-align: middle" width="200px">Cover</th>
                            <th style="vertical-align: middle" width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['item'] as $item)
                            <tr>
                                <td>{{ $numberItem++ }}.</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    @foreach ($item->categories as $category)
                                        <span class="label label-success">{{ $category->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $item->description }}
                                </td>
                                <td>
                                    {{ toRupiah($item->price) }}                                    
                                </td>
                                <td>
                                    <a class="stock" data-item-stock="{{ $item->stock }}" data-item-id="{{ $item->id }}"
                                        data-item-name="{{ $item->name }}" 
                                        data-toggle="modal" data-target="#add-item-stock-modal"
                                        title="Klik untuk merubah stok barang">{{ $item->stock }}</a>
                                </td>
                                <td>
                                    @if ($item->status == "SHOW")
                                        <span class="label label-success">SHOW</span>
                                    @elseif($item->status == "HIDE")
                                        <span class="label label-danger">HIDE</span>                                        
                                    @endif
                                </td>
                                <td>
                                    @if($item->cover)
                                        <img src="{{asset('storage/' . $item->cover)}}"
                                            width="96px"/>
                                    @else
                                        [ No Image ]
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('item.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <div class="btn-group-vertical btn-group-sm">
                                            <a class="btn btn-warning"
                                                data-toggle="modal" data-target="#edit-item-modal" data-backdrop="static"
                                                data-item-name="{{ $item->name }}" data-item-description="{{ $item->description }}"
                                                data-item-price="{{ $item->price }}" data-item-status="{{ $item->status }}"
                                                data-item-cover="{{ $item->cover }}" data-item-id="{{ $item->id }}"
                                                data-item-categories="{{ $item->categories }}">EDIT</a>
                                            
                                            <input type="submit" class="btn btn-danger" 
                                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" 
                                                value="HAPUS">
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10">
                                {{-- Pagination --}}
                                {{$data['item']->appends(Request::all())->links()}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@include('admin.item.category_modal')
@include('admin.item.edit_category_modal')
@include('admin.item.add_item_modal')
@include('admin.item.edit_item_modal')
@include('admin.item.add_item_stock_modal')
{{-- @include('admin.item.kertas_modal') --}}



@push('js')
<script src="{{ asset('assets/admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<script>
    // Menampilkan ketegori menggunakan select2 (Tambah item)
        $('#dataCategories').select2({
            placeholder: 'Add Categories',
            ajax: {
                url : 'http://localhost:8000/admin/ajax/categories/search',
                processResults: function (data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                // id : id nya, text: yang ditampilkan di list
                                id: item.id,
                                text: item.name
                            }
                        })
                    }
                }
            }
        });
    //

    // Menampilkan modal edit kategori
        $('#edit-category-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var category_name = button.data('category-name')
            var category_id = button.data('category-id')

            console.log(category_name, category_id);

            var modal = $(this)
            modal.find('.modal-body #name').val(category_name)
            modal.find('.modal-body #category_id').val(category_id)
        });
    //

    // Menampilkan modal untuk edit stock
        $('#add-item-stock-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var stock = button.data('item-stock')
            var name = "[ " + button.data('item-name') + " ]"
            var item_id = button.data('item-id')

            
            console.log(name, item_id, stock);
            
            var modal = $(this)
            modal.find('.modal-body #data_stock').val(stock)
            modal.find('.modal-body #item_id').val(item_id)
            $(".modal-body .name").html(name);  
        });
    //


    // Untuk kurang dan tambah stock
        var $plus = $('#plusStock');
        var $minus = $('#minusStock');
        var $data = $('#data_stock');

        $plus.click(function() {
            $data.val(parseInt($data.val()) + 1);
        });

        $minus.click(function() {
            if (parseInt($data.val()) <= 0) {
                $data.val(0)    
            } else {
                $data.val(parseInt($data.val()) - 1);
            }
        });
    //
    
    // #EDIT ITEM //

    // Menampilkan edit item dan mengisi data
        $('#edit-item-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var item_id = button.data('item-id')
            var item_name = button.data('item-name')
            var item_description = button.data('item-description')
            var item_price = button.data('item-price')
            var item_status = button.data('item-status')
            var item_categories = button.data('item-categories')
            var item_cover = '{{ asset("storage") }}' + '/' + button.data('item-cover')

            console.log(item_categories);

            var modal = $(this)
            modal.find('.modal-body #item_id').val(item_id)
            modal.find('.modal-body #name').val(item_name)
            modal.find('.modal-body #description').val(item_description)
            modal.find('.modal-body #price').val(item_price)

        // Memasukan data ke photo
            $(".foto").attr("src", item_cover);

        // Untuk select status
            $(document).ready(() => { 
                $('#status option[value=' + item_status + ']').attr('selected', 'selected'); 
            });

        // Menampilkan ketegori menggunakan select2 (Edit item)
            $('#dataCategoriesEdit').select2({
                placeholder: 'Add Categories',
                ajax: {
                    url : 'http://localhost:8000/admin/ajax/categories/search',
                    processResults: function (data) {
                        return {
                            results: data.map(function(item) {
                                return {
                                    // id : id nya, text: yang ditampilkan di list
                                    id: item.id,
                                    text: item.name
                                }
                            })
                        }
                    }
                }
            });

        // Menampilkan inputan sesuai dengan kategori yg dipilih
            item_categories.forEach(function(category){
                var option = new Option(category.name, category.id, true, true);
                $('#dataCategoriesEdit').append(option).trigger('change');
            });

        // Menghapus data inputan setelah di klik "close"
            $('#dataClose').click(function() {
                console.log("Close");
                $('#dataCategoriesEdit').empty();
            }); 
        });
        
    // #EDIT ITEM //

    // Inputan hanya angka
    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
        {
            return false;

        } else {
            return true;
        }
    }
    //
</script>
@endpush

@endsection