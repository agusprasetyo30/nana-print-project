<div class="modal fade" id="add-item-stock-modal">
    <div class="modal-dialog" style="width: 400px">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Stok item</h4>
            </div>
            <div class="modal-body" style="text-align: center">
                <div class="row" >

                <div class="col-md-12" style="text-align: center">

                <form action="{{ route('stock.update', 'test') }}" method="post">
                @csrf
                @method('put')

                <label for="stock">Stok item</label><br>
                <div><b class="name"></b></div>
                <div class="input-group" style="text-align: center; margin-top: 10px; margin-bottom: 10px">
                    <div class="input-group-btn">
                        <a class="btn btn-primary" id="minusStock"><span class="fa fa-minus"></span></a>
                    </div>
                    
                    <input type="text" class="form-control" onkeypress="return isNumberKey(event)"
                        style="text-align: center" name="data_stock" id="data_stock" autofocus="on">
                    
                    <div class="input-group-btn">
                        <a class="btn btn-primary" id="plusStock"><span class="fa fa-plus"></span></a>
                    </div>
                </div>
                <input type="hidden" name="item_id" id="item_id">
                <input type="submit" class="btn btn-success btn-block" value="Simpan">
                
            </form>
        </div>
    </div>

            </div>
        </div>
    </div>
</div>