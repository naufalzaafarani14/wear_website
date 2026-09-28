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
            <a href="<?= base_url('admin/pengguna') ?>" class="btn btn-outline btn-sm" style="margin-bottom:1.25rem;">← Kembali</a>

            <?php if (session()->getFlashdata('sukses')): ?>
                <div class="alert alert-success"><?= esc(session()->getFlashdata('sukses')) ?></div>
            <?php endif; ?>

            <div class="panel" style="max-width:640px;">
                <div class="panel-head">
                    <h2><?= esc($user['nama_lengkap']) ?></h2>
                </div>

                <p style="color:var(--muted); font-size:0.9rem; margin-bottom:1.5rem;"><?= esc($user['email']) ?></p>

                <form method="post" action="<?= base_url('admin/pengguna/update-role/' . $user['id_pengguna']) ?>" style="display:flex; gap:0.75rem; align-items:flex-end; margin-bottom:1.5rem; padding-bottom:1.5rem; border-bottom:1px solid var(--line);">
                    <?= csrf_field() ?>
                    <div class="field" style="margin:0; flex:1;">
                        <label for="role">Role</label>
                        <select id="role" name="role" style="width:100%; padding:0.65rem 0.85rem; border:1.5px solid var(--line); border-radius:10px; font-family:'Inter', sans-serif; font-size:0.9rem;">
                            <option value="user" <?= ($user['role'] === 'user') ? 'selected' : '' ?>>User</option>
                            <option value="admin" <?= ($user['role'] === 'admin') ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Role</button>
                </form>

                <h3 style="font-family:'Plus Jakarta Sans', sans-serif; font-size:0.95rem; margin-bottom:1rem;">Profil Fashion</h3>

                <?php if (! $profil): ?>
                    <p style="color:var(--muted); font-size:0.9rem;">Pengguna belum melengkapi profil fashion.</p>
                <?php else: ?>
                    <table class="admin-table">
                        <tbody>
                            <tr><td style="font-weight:600; width:180px;">Jenis Kelamin</td><td><?= esc($profil['jenis_kelamin'] ?? '-') ?></td></tr>
                            <tr><td style="font-weight:600;">Tinggi Badan</td><td><?= esc($profil['tinggi_badan'] ?? '-') ?> cm</td></tr>
                            <tr><td style="font-weight:600;">Berat Badan</td><td><?= esc($profil['berat_badan'] ?? '-') ?> kg</td></tr>
                            <tr><td style="font-weight:600;">Bentuk Tubuh</td><td><?= esc($profil['nama_bentuk'] ?? '-') ?></td></tr>
                            <tr><td style="font-weight:600;">Warna Kulit</td><td><?= esc($profil['nama_warna_kulit'] ?? '-') ?></td></tr>
                            <tr><td style="font-weight:600;">Style Favorit</td><td><?= esc($profil['nama_style'] ?? '-') ?></td></tr>
                            <tr><td style="font-weight:600;">Ukuran Baju</td><td><?= esc($profil['ukuran_baju'] ?? '-') ?></td></tr>
                            <tr><td style="font-weight:600;">Ukuran Celana</td><td><?= esc($profil['ukuran_celana'] ?? '-') ?></td></tr>
                        </tbody>
                    </table>
                <?php endif; ?>

                <form method="post" action="<?= base_url('admin/pengguna/delete/' . $user['id_pengguna']) ?>" style="margin-top:1.5rem;" onsubmit="return confirm('Yakin hapus pengguna ini? Semua data terkait akan ikut terhapus.')">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-outline" style="color:#c0295a; border-color:#ffd3e2;">Hapus Pengguna</button>
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>