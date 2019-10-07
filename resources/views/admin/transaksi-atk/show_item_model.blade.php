<div class="modal fade" id="show-item-order-modal-{{ $data->id }}">
      <div class="modal-dialog" style="width: 400px">
            <div class="modal-content" >
                  <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Daftar transaksi item</h4>
                  </div>
                  <div class="modal-body" style="text-align: center">
                        <div class="row" >
                              <div class="col-md-12" style="text-align: center; padding: 0px">   
                                    <div class="container-fluid">
                                          <div class="row" style="padding: 10px">
                                                @foreach ($data->item()->where('item_order_id', '=', $data->id)->get() as $item)
                                                <div class="col-md-12" style="background:#f7f7f7; margin-top: 5px; margin-bottom: 5px"> 
                                                      <div class="row">
                                                            <div class="col-md-3" style="padding: 0px">
                                                                  <img src="{{ asset("storage/" . $item->cover) }}" alt="{{ $item->name }}" width="90px" height="70px"> 
                                                            </div>
                                                            <div class="col-md-7" style="padding: 10px; text-align: left">
                                                                  <div style="font-size: 20px">
                                                                        {{ $item->name }}
                                                                  </div>
                                                                  {{-- <hr> --}}
                                                                  <div class="title">
                                                                        {{ toRupiah($item->price) }}
                                                                  </div>
                                                            </div>
                                                            <div class="col-md-2" style="padding:0; padding-bottom: 25px; padding-top: 25px">
                                                                  {{ $item->pivot->quantity }} x
                                                            </div>
                                                      </div>
                                                </div>
                                                @endforeach
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