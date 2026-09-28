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
            <?php if (session()->getFlashdata('sukses')): ?>
                <div class="alert alert-success"><?= esc(session()->getFlashdata('sukses')) ?></div>
            <?php endif; ?>

            <div class="panel">
                <div class="panel-head">
                    <h2>Majalah / Artikel</h2>
                    <a href="<?= base_url('admin/artikel/create') ?>" class="btn btn-primary">+ Tambah Artikel</a>
                </div>

                <form method="get" style="display:flex; gap:0.75rem; margin-bottom:1.25rem;">
                    <input type="text" name="q" placeholder="Cari judul artikel..." value="<?= esc($keyword) ?>" style="flex:1; padding:0.6rem 0.85rem; border:1.5px solid var(--line); border-radius:10px; font-family:'Inter', sans-serif; font-size:0.85rem;">
                    <select name="status" style="padding:0.6rem 0.85rem; border:1.5px solid var(--line); border-radius:10px; font-family:'Inter', sans-serif; font-size:0.85rem;">
                        <option value="">Semua Status</option>
                        <option value="Draft" <?= ($status === 'Draft') ? 'selected' : '' ?>>Draft</option>
                        <option value="Published" <?= ($status === 'Published') ? 'selected' : '' ?>>Published</option>
                    </select>
                    <button type="submit" class="btn btn-outline">Filter</button>
                    <a href="<?= base_url('admin/artikel') ?>" class="btn btn-outline">Reset</a>
                </form>

                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Cover</th>
                            <th>Judul</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($items)): ?>
                            <tr><td colspan="6">Belum ada artikel.</td></tr>
                        <?php else: ?>
                            <?php foreach ($items as $item): ?>
                                <tr>
                                    <td>
                                        <?php if (! empty($item['image_url'])): ?>
                                            <img src="<?= base_url($item['image_url']) ?>" alt="<?= esc($item['judul']) ?>" style="width:56px; height:40px; object-fit:cover; border-radius:6px; border:1px solid var(--line);">
                                        <?php else: ?>
                                            <span style="color:var(--muted); font-size:0.75rem;">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($item['judul']) ?></td>
                                    <td><?= esc($item['author'] ?? '-') ?></td>
                                    <td>
                                        <?php if ($item['status'] === 'Published'): ?>
                                            <span style="color:#1e8a4c; font-weight:600; font-size:0.8rem;">● Published</span>
                                        <?php else: ?>
                                            <span style="color:var(--muted); font-weight:600; font-size:0.8rem;">● Draft</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="font-size:0.8rem; color:var(--muted);"><?= esc(date('d M Y', strtotime($item['tanggal_dibuat']))) ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/artikel/preview/' . $item['id_konten']) ?>" class="btn btn-outline btn-sm">Preview</a>
                                        <a href="<?= base_url('admin/artikel/edit/' . $item['id_konten']) ?>" class="btn btn-outline btn-sm">Edit</a>
                                        <a href="<?= base_url('admin/artikel/delete/' . $item['id_konten']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus artikel ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
</body>
</html>