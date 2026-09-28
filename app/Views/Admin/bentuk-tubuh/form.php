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
                <form method="post" action="<?= $item ? base_url('admin/bentuk-tubuh/update/' . $item['id_bentuk_tubuh']) : base_url('admin/bentuk-tubuh/store') ?>">
                    <?= csrf_field() ?>

                    <div class="field">
                        <label for="nama_bentuk">Nama Bentuk Tubuh</label>
                        <input type="text" id="nama_bentuk" name="nama_bentuk" placeholder="Hourglass, Pear, Rectangle, dll" value="<?= esc(old('nama_bentuk', $item['nama_bentuk'] ?? '')) ?>" required>
                    </div>

                    <div class="field">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi"><?= esc(old('deskripsi', $item['deskripsi'] ?? '')) ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary"><?= $item ? 'Simpan Perubahan' : 'Tambah Bentuk Tubuh' ?></button>
                    <a href="<?= base_url('admin/bentuk-tubuh') ?>" class="btn btn-outline">Batal</a>
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>