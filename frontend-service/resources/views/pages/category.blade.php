<div id="view-category" class="view-section container mt-4">
    <div class="row">
        <div class="col-lg-3 d-none d-lg-block">
            <div class="border rounded-4 p-4">
                <h5 class="fw-bold mb-4">Filter <i class="bi bi-sliders float-end"></i></h5>
                <hr>
                <div class="mb-4">
                    <p class="fw-bold">Kategori</p>
                    <div class="form-check mb-2"><input class="form-check-input" type="checkbox" checked> <label class="form-check-label">Elektronik</label></div>
                    <div class="form-check mb-2"><input class="form-check-input" type="checkbox"> <label class="form-check-label">Kamera</label></div>
                    <div class="form-check mb-2"><input class="form-check-input" type="checkbox"> <label class="form-check-label">Furnitur</label></div>
                </div>
                <hr>
                <div class="mb-4">
                    <p class="fw-bold">Rentang Harga</p>
                    <input type="range" class="form-range" min="100000" max="10000000">
                </div>
                <button class="btn btn-black w-100 mt-3">Terapkan Filter</button>
            </div>
        </div>
        <div class="col-lg-9">
            <h3 class="fw-bold mb-4">Semua Produk Bekas</h3>
            <div class="row g-4" id="category-grid"></div>
        </div>
    </div>
</div>
