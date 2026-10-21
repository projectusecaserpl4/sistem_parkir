<?php require __DIR__ . '/../layouts/header.php'; require __DIR__ . '/../layouts/navbar.php'; ?>
<div class="app-layout"><?php require __DIR__ . '/../layouts/sidebar.php'; ?><main class="content">
<div class="page-header"><h1><?=e($title)?></h1></div><div class="panel form-panel">
<form method="POST" action="<?=BASE_URL?>/parking-rates/<?=$action==='create'?'store':'update?id='.$item['id_tarif']?>">
<div class="form-grid">
<div class="form-group"><label>Jenis Kendaraan *</label><select name="id_jenis_kendaraan" required><option value="">- Pilih -</option><?php foreach($types as $t):?><option value="<?=$t['id_jenis_kendaraan']?>" <?=((int)($item['id_jenis_kendaraan']??0)==$t['id_jenis_kendaraan']?'selected':'')?>><?=e($t['nama_jenis'])?></option><?php endforeach;?></select></div>
<div class="form-group"><label>Tarif Per Jam *</label><input type="number" name="tarif_per_jam" min="0" step="500" required value="<?=e($item['tarif_per_jam']??0)?>"></div>
<div class="form-group"><label>Tarif Maksimal</label><input type="number" name="tarif_maksimal" min="0" step="500" value="<?=e($item['tarif_maksimal']??'')?>"></div>
<div class="form-group"><label>Berlaku Mulai</label><input type="datetime-local" name="berlaku_mulai" value="<?=!empty($item['berlaku_mulai']) ? date('Y-m-d\TH:i',strtotime($item['berlaku_mulai'])) : date('Y-m-d\TH:i')?>"></div>
<div class="form-group"><label>Status</label><select name="status"><option value="aktif" <?=($item['status']??'aktif')==='aktif'?'selected':''?>>Aktif</option><option value="nonaktif" <?=($item['status']??'')==='nonaktif'?'selected':''?>>Nonaktif</option></select></div>
</div><button class="btn btn-primary">Simpan</button> <a class="btn btn-secondary" href="<?=BASE_URL?>/parking-rates">Batal</a>
</form></div></main></div><?php require __DIR__ . '/../layouts/footer.php'; ?>
