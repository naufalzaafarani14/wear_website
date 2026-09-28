<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - WEAR</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
</head>
<body>
<div class="admin-layout">
    <?= view('admin/partials/sidebar') ?>

    <main class="admin-main">
        <?= view('admin/partials/topbar', ['pageTitle' => 'Dashboard']) ?>

        <div class="admin-content">
            <?php if (session()->getFlashdata('sukses')): ?>
                <div class="alert alert-success"><?= esc(session()->getFlashdata('sukses')) ?></div>
            <?php endif; ?>

            <div class="panel" style="margin-bottom:1.75rem;">
                <h2 style="font-family:'Plus Jakarta Sans', sans-serif; margin:0 0 0.35rem;">Selamat datang kembali, Admin WEAR 👋</h2>
                <p style="color:var(--muted); font-size:0.9rem; margin:0;">Kelola fashion, konten, dan inspirasi untuk pengguna WEAR.</p>
            </div>

            <!-- Statistik Utama -->
            <div class="stat-grid" style="grid-template-columns:repeat(6, 1fr);">
                <div class="panel stat-card">
                    <div class="label">Total Pengguna</div>
                    <div class="value"><?= (int) $totalPengguna ?></div>
                </div>
                <div class="panel stat-card">
                    <div class="label">Total Item Fashion</div>
                    <div class="value"><?= (int) $totalItemFashion ?></div>
                </div>
                <div class="panel stat-card">
                    <div class="label">Total Outfit</div>
                    <div class="value"><?= (int) $totalOutfit ?></div>
                </div>
                <div class="panel stat-card">
                    <div class="label">Total Brand</div>
                    <div class="value"><?= (int) $totalBrand ?></div>
                </div>
                <div class="panel stat-card">
                    <div class="label">Fashion Inspiration</div>
                    <div class="value"><?= (int) $totalInspirasi ?></div>
                </div>
                <div class="panel stat-card">
                    <div class="label">Artikel Published</div>
                    <div class="value"><?= (int) $totalArtikelPub ?></div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="panel" style="margin-bottom:1.75rem;">
                <div class="panel-head">
                    <h2>Quick Actions</h2>
                </div>
                <div style="display:flex; gap:0.75rem; flex-wrap:wrap;">
                    <a href="<?= base_url('admin/item-fashion/create') ?>" class="btn btn-primary">+ Tambah Item Fashion</a>
                    <a href="<?= base_url('admin/outfit/create') ?>" class="btn btn-primary">+ Tambah Outfit</a>
                    <a href="<?= base_url('admin/artikel/create') ?>" class="btn btn-primary">+ Tambah Artikel</a>
                    <a href="<?= base_url('admin/brand/create') ?>" class="btn btn-outline">+ Tambah Brand</a>
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.75rem; margin-bottom:1.75rem;">
                <!-- Fashion Overview -->
                <div class="panel">
                    <div class="panel-head">
                        <h2>Fashion Overview</h2>
                    </div>
                    <table class="admin-table">
                        <tbody>
                            <tr><td>Total Item Fashion</td><td style="text-align:right; font-weight:700;"><?= (int) $totalItemFashion ?></td></tr>
                            <tr><td>Active Item (Published)</td><td style="text-align:right; font-weight:700; color:#1e8a4c;"><?= (int) $itemPublished ?></td></tr>
                            <tr><td>Draft Item</td><td style="text-align:right; font-weight:700; color:var(--muted);"><?= (int) $itemDraft ?></td></tr>
                            <tr><td>Total Outfit</td><td style="text-align:right; font-weight:700;"><?= (int) $totalOutfit ?></td></tr>
                            <tr><td>Published Outfit</td><td style="text-align:right; font-weight:700; color:#1e8a4c;"><?= (int) $outfitPublished ?></td></tr>
                            <tr><td>Draft Outfit</td><td style="text-align:right; font-weight:700; color:var(--muted);"><?= (int) $outfitDraft ?></td></tr>
                        </tbody>
                    </table>
                </div>

                <!-- Content Overview -->
                <div class="panel">
                    <div class="panel-head">
                        <h2>Content Overview</h2>
                    </div>
                    <table class="admin-table">
                        <tbody>
                            <?php if (empty($contentOverview)): ?>
                                <tr><td colspan="2">Belum ada konten (Artikel/Inspirasi/Budaya).</td></tr>
                            <?php else: ?>
                                <?php foreach ($contentOverview as $row): ?>
                                    <tr>
                                        <td><?= esc($row['tipe']) ?></td>
                                        <td style="text-align:right; font-weight:700;"><?= (int) $row['jumlah'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Konten Terbaru -->
            <div class="panel">
                <div class="panel-head">
                    <h2>Konten Terbaru</h2>
                </div>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nama Konten</th>
                            <th>Tipe</th>
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($kontenTerbaru)): ?>
                            <tr><td colspan="4">Belum ada konten yang dibuat.</td></tr>
                        <?php else: ?>
                            <?php foreach ($kontenTerbaru as $konten): ?>
                                <tr>
                                    <td><?= esc($konten['nama']) ?></td>
                                    <td><span style="background:var(--soft); padding:0.2rem 0.6rem; border-radius:6px; font-size:0.78rem; font-weight:600;"><?= esc($konten['tipe']) ?></span></td>
                                    <td>
                                        <?php if (($konten['status'] ?? '') === 'Published'): ?>
                                            <span style="color:#1e8a4c; font-weight:600; font-size:0.8rem;">● Published</span>
                                        <?php else: ?>
                                            <span style="color:var(--muted); font-weight:600; font-size:0.8rem;">● Draft</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="font-size:0.8rem; color:var(--muted);"><?= esc(date('d M Y', strtotime($konten['tanggal']))) ?></td>
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