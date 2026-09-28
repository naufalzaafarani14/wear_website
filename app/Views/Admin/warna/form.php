<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= esc($pageTitle) ?> - WEAR</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
</head>
<body>
<div class="admin-layout">
    <?= view('admin/partials/sidebar') ?>

    <main class="admin-main">
        <?= view('admin/partials/topbar', ['pageTitle' => $pageTitle]) ?>

        <div class="admin-content">
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul style="margin:0; padding-left:1.2rem;">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="panel">
                <form method="post" action="<?= $item ? base_url('admin/warna/update/' . $item['id_warna']) : base_url('admin/warna/store') ?>">
                    <?= csrf_field() ?>

                    <div class="field">
                        <label for="nama_warna">Nama Warna</label>
                        <input type="text" id="nama_warna" name="nama_warna" value="<?= esc(old('nama_warna', $item['nama_warna'] ?? '')) ?>" required>
                    </div>

                    <div class="field">
                        <label for="kode_hex">Kode Hex</label>
                        <input type="text" id="kode_hex" name="kode_hex" placeholder="#FF4FA3" value="<?= esc(old('kode_hex', $item['kode_hex'] ?? '')) ?>">
                    </div>

                    <button type="submit" class="btn btn-primary"><?= $item ? 'Simpan Perubahan' : 'Tambah Warna' ?></button>
                    <a href="<?= base_url('admin/warna') ?>" class="btn btn-outline">Batal</a>
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>