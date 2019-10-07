<div class="modal fade" id="edit-category-modal">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title">Edit Kategori</h4>
           </div>
           <div class="modal-body">
                <form action="{{ route('category.update', 'test') }}" method="post">
                    @csrf
                    @method('put')
                    <label for="name">Nama Kategori</label>
                    <input type="text"
                        class="form-control" 
                        name="name" id="name"
                        autofocus=on 
                        placeholder="Masukan nama kategori"
                        required>

                    <input type="hidden" name="category_id" id="category_id">
                    <div class="text-right" style="margin-top: 10px;">
                        <input type="submit" class="btn btn-warning" value="Update">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                {{-- <button type="submit" class="btn btn-primary">Save</button> --}}
            </div>
       </div>
   </div>
</div>
