<div class="modal fade" id="edit-modal">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Pengguna</h4>
        </div>
        <form action="{{ route('users.update', 'test') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="modal-body">
                    {{-- Validation has-error --}}
                    {{-- <span class="help-block">ascnask</span> --}}
                <input type="hidden" name="user_id" id="user_id">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text"
                        name="username" id="username"
                        class="form-control"
                        value="{{ old('username') }}"
                        placeholder="Masukan username"
                        readonly>
                </div>

                <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text"
                            name="name" id="name"
                            class="form-control"
                            value="{{ old('name') }}"
                            placeholder="Masukan nama"
                            autofocus=on>
                </div>

                <div class="form-group">

                    <label for="email">E-mail</label>
                    <input type="email"
                        name="email" id="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        placeholder="Masukan email">
                </div>

                <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea name="address" id="address"
                        cols="30" rows="3"
                        class="form-control"
                        placeholder="Masukan alamat">{{ old('address') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="phone">Nomor Telepon</label>
                    <input type="text"
                        name="phone" id="phone"
                        class="form-control"
                        onkeypress="return isNumberKey(event)"
                        maxlength="15"
                        value="{{ old('phone') }}"
                        placeholder="Masukan nomor telepon">
                </div>

                <div class="form-group">
                    <label for="avatar">Avatar</label> <br>
                    <small class="text-muted">Current avatar</small><br>
                    <img src="" class="foto" width="96px"><br><br>
                    <input type="file"
                        name="avatar" id="avatar"
                        class="form-control">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah avatar</small>
                </div>

                <div class="form-group">
                    <label for="role">Akses</label>
                    <select name="role" id="role" class="form-control">
                        <option value="" selected disabled>Pilih Akses</option>
                        <option value="admin">Admin</option>
                        <option value="customer">Customer</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="ACTIVE">ACTIVE</option>
                        <option value="INACTIVE">INACTIVE</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning">Update</button>
            </div>
        </form>
        </div>
    </div>
</div>
