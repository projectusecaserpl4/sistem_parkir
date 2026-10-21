<?php require __DIR__ . '/../layouts/header.php'; require __DIR__ . '/../layouts/navbar.php'; ?>
<div class="app-layout"><?php require __DIR__ . '/../layouts/sidebar.php'; ?>
<main class="content">
<div class="page-header"><div><h1><?=e($title)?></h1></div></div>
<div class="panel form-panel">
<form method="POST" action="<?=BASE_URL?>/customers/<?=$action==='create'?'store':'update?id=' . $customer['id_customer']?>">
<div class="form-grid">
<div class="form-group"><label>Nama Customer *</label><input name="nama_customer" required value="<?=e($customer['nama_customer']??'')?>"></div>
<div class="form-group"><label>NIK</label><input name="nik" value="<?=e($customer['nik']??'')?>"></div>
<div class="form-group"><label>No. HP</label><input name="no_hp" value="<?=e($customer['no_hp']??'')?>"></div>
<div class="form-group full"><label>Alamat</label><textarea name="alamat"><?=e($customer['alamat']??'')?></textarea></div>
</div>
<button class="btn btn-primary">Simpan</button>
<a href="<?=BASE_URL?>/customers" class="btn btn-secondary">Batal</a>
</form></div></main></div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
