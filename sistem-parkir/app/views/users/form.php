<?php require __DIR__ . '/../layouts/header.php'; require __DIR__ . '/../layouts/navbar.php'; ?>
<div class="app-layout"><?php require __DIR__ . '/../layouts/sidebar.php'; ?><main class="content">
<div class="page-header"><h1><?=e($title)?></h1></div><div class="panel form-panel">
<form method="POST" action="<?=BASE_URL?>/users/<?=$action==='create'?'store':'update?id='.$item['id_user']?>">
<div class="form-grid">
<div class="form-group"><label>Role *</label><select name="id_role" required><?php foreach($roles as $r):?><option value="<?=$r['id_role']?>" <?=((int)($item['id_role']??0)==$r['id_role']?'selected':'')?>><?=e($r['nama_role'])?></option><?php endforeach;?></select></div>
<div class="form-group"><label>Nama Lengkap *</label><input name="nama_lengkap" required value="<?=e($item['nama_lengkap']??'')?>"></div>
<div class="form-group"><label>Username *</label><input name="username" required value="<?=e($item['username']??'')?>"></div>
<div class="form-group"><label>Password <?=($action==='edit'?'(kosongkan jika tidak diubah)':'*')?></label><input type="password" name="password" <?=$action==='create'?'required':''?>></div>
<div class="form-group"><label>No. HP</label><input name="no_hp" value="<?=e($item['no_hp']??'')?>"></div>
<div class="form-group"><label>Status</label><select name="status"><option value="aktif" <?=($item['status']??'aktif')==='aktif'?'selected':''?>>Aktif</option><option value="nonaktif" <?=($item['status']??'')==='nonaktif'?'selected':''?>>Nonaktif</option></select></div>
</div><button class="btn btn-primary">Simpan</button> <a class="btn btn-secondary" href="<?=BASE_URL?>/users">Batal</a>
</form></div></main></div><?php require __DIR__ . '/../layouts/footer.php'; ?>
