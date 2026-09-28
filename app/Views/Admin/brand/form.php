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
                <form method="post" action="<?= $item ? base_url('admin/brand/update/' . $item['id_brand']) : base_url('admin/brand/store') ?>">
                    <?= csrf_field() ?>

                    <div class="field">
                        <label for="nama_brand">Nama Brand</label>
                        <input type="text" id="nama_brand" name="nama_brand" value="<?= esc(old('nama_brand', $item['nama_brand'] ?? '')) ?>" required>
                    </div>

                    <div class="field">
                        <label for="logo_url">URL Logo</label>
                        <input type="text" id="logo_url" name="logo_url" placeholder="https://..." value="<?= esc(old('logo_url', $item['logo_url'] ?? '')) ?>">
                    </div>

                    <div class="field">
                        <label for="website_url">URL Website</label>
                        <input type="text" id="website_url" name="website_url" placeholder="https://..." value="<?= esc(old('website_url', $item['website_url'] ?? '')) ?>">
                    </div>

                    <div class="field">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi"><?= esc(old('deskripsi', $item['deskripsi'] ?? '')) ?></textarea>
                    </div>

                    <div class="field">
                        <label style="display:flex; align-items:center; gap:0.5rem; font-weight:600;">
                            <input type="checkbox" name="is_featured" value="1" style="width:auto;" <?= (old('is_featured', $item['is_featured'] ?? 0)) ? 'checked' : '' ?>>
                            Tampilkan sebagai brand unggulan
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary"><?= $item ? 'Simpan Perubahan' : 'Tambah Brand' ?></button>
                    <a href="<?= base_url('admin/brand') ?>" class="btn btn-outline">Batal</a>
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>