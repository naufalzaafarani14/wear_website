<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>wear — Pinjam, Pakai, Ganti Gaya</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="<?= base_url('assets/css/site.css') ?>">
</head>
<body>

  <!-- NAVBAR -->
  <header class="nav">
    <div class="wrap nav-inner">
      <a href="<?= base_url('/') ?>" class="wordmark">wear<span>.</span></a>
      <ul class="nav-menu">
        <li><a href="#beranda">Beranda</a></li>
        <li><a href="#fitur">Fitur</a></li>
        <li><a href="#tentang">Tentang</a></li>
      </ul>
      <div class="nav-actions">
        <a href="<?= base_url('login') ?>" class="btn-text">Masuk</a>
        <a href="<?= base_url('register') ?>" class="btn btn-fill">Daftar</a>
      </div>
    </div>
  </header>

  <!-- HERO -->
  <section class="hero" id="beranda">
    <div class="wrap hero-grid">
      <h1>Gaya yang pas, bukan sekadar cocok.</h1>
      <div class="hero-side">
        <p>wear bantu kamu nemuin, atur, dan pinjam-pakai koleksi busana dari satu portal — nggak perlu nambah tumpukan baju yang jarang kepake.</p>
        <div class="hero-ctas">
          <a href="<?= base_url('register') ?>" class="btn btn-fill">Mulai Jelajahi</a>
          <a href="#fitur" class="btn btn-outline">Lihat Fitur</a>
        </div>
      </div>
    </div>
    <div class="wrap">
      <div class="cat-strip">
        <a href="#" class="cat-pill">Atasan</a>
        <a href="#" class="cat-pill">Bawahan</a>
        <a href="#" class="cat-pill">Outer</a>
        <a href="#" class="cat-pill">Formal</a>
        <a href="#" class="cat-pill">Kasual</a>
        <a href="#" class="cat-pill">Aksesori</a>
      </div>
    </div>
  </section>

  <!-- KOLEKSI / KATEGORI -->
  <section class="section">
    <div class="wrap">
      <div class="section-head">
        <h2>Koleksi yang selalu bisa kamu putar ulang</h2>
        <p>Ditata per kategori biar gampang dicari, sebelum diajukan untuk dipinjam.</p>
      </div>
      <div class="koleksi-grid">
        <div class="kcard k1"><span>Outer</span></div>
        <div class="kcard k2"><span>Atasan</span></div>
        <div class="kcard k3"><span>Bawahan</span></div>
        <div class="kcard k4"><span>Aksesori</span></div>
        <div class="kcard k5"><span>Formal</span></div>
        <div class="kcard k6"><span>Kasual</span></div>
      </div>
    </div>
  </section>

  <!-- FITUR -->
  <section class="section section-alt" id="fitur">
    <div class="wrap">
      <div class="section-head">
        <h2>Satu portal, dari cari sampai kembaliin</h2>
        <p>Fitur inti yang bikin proses pinjam-pakai gampang dilacak.</p>
      </div>
      <div class="fitur-list">
        <div class="fitur-item">
          <h3>Katalog Busana</h3>
          <p>Semua item tercatat lengkap dengan foto, ukuran, dan status ketersediaan.</p>
        </div>
        <div class="fitur-item">
          <h3>Pinjam & Kembalikan</h3>
          <p>Ajukan peminjaman, pantau tenggat, dan kembalikan tepat waktu langsung dari akun kamu.</p>
        </div>
        <div class="fitur-item">
          <h3>Dashboard Member</h3>
          <p>Riwayat pinjam, item favorit, dan pengingat jatuh tempo dalam satu tempat.</p>
        </div>
        <div class="fitur-item">
          <h3>Pencarian & Filter</h3>
          <p>Saring koleksi berdasarkan kategori, ukuran, warna, atau brand dalam sekali klik.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- TENTANG -->
  <section class="section" id="tentang">
    <div class="wrap tentang-grid">
      <h2>Lemari penuh nggak berarti gaya penuh</h2>
      <div class="tentang-body">
        <p>wear lahir dari ide sederhana: daripada beli baju yang cuma dipakai sekali lalu nganggur di lemari, kenapa nggak pinjam-pakai aja? Lewat sistem katalog dan peminjaman yang transparan, wear bikin kamu bisa gonta-ganti gaya tanpa nambah tumpukan barang.</p>
        <p>Setiap item yang masuk katalog dicatat statusnya secara real-time, jadi kamu selalu tahu mana yang tersedia dan mana yang lagi dipinjam orang lain.</p>
        <div class="tentang-facts">
          <div>
            <span class="fact-num">6</span>
            <span class="fact-label">Kategori busana utama</span>
          </div>
          <div>
            <span class="fact-num">1</span>
            <span class="fact-label">Dashboard buat semua riwayat pinjam</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA BANNER -->
  <section class="cta-banner">
    <div class="wrap cta-inner">
      <h2>Lemari kamu, tapi versi tak terbatas.</h2>
      <a href="<?= base_url('register') ?>" class="btn btn-fill">Daftar Sekarang</a>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="wrap">
      <div class="foot-grid">
        <div class="foot-brand">
          <a href="<?= base_url('/') ?>" class="wordmark">wear<span style="color:var(--pink)">.</span></a>
          <p>Portal katalog dan peminjaman busana — dibuat untuk komunitas yang suka gonta-ganti gaya.</p>
        </div>
        <div class="foot-col">
          <h4>Jelajah</h4>
          <ul>
            <li><a href="#beranda">Beranda</a></li>
            <li><a href="#fitur">Fitur</a></li>
            <li><a href="#tentang">Tentang</a></li>
          </ul>
        </div>
        <div class="foot-col">
          <h4>Akun</h4>
          <ul>
            <li><a href="<?= base_url('login') ?>">Masuk</a></li>
            <li><a href="<?= base_url('register') ?>">Daftar</a></li>
          </ul>
        </div>
      </div>
      <div class="foot-bottom">
        <span>© <?= date('Y') ?> wear.</span>
        <span>Dibuat untuk komunitas yang suka gonta-ganti gaya.</span>
      </div>
    </div>
  </footer>

</body>
</html>