<div id="view-home" class="view-section view-active">
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 py-5">
                    <h1 class="hero-title">TEMUKAN BARANG BEKAS BERKUALITAS UNTUK ANDA</h1>
                    <p class="text-muted mb-4 fs-5">Jelajahi berbagai pilihan produk pre-loved mulai dari gadget hingga furnitur yang telah dikurasi untuk memastikan kualitas terbaik dengan harga terjangkau.</p>
                    <button class="btn btn-black px-5 py-3 fs-5 mb-5" onclick="switchView('category')">Belanja Sekarang</button>
                    <div class="row g-4 mt-2">
                        <div class="col-4 border-end"><h3>500+</h3><p class="text-muted small">Produk Unik</p></div>
                        <div class="col-4 border-end"><h3>100%</h3><p class="text-muted small">Cek Kualitas</p></div>
                        <div class="col-4"><h3>15k+</h3><p class="text-muted small">Pelanggan Puas</p></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-img-box">
                        <i class="bi bi-stars position-absolute text-dark" style="top:20px; right:40px; font-size: 4rem;"></i>
                        <div class="text-center">
                            <h1 class="display-1">♻️</h1>
                            <p class="fw-bold text-muted mt-3">Kualitas Terjamin</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Brands Strip (Simulasi Toko Mitra) -->
    <div class="bg-black py-4 d-flex flex-wrap justify-content-center gap-5 text-white opacity-75">
        <h5 class="mb-0">SONY</h5><h5 class="mb-0">APPLE</h5><h5 class="mb-0">IKEA</h5><h5 class="mb-0">CANON</h5><h5 class="mb-0">SAMSUNG</h5>
    </div>

    <section class="container my-5 py-5">
        <h2 class="text-center mb-5">BARANG TERBARU</h2>
        <div class="row g-4" id="home-new"></div>
        <div class="text-center mt-5">
            <button class="btn btn-outline-black" onclick="switchView('category')">Lihat Semua</button>
        </div>
    </section>

    <section class="container my-5 py-5 border-top">
        <h2 class="text-center mb-5">PALING BANYAK DICARI</h2>
        <div class="row g-4" id="home-top"></div>
        <div class="text-center mt-5">
            <button class="btn btn-outline-black" onclick="switchView('category')">Lihat Semua</button>
        </div>
    </section>
</div>
