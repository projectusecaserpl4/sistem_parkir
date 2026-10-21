<?php require __DIR__ . '/../layouts/header.php'; require __DIR__ . '/../layouts/navbar.php'; ?>
<div class="app-layout"><?php require __DIR__ . '/../layouts/sidebar.php'; ?><main class="content">
<div class="page-header"><h1><?=e($title)?></h1></div><div class="panel form-panel">
<form method="POST" action="<?=BASE_URL?>/parking-areas/<?=$action==='create'?'store':'update?id='.$item['id_area']?>">
<div class="form-grid">
<div class="form-group"><label>Nama Area *</label><input name="nama_area" required value="<?=e($item['nama_area']??'')?>"></div>
<div class="form-group"><label>Lokasi</label><input name="lokasi" value="<?=e($item['lokasi']??'')?>"></div>
<div class="form-group"><label>Kapasitas *</label><input type="number" name="kapasitas" min="0" required value="<?=e($item['kapasitas']??0)?>"></div>
<div class="form-group"><label>Status</label><select name="status"><option value="tersedia" <?=($item['status']??'tersedia')==='tersedia'?'selected':''?>>Tersedia</option><option value="ditutup" <?=($item['status']??'')==='ditutup'?'selected':''?>>Ditutup</option></select></div>
</div><button class="btn btn-primary">Simpan</button> <a class="btn btn-secondary" href="<?=BASE_URL?>/parking-areas">Batal</a>
</form></div></main></div><?php require __DIR__ . '/../layouts/footer.php'; ?>
