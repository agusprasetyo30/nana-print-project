@extends('admin.layouts.app')

@section('page-title', 'Manajemen Pengguna')

@section('admin-role', 'admin')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Pengguna</a></li>
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
                <div class="row" >
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
                                {{ Request::path() == 'admin/users'
                                    && Request::get('role') == null ? 'active' : '' }}">
                                <a href="{{ route('users.index') }}"
                                    class="nav-link">All</a>
                            </li>
                            <li class="nav-item
                                {{ Request::get('role') == 'admin' ? 'active' : '' }}">
                                <a href="{{ route('users.index', ['role' => 'admin']) }}"
                                    class="nav-link">Admin</a>
                            </li>
                            <li class="nav-item
                                {{ Request::get('role') == 'customer' ? 'active' : '' }}">
                                <a href="{{ route('users.index', ['role' => 'customer']) }}"
                                    class="nav-link">Customer</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-xs-12" style="text-align: right; margin-top: 5px">
                        {{-- Tombol tambah --}}
                        <a data-toggle="modal" data-target="#create-modal" data-backdrop="static"
                            class="btn btn-success">
                            <span class="fa fa-plus"></span> Tambah Pengguna</a>
                    </div>
                </div>
            </div>
            <div  class="box-body table-responsive">
                <table class="table table-striped table-hover table-bordered table-align-middle text-center">
                    <thead>
                        <tr>
                            <th style="vertical-align: middle">#</th>
                            <th style="vertical-align: middle">Nama</th>
                            <th>Username <br>(Email)</th>
                            <th style="vertical-align: middle">Akses</th>
                            <th style="vertical-align: middle">Alamat</th>
                            <th style="vertical-align: middle">Telepon</th>
                            <th>Status <br> (Tanggal Daftar)</th>
                            <th style="vertical-align: middle">Avatar</th>
                            <th style="vertical-align: middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td style="vertical-align: middle">{{ $number++ }}.</td>
                                <td style="vertical-align: middle">
                                    {{ $user->name }}
                                </td>
                                <td style="vertical-align: middle">
                                    {{ $user->username }} <br>
                                    <small>( {{ $user->email }} )</small>
                                </td>
                                <td style="vertical-align: middle">
                                    <span class="label {{ $user->getRoleNames()[0] == 'admin' ? 'label-primary' : 'label-info' }}">
                                        {{ $user->getRoleNames()[0] }}
                                    </span>
                                </td>
                                <td style="vertical-align: middle">{{ $user->address }}</td>
                                <td style="vertical-align: middle">{{ $user->phone }}</td>
                                <td style="vertical-align: middle">
                                    <span class="label {{ $user->status == 'ACTIVE' ? 'label-success' : 'label-danger' }}">
                                        {{ $user->status }}
                                    </span><br>
                                    <span class="label label-warning">
                                        ( {{ date('d F Y', strtotime($user->updated_at)) }} )
                                    </span>
                                </td>
                                <td style="vertical-align: middle">
                                    @if($user->avatar)
                                        <img src="{{asset('storage/' . $user->avatar)}}"
                                            width="96px"/>
                                    @else
                                        [ No Image ]
                                    @endif
                                </td>
                                <td style="vertical-align: middle">
                                    <form action="{{route('users.destroy', $user->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <div class="btn-group-vertical btn-group-sm">
                                            {{-- Tombol edit --}}
                                            <a data-my-name="{{ $user->name }}" data-my-username="{{ $user->username }}"
                                                data-my-email="{{ $user->email }}" data-my-address="{{ $user->address }}"
                                                data-my-phone="{{ $user->phone }}" data-my-avatar="{{ $user->avatar }}"
                                                data-my-status="{{ $user->status }}" data-my-role="{{ $user->getRoleNames()[0] }}"
                                                data-user-id="{{ $user->id }}"  
                                                data-toggle="modal" data-target="#edit-modal" data-backdrop="static" class="btn btn-warning">
                                                EDIT</a>
                                            {{-- Tombol Hapus --}}
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')">
                                                HAPUS
                                            </button>
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
                                {{$users->appends(Request::all())->links()}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@include('admin.user.create-modal')
@include('admin.user.edit-modal')

@push('js')
<script>
    // Inputan nomer telepon
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
    
    $('#edit-modal').on('show.bs.modal', function (event) {
        
        var button = $(event.relatedTarget)
        var name = button.data('my-name')
        var username = button.data('my-username')
        var email = button.data('my-email')
        var address = button.data('my-address')
        var phone = button.data('my-phone')
        var avatar = '{{ asset("storage") }}' + '/' + button.data('my-avatar')
        var role = button.data('my-role')
        var status = button.data('my-status')
        var user_id = button.data('user-id')

        console.log(status);

        var modal = $(this)
        modal.find('.modal-body #name').val(name)
        modal.find('.modal-body #username').val(username)
        modal.find('.modal-body #email').val(email)
        modal.find('.modal-body #address').val(address)
        modal.find('.modal-body #phone').val(phone)
        modal.find('.modal-body #status').val(status)
        modal.find('.modal-body #user_id').val(user_id)
        
        // Memasukan data ke photo
        $(".foto").attr("src", avatar);

        // Untuk select role role
        $(document).ready(() => { 
            $('#role option[value=' + role + ']').attr('selected', 'selected'); 
        });   

        // Untuk select status
        $(document).ready(() => { 
            $('#status option[value=' + status + ']').attr('selected', 'selected'); 
        });
    })
</script>
@endpush

@endsection
