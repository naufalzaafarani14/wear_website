<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= isset($data) ? 'Edit' : 'Tambah' ?> Kategori - WEAR Admin</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
</head>
<body>
<div class="admin-layout">
    <?= view('admin/partials/sidebar') ?>

    <main class="admin-main">
        <?= view('admin/partials/topbar', ['pageTitle' => isset($data) ? 'Edit Kategori' : 'Tambah Kategori']) ?>

        <div class="admin-content">
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul style="margin:0; padding-left:1.1rem;">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="panel" style="max-width:520px;">
                <form action="<?= isset($data) ? base_url('admin/kategori/update/' . $data['id_kategori']) : base_url('admin/kategori/store') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="field">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" id="nama_kategori" name="nama_kategori"
                               value="<?= old('nama_kategori', $data['nama_kategori'] ?? '') ?>"
                               placeholder="Contoh: Atasan" required>
                    </div>

                    <div class="field">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" placeholder="Deskripsi singkat kategori (opsional)"><?= old('deskripsi', $data['deskripsi'] ?? '') ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary"><?= isset($data) ? 'Simpan Perubahan' : 'Tambah Kategori' ?></button>
                    <a href="<?= base_url('admin/kategori') ?>" class="btn btn-outline">Batal</a>
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>