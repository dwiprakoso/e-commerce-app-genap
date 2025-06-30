<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wisata Nusantara - Jelajahi Keindahan Indonesia</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }

        .card-hover {
            transition: all 0.3s;
        }

        .card-hover:hover {
            transform: translateY(-5px);
        }

        .navbar-brand {
            font-weight: 800;
        }

        .btn-gradient {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            border: none;
        }

        .btn-gradient:hover {
            background: linear-gradient(135deg, #224abe 0%, #4e73df 100%);
        }

        .hover-link:hover {
            color: #4e73df !important;
            transition: color 0.3s ease;
        }

        .hover-social:hover {
            color: #4e73df !important;
            transition: color 0.3s ease;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
        }

        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(78, 115, 223, 0.8), rgba(34, 74, 190, 0.8));
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .price-tag {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .package-image {
            height: 250px;
            object-fit: cover;
        }

        .news-image {
            height: 200px;
            object-fit: cover;
        }

        .badge-new {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
        }

        .section-title {
            position: relative;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(135deg, #4e73df, #224abe);
            border-radius: 2px;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#home">
                <i class="fas fa-mountain text-primary me-2 fs-4"></i>
                <span class="fw-bold text-gray-800">Wisata Nusantara</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link text-gray-700" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-gray-700" href="#paket">Paket Wisata</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-gray-700" href="#gallery">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-gray-700" href="#berita">Berita</a>
                    </li>
                </ul>

                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-primary btn-sm px-3">
                        Masuk
                    </a>
                    <a href="#" class="btn btn-outline-primary btn-sm px-3">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-gradient text-white py-5">
        <div class="container py-5">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-4">Jelajahi Keindahan Indonesia</h1>
                    <p class="lead mb-4">
                        Temukan destinasi wisata terbaik di Nusantara dengan paket wisata yang menarik dan terpercaya
                    </p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="#paket" class="btn btn-light btn-lg px-4 fw-semibold text-primary">
                            Lihat Paket Wisata
                        </a>
                        <a href="#gallery" class="btn btn-outline-light btn-lg px-4 fw-semibold">
                            Lihat Galeri
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <h2 class="h2 fw-bold text-gray-800 mb-3">Mengapa Memilih Kami?</h2>
                    <p class="text-muted">
                        Kami menyediakan layanan terbaik untuk pengalaman wisata yang tak terlupakan
                    </p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm card-hover">
                        <div class="card-body text-center p-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 64px; height: 64px;">
                                <i class="fas fa-map-marked-alt text-primary fs-4"></i>
                            </div>
                            <h5 class="card-title fw-semibold mb-3">Destinasi Terpilih</h5>
                            <p class="card-text text-muted">
                                Destinasi wisata pilihan terbaik di seluruh Indonesia dengan pemandangan yang
                                menakjubkan
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm card-hover">
                        <div class="card-body text-center p-4">
                            <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 64px; height: 64px;">
                                <i class="fas fa-users text-success fs-4"></i>
                            </div>
                            <h5 class="card-title fw-semibold mb-3">Pemandu Berpengalaman</h5>
                            <p class="card-text text-muted">
                                Tim pemandu wisata profesional dan berpengalaman untuk memberikan pengalaman terbaik
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm card-hover">
                        <div class="card-body text-center p-4">
                            <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 64px; height: 64px;">
                                <i class="fas fa-star text-warning fs-4"></i>
                            </div>
                            <h5 class="card-title fw-semibold mb-3">Pelayanan Terbaik</h5>
                            <p class="card-text text-muted">
                                Layanan 24/7 dengan kepuasan pelanggan sebagai prioritas utama kami
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Paket Wisata Section -->
    <section id="paket" class="py-5 bg-light">
        <div class="container py-4">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <h2 class="h2 fw-bold text-gray-800 section-title">Paket Wisata Terbaik</h2>
                    <p class="text-muted">
                        Pilihan paket wisata menarik dengan harga terjangkau untuk petualangan tak terlupakan
                    </p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm card-hover">
                        <div class="position-relative">
                            <img src="https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?w=400&h=250&fit=crop"
                                class="card-img-top package-image" alt="Bali Paradise">
                            <span class="position-absolute top-0 end-0 m-3 price-tag">Rp 2.500.000</span>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title fw-semibold mb-0">Bali Paradise</h5>
                                <div class="text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="text-muted small mb-3">4 Hari 3 Malam</p>
                            <p class="card-text text-muted mb-3">
                                Jelajahi keindahan pulau dewata dengan mengunjungi pantai-pantai eksotis, pura-pura
                                bersejarah, dan menikmati budaya Bali yang kaya.
                            </p>
                            <div class="d-flex align-items-center text-muted small mb-3">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                <span>Denpasar, Ubud, Kuta, Sanur</span>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary flex-grow-1 fw-semibold">Pesan Sekarang</button>
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm card-hover">
                        <div class="position-relative">
                            <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=250&fit=crop"
                                class="card-img-top package-image" alt="Yogyakarta Heritage">
                            <span class="position-absolute top-0 end-0 m-3 price-tag">Rp 1.800.000</span>
                            <span class="position-absolute top-0 start-0 m-3 badge badge-new text-white">Populer</span>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title fw-semibold mb-0">Yogyakarta Heritage</h5>
                                <div class="text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <p class="text-muted small mb-3">3 Hari 2 Malam</p>
                            <p class="card-text text-muted mb-3">
                                Rasakan pengalaman budaya Jawa yang autentik dengan mengunjungi Borobudur, Prambanan,
                                dan Keraton Yogyakarta.
                            </p>
                            <div class="d-flex align-items-center text-muted small mb-3">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                <span>Borobudur, Prambanan, Malioboro</span>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary flex-grow-1 fw-semibold">Pesan Sekarang</button>
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm card-hover">
                        <div class="position-relative">
                            <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=400&h=250&fit=crop"
                                class="card-img-top package-image" alt="Raja Ampat Adventure">
                            <span class="position-absolute top-0 end-0 m-3 price-tag">Rp 5.200.000</span>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title fw-semibold mb-0">Raja Ampat Adventure</h5>
                                <div class="text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="text-muted small mb-3">5 Hari 4 Malam</p>
                            <p class="card-text text-muted mb-3">
                                Jelajahi surga bawah laut Indonesia di Raja Ampat dengan diving dan snorkeling di spot
                                terbaik dunia.
                            </p>
                            <div class="d-flex align-items-center text-muted small mb-3">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                <span>Waisai, Arborek, Pianemo</span>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary flex-grow-1 fw-semibold">Pesan Sekarang</button>
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm card-hover">
                        <div class="position-relative">
                            <img src="https://images.unsplash.com/photo-1601026703631-d5b6b8d8b9d0?w=400&h=250&fit=crop"
                                class="card-img-top package-image" alt="Lombok Exotic">
                            <span class="position-absolute top-0 end-0 m-3 price-tag">Rp 2.200.000</span>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title fw-semibold mb-0">Lombok Exotic</h5>
                                <div class="text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <p class="text-muted small mb-3">4 Hari 3 Malam</p>
                            <p class="card-text text-muted mb-3">
                                Temukan pesona Lombok dengan pantai pink, Gili Trawangan, dan pendakian Gunung Rinjani
                                yang menantang.
                            </p>
                            <div class="d-flex align-items-center text-muted small mb-3">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                <span>Mataram, Gili Trawangan, Senggigi</span>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary flex-grow-1 fw-semibold">Pesan Sekarang</button>
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm card-hover">
                        <div class="position-relative">
                            <img src="https://images.unsplash.com/photo-1580839071267-5a9fe5b22a0a?w=400&h=250&fit=crop"
                                class="card-img-top package-image" alt="Bandung Explore">
                            <span class="position-absolute top-0 end-0 m-3 price-tag">Rp 1.500.000</span>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title fw-semibold mb-0">Bandung Explore</h5>
                                <div class="text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <p class="text-muted small mb-3">3 Hari 2 Malam</p>
                            <p class="card-text text-muted mb-3">
                                Nikmati suasana sejuk Bandung dengan wisata kuliner, belanja di factory outlet, dan
                                pemandangan alam yang indah.
                            </p>
                            <div class="d-flex align-items-center text-muted small mb-3">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                <span>Dago, Lembang, Kawah Putih</span>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary flex-grow-1 fw-semibold">Pesan Sekarang</button>
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm card-hover">
                        <div class="position-relative">
                            <img src="https://images.unsplash.com/photo-1594736797933-d0f4c7a7a5e8?w=400&h=250&fit=crop"
                                class="card-img-top package-image" alt="Flores Komodo">
                            <span class="position-absolute top-0 end-0 m-3 price-tag">Rp 4.800.000</span>
                            <span class="position-absolute top-0 start-0 m-3 badge badge-new text-white">Terbaru</span>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title fw-semibold mb-0">Flores Komodo</h5>
                                <div class="text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="text-muted small mb-3">5 Hari 4 Malam</p>
                            <p class="card-text text-muted mb-3">
                                Bertemu langsung dengan komodo di habitat aslinya dan jelajahi keindahan Taman Nasional
                                Komodo yang memukau.
                            </p>
                            <div class="d-flex align-items-center text-muted small mb-3">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                <span>Labuan Bajo, Pulau Komodo, Rinca</span>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary flex-grow-1 fw-semibold">Pesan Sekarang</button>
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12 text-center">
                    <button class="btn btn-outline-primary btn-lg px-4">
                        Lihat Semua Paket Wisata
                        <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-5 bg-white">
        <div class="container py-4">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <h2 class="h2 fw-bold text-gray-800 section-title">Galeri Wisata</h2>
                    <p class="text-muted">
                        Lihat momen-momen indah dan pengalaman tak terlupakan dari perjalanan wisata bersama kami
                    </p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?w=400&h=300&fit=crop"
                            class="img-fluid w-100" style="height: 250px; object-fit: cover;" alt="Sunset di Bali">
                        <div class="gallery-overlay">
                            <div class="text-center text-white">
                                <h5 class="fw-bold mb-2">Sunset di Bali</h5>
                                <p class="mb-0">Keindahan matahari terbenam di Pantai Kuta</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=300&fit=crop"
                            class="img-fluid w-100" style="height: 250px; object-fit: cover;" alt="Candi Borobudur">
                        <div class="gallery-overlay">
                            <div class="text-center text-white">
                                <h5 class="fw-bold mb-2">Candi Borobudur</h5>
                                <p class="mb-0">Keajaiban arsitektur Buddhist kuno</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=400&h=300&fit=crop"
                            class="img-fluid w-100" style="height: 250px; object-fit: cover;" alt="Raja Ampat">
                        <div class="gallery-overlay">
                            <div class="text-center text-white">
                                <h5 class="fw-bold mb-2">Raja Ampat</h5>
                                <p class="mb-0">Surga bawah laut Indonesia</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1594736797933-d0f4c7a7a5e8?w=400&h=300&fit=crop"
                            class="img-fluid w-100" style="height: 250px; object-fit: cover;" alt="Komodo Dragon">
                        <div class="gallery-overlay">
                            <div class="text-center text-white">
                                <h5 class="fw-bold mb-2">Komodo Dragon</h5>
                                <p class="mb-0">Reptil purba di Pulau Komodo</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1601026703631-d5b6b8d8b9d0?w=400&h=300&fit=crop"
                            class="img-fluid w-100" style="height: 250px; object-fit: cover;" alt="Gili Trawangan">
                        <div class="gallery-overlay">
                            <div class="text-center text-white">
                                <h5 class="fw-bold mb-2">Gili Trawangan</h5>
                                <p class="mb-0">Pantai eksotis di Lombok</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1580839071267-5a9fe5b22a0a?w=400&h=300&fit=crop"
                            class="img-fluid w-100" style="height: 250px; object-fit: cover;"
                            alt="Kawah Putih Bandung">
                        <div class="gallery-overlay">
                            <div class="text-center text-white">
                                <h5 class="fw-bold mb-2">Kawah Putih</h5>
                                <p class="mb-0">Danau vulkanik di Bandung</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1555212697-194d092e3b8f?w=400&h=300&fit=crop"
                            class="img-fluid w-100" style="height: 250px; object-fit: cover;" alt="Danau Toba">
                        <div class="gallery-overlay">
                            <div class="text-center text-white">
                                <h5 class="fw-bold mb-2">Danau Toba</h5>
                                <p class="mb-0">Danau vulkanik terbesar di dunia</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400&h=300&fit=crop"
                            class="img-fluid w-100" style="height: 250px; object-fit: cover;" alt="Bromo Tengger">
                        <div class="gallery-overlay">
                            <div class="text-center text-white">
                                <h5 class="fw-bold mb-2">Bromo Tengger</h5>
                                <p class="mb-0">Sunrise spektakuler di Jawa Timur</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=400&h=300&fit=crop"
                            class="img-fluid w-100" style="height: 250px; object-fit: cover;" alt="Toraja">
                        <div class="gallery-overlay">
                            <div class="text-center text-white">
                                <h5 class="fw-bold mb-2">Tana Toraja</h5>
                                <p class="mb-0">Budaya unik Sulawesi Selatan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12 text-center">
                    <button class="btn btn-outline-primary btn-lg px-4">
                        Lihat Semua Foto
                        <i class="fas fa-images ms-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita Section -->
    <section id="berita" class="py-5 bg-light">
        <div class="container py-4">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <h2 class="h2 fw-bold text-gray-800 section-title">Berita & Artikel Terbaru</h2>
                    <p class="text-muted">
                        Dapatkan informasi terkini seputar destinasi wisata, tips perjalanan, dan update terbaru dari
                        dunia pariwisata
                    </p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm card-hover">
                        <div class="position-relative">
                            <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=200&fit=crop"
                                class="card-img-top news-image" alt="Borobudur News">
                            <span class="position-absolute top-0 start-0 m-3 badge bg-danger text-white">
                                <i class="fas fa-fire me-1"></i>Hot
                            </span>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-primary">Destinasi</span>
                                <small class="text-muted">2 hari yang lalu</small>
                            </div>
                            <h5 class="card-title fw-semibold mb-3">
                                <a href="#" class="text-decoration-none text-dark hover-link">
                                    Borobudur Dibuka Kembali dengan Protokol Kesehatan Ketat
                                </a>
                            </h5>
                            <p class="card-text text-muted mb-3">
                                Candi Borobudur kembali dibuka untuk wisatawan dengan menerapkan protokol kesehatan yang
                                ketat. Kunjungan dibatasi maksimal 1.200 orang per hari...
                            </p>
                            <div class="d-flex align-items-center">
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=32&h=32&fit=crop&crop=face"
                                    class="rounded-circle me-2" width="32" height="32" alt="Author">
                                <small class="text-muted">Admin Wisata</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm card-hover">
                        <div class="position-relative">
                            <img src="https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?w=400&h=200&fit=crop"
                                class="card-img-top news-image" alt="Bali Tourism">
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-success">Tips Travel</span>
                                <small class="text-muted">5 hari yang lalu</small>
                            </div>
                            <h5 class="card-title fw-semibold mb-3">
                                <a href="#" class="text-decoration-none text-dark hover-link">
                                    5 Tips Hemat Berlibur ke Bali untuk Backpacker
                                </a>
                            </h5>
                            <p class="card-text text-muted mb-3">
                                Bali tetap bisa dinikmati dengan budget terbatas. Berikut tips hemat untuk backpacker
                                yang ingin menjelajahi pulau dewata tanpa menguras kantong...
                            </p>
                            <div class="d-flex align-items-center">
                                <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=32&h=32&fit=crop&crop=face"
                                    class="rounded-circle me-2" width="32" height="32" alt="Author">
                                <small class="text-muted">Sarah Travel</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm card-hover">
                        <div class="position-relative">
                            <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=400&h=200&fit=crop"
                                class="card-img-top news-image" alt="Raja Ampat Conservation">
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-info">Konservasi</span>
                                <small class="text-muted">1 minggu yang lalu</small>
                            </div>
                            <h5 class="card-title fw-semibold mb-3">
                                <a href="#" class="text-decoration-none text-dark hover-link">
                                    Program Konservasi Terumbu Karang di Raja Ampat Menunjukkan Hasil Positif
                                </a>
                            </h5>
                            <p class="card-text text-muted mb-3">
                                Upaya konservasi terumbu karang di Raja Ampat membuahkan hasil. Populasi ikan dan
                                kesehatan terumbu karang mengalami peningkatan signifikan...
                            </p>
                            <div class="d-flex align-items-center">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=32&h=32&fit=crop&crop=face"
                                    class="rounded-circle me-2" width="32" height="32" alt="Author">
                                <small class="text-muted">Dr. Marine</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm card-hover">
                        <div class="position-relative">
                            <img src="https://images.unsplash.com/photo-1594736797933-d0f4c7a7a5e8?w=400&h=200&fit=crop"
                                class="card-img-top news-image" alt="Komodo Park">
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-warning">Event</span>
                                <small class="text-muted">2 minggu yang lalu</small>
                            </div>
                            <h5 class="card-title fw-semibold mb-3">
                                <a href="#" class="text-decoration-none text-dark hover-link">
                                    Festival Komodo 2025 Siap Digelar di Labuan Bajo
                                </a>
                            </h5>
                            <p class="card-text text-muted mb-3">
                                Festival Komodo tahunan akan kembali digelar di Labuan Bajo dengan berbagai acara
                                menarik untuk mempromosikan pariwisata Flores...
                            </p>
                            <div class="d-flex align-items-center">
                                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=32&h=32&fit=crop&crop=face"
                                    class="rounded-circle me-2" width="32" height="32" alt="Author">
                                <small class="text-muted">Event Organizer</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm card-hover">
                        <div class="position-relative">
                            <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400&h=200&fit=crop"
                                class="card-img-top news-image" alt="Mount Bromo">
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-secondary">Panduan</span>
                                <small class="text-muted">3 minggu yang lalu</small>
                            </div>
                            <h5 class="card-title fw-semibold mb-3">
                                <a href="#" class="text-decoration-none text-dark hover-link">
                                    Panduan Lengkap Hiking ke Gunung Bromo untuk Pemula
                                </a>
                            </h5>
                            <p class="card-text text-muted mb-3">
                                Ingin melihat sunrise di Bromo? Simak panduan lengkap hiking ke Gunung Bromo khusus
                                untuk pemula, termasuk persiapan dan tips keamanan...
                            </p>
                            <div class="d-flex align-items-center">
                                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=32&h=32&fit=crop&crop=face"
                                    class="rounded-circle me-2" width="32" height="32" alt="Author">
                                <small class="text-muted">Mountain Guide</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm card-hover">
                        <div class="position-relative">
                            <img src="https://images.unsplash.com/photo-1601026703631-d5b6b8d8b9d0?w=400&h=200&fit=crop"
                                class="card-img-top news-image" alt="Lombok Tourism">
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-primary">Destinasi</span>
                                <small class="text-muted">1 bulan yang lalu</small>
                            </div>
                            <h5 class="card-title fw-semibold mb-3">
                                <a href="#" class="text-decoration-none text-dark hover-link">
                                    Lombok Raih Penghargaan Sustainable Tourism Award 2025
                                </a>
                            </h5>
                            <p class="card-text text-muted mb-3">
                                Lombok berhasil meraih penghargaan Sustainable Tourism Award 2025 berkat komitmen dalam
                                pengembangan pariwisata berkelanjutan...
                            </p>
                            <div class="d-flex align-items-center">
                                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=32&h=32&fit=crop&crop=face"
                                    class="rounded-circle me-2" width="32" height="32" alt="Author">
                                <small class="text-muted">Tourism Board</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12 text-center">
                    <button class="btn btn-outline-primary btn-lg px-4">
                        Lihat Semua Berita
                        <i class="fas fa-newspaper ms-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h2 class="h2 fw-bold text-gray-800 mb-3">Siap Memulai Petualangan?</h2>
                    <p class="text-muted mb-4">
                        Bergabunglah dengan ribuan wisatawan yang telah mempercayai kami untuk pengalaman wisata terbaik
                    </p>
                    <a href="#" class="btn btn-primary btn-lg px-4 fw-semibold btn-gradient">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-5" style="background-color: #343a40 !important;">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-mountain text-info me-2 fs-4"></i>
                        <span class="h5 fw-bold mb-0 text-white">Wisata Nusantara</span>
                    </div>
                    <p class="text-light small mb-0">
                        Menjelajahi keindahan Indonesia dengan pengalaman wisata yang tak terlupakan
                    </p>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-semibold mb-3 text-white">Menu</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="#paket"
                                class="text-light text-decoration-none small hover-link">Paket Wisata</a></li>
                        <li class="mb-2"><a href="#gallery"
                                class="text-light text-decoration-none small hover-link">Galeri</a></li>
                        <li class="mb-2"><a href="#"
                                class="text-light text-decoration-none small hover-link">Video</a></li>
                        <li class="mb-2"><a href="#berita"
                                class="text-light text-decoration-none small hover-link">Berita</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-semibold mb-3 text-white">Kontak</h6>
                    <ul class="list-unstyled text-light small mb-0">
                        <li class="mb-2"><i class="fas fa-phone me-2"></i> +62 123 456 789</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i> info@wisatanusantara.com</li>
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Jakarta, Indonesia</li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-semibold mb-3 text-white">Ikuti Kami</h6>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-light hover-social">
                            <i class="fab fa-facebook fs-5"></i>
                        </a>
                        <a href="#" class="text-light hover-social">
                            <i class="fab fa-instagram fs-5"></i>
                        </a>
                        <a href="#" class="text-light hover-social">
                            <i class="fab fa-twitter fs-5"></i>
                        </a>
                        <a href="#" class="text-light hover-social">
                            <i class="fab fa-youtube fs-5"></i>
                        </a>
                    </div>
                </div>
            </div>

            <hr class="border-light my-4 opacity-25">
            <div class="text-center">
                <p class="text-light small mb-0">&copy; 2025 Wisata Nusantara. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Add active class to navigation links
        window.addEventListener('scroll', function() {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-link');

            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100;
                if (window.pageYOffset >= sectionTop) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });

        // Add scroll effect to navbar
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('shadow');
            } else {
                navbar.classList.remove('shadow');
            }
        });
    </script>
</body>

</html>
