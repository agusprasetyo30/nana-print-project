<div class="modal fade" id="create-modal">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Tambah Pengguna</h4>
        </div>
        <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                    {{-- Validation has-error --}}
                    {{-- <span class="help-block">ascnask</span> --}}

                <div class="form-group">
                        <label for="user_name">Nama</label>
                        <input type="text"
                            name="name" id="user_name"
                            class="form-control"
                            value="{{ old('name') }}"
                            placeholder="Masukan nama"
                            autofocus=on
                            required>
                </div>

                <div class="form-group">
                    <label for="user_username">Username</label>
                    <input type="text"
                        name="username" id="user_username"
                        class="form-control"
                        value="{{ old('username') }}"
                        placeholder="Masukan username" required>
                </div>

                <div class="form-group">

                    <label for="user_email">E-mail</label>
                    <input type="email"
                        name="email" id="user_email"
                        class="form-control"
                        value="{{ old('email') }}"
                        placeholder="Masukan email" required>
                </div>

                <div class="form-group">
                    <label for="user_address">Alamat</label>
                    <textarea name="address" id="user_address"
                        cols="30" rows="3"
                        class="form-control"
                        placeholder="Masukan alamat" required>{{ old('address') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="user_phone">Nomor Telepon</label>
                    <input type="text"
                        name="phone" id="user_phone"
                        class="form-control"
                        onkeypress="return isNumberKey(event)"
                        maxlength="15"
                        value="{{ old('phone') }}"
                        placeholder="Masukan nomor telepon" required>
                </div>

                <div class="form-group">
                    <label for="user_avatar">Avatar</label>
                    <input type="file"
                        name="avatar" id="user_avatar"
                        class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="user_role">Akses</label>
                    <select name="role" id="user_role" class="form-control" required>
                        <option value="" selected disabled>Pilih Akses</option>
                        <option value="admin">Admin</option>
                        <option value="customer">Customer</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="user_password">Password</label>
                    <input type="password"
                        name="password" id="user_password"
                        class="form-control"
                        placeholder="Masukan password" required>
                </div>

                <div class="form-group">
                    <label for="user_password_confirmation">Konfirmasi Password</label>
                    <input type="password"
                        name="password_confirmation" id="user_password_confirmation"
                        class="form-control"
                        placeholder="Masukan konfirmasi password" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
        </div>
    </div>
</div>
