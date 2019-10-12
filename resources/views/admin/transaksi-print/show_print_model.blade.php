<div class="modal fade" id="show-print-order-modal-{{ $data->id }}">
      <div class="modal-dialog" style="width: 400px">
            <div class="modal-content" >
                  <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Daftar transaksi Print & Foto</h4>
                  </div>
                  <div class="modal-body" style="text-align: center">
                        <div class="row" >
                              <div class="col-md-12" style="text-align: center; padding: 0px">   
                                    <div class="container-fluid">
                                          <div class="row" style="padding: 10px">
                                                @php
                                                      $total = 0;
                                                @endphp
                                                @foreach ($data->paper()->where('print_order_id', '=', $data->id)->get() as $item)                                                    
                                                      <div class="col-md-12" style="background:#f7f7f7; margin-top: 5px; margin-bottom: 5px"> 
                                                            <div class="row">
                                                                  <div class="col-md-3" style="padding: 0px">
                                                                        @if ($data->type == "PRINT")
                                                                              <img src="https://cdn0.iconfinder.com/data/icons/print-7/24/Print_Button_printer-512.png" alt="Contoh" width="100%" height="110px"> 
                                                                        @elseif($data->type == "PHOTO")
                                                                              <img src="https://icon-library.net/images/image-icon/image-icon-4.jpg" alt="Contoh" width="100%" height="110px"> 
                                                                        @endif
                                                                  </div>
                                                                  <div class="col-md-5" style="padding: 5px; text-align: left">
                                                                        <div style="font-size: 15px; " >
                                                                              <label for="nama-file">Nama File :</label>
                                                                              <div id="nama-file" style="margin-bottom: 5px">
                                                                                    <span class="label label-success">
                                                                                          {{ substr($data->file, 13) }}
                                                                                    </span>
                                                                              </div> 
                                                                              <label for="jenis-file">Jenis Kertas :</label>
                                                                              <div id="jenis-file">
                                                                                    {{ $item->name }}
                                                                              </div>                                                                        
                                                                        </div>
                                                                  </div>
                                                                  <div class="col-md-4" style="padding:5px; text-align: left">
                                                                        <div style="font-size: 15px; " >                                                                  
                                                                              <label for="halaman-file">Tipe Print :</label>
                                                                              <div id="halaman-file" style="margin-bottom: 5px">
                                                                                    @if ($data->type == "PRINT")
                                                                                          <span class="label label-danger">PRINT</span>
                                                                                    @elseif ($data->type == "PHOTO")
                                                                                          <span class="label label-success">PHOTO</span>
                                                                                    @endif
                                                                              </div>

                                                                              <label for="total-file">Harga Kertas :</label>
                                                                              <div id="total-file">
                                                                                    {{ toRupiah($item->price) }}
                                                                              </div>
                                                                        </div>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                      @php
                                                            $total = $item->pivot->quantity * $item->price;
                                                      @endphp
                                                      <div style="float:left; font-weight: bold; font-size: 15px; text-align: left ;width: 100%; border-bottom: 1px solid black">
                                                            {{ $item->pivot->quantity }} items | {{ toRupiah($total) }}
                                                      </div>
                                                @endforeach
                                          </div>
                                          <div style="text-align: left; margin-top: 10px;">
                                                <label for="description">Deskripsi : </label>
                                                <div>
                                                      {{ $data->description }}
                                                </div>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</div>