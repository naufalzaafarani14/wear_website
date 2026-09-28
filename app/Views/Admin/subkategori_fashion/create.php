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
                    <ul style="margin:0;">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="panel">
                <div class="panel-head">
                    <h2>Tambah Subkategori Fashion</h2>
                </div>

                <form action="/admin/subkategori-fashion/store" method="post">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="id_kategori">Kategori Induk</label>
                        <select name="id_kategori" id="id_kategori" class="form-control" required>
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            <?php foreach ($kategoris as $k): ?>
                                <option value="<?= $k['id_kategori'] ?>"
                                    <?= old('id_kategori') == $k['id_kategori'] ? 'selected' : '' ?>>
                                    <?= esc($k['nama_kategori']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama_subkategori">Nama Subkategori</label>
                        <input type="text" name="nama_subkategori" id="nama_subkategori"
                               class="form-control" placeholder="Contoh: Kaos & Kemeja Kasual"
                               value="<?= old('nama_subkategori') ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3"
                                  placeholder="Deskripsi singkat subkategori ini"><?= old('deskripsi') ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="/admin/subkategori-fashion" class="btn btn-outline">Batal</a>
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>