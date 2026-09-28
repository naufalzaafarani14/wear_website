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
            <div class="panel" style="max-width:640px; margin:0 auto;">
                <a href="<?= base_url('admin/moderasi-konten') ?>" class="btn btn-outline btn-sm" style="margin-bottom:1.25rem;">← Kembali</a>

                <?php if ($item['tipe_media'] === 'Video'): ?>
                    <video src="<?= base_url($item['media_url']) ?>" controls style="width:100%; border-radius:14px; margin-bottom:1.5rem;"></video>
                <?php else: ?>
                    <img src="<?= base_url($item['media_url']) ?>" alt="Postingan" style="width:100%; max-height:400px; object-fit:cover; border-radius:14px; margin-bottom:1.5rem;">
                <?php endif; ?>

                <p style="font-size:0.95rem; margin-bottom:1rem;"><?= esc($item['caption'] ?? '-') ?></p>

                <div style="display:flex; flex-direction:column; gap:0.4rem; font-size:0.85rem; color:var(--muted); border-top:1px solid var(--line); padding-top:1rem; margin-bottom:1.5rem;">
                    <span><strong>Channel:</strong> <?= esc($item['nama_channel'] ?? '-') ?></span>
                    <span><strong>User:</strong> <?= esc($item['nama_lengkap'] ?? '-') ?> (<?= esc($item['email'] ?? '-') ?>)</span>
                    <?php if (! empty($item['nama_outfit'])): ?>
                        <span><strong>Outfit yang di-tag:</strong> <?= esc($item['nama_outfit']) ?></span>
                    <?php endif; ?>
                    <span><strong>Tanggal:</strong> <?= esc(date('d F Y, H:i', strtotime($item['created_at']))) ?></span>
                    <span><strong>Status saat ini:</strong> <?= esc($item['status']) ?></span>
                    <?php if (! empty($item['catatan_moderasi'])): ?>
                        <span><strong>Catatan moderasi sebelumnya:</strong> <?= esc($item['catatan_moderasi']) ?></span>
                    <?php endif; ?>
                </div>

                <?php if ($item['status'] !== 'Published'): ?>
                    <form method="post" action="<?= base_url('admin/moderasi-konten/approve/' . $item['id_postingan']) ?>" style="display:inline;">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-primary">✓ Setujui & Tayangkan</button>
                    </form>
                <?php endif; ?>

                <?php if ($item['status'] !== 'Ditolak'): ?>
                    <form method="post" action="<?= base_url('admin/moderasi-konten/reject/' . $item['id_postingan']) ?>" style="margin-top:1rem;">
                        <?= csrf_field() ?>
                        <div class="field">
                            <label for="catatan_moderasi">Alasan penolakan (opsional, akan dilihat user)</label>
                            <textarea id="catatan_moderasi" name="catatan_moderasi" placeholder="Contoh: Gambar tidak sesuai pedoman komunitas"></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger">✕ Tolak Postingan</button>
                    </form>
                <?php endif; ?>

                <form method="post" action="<?= base_url('admin/moderasi-konten/delete/' . $item['id_postingan']) ?>" style="margin-top:1rem;" onsubmit="return confirm('Yakin hapus permanen? Tindakan ini tidak bisa dibatalkan.')">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-outline" style="color:#c0295a; border-color:#ffd3e2;">Hapus Permanen</button>
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>