@extends('layouts.app')

@section('content')
    @include('pages.home')
    @include('pages.category')
    @include('pages.detail')
    @include('pages.cart')
    @include('partials.auth-modal')

    @include('partials.auth-modal')

@endsection

@push('scripts')
    <!-- Modal Simulasi Pembayaran -->
    <div class="modal fade" id="paymentModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow-lg">
                <div class="modal-body text-center p-5">
                    <div class="mb-3">
                        <i class="bi bi-wallet2 text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Selesaikan Pembayaran</h4>
                    <p class="text-muted mb-2">Total tagihan untuk nomor pesanan <strong id="pay-inv"></strong>:</p>
                    <h2 class="fw-bold text-dark mb-4" id="pay-total"></h2>

                    <button class="btn btn-black w-100 rounded-pill py-3 fw-bold mb-3" onclick="processPayment('paid')">
                        Bayar Sekarang
                    </button>
                    <button class="btn btn-outline-danger w-100 rounded-pill py-2 fw-bold"
                        onclick="processPayment('cancelled')">
                        Batalkan Pesanan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let products = [];
        let cart = [];
        let user = null;
        let orders = [];
        let curQty = 1;
        let curPid = null;

        function switchView(view) {
            document.querySelectorAll('.view-section').forEach(v => v.classList.remove('view-active'));
            document.getElementById('view-' + view).classList.add('view-active');
            window.scrollTo(0, 0);
            if (view === 'cart') renderCart();
        }

        function renderProducts() {
            const html = (p) => {
                let stockBadge = '';
                let clickEvent = `onclick="showDetail(${p.id})"`;
                let cardStyle = '';

                if (p.stock > 0) {
                    stockBadge =
                        `<span class="badge bg-success mb-2" style="font-size: 0.7rem;">Sisa: ${p.stock}</span>`;
                } else {
                    stockBadge = `<span class="badge bg-danger mb-2" style="font-size: 0.7rem;">Out of Stock</span>`;
                    clickEvent = ''; // Matikan klik detail
                    cardStyle = 'opacity: 0.5; filter: grayscale(100%);'; // Bikin buram
                }

                return `
            <div class="col-6 col-md-4 col-lg-3" style="${cardStyle}">
                <div class="product-img-box mb-2" ${clickEvent} style="cursor: pointer;">
                    <img src="${p.img}" alt="${p.name}">
                </div>
                ${stockBadge}
                <h6 class="fw-bold mb-1 cursor-pointer" ${clickEvent}>${p.name}</h6>
                <div class="stars mb-1 small"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                <h5 class="fw-bold">Rp ${p.price.toLocaleString('id-ID')}</h5>
            </div>`;
            };

            const newContainer = document.getElementById('home-new');
            if (newContainer) newContainer.innerHTML = products.filter(p => p.type === 'new').map(html).join('');

            const topContainer = document.getElementById('home-top');
            if (topContainer) topContainer.innerHTML = products.filter(p => p.type === 'top').map(html).join('');

            const gridContainer = document.getElementById('category-grid');
            if (gridContainer) gridContainer.innerHTML = products.map(html).join('');
        }

        function showDetail(id) {
            const p = products.find(x => x.id === id);
            if (!p) return;
            curPid = id;
            curQty = 1;
            document.getElementById('d-title').innerText = p.name;
            document.getElementById('d-price').innerText = "Rp " + p.price.toLocaleString('id-ID');
            document.getElementById('d-main-img').src = p.img;
            document.getElementById('d-thumb-1').src = p.img;
            document.getElementById('d-thumb-2').src = "https://images.unsplash.com/photo-1491933382434-500287f9b54b?w=400";
            document.getElementById('d-thumb-3').src = "https://images.unsplash.com/photo-1453728013993-6d66e9c9123a?w=400";
            document.getElementById('d-qty').innerText = curQty;
            document.getElementById('d-desc').innerText = p.desc || 'Tidak ada deskripsi.';
            switchView('detail');
        }

        function setMainImg(s) {
            document.getElementById('d-main-img').src = s;
        }

        function updateQty(v) {
            if (curQty + v >= 1) {
                curQty += v;
                document.getElementById('d-qty').innerText = curQty;
            }
        }

        function addToCart() {

            const p = products.find(x => x.id === curPid);
            if (!p) return;

            // Cek apakah barang sudah ada di keranjang sebelumnya
            const ex = cart.find(x => x.id === curPid);
            const currentCartQty = ex ? ex.qty : 0;

            // Validasi total keranjang vs sisa stok
            if (currentCartQty + curQty > p.stock) {
                alert(
                    `Gagal! Sisa stok hanya ${p.stock} unit. Anda sudah memasukkan ${currentCartQty} unit ke dalam keranjang.`
                    );
                return;
            }

            if (ex) {
                ex.qty += curQty;
            } else {
                cart.push({
                    ...p,
                    qty: curQty
                });
            }

            updateBadge();
            alert("Berhasil masuk keranjang belanja!");

            // Tutup modal detail secara otomatis (opsional biar rapi)
            switchView('home');
        }

        function updateBadge() {
            const b = document.getElementById('cart-count');
            if (!b) return;
            const total = cart.reduce((a, b) => a + b.qty, 0);
            b.innerText = total;
            b.style.display = total > 0 ? 'block' : 'none';
        }

        function renderCart() {
            const list = document.getElementById('cart-list');
            if (!list) return;
            const warn = document.getElementById('auth-warning');
            if (warn) warn.classList.toggle('d-none', user !== null);

            if (cart.length === 0) {
                list.innerHTML = `<div class="text-center py-5 text-muted">Keranjang masih kosong</div>`;
                updateSummary(0);
                return;
            }

            list.innerHTML = cart.map(i => `
            <div class="d-flex align-items-center mb-3 p-3 border rounded-4 shadow-sm bg-white">
                <img src="${i.img}" style="width:100px; height:100px; object-fit:cover;" class="rounded-3 me-3">
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between">
                        <h6 class="fw-bold mb-1 text-uppercase">${i.name}</h6>
                        <i class="bi bi-trash text-danger cursor-pointer" onclick="remItem(${i.id})"></i>
                    </div>
                    <p class="small text-muted mb-2">Jumlah: ${i.qty} unit</p>
                    <h5 class="fw-bold mb-0">Rp ${(i.price * i.qty).toLocaleString('id-ID')}</h5>
                </div>
            </div>`).join('');

            updateSummary(cart.reduce((a, b) => a + (b.price * b.qty), 0));
        }

        function remItem(id) {
            cart = cart.filter(x => x.id !== id);
            renderCart();
            updateBadge();
        }

        function updateSummary(sub) {
            const cSub = document.getElementById('c-subtotal');
            if (!cSub) return;
            const disc = Math.round(sub * 0.1);
            const total = sub - disc + (sub > 0 ? 20000 : 0);
            cSub.innerText = "Rp " + sub.toLocaleString('id-ID');
            document.getElementById('c-discount').innerText = "-Rp " + disc.toLocaleString('id-ID');
            document.getElementById('c-total').innerText = "Rp " + total.toLocaleString('id-ID');
        }

        // --- AUTHENTICATION & UI ---
        const authModalEl = document.getElementById('authModal');
        let authModal;
        if (typeof bootstrap !== 'undefined' && authModalEl) {
            authModal = new bootstrap.Modal(authModalEl);
        }

        function openAuthModal() {
            if (!user && authModal) {
                authModal.show();
            }
        }

        async function handleLogin(e) {
            e.preventDefault();
            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-password').value;

            showEAI("Mengautentikasi...", "User Service: POST http://127.0.0.1:8001/api/auth/login");

            try {
                const response = await fetch('http://127.0.0.1:8001/api/auth/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        email,
                        password
                    })
                });
                const data = await response.json();
                if (!response.ok) throw new Error(data.message || "Email atau password salah!");

                user = data.user;
                localStorage.setItem('user_data', JSON.stringify(user));
                if (data.token) localStorage.setItem('auth_token', data.token);

                hideEAI();
                if (authModal) authModal.hide();
                updateUserUI();
                alert(`Selamat datang kembali, ${user.name}!`);
            } catch (error) {
                hideEAI();
                alert("Gagal Login: " + error.message);
            }
        }

        async function handleRegister(e) {
            e.preventDefault();
            const name = document.getElementById('reg-name').value;
            const email = document.getElementById('reg-email').value;
            const password = document.getElementById('reg-password').value;
            const role = document.getElementById('reg-role').value;

            showEAI("Membuat Akun...", "User Service: POST http://127.0.0.1:8001/api/auth/register");

            try {
                const response = await fetch('http://127.0.0.1:8001/api/auth/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        name,
                        email,
                        password,
                        role
                    })
                });
                const data = await response.json();
                if (!response.ok) throw new Error(data.message || "Gagal membuat akun.");

                hideEAI();
                alert(`Akun ${role} berhasil dibuat! Silakan login dengan email tersebut.`);
                document.getElementById('pills-login-tab').click();
            } catch (error) {
                hideEAI();
                alert("Gagal Register: " + error.message);
            }
        }

        function handleLogout() {
            user = null;
            localStorage.removeItem('user_data');
            localStorage.removeItem('auth_token');

            const dropdownElement = document.getElementById('user-trigger');
            if (dropdownElement && typeof bootstrap !== 'undefined') {
                const bsDropdown = bootstrap.Dropdown.getInstance(dropdownElement);
                if (bsDropdown) bsDropdown.hide();
            }

            updateUserUI();
            alert("Anda telah keluar.");
        }

        function updateUserUI() {
            const icon = document.getElementById('user-icon');
            const trigger = document.getElementById('user-trigger');
            const navName = document.getElementById('navbar-user-name');

            if (!icon || !trigger || !navName) return;

            if (user) {
                icon.classList.add('text-success');
                trigger.removeAttribute('onclick');
                trigger.setAttribute('data-bs-toggle', 'dropdown');
                navName.innerText = user.name;
                navName.classList.remove('d-none');
                const nameDisplay = document.getElementById('user-name-display');
                if (nameDisplay) nameDisplay.innerText = `${user.name} (${user.role})`;

                const dashboardMenu = document.getElementById('menu-dashboard');
                if (dashboardMenu) dashboardMenu.style.display = (user.role === 'penjual' || user.role === 'admin') ?
                    'block' : 'none';
            } else {
                icon.classList.remove('text-success');
                trigger.removeAttribute('data-bs-toggle');
                trigger.setAttribute('onclick', 'openAuthModal()');
                navName.classList.add('d-none');
                navName.innerText = '';
            }

            const warn = document.getElementById('auth-warning');
            if (warn) warn.classList.toggle('d-none', user !== null);

            fetchOrderHistory(); // Refresh riwayat kalau user ganti/logout
        }

        let currentOrderId = null; // Variabel penampung ID pesanan yang sedang diproses
        let paymentModal; // Variabel untuk modal Bootstrap

        // Inisialisasi modal saat web diload
        window.addEventListener('DOMContentLoaded', () => {
            // ... (kode load user sebelumnya)
            paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
        });

        // --- UBAH FUNGSI CHECKOUT ---
        async function checkout() {
            if (!user) {
                alert("Silakan login!");
                openAuthModal();
                return;
            }
            if (cart.length === 0) {
                alert("Keranjang kosong!");
                return;
            }

            const item = cart[0];
            const orderData = {
                user_id: user.id,
                product_id: item.id,
                quantity: item.qty,
                total_price: item.price * item.qty,
                status: 'pending'
            };

            showEAI("Memproses Pesanan...", "Order Service: POST /api/orders");

            try {
                const response = await fetch('http://127.0.0.1:8003/api/orders', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(orderData)
                });
                const result = await response.json();
                if (!response.ok) throw new Error(result.message);

                hideEAI();

                // Simpan ID pesanan dari response Aul
                currentOrderId = result.data.id;

                // Kosongkan keranjang
                cart = [];
                renderCart();
                updateBadge();

                // Tampilkan Modal Pembayaran
                document.getElementById('pay-inv').innerText = 'INV-' + currentOrderId;
                document.getElementById('pay-total').innerText = 'Rp ' + orderData.total_price.toLocaleString('id-ID');
                paymentModal.show();

            } catch (error) {
                hideEAI();
                alert("Gagal Checkout: " + error.message);
            }
        }

        // --- FUNGSI BARU UNTUK BAYAR/BATAL ---
        async function processPayment(newStatus) {
            showEAI("Memperbarui Status...", `PUT /api/orders/${currentOrderId}/status`);

            try {
                const response = await fetch(`http://127.0.0.1:8003/api/orders/${currentOrderId}/status`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        status: newStatus
                    })
                });

                if (!response.ok) throw new Error("Gagal mengubah status");

                hideEAI();
                paymentModal.hide();

                if (newStatus === 'paid') {
                    alert("Pembayaran Berhasil! Pesanan sedang diproses.");
                } else {
                    alert("Pesanan berhasil dibatalkan.");
                }

                // Refresh data terbaru
                if (typeof fetchProducts === "function") fetchProducts();
                if (typeof fetchOrderHistory === "function") fetchOrderHistory();
                switchView('home');

            } catch (error) {
                hideEAI();
                alert("Terjadi kesalahan: " + error.message);
            }
        }

        async function fetchOrderHistory() {
            const historyContainer = document.getElementById('order-history-list');
            if (!historyContainer) return;

            if (!user) {
                historyContainer.innerHTML =
                    '<div class="text-center text-muted small py-3">Silakan login untuk melihat riwayat.</div>';
                return;
            }

            try {
                const response = await fetch(`http://127.0.0.1:8003/api/orders/history/${user.id}`);
                const data = await response.json();

                if (!response.ok) throw new Error("Gagal mengambil riwayat");

                historyContainer.innerHTML = '';

                if (!data.data || data.data.length === 0) {
                    historyContainer.innerHTML =
                        '<div class="text-muted small">Belum ada transaksi. Ayo belanja!</div>';
                    return;
                }

                data.data.forEach(order => {
                    let badgeColor = order.status === 'pending' ? 'bg-warning text-dark' : 'bg-success';
                    historyContainer.innerHTML += `
                    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                        <div>
                            <div class="fw-bold small">INV-${order.id}</div>
                            <span class="badge ${badgeColor}" style="font-size: 0.65rem;">${order.status.toUpperCase()}</span>
                        </div>
                        <div class="fw-bold">Rp ${parseInt(order.total_price).toLocaleString('id-ID')}</div>
                    </div>
                `;
                });

            } catch (error) {
                console.error("Error Fetch History:", error);
                historyContainer.innerHTML = '<div class="text-danger small">Belum ada riwayat.</div>';
            }
        }

        function showEAI(t, s) {
            const eaiText = document.getElementById('eai-loading-text');
            const eaiService = document.getElementById('eai-service-text');
            const eaiOverlay = document.getElementById('eai-overlay');

            if (eaiText) eaiText.innerText = t;
            if (eaiService) eaiService.innerText = s;
            if (eaiOverlay) eaiOverlay.style.display = 'flex';
        }

        function hideEAI() {
            const eaiOverlay = document.getElementById('eai-overlay');
            if (eaiOverlay) eaiOverlay.style.display = 'none';
        }

        async function fetchProducts() {
            if (document.getElementById('eai-overlay')) {
                showEAI("Menarik Data Katalog...", "GET http://127.0.0.1:8002/api/products");
            }

            try {
                const response = await fetch('http://127.0.0.1:8002/api/products');
                const result = await response.json();

                products = result.data.map(item => ({
                    id: item.id,
                    name: item.name,
                    price: parseFloat(item.price),
                    desc: item.description,
                    stock: parseInt(item.stock),
                    img: "https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=400",
                    type: "new"
                }));

                renderProducts();
                hideEAI();

            } catch (error) {
                console.error("Error Fetching Data:", error);
                hideEAI();
                // Tidak perlu dimunculkan alert terus-menerus jika API belum siap
            }
        }

        // Menjalankan fungsi otomatis saat website dimuat
        window.addEventListener('DOMContentLoaded', () => {
            const savedUser = localStorage.getItem('user_data');
            if (savedUser) {
                user = JSON.parse(savedUser);
                updateUserUI();
            }
            fetchProducts();
        });
    </script>
@endpush
