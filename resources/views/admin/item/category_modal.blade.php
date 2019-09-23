<div class="modal fade" id="category-modal" style="padding-right: 0px">
    <div class="modal-dialog" style="width: auto; margin: 10px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Kategori</h4>
            </div>
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="box box-success">
                            <div class="box-header"><h4>Tambah Kategori Item</h4></div>
                            <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="box-body">
                                    <label for="name">Nama Kategori</label>
                                    <input type="text" class="form-control" 
                                        name="name" id="name" autofocus=on
                                        placeholder="Masukan nama kategori"
                                        required>

                                    <div style="text-align: right; margin-top: 10px;">
                                        <input type="submit" class="btn btn-success" value="Simpan">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="box box-warning">
                            <div class="box-header"><h4>Data Kategori Item</h4></div>
                            <div class="box-body table-responsive">
                                <table id="category-table" class="table table-striped table-hover table-bordered table-align-middle text-center">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align: middle" width="10px">#</th>
                                            <th style="vertical-align: middle" width="250px">Nama Kategori</th>
                                            <th style="vertical-align: middle" width="100px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['category'] as $category)
                                        <tr>
                                            <td>{{ $numberCategory++ }}.</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <form action="{{ route('category.delete', $category->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        
                                                        <a class="btn btn-warning btn-sm" 
                                                            data-category-name="{{ $category->name }}" data-category-id="{{ $category->id }}"
                                                            data-toggle="modal" data-target="#edit-category-modal" data-backdrop="static">Edit</a>
                                                        
                                                        <input type="submit" onclick="return confirm('Apakah anda ingin menghapus kategori ini ?')" class="btn btn-danger btn-sm" value="Hapus">
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="10" id="category-table">
                                                {{-- {{ $data['category']->appends(Request::all())->links() }} --}}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="submit" class="btn btn-primary">Save</button> --}}
            </div>
        </div>
    </div>
</div>