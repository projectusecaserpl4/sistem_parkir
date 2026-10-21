<?php require __DIR__ . '/../layouts/header.php'; require __DIR__ . '/../layouts/navbar.php'; ?>
<div class="app-layout"><?php require __DIR__ . '/../layouts/sidebar.php'; ?><main class="content">
<div class="page-header"><h1><?=e($title)?></h1></div>
<div class="panel form-panel"><form method="POST" action="<?=BASE_URL?>/vehicle-types/<?=$action==='create'?'store':'update?id='.$item['id_jenis_kendaraan']?>">
<div class="form-group"><label>Nama Jenis *</label><input name="nama_jenis" required value="<?=e($item['nama_jenis']??'')?>"></div>
<div class="form-group"><label>Deskripsi</label><textarea name="deskripsi"><?=e($item['deskripsi']??'')?></textarea></div>
<button class="btn btn-primary">Simpan</button> <a class="btn btn-secondary" href="<?=BASE_URL?>/vehicle-types">Batal</a>
</form></div></main></div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
