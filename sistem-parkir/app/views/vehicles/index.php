<?php require __DIR__ . '/../layouts/header.php'; require __DIR__ . '/../layouts/navbar.php'; ?>
<div class="app-layout"><?php require __DIR__ . '/../layouts/sidebar.php'; ?><main class="content">
<div class="page-header"><div><h1>Data Kendaraan</h1><p>Kelola kendaraan milik customer.</p></div><a href="<?=BASE_URL?>/vehicles/create" class="btn btn-primary">+ Tambah Kendaraan</a></div>
<?php if($msg=flash('success')):?><div class="alert alert-success"><?=e($msg)?></div><?php endif;?>
<?php if($msg=flash('error')):?><div class="alert alert-danger"><?=e($msg)?></div><?php endif;?>
<div class="panel table-wrap"><table><thead><tr><th>No</th><th>No. Polisi</th><th>Pemilik</th><th>Jenis</th><th>Merk/Model</th><th>Warna</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
<?php foreach($vehicles as $i=>$row):?><tr><td><?=$i+1?></td><td><strong><?=e($row['nomor_polisi'])?></strong></td><td><?=e($row['nama_customer'])?></td><td><?=e($row['nama_jenis'])?></td><td><?=e(trim($row['merk'].' '.$row['model']))?></td><td><?=e($row['warna'])?></td><td><span class="badge"><?=e($row['status'])?></span></td><td class="actions"><a class="btn btn-warning btn-sm" href="<?=BASE_URL?>/vehicles/edit?id=<?=$row['id_vehicle']?>">Edit</a><a class="btn btn-danger btn-sm" href="<?=BASE_URL?>/vehicles/delete?id=<?=$row['id_vehicle']?>" onclick="return confirm('Hapus kendaraan ini?')">Hapus</a></td></tr><?php endforeach;?>
<?php if(!$vehicles):?><tr><td colspan="8" class="empty">Belum ada data.</td></tr><?php endif;?>
</tbody></table></div></main></div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
