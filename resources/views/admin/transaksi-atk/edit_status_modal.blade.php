<div class="modal fade" id="edit-status-modal">
      <div class="modal-dialog" style="width: 400px">
            <div class="modal-content" >
                  <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                              id="dataClose">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Status Transaksi Item</h4>
                  </div>
                  <div class="modal-body" style="text-align: center">
                        <div class="row" >
                              <form action="{{ route('order-atk.update-status', 'test') }}" method="post">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="order_atk_id" id="order_atk_id">
                                    <div class="col-md-12" style="text-align: center; padding: 0px">   
                                          <input type="submit" name="btn-status" id="status-cart" class="btn btn-danger" value="CART">
                                          <input type="submit" name="btn-status" id="status-submit" class="btn btn-primary" value="SUBMIT">
                                          <input type="submit" name="btn-status" id="status-process" class="btn btn-warning" value="PROCESS">
                                          <input type="submit" name="btn-status" id="status-finish" class="btn btn-success" value="FINISH">
                                    </div>
                              </form>
                        </div>
                  </div>
            </div>
      </div>
</div>