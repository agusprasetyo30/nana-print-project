<div class="modal fade" id="show-print-order-modal">
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
                                                <div class="col-md-12" style="background:#f7f7f7; margin-top: 5px; margin-bottom: 5px"> 
                                                      <div class="row">
                                                            <div class="col-md-3" style="padding: 0px">
                                                                  <img src="https://asset-a.grid.id/crop/0x0:0x0/700x465/photo/grid/original/76258_pensil-inul.jpg" alt="Contoh" width="100%" height="110px"> 
                                                            </div>
                                                            <div class="col-md-5" style="padding: 5px; text-align: left">
                                                                  <div style="font-size: 15px; " >
                                                                        <label for="nama-file">Nama File :</label>
                                                                        <div id="nama-file" style="margin-bottom: 5px">
                                                                              data.pdf
                                                                        </div> 
                                                                        <label for="jenis-file">Jenis Kertas :</label>
                                                                        <div id="jenis-file">
                                                                              A4 Hitam Putih
                                                                        </div>                                                                        
                                                                  </div>
                                                            </div>
                                                            <div class="col-md-4" style="padding:5px; text-align: left">
                                                                  <div style="font-size: 15px; " >                                                                  
                                                                        <label for="halaman-file">Jml Halaman :</label>
                                                                        <div id="halaman-file" style="margin-bottom: 5px">
                                                                              12 Halaman
                                                                        </div>

                                                                        <label for="total-file">Harga Kertas :</label>
                                                                        <div id="total-file">
                                                                              Rp. 400
                                                                        </div>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                </div>
                                          </div>
                                          
                                          <div style="float:left; font-weight: bold; font-size: 15px; text-align: left ;width: 100%; border-bottom: 1px solid black">
                                                12 Halaman | Rp. 10.000
                                          </div>
                                          <br>
                                          <div style="text-align: left; margin-top: 10px;">
                                                <label for="description">Deskripsi : </label>
                                                <div>
                                                      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo officia, nulla quam quidem temporibus consectetur architecto corrupti tempora doloremque totam!
                                                </div>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</div>