<div class="modal fade" id="edit-item-modal" style="padding-right: 0px">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" id="dataClose" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Item</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('item.update', 'test') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" 
                        name="name" id="name" placeholder="Masukan nama item" 
                        value="{{ old('name') }}" autofocus="on" required> <br>
                        
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control" 
                        name="description" id="description" 
                        cols="30" rows="3" placeholder="Masukan deskripsi" required>{{ old('description') }}</textarea><br>
                    
                    <div class="form-group">
                        <label for="cover">Cover</label> <br>
                        <small class="text-muted">Current cover</small><br>
                        <img src="" class="foto" width="96px"><br><br>
                        <input type="file"
                            name="cover" id="cover"
                            class="form-control">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah cover</small>
                    </div><br>

                    <label for="cover">Kategori</label>
                    <div class="form-group">                    
                        <select name="categories[]"
                            id="dataCategoriesEdit"
                            class="form-control select2 select2-container" multiple="multiple" style="width: 100%; background: chartreuse"
                            data-placeholder="Tambahkan kategori" required>
                        </select>
                    </div>
                    
                    <label for="price">Harga</label>
                    <div class="input-group">
                        <span class="input-group-addon">Rp.</span>
                        <input type="number" class="form-control" 
                            min="0" value="{{ old('price') }}" name="price" id="price" 
                            placeholder="Masukan harga item" required>
                    </div> <br>

                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="SHOW">SHOW</option>
                        <option value="HIDE">HIDE</option>
                    </select>

                    <input type="hidden" name="item_id" id="item_id">

                    <div class="text-right" style="margin-top: 10px">
                        <input type="submit" class="btn btn-warning" value="Update">
                    </div>
                </form>                
            </div>
        </div>
    </div>
</div>