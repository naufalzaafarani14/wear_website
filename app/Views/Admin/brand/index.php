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
                    <h2>Daftar Brand</h2>
                    <a href="<?= base_url('admin/brand/create') ?>" class="btn btn-primary">+ Tambah Brand</a>
                </div>

                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nama Brand</th>
                            <th>Website</th>
                            <th>Unggulan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($items)): ?>
                            <tr><td colspan="4">Belum ada data brand.</td></tr>
                        <?php else: ?>
                            <?php foreach ($items as $item): ?>
                                <tr>
                                    <td><?= esc($item['nama_brand']) ?></td>
                                    <td>
                                        <?php if (! empty($item['website_url'])): ?>
                                            <a href="<?= esc($item['website_url']) ?>" target="_blank" rel="noopener">Kunjungi</a>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $item['is_featured'] ? '✅' : '—' ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/brand/edit/' . $item['id_brand']) ?>" class="btn btn-outline btn-sm">Edit</a>
                                        <a href="<?= base_url('admin/brand/delete/' . $item['id_brand']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus brand ini?')">Hapus</a>
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