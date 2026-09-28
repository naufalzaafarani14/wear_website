<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>WEAR — Discover Your Style, Express Yourself.</title>
<link rel="stylesheet" href="<?= base_url('assets/css/home.css') ?>">
</head>
<body>

<!-- Preloader -->
<div class="preloader" id="preloader">
    <div class="preloader-mark">W</div>
</div>

<!-- ============ 1. NAVBAR ============ -->
<nav class="navbar">
    <div class="wrap">
        <a href="<?= base_url('/') ?>" class="logo">
            <img src="<?= base_url('assets/images/logo/wear-logo.png') ?>" alt="WEAR"
             onerror="this.style.display='none';">
            <span class="wordmark">WEAR</span>
        </a>

        <ul class="nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#fashion">Fashion</a></li>
            <li><a href="#scan">Scan Outfit</a></li>
            <li><a href="#explore">Explore</a></li>
            <li><a href="#faq">FAQ</a></li>
            <li><a href="#about">About Us</a></li>
        </ul>

        <div class="nav-actions">
            <button class="search-toggle" id="searchToggle" aria-label="Cari">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none"><circle cx="11" cy="11" r="7" stroke="#2b2a3d" stroke-width="1.8"/><path d="M20 20L16.5 16.5" stroke="#2b2a3d" stroke-width="1.8" stroke-linecap="round"/></svg>
            </button>
            <a href="<?= base_url('login') ?>" class="btn-text">Login</a>
            <a href="<?= base_url('register') ?>" class="btn btn-primary btn-sm">Get Started</a>
        </div>

        <button class="hamburger" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>
    </div>

    <div class="mobile-menu">
        <a href="#home">Home</a>
        <a href="#fashion">Fashion</a>
        <a href="#explore">Explore</a>
        <a href="#faq">FAQ</a>
        <a href="#about">About Us</a>
        <a href="#contact">Contact</a>
        <div class="mob-actions">
            <a href="<?= base_url('login') ?>" class="btn btn-outline btn-sm">Login</a>
            <a href="<?= base_url('register') ?>" class="btn btn-primary btn-sm">Get Started</a>
        </div>
    </div>

    <div class="search-overlay" id="searchOverlay">
        <div class="wrap">
            <div class="search-input-row">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none"><circle cx="11" cy="11" r="7" stroke="#7a7788" stroke-width="1.8"/><path d="M20 20L16.5 16.5" stroke="#7a7788" stroke-width="1.8" stroke-linecap="round"/></svg>
                <input type="text" id="searchInput" placeholder="Cari kategori, outfit, atau inspirasi...">
            </div>
            <div class="search-results" id="searchResults"></div>
        </div>
    </div>
</nav>

<!-- ============ 2. HERO ============ -->
<section class="hero" id="home">
    <div class="hero-decor">
        <span class="blob b1"></span>
        <span class="blob b2"></span>
    </div>
    <div class="wrap">
        <div class="hero-copy">
            <span class="hero-badge"><span class="dot-live"></span> Fashion Discovery Platform</span>
            <h1>Outfit di lemari banyak,<br>tapi bingung mau pakai <span class="accent">apa?</span></h1>
            <p class="lead">Temukan inspirasi, padukan gayamu, dan ciptakan outfit yang lebih sesuai denganmu bersama WEAR.</p>
            <div class="hero-ctas">
                <a href="#scan" class="btn btn-primary btn-lg">Discover Your Style <span style="margin-left:2px;">&#8250;</span></a>
                <a href="#fashion" class="btn btn-outline btn-lg">Explore Fashion</a>
            </div>
            <div class="hero-stats">
                <div><div class="stat-num">12K+</div><div class="stat-label">Outfit curated</div></div>
                <div><div class="stat-num">340+</div><div class="stat-label">Fashion brands</div></div>
                <div><div class="stat-num">50K+</div><div class="stat-label">Style lovers</div></div>
            </div>
        </div>

        <div class="hero-visual">
            <div class="collage">
                <div class="collage-card card-1 float-a">
                    <span class="badge-label">Trending</span>
                    <div class="card-media grad-a">
                        <img src="<?= base_url('assets/images/hero1.jpg') ?>" alt="Hero 1" style="width:100%;height:100%;object-fit:cover;">
                    </div>
                </div>
                <div class="collage-card card-2 float-b">
                    <span class="badge-label">For You</span>
                    <div class="card-media grad-b">
                        <img src="<?= base_url('assets/images/hero2.jpg') ?>" alt="Hero 2" style="width:100%;height:100%;object-fit:cover;">
                    </div>
                </div>
                <div class="collage-card card-3 float-c">
                    <div class="card-media grad-c">
                        <svg width="55" height="55" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 4H17L18 12L15 20H13L12 12L11 20H9L6 12L7 4Z" stroke="#2b2a3d" stroke-width="1.3" stroke-linejoin="round" fill="rgba(255,255,255,0.4)"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============ 3. FASHION CATEGORIES ============ -->
<section class="categories" id="fashion">
    <div class="wrap">
        <div class="section-head reveal">
            <p class="eyebrow">Categories</p>
            <h2>Jelajahi Fashion Sesuai Kategorimu</h2>
            <p>Temukan gaya yang paling merepresentasikan dirimu dari berbagai kategori pilihan.</p>
        </div>

        <div class="carousel-wrap">
            <button class="carousel-btn prev" id="catPrev" aria-label="Sebelumnya">&#8249;</button>
            <div class="category-grid" id="categoryCarousel">
                <button class="category-card cat-a reveal" data-category="Women">
                    <div class="card-media-inner">
                        <img src="<?= base_url('assets/images/cat-women.jpg') ?>" alt="Women">
                    </div>
                    <div class="cat-body"><span>Women</span></div>
                </button>
                <button class="category-card cat-b reveal" data-category="Men">
                    <div class="card-media-inner">
                        <img src="<?= base_url('assets/images/cat-men.jpg') ?>" alt="Men">
                    </div>
                    <div class="cat-body"><span>Men</span></div>
                </button>
                <button class="category-card cat-a reveal" data-category="Unisex">
                    <div class="card-media-inner">
                        <img src="<?= base_url('assets/images/cat-unisex.jpg') ?>" alt="Unisex">
                    </div>
                    <div class="cat-body"><span>Unisex</span></div>
                </button>
                <button class="category-card cat-b reveal" data-category="Casual">
                    <div class="card-media-inner">
                        <img src="<?= base_url('assets/images/cat-causal.jpg') ?>" alt="Casual">
                    </div>
                    <div class="cat-body"><span>Casual</span></div>
                </button>
                <button class="category-card cat-a reveal" data-category="Streetwear">
                    <div class="card-media-inner">
                        <img src="<?= base_url('assets/images/cat-street.jpg') ?>" alt="Streetwear">
                    </div>
                    <div class="cat-body"><span>Streetwear</span></div>
                </button>
                <button class="category-card cat-b reveal" data-category="Minimalist">
                    <div class="card-media-inner">
                        <img src="<?= base_url('assets/images/cat-minimal.jpg') ?>" alt="Minimalist">
                    </div>
                    <div class="cat-body"><span>Minimalist</span></div>
                </button>
                <button class="category-card cat-a reveal" data-category="Hijab">
                    <div class="card-media-inner">
                        <img src="<?= base_url('assets/images/cat-hijab.jpg') ?>" alt="Hijab">
                    </div>
                    <div class="cat-body"><span>Hijab</span></div>
                </button>
                <button class="category-card cat-b reveal" data-category="Office">
                    <div class="card-media-inner">
                        <img src="<?= base_url('assets/images/cat-office.jpg') ?>" alt="Office">
                    </div>
                    <div class="cat-body"><span>Office</span></div>
                </button>
                <button class="category-card cat-a reveal" data-category="Korean Style">
                    <div class="card-media-inner">
                        <img src="<?= base_url('assets/images/cat-korean.jpg') ?>" alt="Korean Style">
                    </div>
                    <div class="cat-body"><span>Korean Style</span></div>
                </button>
                <button class="category-card cat-b reveal" data-category="Party">
                    <div class="card-media-inner">
                        <img src="<?= base_url('assets/images/cat-party.jpg') ?>" alt="Party">
                    </div>
                    <div class="cat-body"><span>Party</span></div>
                </button>
                <button class="category-card cat-a reveal" data-category="Traditional / Cultural">
                    <div class="card-media-inner">
                        <img src="<?= base_url('assets/images/cat-traditional.jpg') ?>" alt="Traditional / Cultural Fashion">
                    </div>
                    <div class="cat-body"><span>Traditional / Cultural</span></div>
                </button>
            </div>
            <button class="carousel-btn next" id="catNext" aria-label="Selanjutnya">&#8250;</button>
        </div>
    </div>
</section>

<!-- ============ 4. TRENDING FASHION ============ -->
<section id="explore">
    <div class="wrap">
        <div class="section-head reveal">
            <p class="eyebrow">Trending Now</p>
            <h2>Fashion yang Sedang Digemari</h2>
            <p>Kurasi outfit dan gaya yang lagi banyak dicari minggu ini.</p>
        </div>

        <button class="btn btn-outline random-fashion-btn" id="randomFashionBtn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M12 3L14 9L20 9L15 13L17 19L12 15.5L7 19L9 13L4 9L10 9L12 3Z" stroke="#f58bb3" stroke-width="1.4" stroke-linejoin="round"/></svg>
            Random Fashion
        </button>

        <div class="carousel-wrap">
            <button class="carousel-btn prev" aria-label="Sebelumnya">&#8249;</button>
            <div class="trend-grid" id="trendCarousel">
            <div class="trend-card reveal">
                <div class="trend-thumb">
                    <img src="<?= base_url('assets/images/cat-women.jpg') ?>" alt="Oversized Blazer Look">
                    <span class="trend-tag">Trending</span>
                </div>
                <div class="trend-body">
                    <span class="cat">Women</span>
                    <h4>Oversized Blazer Look</h4>
                    <p>Padanan blazer oversized dengan inner simpel, cocok untuk kerja maupun jalan santai.</p>
                    <a href="#" class="btn btn-outline btn-sm" data-requires-auth>Explore</a>
                </div>
            </div>

            <div class="trend-card reveal">
                <div class="trend-thumb">
                    <img src="<?= base_url('assets/images/cat-street.jpg') ?>" alt="Layered Street Style">
                    <span class="trend-tag">New</span>
                </div>
                <div class="trend-body">
                    <span class="cat">Streetwear</span>
                    <h4>Layered Street Style</h4>
                    <p>Gaya jalanan dengan layering jaket dan aksesoris bold, penuh karakter.</p>
                    <a href="#" class="btn btn-outline btn-sm" data-requires-auth>Explore</a>
                </div>
            </div>

            <div class="trend-card reveal">
                <div class="trend-thumb">
                    <img src="<?= base_url('assets/images/cat-hijab.jpg') ?>" alt="Modest Chic Ensemble">
                    <span class="trend-tag">Popular</span>
                </div>
                <div class="trend-body">
                    <span class="cat">Hijab</span>
                    <h4>Modest Chic Ensemble</h4>
                    <p>Perpaduan warna lembut dan siluet longgar yang tetap terlihat modern.</p>
                    <a href="#" class="btn btn-outline btn-sm" data-requires-auth>Explore</a>
                </div>
            </div>

            <div class="trend-card reveal">
                <div class="trend-thumb">
                    <img src="<?= base_url('assets/images/cat-office.jpg') ?>" alt="Minimalist Office Wear">
                    <span class="trend-tag">Trending</span>
                </div>
                <div class="trend-body">
                    <span class="cat">Formal</span>
                    <h4>Minimalist Office Wear</h4>
                    <p>Tampil profesional dengan potongan clean dan palet warna netral.</p>
                    <a href="#" class="btn btn-outline btn-sm" data-requires-auth>Explore</a>
                </div>
            </div>
            </div>
            <button class="carousel-btn next" aria-label="Selanjutnya">&#8250;</button>
        </div>
    </div>
</section>

<!-- ============ 4B. SCAN YOUR OUTFIT (AI Demo) ============ -->
<section class="scan-section" id="scan">
    <div class="wrap">
        <div class="scan-grid">
            <div class="scan-panel reveal">
                <p class="eyebrow">AI-Powered</p>
                <div class="scan-copy">
                    <h2>Scan Your Outfit</h2>
                    <p>Punya baju tapi bingung dipadukan dengan apa? Pilih warna item di bawah untuk lihat demonya.</p>
                </div>

                <div class="scan-color-label">Choose Item Color to Demo</div>
                <div class="scan-color-row" id="scanColorRow">
                    <button class="scan-color-btn active" data-color="black">Black</button>
                    <button class="scan-color-btn" data-color="white">White</button>
                    <button class="scan-color-btn" data-color="blue">Blue</button>
                </div>

                <div class="scan-drop shimmer">
                    <span class="corner tl"></span><span class="corner tr"></span>
                    <span class="corner bl"></span><span class="corner br"></span>
                    <div class="cam-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M4 8h3l1.5-2h7L17 8h3a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1Z" stroke="#8ba0bd" stroke-width="1.6" stroke-linejoin="round"/><circle cx="12" cy="13" r="3.4" stroke="#8ba0bd" stroke-width="1.6"/></svg>
                    </div>
                    <p>Point camera at your clothing item</p>
                </div>

                <div class="scan-actions">
                    <button class="btn btn-primary btn-sm" id="scanBtn">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M4 8h3l1.5-2h7L17 8h3a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1Z" stroke="#fff" stroke-width="1.6" stroke-linejoin="round"/><circle cx="12" cy="13" r="3.2" stroke="#fff" stroke-width="1.6"/></svg>
                        Scan My Outfit
                    </button>
                    <button class="btn btn-outline btn-sm" id="scanUploadBtn">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M12 16V4M12 4L8 8M12 4l4 4" stroke="#2b2a3d" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M4 16v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-3" stroke="#2b2a3d" stroke-width="1.6" stroke-linecap="round"/></svg>
                        Upload
                    </button>
                </div>
            </div>

            <div class="scan-panel reveal">
                <div class="scan-result-block">
                    <div class="scan-result-label">Detected Item</div>
                    <div class="detected-item-card">
                        <div class="swatch" id="scanSwatch" style="background:#1c1c26;"></div>
                        <div>
                            <h5 id="scanItemName">Black Top</h5>
                            <span id="scanItemMeta">Category: Top · Color: Black</span>
                        </div>
                    </div>
                </div>

                <div class="scan-result-block">
                    <div class="scan-result-label">Colors That Match</div>
                    <div class="match-swatch-row" id="scanMatchRow"></div>
                </div>

                <div class="scan-result-block">
                    <div class="scan-result-label">Complete Your Outfit</div>
                    <div class="outfit-complete-list" id="scanOutfitList"></div>
                </div>

                <div class="scan-why"><strong>Why this matches:</strong> <span id="scanWhy"></span></div>
            </div>
        </div>
    </div>
</section>

<!-- ============ 5. PERSONALIZED RECOMMENDATION ============ -->
<section>
    <div class="recommend reveal">
        <div class="wrap">
            <div>
                <p class="eyebrow">Personalized For You</p>
                <h2>Your Style, Your Recommendation</h2>
                <p>Pilih preferensimu di bawah ini — klik tiap kartu untuk mengisi. Data ini yang jadi dasar rekomendasi outfit personal buat kamu.</p>
            </div>

            <div class="pref-grid">
                <div class="pref-chip" data-pref="gender">Gender</div>
                <div class="pref-chip" data-pref="style">Style Favorit</div>
                <div class="pref-chip" data-pref="warna">Warna Favorit</div>
                <div class="pref-chip" data-pref="occasion">Occasion</div>
                <div class="pref-chip" data-pref="budget">Budget</div>
                <div class="pref-chip" data-pref="kulit">Warna Kulit</div>
                <div class="pref-chip" data-pref="badan">Tinggi & Berat Badan</div>
                <div class="pref-chip" data-pref="bentuk">Bentuk Tubuh</div>
                <div class="pref-chip" data-pref="brand">Brand Diminati</div>
                <div class="pref-chip" data-pref="lain">Preferensi Lain</div>
            </div>

            <div class="pref-panel" id="prefPanel"></div>

            <div class="pref-cta-row">
                <p class="pref-summary">Preferensi tersimpan otomatis di perangkatmu selagi kamu memilih.</p>
                <button class="btn btn-primary btn-lg" id="savePrefBtn">Simpan Preferensi & Lihat Rekomendasi</button>
            </div>
        </div>
    </div>
</section>

<!-- ============ 6. WHY CHOOSE US ============ -->
<section>
    <div class="wrap">
        <div class="section-head center reveal" style="margin-left:auto;margin-right:auto;">
            <p class="eyebrow">Why Choose Us</p>
            <h2>Kenapa Memilih WEAR</h2>
            <p>Lebih dari sekadar katalog — kami bantu kamu menemukan gaya yang benar-benar cocok.</p>
        </div>

        <div class="why-grid">
            <div class="why-card reveal">
                <span class="icon-wrap"><svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M12 21C12 21 4 14.5 4 9C4 6 6.2 4 9 4C10.5 4 11.6 4.7 12 5.6C12.4 4.7 13.5 4 15 4C17.8 4 20 6 20 9C20 14.5 12 21 12 21Z" stroke="#ff4fa3" stroke-width="1.5"/></svg></span>
                <h4>Personalized Recommendations</h4>
                <p>Rekomendasi disesuaikan dengan gaya, warna, dan preferensimu sendiri.</p>
            </div>
            <div class="why-card reveal">
                <span class="icon-wrap"><svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M12 3L14 9L20 9L15 13L17 19L12 15.5L7 19L9 13L4 9L10 9L12 3Z" stroke="#ff4fa3" stroke-width="1.5" stroke-linejoin="round"/></svg></span>
                <h4>Latest Fashion Trends</h4>
                <p>Update tren fashion terbaru biar kamu nggak ketinggalan gaya.</p>
            </div>
            <div class="why-card reveal">
                <span class="icon-wrap"><svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M4 12H20M4 12L9 7M4 12L9 17" stroke="#ff4fa3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                <h4>Easy to Explore</h4>
                <p>Navigasi simpel, cari inspirasi fashion tanpa ribet.</p>
            </div>
            <div class="why-card reveal">
                <span class="icon-wrap"><svg width="20" height="20" viewBox="0 0 24 24" fill="none"><rect x="4" y="4" width="16" height="16" rx="3" stroke="#ff4fa3" stroke-width="1.5"/></svg></span>
                <h4>User Friendly</h4>
                <p>Tampilan bersih dan mudah dipahami untuk semua kalangan usia.</p>
            </div>
            <div class="why-card reveal">
                <span class="icon-wrap"><svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M4 20L10 4L14 14L20 4" stroke="#ff4fa3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                <h4>Fashion Inspiration</h4>
                <p>Koleksi inspirasi outfit untuk berbagai gaya dan suasana.</p>
            </div>
            <div class="why-card reveal">
                <span class="icon-wrap"><svg width="20" height="20" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="8" stroke="#ff4fa3" stroke-width="1.5"/><path d="M12 8V12L15 14" stroke="#ff4fa3" stroke-width="1.5" stroke-linecap="round"/></svg></span>
                <h4>Smart Recommendation</h4>
                <p>Sistem terus belajar dari preferensimu untuk hasil yang makin akurat.</p>
            </div>
        </div>
    </div>
</section>

<!-- ============ 7. HOW IT WORKS ============ -->
<section class="steps">
    <div class="wrap">
        <div class="section-head center reveal" style="margin-left:auto;margin-right:auto;">
            <p class="eyebrow">How It Works</p>
            <h2>Mulai dalam 4 Langkah Mudah</h2>
        </div>

        <div class="step-row">
            <div class="step-card reveal">
                <div class="step-num">1</div>
                <h4>Create Account</h4>
                <p>Daftar akun secara gratis hanya dalam beberapa detik.</p>
            </div>
            <div class="step-card reveal">
                <div class="step-num">2</div>
                <h4>Choose Your Style</h4>
                <p>Pilih gaya, warna, dan preferensi fashion favoritmu.</p>
            </div>
            <div class="step-card reveal">
                <div class="step-num">3</div>
                <h4>Get Recommendations</h4>
                <p>Dapatkan rekomendasi outfit yang dipersonalisasi untukmu.</p>
            </div>
            <div class="step-card reveal">
                <div class="step-num">4</div>
                <h4>Discover Your Fashion</h4>
                <p>Eksplorasi dan temukan gaya terbaik versi dirimu.</p>
            </div>
        </div>
    </div>
</section>

<!-- ============ 8. FASHION INSPIRATION ============ -->
<section>
    <div class="wrap">
        <div class="section-head reveal">
            <p class="eyebrow">Get Inspired</p>
            <h2>Fashion Inspiration</h2>
            <p>Kumpulan inspirasi outfit untuk berbagai momen dan suasana.</p>
        </div>

        <div class="inspo-grid">
            <div class="inspo-item reveal" data-title="Casual Outfit" data-grad="grad-a" data-desc="Kombinasi santai sehari-hari — kaos, denim, dan sneakers yang tetap terlihat effortless.">
                <div class="inspo-media grad-a">
                    <img src="<?= base_url('assets/images/cat-causal.jpg') ?>" alt="Casual Outfit">
                    <span class="inspo-tag">Casual</span>
                </div>
                <div class="inspo-body"><h4>Casual Outfit</h4><p>Simpel, nyaman, tetap stylish untuk aktivitas harian.</p></div>
            </div>
            <div class="inspo-item reveal" data-title="Hijab Outfit" data-grad="grad-b" data-desc="Padu padan hijab modern dengan siluet longgar dan warna-warna lembut.">
                <div class="inspo-media grad-b">
                    <img src="<?= base_url('assets/images/cat-hijab.jpg') ?>" alt="Hijab Outfit">
                    <span class="inspo-tag">Hijab</span>
                </div>
                <div class="inspo-body"><h4>Hijab Outfit</h4><p>Modest namun tetap terlihat modern dan fashionable.</p></div>
            </div>
            <div class="inspo-item reveal" data-title="Street Style" data-grad="grad-c" data-desc="Layering jaket, aksesoris bold, dan sneakers jadi kunci gaya jalanan yang penuh karakter.">
                <div class="inspo-media grad-c">
                    <img src="<?= base_url('assets/images/cat-street.jpg') ?>" alt="Street Style">
                    <span class="inspo-tag">Street</span>
                </div>
                <div class="inspo-body"><h4>Street Style</h4><p>Berani, layered, dan penuh ekspresi diri.</p></div>
            </div>
            <div class="inspo-item reveal" data-title="Office Outfit" data-grad="grad-a" data-desc="Potongan clean dan warna netral yang tetap profesional sepanjang hari kerja.">
                <div class="inspo-media grad-a">
                    <img src="<?= base_url('assets/images/cat-office.jpg') ?>" alt="Office Outfit">
                    <span class="inspo-tag">Office</span>
                </div>
                <div class="inspo-body"><h4>Office Outfit</h4><p>Rapi, profesional, tanpa kehilangan gaya personal.</p></div>
            </div>
            <div class="inspo-item reveal" data-title="Party Outfit" data-grad="grad-b" data-desc="Siluet fitted dengan aksen mengkilap, cocok untuk tampil maksimal di acara malam.">
                <div class="inspo-media grad-b">
                    <img src="<?= base_url('assets/images/cat-party.jpg') ?>" alt="Party Outfit">
                    <span class="inspo-tag">Party</span>
                </div>
                <div class="inspo-body"><h4>Party Outfit</h4><p>Glamor secukupnya untuk momen spesial.</p></div>
            </div>
            <div class="inspo-item reveal" data-title="Korean Style" data-grad="grad-c" data-desc="Oversized top, wide-leg pants, dan palet warna soft — kekinian tapi tetap effortless.">
                <div class="inspo-media grad-c">
                    <img src="<?= base_url('assets/images/cat-korean.jpg') ?>" alt="Korean Style">
                    <span class="inspo-tag">Korean</span>
                </div>
                <div class="inspo-body"><h4>Korean Style</h4><p>Oversized, soft, dan effortlessly chic.</p></div>
            </div>
        </div>
    </div>
</section>

<!-- ============ 9. FAQ ============ -->
<section id="faq">
    <div class="wrap">
        <div class="section-head center reveal" style="margin-left:auto;margin-right:auto;">
            <p class="eyebrow">FAQ</p>
            <h2>Pertanyaan yang Sering Diajukan</h2>
        </div>

        <div class="faq-list">
            <details class="faq-item reveal">
                <summary>Apa itu WEAR?</summary>
                <p>WEAR adalah platform fashion & lifestyle yang membantu kamu menemukan inspirasi gaya dan rekomendasi outfit yang sesuai dengan karaktermu.</p>
            </details>
            <details class="faq-item reveal">
                <summary>Apakah harus memiliki akun untuk menggunakan WEAR?</summary>
                <p>Tidak, kamu tetap bisa menjelajahi kategori, trending fashion, dan inspirasi tanpa akun. Namun untuk rekomendasi personal, kamu perlu mendaftar.</p>
            </details>
            <details class="faq-item reveal">
                <summary>Bagaimana cara mendapatkan rekomendasi fashion?</summary>
                <p>Setelah mendaftar dan login, lengkapi preferensi gaya, warna, dan occasion favoritmu di halaman profil, lalu sistem akan memberikan rekomendasi.</p>
            </details>
            <details class="faq-item reveal">
                <summary>Apakah rekomendasi fashion ini gratis?</summary>
                <p>Ya, seluruh fitur rekomendasi di WEAR dapat digunakan secara gratis.</p>
            </details>
            <details class="faq-item reveal">
                <summary>Apakah saya bisa mengubah preferensi fashion saya?</summary>
                <p>Tentu, kamu bisa memperbarui preferensi kapan pun lewat halaman profil setelah login.</p>
            </details>
            <details class="faq-item reveal">
                <summary>Bagaimana cara login atau membuat akun?</summary>
                <p>Klik tombol "Login" atau "Get Started" di bagian atas halaman, lalu ikuti instruksi pendaftaran singkatnya.</p>
            </details>
        </div>
    </div>
</section>

<!-- ============ 10. ABOUT US ============ -->
<section id="about">
    <div class="wrap about-grid">
        <div class="about-visual reveal">
            <img src="<?= base_url('assets/images/logo/wear-logo.png') ?>" alt="WEAR" style="width:55%;height:auto;object-fit:contain;">
        </div>
        <div class="about-copy reveal">
            <p class="eyebrow">About Us</p>
            <h2>Dibuat untuk Kamu yang Ingin Bergaya Tanpa Ribet</h2>
            <p>WEAR hadir untuk menjawab masalah klasik anak muda: bingung mix and match outfit setiap hari. Kami percaya semua orang berhak tampil percaya diri dengan gaya yang benar-benar mencerminkan dirinya.</p>
            <p>Target pengguna kami adalah anak muda yang aktif, senang bereksplorasi dengan gaya, dan ingin mendapatkan inspirasi fashion yang relevan tanpa harus scroll berjam-jam.</p>
            <ul class="about-list">
                <li>Rekomendasi berbasis preferensi personal</li>
                <li>Kurasi tren fashion terkini</li>
                <li>Antarmuka yang simpel & menyenangkan digunakan</li>
            </ul>
        </div>
    </div>
</section>

<!-- ============ 11. CONTACT / CTA ============ -->
<section id="contact">
    <div class="wrap cta-banner reveal">
        <p class="eyebrow">Get Started</p>
        <h2>Ready to Discover Your Style?</h2>
        <p>Bergabung sekarang dan mulai perjalanan gayamu bersama WEAR.</p>
        <a href="<?= base_url('register') ?>" class="btn btn-primary btn-lg">Get Started</a>

        <div class="social-row">
            <a href="#" aria-label="Instagram"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><rect x="3" y="3" width="18" height="18" rx="5" stroke="currentColor" stroke-width="1.5"/><circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1.5"/></svg></a>
            <a href="#" aria-label="TikTok"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M14 4V15.5C14 17 12.8 18 11.5 18C10.2 18 9 17 9 15.5C9 14 10.2 13 11.5 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M14 4C14 6 15.5 7.5 17.5 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg></a>
            <a href="mailto:hello@wear.id" aria-label="Email"><svg width="18" height="18" viewBox="0 0 24 24" fill="none"><rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="M3 6L12 13L21 6" stroke="currentColor" stroke-width="1.5"/></svg></a>
        </div>
    </div>
</section>

<!-- ============ 12. FOOTER ============ -->
<footer>
    <div class="wrap">
        <div class="foot-grid">
            <div class="foot-brand">
                <a href="<?= base_url('/') ?>" class="logo">
                    <img src="<?= base_url('assets/images/logo/wear-logo.png') ?>" alt="WEAR" onerror="this.style.display='none';">
                    <span class="wordmark">WEAR</span>
                </a>
                <p>Platform fashion & lifestyle yang membantu kamu menemukan gaya dan rekomendasi outfit personal.</p>
            </div>

            <div class="foot-col">
                <h5>Quick Links</h5>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#explore">Explore</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>

            <div class="foot-col">
                <h5>Categories</h5>
                <ul>
                    <li><a href="#fashion">Women</a></li>
                    <li><a href="#fashion">Men</a></li>
                    <li><a href="#fashion">Hijab</a></li>
                    <li><a href="#fashion">Streetwear</a></li>
                </ul>
            </div>

            <div class="foot-col">
                <h5>Support</h5>
                <ul>
                    <li><a href="#faq">FAQ</a></li>
                    <li><a href="<?= base_url('login') ?>">Login</a></li>
                    <li><a href="<?= base_url('register') ?>">Register</a></li>
                    <li><a href="mailto:hello@wear.id">Contact</a></li>
                </ul>
            </div>
        </div>

        <div class="foot-bottom">
            <span>© <?= date('Y') ?> WEAR. All rights reserved.</span>
            <span>Made for those who love expressing style.</span>
        </div>
    </div>
</footer>

<!-- Toast: prompt login untuk fitur yang butuh akun -->
<div class="auth-toast" id="authToast">
    <span>Login or create an account to unlock personalized fashion recommendations.</span>
    <a href="<?= base_url('login') ?>">Login</a>
</div>

<!-- Toast generik (dipakai fitur kategori, dsb) -->
<div class="auth-toast" id="genericToast"><span></span></div>

<!-- Modal generik: detail trending / random fashion / inspirasi -->
<div class="wear-modal-overlay" id="wearModal">
    <div class="wear-modal">
        <button class="wear-modal-close" onclick="window.wearCloseModal()">&times;</button>
        <div id="wearModalBody"></div>
    </div>
</div>

<button class="sound-toggle" id="soundToggle" aria-label="Mute/unmute suara"></button>

<script>
    window.WEAR_LOGGED_IN = <?= session()->get('logged_in') ? 'true' : 'false' ?>;
    window.WEAR_LOGIN_URL = '<?= base_url('login') ?>';
</script>
<script src="<?= base_url('assets/js/home.js') ?>"></script>
<script>
// ---- Demo interaktif "Scan Your Outfit" (frontend-only, siap disambungkan ke AI backend) ----
document.addEventListener('DOMContentLoaded', function () {
    var scanData = {
        black: {
            swatch: '#1c1c26', name: 'Black Top', meta: 'Category: Top · Color: Black',
            matches: [['White', '#ffffff'], ['Beige', '#e3c9a8'], ['Denim Blue', '#5c7fa6'], ['Grey', '#9a99a6'], ['Pastel Pink', '#f3c9d6']],
            outfit: [['Bottom', 'Straight-leg Denim Jeans'], ['Shoes', 'White Chunky Sneakers'], ['Bag', 'Mini Cream Tote Bag'], ['Accessories', 'Silver Chain Necklace'], ['Outerwear', 'Beige Trench Coat']],
            why: 'Neutral and contrasting tones create visual balance, while the accessories add a focal point without overwhelming the look.'
        },
        white: {
            swatch: '#ffffff', name: 'White Top', meta: 'Category: Top · Color: White',
            matches: [['Black', '#1c1c26'], ['Beige', '#e3c9a8'], ['Olive', '#8a8f66'], ['Denim Blue', '#5c7fa6'], ['Tan', '#c8a074']],
            outfit: [['Bottom', 'High-waist Wide Trousers'], ['Shoes', 'Tan Leather Loafers'], ['Bag', 'Structured Black Handbag'], ['Accessories', 'Gold Hoop Earrings'], ['Outerwear', 'Olive Utility Jacket']],
            why: 'White stays versatile with earthy tones, letting the gold accessories bring in warmth without clashing.'
        },
        blue: {
            swatch: '#5c7fa6', name: 'Denim Blue Top', meta: 'Category: Top · Color: Denim Blue',
            matches: [['White', '#ffffff'], ['Grey', '#9a99a6'], ['Cream', '#f1ebe1'], ['Rust', '#b5643f'], ['Black', '#1c1c26']],
            outfit: [['Bottom', 'Cream Wide-leg Pants'], ['Shoes', 'White Canvas Sneakers'], ['Bag', 'Rust Crossbody Bag'], ['Accessories', 'Simple Silver Necklace'], ['Outerwear', 'Grey Knit Cardigan']],
            why: 'Denim blue pairs well with warm rust and soft cream, keeping the palette relaxed but still put-together.'
        }
    };

    var swatchEl = document.getElementById('scanSwatch');
    var nameEl = document.getElementById('scanItemName');
    var metaEl = document.getElementById('scanItemMeta');
    var matchRow = document.getElementById('scanMatchRow');
    var outfitList = document.getElementById('scanOutfitList');
    var whyEl = document.getElementById('scanWhy');
    var colorBtns = document.querySelectorAll('.scan-color-btn');

    function renderScan(key) {
        var d = scanData[key];
        if (!d) return;
        swatchEl.style.background = d.swatch;
        nameEl.textContent = d.name;
        metaEl.textContent = d.meta;
        whyEl.textContent = d.why;

        matchRow.innerHTML = d.matches.map(function (m) {
            return '<div class="match-swatch"><span class="dot" style="background:' + m[1] + ';"></span><span>' + m[0] + '</span></div>';
        }).join('');

        outfitList.innerHTML = d.outfit.map(function (o) {
            return '<div class="row"><span class="label">' + o[0] + '</span><span class="value">' + o[1] + '</span></div>';
        }).join('');
    }

    colorBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            colorBtns.forEach(function (b) { b.classList.remove('active'); });
            btn.classList.add('active');
            renderScan(btn.getAttribute('data-color'));
        });
    });

    var scanBtn = document.getElementById('scanBtn');
    if (scanBtn) {
        scanBtn.addEventListener('click', function () {
            var activeBtn = document.querySelector('.scan-color-btn.active');
            renderScan(activeBtn ? activeBtn.getAttribute('data-color') : 'black');
            if (window.wearShowToast) window.wearShowToast('Outfit berhasil di-scan! Rekomendasi diperbarui.');
        });
    }
    var uploadBtn = document.getElementById('scanUploadBtn');
    if (uploadBtn && window.wearShowToast) {
        uploadBtn.addEventListener('click', function () { window.wearShowToast('Fitur upload foto akan segera hadir.'); });
    }

    renderScan('black');
});
</script>
</body>
</html>