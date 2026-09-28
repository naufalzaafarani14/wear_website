<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Fashion App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-dark px-4">
    <span class="navbar-brand mb-0 h1">Fashion App</span>
    <a href="<?= base_url('logout') ?>" class="btn btn-outline-light btn-sm">Logout</a>
</nav>

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <h4>Selamat datang, <?= esc(session()->get('nama_lengkap')) ?> 👋</h4>
            <p class="mb-1">Email: <?= esc(session()->get('email')) ?></p>
            <p class="mb-0">Role: <?= esc(session()->get('role')) ?></p>
        </div>
    </div>
</div>
</body>
</html>