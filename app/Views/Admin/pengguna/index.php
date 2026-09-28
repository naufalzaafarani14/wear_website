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
                    <h2>Daftar Pengguna</h2>
                </div>

                <form method="get" style="display:flex; gap:0.75rem; margin-bottom:1.25rem;">
                    <input type="text" name="q" placeholder="Cari nama atau email..." value="<?= esc($keyword) ?>" style="flex:1; padding:0.6rem 0.85rem; border:1.5px solid var(--line); border-radius:10px; font-family:'Inter', sans-serif; font-size:0.85rem;">
                    <button type="submit" class="btn btn-outline">Cari</button>
                    <a href="<?= base_url('admin/pengguna') ?>" class="btn btn-outline">Reset</a>
                </form>

                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Tanggal Daftar</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($items)): ?>
                            <tr><td colspan="5">Belum ada pengguna terdaftar.</td></tr>
                        <?php else: ?>
                            <?php foreach ($items as $item): ?>
                                <tr>
                                    <td><?= esc($item['nama_lengkap']) ?></td>
                                    <td><?= esc($item['email']) ?></td>
                                    <td>
                                        <?php if ($item['role'] === 'admin'): ?>
                                            <span style="background:var(--soft); padding:0.2rem 0.6rem; border-radius:6px; font-size:0.78rem; font-weight:600;">Admin</span>
                                        <?php else: ?>
                                            <span style="color:var(--muted); font-size:0.78rem;">User</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="font-size:0.8rem; color:var(--muted);"><?= esc(date('d M Y', strtotime($item['tanggal_daftar']))) ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/pengguna/detail/' . $item['id_pengguna']) ?>" class="btn btn-outline btn-sm">Lihat Detail</a>
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