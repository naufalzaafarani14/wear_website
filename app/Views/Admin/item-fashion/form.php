<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= esc($pageTitle) ?> - WEAR</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
    <style>
        .select-box { width:100%; padding:0.65rem 0.85rem; border:1.5px solid var(--line); border-radius:10px; font-family:'Inter', sans-serif; font-size:0.9rem; }
        .checkbox-group { display:flex; flex-wrap:wrap; gap:0.75rem; padding:0.75rem; border:1.5px solid var(--line); border-radius:10px; }
        .checkbox-item { display:flex; align-items:center; gap:0.4rem; font-weight:500; font-size:0.85rem; }
    </style>
</head>
<body>
<div class="admin-layout">
    <?= view('admin/partials/sidebar') ?>

    <main class="admin-main">
        <?= view('admin/partials/topbar', ['pageTitle' => $pageTitle]) ?>

        <div class="admin-content">
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul style="margin:0; padding-left:1.2rem;">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="panel">
                <form method="post" action="<?= $item ? base_url('admin/item-fashion/update/' . $item['id_item']) : base_url('admin/item-fashion/store') ?>" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="field">
                        <label for="nama_item">Nama Item</label>
                        <input type="text" id="nama_item" name="nama_item" value="<?= esc(old('nama_item', $item['nama_item'] ?? '')) ?>" required>
                    </div>

                    <div class="field">
                        <label for="id_subkategori">Subkategori</label>
                        <?php $selectedSub = old('id_subkategori', $item['id_subkategori'] ?? ''); ?>
                        <select id="id_subkategori" name="id_subkategori" required class="select-box">
                            <option value="">-- Pilih Subkategori --</option>
                            <?php foreach ($subkategoriList as $sub): ?>
                                <option value="<?= esc($sub['id_subkategori']) ?>" <?= ($selectedSub == $sub['id_subkategori']) ? 'selected' : '' ?>>
                                    <?= esc($sub['nama_subkategori']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="field">
                        <label for="id_style">Style</label>
                        <?php $selectedStyle = old('id_style', $item['id_style'] ?? ''); ?>
                        <select id="id_style" name="id_style" class="select-box">
                            <option value="">-- Pilih Style (opsional) --</option>
                            <?php foreach ($styleList as $style): ?>
                                <option value="<?= esc($style['id_style']) ?>" <?= ($selectedStyle == $style['id_style']) ? 'selected' : '' ?>>
                                    <?= esc($style['nama_style']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="field">
                        <label for="jenis_item">Jenis Item</label>
                        <input type="text" id="jenis_item" name="jenis_item" placeholder="Kaos, Kemeja, Rok, dll" value="<?= esc(old('jenis_item', $item['jenis_item'] ?? '')) ?>">
                    </div>

                    <div class="field">
                        <label for="gender">Gender</label>
                        <?php $selectedGender = old('gender', $item['gender'] ?? ''); ?>
                        <select id="gender" name="gender" class="select-box">
                            <option value="">-- Pilih Gender --</option>
                            <option value="Pria" <?= ($selectedGender === 'Pria') ? 'selected' : '' ?>>Pria</option>
                            <option value="Wanita" <?= ($selectedGender === 'Wanita') ? 'selected' : '' ?>>Wanita</option>
                            <option value="Unisex" <?= ($selectedGender === 'Unisex') ? 'selected' : '' ?>>Unisex</option>
                        </select>
                    </div>

                    <div class="field">
                        <label>Warna Tersedia</label>
                        <div class="checkbox-group">
                            <?php foreach ($warnaList as $warna): ?>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="warna[]" value="<?= esc($warna['id_warna']) ?>" style="width:auto;" <?= in_array($warna['id_warna'], $selectedWarna) ? 'checked' : '' ?>>
                                    <?php if (! empty($warna['kode_hex'])): ?>
                                        <span style="display:inline-block; width:12px; height:12px; border-radius:3px; background:<?= esc($warna['kode_hex']) ?>; border:1px solid var(--line);"></span>
                                    <?php endif; ?>
                                    <?= esc($warna['nama_warna']) ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="field">
                        <label>Occasion</label>
                        <div class="checkbox-group">
                            <?php if (empty($occasionList)): ?>
                                <span style="color:var(--muted); font-size:0.85rem;">Belum ada data occasion.</span>
                            <?php endif; ?>
                            <?php foreach ($occasionList as $occ): ?>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="occasion[]" value="<?= esc($occ['id']) ?>" style="width:auto;" <?= in_array($occ['id'], $selectedOccasion) ? 'checked' : '' ?>>
                                    <?= esc($occ['nama']) ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="field">
                        <label for="status">Status</label>
                        <?php $selectedStatus = old('status', $item['status'] ?? 'Draft'); ?>
                        <select id="status" name="status" required class="select-box">
                            <option value="Draft" <?= ($selectedStatus === 'Draft') ? 'selected' : '' ?>>Draft</option>
                            <option value="Published" <?= ($selectedStatus === 'Published') ? 'selected' : '' ?>>Published</option>
                        </select>
                    </div>

                    <div class="field">
                        <label for="tags">Tags (pisahkan dengan koma)</label>
                        <input type="text" id="tags" name="tags" placeholder="casual, summer, cotton" value="<?= esc(old('tags', $item['tags'] ?? '')) ?>">
                    </div>

                    <div class="field">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi"><?= esc(old('deskripsi', $item['deskripsi'] ?? '')) ?></textarea>
                    </div>

                    <div class="field">
                        <label for="gambar">Foto Item <?= $item ? '(kosongkan jika tidak ingin ganti foto)' : '' ?></label>
                        <input type="file" id="gambar" name="gambar" accept="image/png, image/jpeg, image/webp">
                        <?php if ($item && ! empty($item['image_url'])): ?>
                            <div style="margin-top:0.75rem;">
                                <img src="<?= base_url($item['image_url']) ?>" alt="Foto saat ini" style="width:100px; height:100px; object-fit:cover; border-radius:10px; border:1px solid var(--line);">
                            </div>
                        <?php endif; ?>
                    </div>

                    <hr style="border:none; border-top:1px solid var(--line); margin:1.5rem 0;">
                    <h3 style="font-family:'Plus Jakarta Sans', sans-serif; font-size:0.95rem; margin-bottom:1rem;">Info Brand & Harga (opsional)</h3>

                    <div class="field">
                        <label for="id_brand">Brand</label>
                        <?php $selectedBrand = old('id_brand', $produk['id_brand'] ?? ''); ?>
                        <select id="id_brand" name="id_brand" class="select-box">
                            <option value="">-- Tidak ada brand --</option>
                            <?php foreach ($brandList as $brand): ?>
                                <option value="<?= esc($brand['id_brand']) ?>" <?= ($selectedBrand == $brand['id_brand']) ? 'selected' : '' ?>>
                                    <?= esc($brand['nama_brand']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="field">
                        <label for="harga">Harga (Rp)</label>
                        <input type="number" id="harga" name="harga" step="0.01" placeholder="150000" value="<?= esc(old('harga', $produk['harga'] ?? '')) ?>">
                    </div>

                    <div class="field">
                        <label for="link_produk">Link Produk</label>
                        <input type="text" id="link_produk" name="link_produk" placeholder="https://..." value="<?= esc(old('link_produk', $produk['link_produk'] ?? '')) ?>">
                    </div>

                    <button type="submit" class="btn btn-primary"><?= $item ? 'Simpan Perubahan' : 'Tambah Item Fashion' ?></button>
                    <a href="<?= base_url('admin/item-fashion') ?>" class="btn btn-outline">Batal</a>
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>