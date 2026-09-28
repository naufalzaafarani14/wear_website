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

            <?php if (session()->getFlashdata('gagal')): ?>
                <div class="alert alert-danger"><?= esc(session()->getFlashdata('gagal')) ?></div>
            <?php endif; ?>

            <div class="panel">
                <div class="panel-head" style="display:flex; justify-content:space-between; align-items:center;">
                    <h2>Daftar Subkategori Fashion</h2>
                    <a href="/admin/subkategori-fashion/create" class="btn btn-primary">+ Tambah Subkategori</a>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th style="width:50px;">#</th>
                            <th>Kategori Induk</th>
                            <th>Nama Subkategori</th>
                            <th>Deskripsi</th>
                            <th style="width:160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($subkategoris)): ?>
                            <tr>
                                <td colspan="5" style="text-align:center; color:var(--muted); padding:1.5rem;">
                                    Belum ada data subkategori. Klik "Tambah Subkategori" untuk mulai.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($subkategoris as $i => $s): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= esc($s['nama_kategori']) ?></td>
                                    <td><?= esc($s['nama_subkategori']) ?></td>
                                    <td><?= esc($s['deskripsi'] ?? '-') ?></td>
                                    <td>
                                        <a href="/admin/subkategori-fashion/edit/<?= $s['id_subkategori'] ?>" class="btn btn-sm btn-outline">Edit</a>
                                        <a href="/admin/subkategori-fashion/delete/<?= $s['id_subkategori'] ?>"
                                           class="btn btn-sm btn-outline-danger"
                                           onclick="return confirm('Hapus subkategori ini? Semua item fashion di bawahnya juga akan ikut terhapus.');">Hapus</a>
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