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
                    <h2>Daftar Item Fashion</h2>
                    <a href="<?= base_url('admin/item-fashion/create') ?>" class="btn btn-primary">+ Tambah Item Fashion</a>
                </div>

                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nama Item</th>
                            <th>Subkategori</th>
                            <th>Style</th>
                            <th>Gender</th>
                            <th>Warna</th>
                            <th>Occasion</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($items)): ?>
                            <tr><td colspan="9">Belum ada data item fashion.</td></tr>
                        <?php else: ?>
                            <?php foreach ($items as $item): ?>
                                <tr>
                                    <td>
                                        <?php if (! empty($item['image_url'])): ?>
                                            <img src="<?= base_url($item['image_url']) ?>" alt="<?= esc($item['nama_item']) ?>" style="width:44px; height:44px; object-fit:cover; border-radius:8px; border:1px solid var(--line);">
                                        <?php else: ?>
                                            <span style="color:var(--muted); font-size:0.75rem;">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($item['nama_item']) ?></td>
                                    <td><?= esc($item['nama_subkategori'] ?? '-') ?></td>
                                    <td><?= esc($item['nama_style'] ?? '-') ?></td>
                                    <td><?= esc($item['gender'] ?? '-') ?></td>
                                    <td style="font-size:0.8rem;"><?= esc($item['daftar_warna'] ?? '-') ?></td>
                                    <td style="font-size:0.8rem;"><?= esc($item['daftar_occasion'] ?? '-') ?></td>
                                    <td>
                                        <?php if ($item['status'] === 'Published'): ?>
                                            <span style="color:#1e8a4c; font-weight:600; font-size:0.8rem;">● Published</span>
                                        <?php else: ?>
                                            <span style="color:var(--muted); font-weight:600; font-size:0.8rem;">● Draft</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('admin/item-fashion/edit/' . $item['id_item']) ?>" class="btn btn-outline btn-sm">Edit</a>
                                        <a href="<?= base_url('admin/item-fashion/delete/' . $item['id_item']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus item fashion ini?')">Hapus</a>
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