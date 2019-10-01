<div class="modal fade" id="edit-paper-modal">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title">Edit Kertas</h4>
           </div>
           <div class="modal-body">
               <form action="{{ route('paper.update', 'test') }}" method="post">
                    @csrf
                    @method('put')
                    
                    <label for="name">Nama Kertas</label>
                    <input type="text"
                        class="form-control" 
                        name="name" id="name"
                        autofocus=on
                        autocomplete="off"
                        placeholder="Masukan nama kertas"
                        required> <br>
                    
                    <label for="price">Harga</label>
                    <input type="number"
                        class="form-control" 
                        name="price" id="price"
                        autofocus=on
                        autocomplete="off"
                        placeholder="Masukan harga kertas"
                        required> <br>

                    <label for="type">Tipe Kertas</label>
                    <select name="type" id="type" class="form-control">
                        <option value="" selected disabled>Pilih tipe kertas</option>
                        <option value="PRINT">PRINT</option>
                        <option value="PHOTO">PHOTO</option>
                    </select>
                    

                    <input type="hidden" name="paper_id" id="paper_id">
                  
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
