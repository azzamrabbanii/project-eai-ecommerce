<div>
    <div class="top-banner">
        Promo Akhir Pekan! Dapatkan diskon tambahan 10% untuk barang elektronik bekas. <a href="#" class="text-white fw-bold">Cek Sekarang</a>
    </div>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
                <i class="bi bi-list fs-1"></i>
            </button>
            <span class="brand-logo me-4" onclick="switchView('home')">REUSED.CO</span>
            <div class="collapse navbar-collapse" id="navContent">
                <ul class="navbar-nav me-auto fw-medium text-uppercase small">
                    <li class="nav-item"><a class="nav-link" href="#" onclick="switchView('category')">Elektronik</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Gadget</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Kamera</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Furnitur</a></li>
                </ul>
                <div class="d-flex flex-grow-1 mx-lg-4" style="max-width: 500px;">
                    <div class="input-group">
                        <span class="input-group-text border-0 bg-light rounded-start-pill"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control border-0 bg-light rounded-end-pill" placeholder="Cari barang bekas berkualitas...">
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <i class="bi bi-cart3 nav-icon" onclick="switchView('cart')">
                    <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem; display:none;">0</span>
                </i>

                <!-- BAGIAN PROFIL & DROPDOWN YANG BARU -->
                <div class="dropdown ms-3">
                    <!-- Elemen yang di-klik (Ikon + Nama) -->
                    <div class="d-flex align-items-center" id="user-trigger" onclick="openAuthModal()" style="cursor: pointer;">
                        <i class="bi bi-person-circle fs-4" id="user-icon"></i>
                        <!-- Tempat nama muncul di navbar (default disembunyikan pakai d-none) -->
                        <span id="navbar-user-name" class="ms-2 fw-bold text-dark d-none" style="font-size: 0.9rem;"></span>
                    </div>

                    <!-- Isi Dropdown Menu -->
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-3 rounded-4 py-2" id="user-menu">
                        <li class="px-4 py-2 bg-light mx-2 rounded-3 mb-2">
                            <span class="d-block fw-bold text-dark" id="user-name-display" style="font-family: 'Inter', sans-serif; text-transform: none; font-size: 0.95rem;"></span>
                            <span class="d-block text-success small mt-1" style="font-size: 0.75rem;"><i class="bi bi-check-circle-fill me-1"></i> Akun Aktif</span>
                        </li>
                        <li><a class="dropdown-item py-2 px-4" href="#" id="menu-dashboard" style="display: none;"><i class="bi bi-shop me-2 text-muted"></i>Dashboard Penjual</a></li>
                        <li><hr class="dropdown-divider my-1"></li>
                        <li><a class="dropdown-item py-2 px-4 text-danger fw-bold" href="#" onclick="handleLogout()"><i class="bi bi-box-arrow-right me-2"></i>Keluar</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </nav>
</div>
