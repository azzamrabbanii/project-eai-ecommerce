<div id="view-detail" class="view-section container mt-4">
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="row">
                <div class="col-3">
                    <img src="" id="d-thumb-1" class="thumb-img active" onclick="setMainImg(this.src)">
                    <img src="" id="d-thumb-2" class="thumb-img" onclick="setMainImg(this.src)">
                    <img src="" id="d-thumb-3" class="thumb-img" onclick="setMainImg(this.src)">
                </div>
                <div class="col-9">
                    <img src="" id="d-main-img" class="detail-main-img shadow-sm">
                </div>
            </div>
        </div>
        <div class="col-lg-6 ps-lg-5">
            <h1 id="d-title" class="mb-2">NAMA PRODUK</h1>
            <div class="stars mb-3 fs-5"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i> <span class="text-dark fs-6 ms-2">4.5/5 (Kondisi 90%)</span></div>
            <h2 id="d-price" class="fw-bold mb-4">Rp 0</h2>
            <p class="text-muted mb-4 border-bottom pb-4" id="d-desc">Barang bekas berkualitas tinggi yang telah melalui proses pengecekan fungsi secara menyeluruh. Fisik masih sangat mulus dengan kelengkapan original.</p>

            <div class="mb-4 border-bottom pb-4">
                <p class="fw-bold mb-2">Pilih Variasi / Warna</p>
                <div class="btn-group gap-2">
                    <button class="btn btn-light rounded-pill px-4 border">Hitam</button>
                    <button class="btn btn-light rounded-pill px-4 border">Silver</button>
                </div>
            </div>

            <div class="d-flex gap-3">
                <div class="bg-light rounded-pill d-flex align-items-center px-3" style="width: 130px; justify-content: space-between;">
                    <i class="bi bi-dash fs-4 cursor-pointer" onclick="updateQty(-1)"></i>
                    <span id="d-qty" class="fw-bold fs-5">1</span>
                    <i class="bi bi-plus fs-4 cursor-pointer" onclick="updateQty(1)"></i>
                </div>
                <button class="btn btn-black grow py-3" onclick="addToCart()">Tambah ke Keranjang</button>
            </div>
        </div>
    </div>

    <div class="mt-5 pt-5 border-top">
        <h3 class="fw-bold mb-4 text-center">Ulasan Pembeli</h3>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="border rounded-4 p-4 shadow-sm h-100">
                    <div class="stars mb-2"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                    <h5 class="fw-bold">Rizky S. <i class="bi bi-check-circle-fill text-success fs-6"></i></h5>
                    <p class="text-muted mb-0">"Barangnya beneran masih mulus kayak baru. Sellernya ramah dan proses pengiriman cepat banget!"</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="border rounded-4 p-4 shadow-sm h-100">
                    <div class="stars mb-2"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                    <h5 class="fw-bold">Dina K. <i class="bi bi-check-circle-fill text-success fs-6"></i></h5>
                    <p class="text-muted mb-0">"Nggak nyangka dapet harga segini untuk spek sebagus ini. Sangat membantu untuk budget mahasiswa."</p>
                </div>
            </div>
        </div>
    </div>
</div>
