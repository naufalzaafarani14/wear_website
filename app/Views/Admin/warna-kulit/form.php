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
                <form method="post" action="<?= $item ? base_url('admin/warna-kulit/update/' . $item['id_warna_kulit']) : base_url('admin/warna-kulit/store') ?>">
                    <?= csrf_field() ?>

                    <div class="field">
                        <label for="nama_warna_kulit">Nama Warna Kulit</label>
                        <input type="text" id="nama_warna_kulit" name="nama_warna_kulit" placeholder="Terang, Kuning Langsat, Sawo Matang, dll" value="<?= esc(old('nama_warna_kulit', $item['nama_warna_kulit'] ?? '')) ?>" required>
                    </div>

                    <div class="field">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi"><?= esc(old('deskripsi', $item['deskripsi'] ?? '')) ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary"><?= $item ? 'Simpan Perubahan' : 'Tambah Warna Kulit' ?></button>
                    <a href="<?= base_url('admin/warna-kulit') ?>" class="btn btn-outline">Batal</a>
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>