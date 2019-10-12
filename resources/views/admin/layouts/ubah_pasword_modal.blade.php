<div class="modal fade" id="ubah-password-modal">
      <div class="modal-dialog" style="width: 400px">
            <div class="modal-content" >
                  <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Ubah Password</h4>
                  </div>
                  <div class="modal-body" style="text-align: center">
                        <div class="row" >
                              <div class="col-md-12" style="text-align: left; padding: 5px">   
                                 <form action="" method="post">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" 
                                       name="username" id="username" value="Data Username" disabled><br>
                                    
                                    <label for="old_password">Password Lama</label>
                                    <input type="password" class="form-control" 
                                       name="old_password" id="old_password" autofocus=on><br>

                                    <label for="new_password">Password Baru</label>
                                    <input type="password" class="form-control" 
                                       name="new_password" id="new_password"><br>

                                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control" 
                                       name="password_confirmation" id="password_confirmation"> <br>

                                    <input type="submit" value="Update Password" 
                                       class="btn btn-success btn-block">
                                 </form>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</div>