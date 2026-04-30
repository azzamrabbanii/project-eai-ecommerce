<div id="view-cart" class="view-section container mt-4">
    <h2 class="fw-bold mb-4">KERANJANG ANDA</h2>
    <div class="row g-4">
        <div class="col-lg-7" id="cart-list"></div>
        <div class="col-lg-5">
            <div class="border rounded-4 p-4 shadow-sm bg-white">
                <h4 class="fw-bold mb-4">Ringkasan Pesanan</h4>
                <div class="d-flex justify-content-between mb-3 text-muted"><span>Subtotal</span><span class="text-dark fw-bold" id="c-subtotal">Rp 0</span></div>
                <div class="d-flex justify-content-between mb-3 text-muted"><span>Diskon Member</span><span class="text-danger fw-bold" id="c-discount">-Rp 0</span></div>
                <div class="d-flex justify-content-between mb-4 text-muted"><span>Biaya Pengiriman</span><span class="text-dark fw-bold">Rp 20.000</span></div>
                <hr>
                <div class="d-flex justify-content-between mb-4 fs-4 fw-bold"><span>Total</span><span id="c-total">Rp 0</span></div>
                <button class="btn btn-black w-100 rounded-pill py-3 fw-bold" onclick="checkout()">
                     Lanjut ke Pembayaran <i class="bi bi-arrow-right ms-2"></i>
                </button>
                <div id="auth-warning" class="text-danger small mt-3 text-center d-none">Harap Login (User Service) untuk melakukan transaksi.</div>
            </div>

            <div class="mt-4 p-4 border rounded-4 bg-light">
                <h6 class="fw-bold mb-3"><i class="bi bi-clock-history me-2"></i> Riwayat Transaksi (EAI API)</h6>
                <div id="order-history-list" class="small text-muted">Belum ada riwayat pesanan di database.</div>
            </div>
        </div>
    </div>
</div>
