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
                <form method="post" action="<?= $item ? base_url('admin/artikel/update/' . $item['id_konten']) : base_url('admin/artikel/store') ?>" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="field">
                        <label for="judul">Judul Artikel</label>
                        <input type="text" id="judul" name="judul" value="<?= esc(old('judul', $item['judul'] ?? '')) ?>" required>
                    </div>

                    <div class="field">
                        <label for="author">Author</label>
                        <input type="text" id="author" name="author" placeholder="Nama penulis" value="<?= esc(old('author', $item['author'] ?? '')) ?>">
                    </div>

                    <div class="field">
                        <label for="ringkasan">Ringkasan (muncul di kartu preview)</label>
                        <textarea id="ringkasan" name="ringkasan" style="min-height:70px;"><?= esc(old('ringkasan', $item['ringkasan'] ?? '')) ?></textarea>
                    </div>

                    <div class="field">
                        <label for="isi_konten">Isi Artikel</label>
                        <textarea id="isi_konten" name="isi_konten" style="min-height:220px;" required><?= esc(old('isi_konten', $item['isi_konten'] ?? '')) ?></textarea>
                    </div>

                    <div class="field">
                        <label for="tags">Tags (pisahkan dengan koma)</label>
                        <input type="text" id="tags" name="tags" placeholder="color-matching, tips, formal" value="<?= esc(old('tags', $item['tags'] ?? '')) ?>">
                    </div>

                    <div class="field">
                        <label for="status">Status</label>
                        <?php $selectedStatus = old('status', $item['status'] ?? 'Draft'); ?>
                        <select id="status" name="status" required style="width:100%; padding:0.65rem 0.85rem; border:1.5px solid var(--line); border-radius:10px; font-family:'Inter', sans-serif; font-size:0.9rem;">
                            <option value="Draft" <?= ($selectedStatus === 'Draft') ? 'selected' : '' ?>>Draft</option>
                            <option value="Published" <?= ($selectedStatus === 'Published') ? 'selected' : '' ?>>Published</option>
                        </select>
                    </div>

                    <div class="field">
                        <label for="gambar">Cover Image <?= $item ? '(kosongkan jika tidak ingin ganti)' : '' ?></label>
                        <input type="file" id="gambar" name="gambar" accept="image/png, image/jpeg, image/webp">
                        <?php if ($item && ! empty($item['image_url'])): ?>
                            <div style="margin-top:0.75rem;">
                                <img src="<?= base_url($item['image_url']) ?>" alt="Cover saat ini" style="width:160px; height:100px; object-fit:cover; border-radius:10px; border:1px solid var(--line);">
                            </div>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary"><?= $item ? 'Simpan Perubahan' : 'Tambah Artikel' ?></button>
                    <a href="<?= base_url('admin/artikel') ?>" class="btn btn-outline">Batal</a>
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>