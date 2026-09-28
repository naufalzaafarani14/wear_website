<div class="admin-topbar">
    <h1><?= esc($pageTitle ?? 'Dashboard') ?></h1>
    <div class="admin-user">
        <div class="avatar"><?= strtoupper(substr(session()->get('nama_lengkap') ?? 'A', 0, 1)) ?></div>
        <span><?= esc(session()->get('nama_lengkap')) ?></span>
    </div>
</div>