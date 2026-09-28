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
                    <h2>Daftar Warna</h2>
                    <a href="<?= base_url('admin/warna/create') ?>" class="btn btn-primary">+ Tambah Warna</a>
                </div>

                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nama Warna</th>
                            <th>Kode Hex</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($items)): ?>
                            <tr><td colspan="3">Belum ada data warna.</td></tr>
                        <?php else: ?>
                            <?php foreach ($items as $item): ?>
                                <tr>
                                    <td><?= esc($item['nama_warna']) ?></td>
                                    <td>
                                        <?php if (! empty($item['kode_hex'])): ?>
                                            <span style="display:inline-block; width:14px; height:14px; border-radius:4px; background:<?= esc($item['kode_hex']) ?>; border:1px solid var(--line); vertical-align:middle; margin-right:6px;"></span>
                                        <?php endif; ?>
                                        <?= esc($item['kode_hex']) ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('admin/warna/edit/' . $item['id_warna']) ?>" class="btn btn-outline btn-sm">Edit</a>
                                        <a href="<?= base_url('admin/warna/delete/' . $item['id_warna']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus warna ini?')">Hapus</a>
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