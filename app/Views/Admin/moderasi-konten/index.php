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

            <?php if ($jumlahMenunggu > 0): ?>
                <div class="panel" style="background:#fff8e6; border-color:#ffe4a3; margin-bottom:1.5rem;">
                    <strong>⏳ <?= $jumlahMenunggu ?> postingan menunggu direview.</strong> Cek dan tindak lanjuti secepatnya biar user gak nunggu lama.
                </div>
            <?php endif; ?>

            <div class="panel">
                <div class="panel-head">
                    <h2>Semua Postingan</h2>
                </div>

                <div style="display:flex; gap:0.5rem; margin-bottom:1.25rem;">
                    <a href="<?= base_url('admin/moderasi-konten') ?>" class="btn <?= empty($status) ? 'btn-primary' : 'btn-outline' ?> btn-sm">Semua</a>
                    <a href="<?= base_url('admin/moderasi-konten?status=Menunggu Review') ?>" class="btn <?= ($status === 'Menunggu Review') ? 'btn-primary' : 'btn-outline' ?> btn-sm">Menunggu Review</a>
                    <a href="<?= base_url('admin/moderasi-konten?status=Published') ?>" class="btn <?= ($status === 'Published') ? 'btn-primary' : 'btn-outline' ?> btn-sm">Published</a>
                    <a href="<?= base_url('admin/moderasi-konten?status=Ditolak') ?>" class="btn <?= ($status === 'Ditolak') ? 'btn-primary' : 'btn-outline' ?> btn-sm">Ditolak</a>
                </div>

                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Media</th>
                            <th>Caption</th>
                            <th>Channel</th>
                            <th>User</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($items)): ?>
                            <tr><td colspan="7">Belum ada postingan.</td></tr>
                        <?php else: ?>
                            <?php foreach ($items as $item): ?>
                                <tr>
                                    <td>
                                        <?php if ($item['tipe_media'] === 'Video'): ?>
                                            <span style="font-size:0.75rem; color:var(--muted);">🎥 Video</span>
                                        <?php else: ?>
                                            <img src="<?= base_url($item['media_url']) ?>" alt="Postingan" style="width:48px; height:48px; object-fit:cover; border-radius:8px; border:1px solid var(--line);">
                                        <?php endif; ?>
                                    </td>
                                    <td style="max-width:200px; font-size:0.85rem;"><?= esc(mb_strimwidth($item['caption'] ?? '-', 0, 60, '...')) ?></td>
                                    <td><?= esc($item['nama_channel'] ?? '-') ?></td>
                                    <td><?= esc($item['nama_lengkap'] ?? '-') ?></td>
                                    <td>
                                        <?php
                                            $warna = match ($item['status']) {
                                                'Published' => '#1e8a4c',
                                                'Ditolak'   => '#c0295a',
                                                default     => '#b8860b',
                                            };
                                        ?>
                                        <span style="color:<?= $warna ?>; font-weight:600; font-size:0.8rem;">● <?= esc($item['status']) ?></span>
                                    </td>
                                    <td style="font-size:0.8rem; color:var(--muted);"><?= esc(date('d M Y', strtotime($item['created_at']))) ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/moderasi-konten/detail/' . $item['id_postingan']) ?>" class="btn btn-outline btn-sm">Lihat</a>
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