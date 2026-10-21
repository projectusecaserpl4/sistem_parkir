<?php require __DIR__ . '/../layouts/header.php'; require __DIR__ . '/../layouts/navbar.php'; ?>
<div class="app-layout"><?php require __DIR__ . '/../layouts/sidebar.php'; ?><main class="content">
<div class="page-header"><h1><?=e($title)?></h1></div><div class="panel form-panel">
<form method="POST" action="<?=BASE_URL?>/parking-slots/<?=$action==='create'?'store':'update?id='.$item['id_slot']?>">
<div class="form-grid">
<div class="form-group"><label>Area *</label><select name="id_area" required><option value="">- Pilih Area -</option><?php foreach($areas as $a):?><option value="<?=$a['id_area']?>" <?=((int)($item['id_area']??0)==$a['id_area']?'selected':'')?>><?=e($a['nama_area'])?></option><?php endforeach;?></select></div>
<div class="form-group"><label>Kode Slot *</label><input name="kode_slot" required value="<?=e($item['kode_slot']??'')?>" placeholder="M-A01"></div>
<div class="form-group"><label>Jenis Kendaraan *</label><select name="jenis_kendaraan"><option value="motor" <?=($item['jenis_kendaraan']??'motor')==='motor'?'selected':''?>>Motor</option><option value="mobil" <?=($item['jenis_kendaraan']??'')==='mobil'?'selected':''?>>Mobil</option><option value="lainnya" <?=($item['jenis_kendaraan']??'')==='lainnya'?'selected':''?>>Lainnya</option></select></div>
<div class="form-group"><label>Status</label><select name="status"><option value="kosong" <?=($item['status']??'kosong')==='kosong'?'selected':''?>>Kosong</option><option value="terisi" <?=($item['status']??'')==='terisi'?'selected':''?>>Terisi</option><option value="rusak" <?=($item['status']??'')==='rusak'?'selected':''?>>Rusak</option></select></div>
</div><button class="btn btn-primary">Simpan</button> <a class="btn btn-secondary" href="<?=BASE_URL?>/parking-slots">Batal</a>
</form></div></main></div><?php require __DIR__ . '/../layouts/footer.php'; ?>
