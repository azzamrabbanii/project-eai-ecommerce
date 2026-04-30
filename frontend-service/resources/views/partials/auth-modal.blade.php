
<div class="modal fade" id="authModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <ul class="nav nav-pills w-100 mb-3 justify-content-center" id="auth-pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-bold px-4 rounded-pill" id="pills-login-tab" data-bs-toggle="pill" data-bs-target="#pills-login" type="button">Login</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold px-4 rounded-pill" id="pills-register-tab" data-bs-toggle="pill" data-bs-target="#pills-register" type="button">Register</button>
                    </li>
                </ul>
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 pb-4">
                <div class="tab-content" id="auth-pills-tabContent">


                    <div class="tab-pane fade show active" id="pills-login" role="tabpanel">
                        <h4 class="fw-bold text-center mb-4">Selamat Datang Kembali</h4>
                        <form onsubmit="handleLogin(event)">
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Email</label>
                                <input type="email" id="login-email" class="form-control rounded-pill px-3 py-2" placeholder="nama@email.com" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label small fw-bold">Password</label>
                                <input type="password" id="login-password" class="form-control rounded-pill px-3 py-2" placeholder="******" required>
                            </div>
                            <button type="submit" class="btn btn-black w-100 rounded-pill py-2">Masuk</button>
                        </form>
                    </div>


                    <div class="tab-pane fade" id="pills-register" role="tabpanel">
                        <h4 class="fw-bold text-center mb-4">Buat Akun Baru</h4>
                        <form onsubmit="handleRegister(event)">
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Nama Lengkap</label>
                                <input type="text" id="reg-name" class="form-control rounded-pill px-3 py-2" placeholder="Nama Anda" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Email</label>
                                <input type="email" id="reg-email" class="form-control rounded-pill px-3 py-2" placeholder="nama@email.com" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Password</label>
                                <input type="password" id="reg-password" class="form-control rounded-pill px-3 py-2" placeholder="Minimal 6 karakter" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label small fw-bold">Daftar Sebagai</label>
                                <select id="reg-role" class="form-select rounded-pill px-3 py-2">
                                    <option value="user">Pembeli (User)</option>
                                    <option value="penjual">Penjual Barang</option>
                                </select>
                                <div class="form-text small mt-2">*Akun Admin hanya bisa dibuat oleh sistem.</div>
                            </div>
                            <button type="submit" class="btn btn-black w-100 rounded-pill py-2">Daftar Sekarang</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
