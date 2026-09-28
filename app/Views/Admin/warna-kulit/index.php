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
                    <h2>Daftar Warna Kulit</h2>
                    <a href="<?= base_url('admin/warna-kulit/create') ?>" class="btn btn-primary">+ Tambah Warna Kulit</a>
                </div>

                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($items)): ?>
                            <tr><td colspan="3">Belum ada data warna kulit.</td></tr>
                        <?php else: ?>
                            <?php foreach ($items as $item): ?>
                                <tr>
                                    <td><?= esc($item['nama_warna_kulit']) ?></td>
                                    <td><?= esc($item['deskripsi']) ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/warna-kulit/edit/' . $item['id_warna_kulit']) ?>" class="btn btn-outline btn-sm">Edit</a>
                                        <a href="<?= base_url('admin/warna-kulit/delete/' . $item['id_warna_kulit']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus warna kulit ini?')">Hapus</a>
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