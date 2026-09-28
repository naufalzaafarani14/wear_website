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
                    <h2>Daftar Bentuk Tubuh</h2>
                    <a href="<?= base_url('admin/bentuk-tubuh/create') ?>" class="btn btn-primary">+ Tambah Bentuk Tubuh</a>
                </div>

                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nama Bentuk</th>
                            <th>Deskripsi</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($items)): ?>
                            <tr><td colspan="3">Belum ada data bentuk tubuh.</td></tr>
                        <?php else: ?>
                            <?php foreach ($items as $item): ?>
                                <tr>
                                    <td><?= esc($item['nama_bentuk']) ?></td>
                                    <td><?= esc($item['deskripsi']) ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/bentuk-tubuh/edit/' . $item['id_bentuk_tubuh']) ?>" class="btn btn-outline btn-sm">Edit</a>
                                        <a href="<?= base_url('admin/bentuk-tubuh/delete/' . $item['id_bentuk_tubuh']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus bentuk tubuh ini?')">Hapus</a>
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