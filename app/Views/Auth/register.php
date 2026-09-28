<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - WEAR</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/auth.css') ?>">
</head>
<body>
<div class="auth-page">

    <div class="auth-brand">
        <div class="brand-mark">
            <img src="<?= base_url('assets/images/logo/wear-logo.png') ?>" alt="WEAR"
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">
            <span class="wordmark-fallback">WEAR</span>
        </div>

        <div class="brand-copy">
            <h1>Mulai perjalanan gayamu bersama kami.</h1>
            <p>Daftar sekarang dan dapatkan rekomendasi outfit yang disesuaikan dengan bentuk tubuh dan preferensi style-mu.</p>
        </div>

        <div class="brand-foot">© <?= date('Y') ?> WEAR. Semua hak dilindungi.</div>
    </div>

    <div class="auth-form-panel">
        <div class="auth-card">
            <p class="eyebrow">Gabung sekarang</p>
            <h2>Buat akun baru</h2>
            <p class="sub">Gratis, cukup butuh beberapa detik.</p>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('register/proses') ?>" method="post">
                <?= csrf_field() ?>

                <div class="field">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?= old('nama_lengkap') ?>" placeholder="Nama kamu" required>
                </div>

                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= old('email') ?>" placeholder="nama@email.com" required>
                </div>

                <div class="row-2">
                    <div class="field">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                    </div>

                    <div class="field">
                        <label for="konfirmasi_password">Konfirmasi</label>
                        <input type="password" id="konfirmasi_password" name="konfirmasi_password" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn-primary">Daftar</button>
            </form>

            <p class="auth-switch">Sudah punya akun? <a href="<?= base_url('login') ?>">Masuk di sini</a></p>
        </div>
    </div>

</div>
</body>
</html>