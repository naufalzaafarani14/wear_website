<aside class="admin-sidebar">
    <div class="brand">wear<span>.</span> admin</div>

    <ul class="admin-nav">
        <li>
            <a href="<?= base_url('admin') ?>" class="<?= (current_url(true)->getPath() === 'admin') ? 'active' : '' ?>">
                Dashboard
            </a>
        </li>
        <li>
            <a href="<?= base_url('admin/kategori') ?>" class="<?= (strpos(current_url(), 'admin/kategori') !== false) ? 'active' : '' ?>">
                Kelola Kategori
            </a>
        </li>
        <li>
            <a href="<?= base_url('admin/subkategori-fashion') ?>" class="<?= (strpos(current_url(), 'admin/subkategori-fashion') !== false) ? 'active' : '' ?>">
                Subkategori Fashion
            </a>
        </li>
        <li>
            <a href="<?= base_url('admin/item-fashion') ?>" class="<?= (strpos(current_url(), 'admin/item-fashion') !== false) ? 'active' : '' ?>">
                Item Fashion
            </a>
        </li>
        <li>
            <a href="<?= base_url('admin/outfit') ?>" class="<?= (strpos(current_url(), 'admin/outfit') !== false) ? 'active' : '' ?>">
                Outfit
            </a>
        </li>
        <li>
            <a href="<?= base_url('admin/warna') ?>" class="<?= (strpos(current_url(), 'admin/warna') !== false && strpos(current_url(), 'warna-kulit') === false) ? 'active' : '' ?>">
                Warna
            </a>
        </li>
        <li>
            <a href="<?= base_url('admin/bentuk-tubuh') ?>" class="<?= (strpos(current_url(), 'admin/bentuk-tubuh') !== false) ? 'active' : '' ?>">
                Bentuk Tubuh
            </a>
        </li>
        <li>
            <a href="<?= base_url('admin/warna-kulit') ?>" class="<?= (strpos(current_url(), 'admin/warna-kulit') !== false) ? 'active' : '' ?>">
                Warna Kulit
            </a>
        </li>
        <li>
            <a href="<?= base_url('admin/occasion') ?>" class="<?= (strpos(current_url(), 'admin/occasion') !== false) ? 'active' : '' ?>">
                Occasion
            </a>
        </li>
        <li>
            <a href="<?= base_url('admin/brand') ?>" class="<?= (strpos(current_url(), 'admin/brand') !== false) ? 'active' : '' ?>">
                Brand
            </a>
        </li>
        <li>
            <a href="<?= base_url('admin/artikel') ?>" class="<?= (strpos(current_url(), 'admin/artikel') !== false) ? 'active' : '' ?>">
                Majalah / Artikel
            </a>
        </li>
        <li>
            <a href="<?= base_url('admin/moderasi-konten') ?>" class="<?= (strpos(current_url(), 'admin/moderasi-konten') !== false) ? 'active' : '' ?>">
                Moderasi Konten
            </a>
        </li>
        <li>
            <a href="<?= base_url('admin/pengguna') ?>" class="<?= (strpos(current_url(), 'admin/pengguna') !== false) ? 'active' : '' ?>">
                Kelola Pengguna
            </a>
        </li>
        <li><a href="<?= base_url('logout') ?>">Logout</a></li>
    </ul>
</aside>