<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Kategori - WEAR Admin</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
</head>
<body>
<div class="admin-layout">
    <?= view('admin/partials/sidebar') ?>

    <main class="admin-main">
        <?= view('admin/partials/topbar', ['pageTitle' => 'Kelola Kategori']) ?>

        <div class="admin-content">
            <?php if (session()->getFlashdata('sukses')): ?>
                <div class="alert alert-success"><?= esc(session()->getFlashdata('sukses')) ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('gagal')): ?>
                <div class="alert alert-danger"><?= esc(session()->getFlashdata('gagal')) ?></div>
            <?php endif; ?>

            <div class="panel">
                <div class="panel-head">
                    <h2>Daftar Kategori Fashion</h2>
                    <a href="<?= base_url('admin/kategori/create') ?>" class="btn btn-primary btn-sm">+ Tambah Kategori</a>
                </div>

                <table class="admin-table">
                    <thead>
                        <tr>
                            <th style="width:60px;">No</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th style="width:160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($kategori)): ?>
                            <tr>
                                <td colspan="4" style="text-align:center; color:var(--muted); padding:2rem;">
                                    Belum ada data kategori.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($kategori as $i => $row): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= esc($row['nama_kategori']) ?></td>
                                    <td><?= esc($row['deskripsi'] ?? '-') ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/kategori/edit/' . $row['id_kategori']) ?>" class="btn btn-outline btn-sm">Edit</a>
                                        <a href="<?= base_url('admin/kategori/delete/' . $row['id_kategori']) ?>"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Yakin mau hapus kategori ini?');">Hapus</a>
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