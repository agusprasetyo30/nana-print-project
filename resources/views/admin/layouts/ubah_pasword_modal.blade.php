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
										<form action="{{ route('ubah-password') }}" method="post">
											@csrf
											<label for="email">Email</label>
											<input type="text" class="form-control" 
												name="email" id="email" value="{{ \Auth::user()->email }}" readonly><br>
													
											<label for="old_password">Password Lama</label>
											<input type="password" class="form-control" 
												name="old_password" id="old_password" autofocus=on required><br>

											<label for="new_password">Password Baru</label>
											<input type="password" class="form-control" 
												name="password" id="new_password" required><br>

											<label for="password_confirmation">Konfirmasi Password Baru</label>
											<input type="password" class="form-control" 
												name="password_confirmation" id="password_confirmation" required> <br>

											<input type="submit" value="Ubah Password" 
												class="btn btn-success btn-block">
										</form>
									</div>
                        </div>
                  </div>
            </div>
      </div>
</div>