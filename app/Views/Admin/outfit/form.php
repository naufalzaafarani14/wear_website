<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= esc($pageTitle) ?> - WEAR</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
    <style>
        .select-box { width:100%; padding:0.65rem 0.85rem; border:1.5px solid var(--line); border-radius:10px; font-family:'Inter', sans-serif; font-size:0.9rem; }
        .checkbox-group { display:flex; flex-wrap:wrap; gap:0.75rem; padding:0.75rem; border:1.5px solid var(--line); border-radius:10px; max-height:260px; overflow-y:auto; }
        .checkbox-item { display:flex; align-items:center; gap:0.4rem; font-weight:500; font-size:0.85rem; }
        .item-badge { color:var(--muted); font-size:0.78rem; }
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
                <form method="post" action="<?= $outfit ? base_url('admin/outfit/update/' . $outfit['id_outfit']) : base_url('admin/outfit/store') ?>" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="field">
                        <label for="nama_outfit">Nama Outfit</label>
                        <input type="text" id="nama_outfit" name="nama_outfit" placeholder="Campus Casual" value="<?= esc(old('nama_outfit', $outfit['nama_outfit'] ?? '')) ?>" required>
                    </div>

                    <div class="field">
                        <label for="id_style">Style</label>
                        <?php $selectedStyle = old('id_style', $outfit['id_style'] ?? ''); ?>
                        <select id="id_style" name="id_style" required class="select-box">
                            <option value="">-- Pilih Style --</option>
                            <?php foreach ($styleList as $style): ?>
                                <option value="<?= esc($style['id_style']) ?>" <?= ($selectedStyle == $style['id_style']) ? 'selected' : '' ?>>
                                    <?= esc($style['nama_style']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="field">
                        <label for="gender">Gender</label>
                        <?php $selectedGender = old('gender', $outfit['gender'] ?? ''); ?>
                        <select id="gender" name="gender" required class="select-box">
                            <option value="">-- Pilih Gender --</option>
                            <option value="Wanita" <?= ($selectedGender === 'Wanita') ? 'selected' : '' ?>>Wanita</option>
                            <option value="Pria" <?= ($selectedGender === 'Pria') ? 'selected' : '' ?>>Pria</option>
                            <option value="Unisex" <?= ($selectedGender === 'Unisex') ? 'selected' : '' ?>>Unisex</option>
                        </select>
                    </div>

                    <div class="field">
                        <label>Item Fashion yang Digunakan <span style="font-weight:400; color:var(--muted);">(pilih minimal 2, hanya item Published yang muncul)</span></label>
                        <div class="checkbox-group">
                            <?php if (empty($itemList)): ?>
                                <span style="color:var(--muted); font-size:0.85rem;">Belum ada item fashion yang Published.</span>
                            <?php endif; ?>
                            <?php foreach ($itemList as $itemFashion): ?>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="item[]" value="<?= esc($itemFashion['id_item']) ?>" style="width:auto;" <?= in_array($itemFashion['id_item'], $selectedItem) ? 'checked' : '' ?>>
                                    <?= esc($itemFashion['nama_item']) ?>
                                    <span class="item-badge">— <?= esc($itemFashion['nama_subkategori'] ?? 'Tanpa subkategori') ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="field">
                        <label>Occasion</label>
                        <div class="checkbox-group" style="max-height:130px;">
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
                        <label>Warna Dominan</label>
                        <div class="checkbox-group" style="max-height:130px;">
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
                        <label for="budget">Estimasi Budget (Rp)</label>
                        <input type="number" id="budget" name="budget" step="0.01" placeholder="500000" value="<?= esc(old('budget', $outfit['budget'] ?? '')) ?>">
                    </div>

                    <div class="field">
                        <label for="tags">Tags (pisahkan dengan koma)</label>
                        <input type="text" id="tags" name="tags" placeholder="casual, campus, minimalis" value="<?= esc(old('tags', $outfit['tags'] ?? '')) ?>">
                    </div>

                    <div class="field">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" placeholder="Outfit kasual yang nyaman digunakan untuk aktivitas kuliah dan kegiatan sehari-hari."><?= esc(old('deskripsi', $outfit['deskripsi'] ?? '')) ?></textarea>
                    </div>

                    <div class="field">
                        <label for="tips">Tips Styling</label>
                        <textarea id="tips" name="tips" placeholder="Padukan dengan aksesori minimalis agar tampilan tetap clean."><?= esc(old('tips', $outfit['tips'] ?? '')) ?></textarea>
                    </div>

                    <div class="field">
                        <label for="gambar">Foto Cover Outfit <?= $outfit ? '(kosongkan jika tidak ingin ganti foto)' : '' ?></label>
                        <input type="file" id="gambar" name="gambar" accept="image/png, image/jpeg, image/webp">
                        <?php if ($outfit && ! empty($outfit['image_url'])): ?>
                            <div style="margin-top:0.75rem;">
                                <img src="<?= base_url($outfit['image_url']) ?>" alt="Cover saat ini" style="width:120px; height:120px; object-fit:cover; border-radius:10px; border:1px solid var(--line);">
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="field">
                        <label for="status">Status</label>
                        <?php $selectedStatus = old('status', $outfit['status'] ?? 'Draft'); ?>
                        <select id="status" name="status" required class="select-box">
                            <option value="Draft" <?= ($selectedStatus === 'Draft') ? 'selected' : '' ?>>Draft</option>
                            <option value="Published" <?= ($selectedStatus === 'Published') ? 'selected' : '' ?>>Published</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary"><?= $outfit ? 'Simpan Perubahan' : 'Tambah Outfit' ?></button>
                    <a href="<?= base_url('admin/outfit') ?>" class="btn btn-outline">Batal</a>
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>