<?php require __DIR__ . '/../layouts/header.php'; require __DIR__ . '/../layouts/navbar.php'; ?>
<div class="app-layout"><?php require __DIR__ . '/../layouts/sidebar.php'; ?><main class="content">
<div class="page-header"><h1><?=e($title)?></h1></div>
<div class="panel form-panel"><form method="POST" action="<?=BASE_URL?>/vehicles/<?=$action==='create'?'store':'update?id='.$vehicle['id_vehicle']?>">
<div class="form-grid">
<div class="form-group"><label>Pemilik *</label><select name="id_customer" required><option value="">- Pilih Customer -</option><?php foreach($customers as $c):?><option value="<?=$c['id_customer']?>" <?=((int)($vehicle['id_customer']??0)==$c['id_customer']?'selected':'')?>><?=e($c['nama_customer'])?></option><?php endforeach;?></select></div>
<div class="form-group"><label>Jenis Kendaraan *</label><select name="id_jenis_kendaraan" required><option value="">- Pilih Jenis -</option><?php foreach($types as $t):?><option value="<?=$t['id_jenis_kendaraan']?>" <?=((int)($vehicle['id_jenis_kendaraan']??0)==$t['id_jenis_kendaraan']?'selected':'')?>><?=e($t['nama_jenis'])?></option><?php endforeach;?></select></div>
<div class="form-group"><label>Nomor Polisi *</label><input name="nomor_polisi" required value="<?=e($vehicle['nomor_polisi']??'')?>" placeholder="D 1234 AB"></div>
<div class="form-group"><label>Merk</label><input name="merk" value="<?=e($vehicle['merk']??'')?>"></div>
<div class="form-group"><label>Model</label><input name="model" value="<?=e($vehicle['model']??'')?>"></div>
<div class="form-group"><label>Warna</label><input name="warna" value="<?=e($vehicle['warna']??'')?>"></div>
<div class="form-group"><label>Tahun</label><input type="number" name="tahun" min="1900" max="<?=date('Y')+1?>" value="<?=e($vehicle['tahun']??'')?>"></div>
<div class="form-group"><label>Status</label><select name="status"><option value="aktif" <?=($vehicle['status']??'aktif')==='aktif'?'selected':''?>>Aktif</option><option value="nonaktif" <?=($vehicle['status']??'')==='nonaktif'?'selected':''?>>Nonaktif</option></select></div>
</div><button class="btn btn-primary">Simpan</button> <a class="btn btn-secondary" href="<?=BASE_URL?>/vehicles">Batal</a>
</form></div></main></div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
