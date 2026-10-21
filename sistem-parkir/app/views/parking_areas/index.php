<?php require __DIR__ . '/../layouts/header.php'; require __DIR__ . '/../layouts/navbar.php'; ?>
<div class="app-layout"><?php require __DIR__ . '/../layouts/sidebar.php'; ?><main class="content">
<div class="page-header"><div><h1>Area Parkir</h1><p>Kelola lokasi area parkir.</p></div><a href="<?=BASE_URL?>/parking-areas/create" class="btn btn-primary">+ Tambah Area</a></div>
<?php if($msg=flash('success')):?><div class="alert alert-success"><?=e($msg)?></div><?php endif;?>
<?php if($msg=flash('error')):?><div class="alert alert-danger"><?=e($msg)?></div><?php endif;?>
<div class="panel table-wrap"><table><thead><tr><th>No</th><th>Nama Area</th><th>Lokasi</th><th>Kapasitas</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
<?php foreach($items as $i=>$row):?><tr><td><?=$i+1?></td><td><?=e($row['nama_area'])?></td><td><?=e($row['lokasi'])?></td><td><?=e($row['kapasitas'])?></td><td><span class="badge"><?=e($row['status'])?></span></td><td class="actions"><a class="btn btn-warning btn-sm" href="<?=BASE_URL?>/parking-areas/edit?id=<?=$row['id_area']?>">Edit</a><a class="btn btn-danger btn-sm" href="<?=BASE_URL?>/parking-areas/delete?id=<?=$row['id_area']?>" onclick="return confirm('Hapus area ini?')">Hapus</a></td></tr><?php endforeach;?>
<?php if(!$items):?><tr><td colspan="6" class="empty">Belum ada data.</td></tr><?php endif;?>
</tbody></table></div></main></div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
