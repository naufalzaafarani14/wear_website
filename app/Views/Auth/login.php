<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WEAR</title>
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
            <h1>Padu padan gayamu, temukan versi terbaikmu.</h1>
            <p>Simpan koleksi outfit favorit, dapatkan rekomendasi gaya, dan atur wardrobe kamu — semua di satu tempat.</p>
        </div>

        <div class="brand-foot">© <?= date('Y') ?> WEAR. Semua hak dilindungi.</div>
    </div>

    <div class="auth-form-panel">
        <div class="auth-card">
            <p class="eyebrow">Selamat datang kembali</p>
            <h2>Masuk ke akunmu</h2>
            <p class="sub">Lanjutkan eksplorasi gaya dan wardrobe kamu.</p>

            <?php if (session()->getFlashdata('sukses')): ?>
                <div class="alert alert-success"><?= esc(session()->getFlashdata('sukses')) ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('gagal')): ?>
                <div class="alert alert-danger"><?= esc(session()->getFlashdata('gagal')) ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('login/proses') ?>" method="post">
                <?= csrf_field() ?>

                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= old('email') ?>" placeholder="nama@email.com" required>
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-primary">Masuk</button>
            </form>

            <p class="auth-switch">Belum punya akun? <a href="<?= base_url('register') ?>">Daftar di sini</a></p>
        </div>
    </div>

</div>
</body>
</html>