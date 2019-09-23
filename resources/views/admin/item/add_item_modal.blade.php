<div class="modal fade" id="add-item-modal" style="padding-right: 0px">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Item</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('item.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <label for="name">Nama</label>
                    <input type="text" class="form-control" 
                        name="name" id="name" placeholder="Masukan nama item" 
                        value="{{ old('name') }}" autofocus="on" required> <br>
                        
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control" 
                        name="description" id="description" 
                        cols="30" rows="3" placeholder="Masukan deskripsi" required>{{ old('description') }}</textarea><br>
                    
                    <label for="cover">Cover</label>
                    <input type="file" name="cover" id="cover" class="form-control"><br>

                    <label for="cover">Kategori</label>
                    <div class="form-group">                    
                        <select name="categories[]"
                            id="dataCategories"
                            class="form-control select2 select2-container" multiple="multiple" style="width: 100%; background: chartreuse"
                            data-placeholder="Tambahkan kategori">
                        </select>
                    </div>
                    
                    <label for="price">Harga</label>
                    <div class="input-group">
                        <span class="input-group-addon">Rp.</span>
                        <input type="number" class="form-control" 
                            min="0" value="{{ old('price') }}" name="price" id="price" 
                            placeholder="Masukan harga item" required>
                    </div> <br>
                    
                    <label for="stock">Stok</label>
                    <input type="number" class="form-control" 
                        min="0" value="{{ old('stock') }}" name="stock" id="stock"
                        placeholder="Masukan total stok item" required> <br>

                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="" selected disabled>Pilih Status</option>
                        <option value="SHOW">SHOW</option>
                        <option value="HIDE">HIDE</option>
                    </select>

                    <div class="text-right" style="margin-top: 10px">
                        <input type="submit" class="btn btn-success" value="Simpan">
                    </div>
                </form>                
            </div>
            <div class="modal-footer">
                {{-- <button type="submit" class="btn btn-primary">Save</button> --}}
            </div>
        </div>
    </div>
</div>