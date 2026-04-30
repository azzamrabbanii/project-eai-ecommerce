<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REUSED.CO - Quality Secondhand Products Sale</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-black: #000000;
            --light-gray: #F0EEED;
            --text-gray: #00000099;
            --danger-red: #FF3333;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #FFFFFF;
            color: var(--primary-black);
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6, .brand-logo {
            font-family: 'Montserrat', sans-serif;
            font-weight: 900;
            text-transform: uppercase;
        }

        .btn-black {
            background-color: var(--primary-black);
            color: white;
            border-radius: 50px;
            padding: 12px 24px;
            font-weight: 500;
            transition: all 0.3s;
            border: none;
        }
        .btn-black:hover { background-color: #333; color: white; transform: translateY(-2px); }

        .btn-outline-black {
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 50px;
            color: var(--primary-black);
            padding: 10px 40px;
            font-weight: 500;
            transition: all 0.3s;
        }
        .btn-outline-black:hover { background-color: var(--primary-black); color: white; }

        .view-section {
            display: none;
            animation: fadeIn 0.4s ease-in-out;
            min-height: 80vh;
            padding-bottom: 200px;
        }
        .view-active { display: block; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

        .top-banner { background-color: var(--primary-black); color: white; font-size: 0.8rem; padding: 10px 0; text-align: center; }
        .navbar { padding: 20px 0; background-color: white; z-index: 1000; }
        .brand-logo { font-size: 1.8rem; letter-spacing: -1px; cursor: pointer; }
        .search-bar { background-color: var(--light-gray); border-radius: 50px; padding: 10px 20px; border: none; width: 100%; }
        .nav-icon { font-size: 1.4rem; margin-left: 20px; cursor: pointer; color: black; position: relative; }

        /* Hero Section */
        .hero-section { background-color: #F2F0F1; padding: 40px 0 0 0; }
        .hero-title { font-size: clamp(2rem, 5vw, 4rem); line-height: 1; margin-bottom: 20px; }
        .hero-img-box { background-color: #E2E0E1; height: 100%; min-height: 450px; border-radius: 40px 40px 0 0; display:flex; align-items:center; justify-content:center; position: relative; }

        /* Products */
        .product-img-box { background-color: var(--light-gray); border-radius: 20px; overflow: hidden; aspect-ratio: 1/1; display: flex; align-items: center; justify-content: center; cursor: pointer; }
        .product-img-box img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
        .product-img-box:hover img { transform: scale(1.1); }
        .stars { color: #FFC633; }

        /* Details */
        .detail-main-img { background-color: var(--light-gray); border-radius: 20px; width: 100%; aspect-ratio: 1/1; object-fit: cover; }
        .thumb-img { background-color: var(--light-gray); border-radius: 15px; width: 100%; aspect-ratio: 1/1; object-fit: cover; cursor: pointer; margin-bottom: 15px; border: 2px solid transparent; }
        .thumb-img.active { border-color: black; }

        /* Footer & Newsletter */
        .newsletter-wrapper { margin-top: -120px; position: relative; z-index: 30; }
        .newsletter-box { background-color: var(--primary-black); border-radius: 20px; padding: 40px; color: white; }
        .footer-area { background-color: #F0EEED; padding-top: 160px; padding-bottom: 50px; }

        #eai-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(255,255,255,0.95); z-index: 9999;
            display: none; justify-content: center; align-items: center; flex-direction: column;
        }
    </style>
</head>
<body>

    <div id="eai-overlay">
        <div class="spinner-border text-dark" role="status" style="width: 3rem; height: 3rem;"></div>
        <h4 class="mt-4 fw-bold" id="eai-loading-text">Menghubungkan API Gateway...</h4>
        <p class="text-muted" id="eai-service-text">Integrasi Microservices sedang berjalan</p>
    </div>

    <!-- Panggil Navbar Component -->
    @include('partials.navbar')

    <!-- Konten Utama (Berubah-ubah sesuai halaman) -->
    <main>
        @yield('content')
    </main>

    <!-- Panggil Footer Component -->
    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Tempat menaruh JavaScript khusus per halaman -->
    @stack('scripts')
</body>
</html>
