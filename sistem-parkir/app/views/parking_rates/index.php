<?php require __DIR__ . '/../layouts/header.php'; require __DIR__ . '/../layouts/navbar.php'; ?>
<div class="app-layout"><?php require __DIR__ . '/../layouts/sidebar.php'; ?><main class="content">
<div class="page-header"><div><h1>Tarif Parkir</h1><p>Kelola tarif berdasarkan jenis kendaraan.</p></div><a href="<?=BASE_URL?>/parking-rates/create" class="btn btn-primary">+ Tambah Tarif</a></div>
<?php if($msg=flash('success')):?><div class="alert alert-success"><?=e($msg)?></div><?php endif;?>
<?php if($msg=flash('error')):?><div class="alert alert-danger"><?=e($msg)?></div><?php endif;?>
<div class="panel table-wrap"><table><thead><tr><th>No</th><th>Jenis</th><th>Per Jam</th><th>Maksimal</th><th>Berlaku Mulai</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
<?php foreach($items as $i=>$row):?><tr><td><?=$i+1?></td><td><?=e($row['nama_jenis'])?></td><td>Rp <?=number_format($row['tarif_per_jam'],0,',','.')?></td><td><?= $row['tarif_maksimal']!==null ? 'Rp '.number_format($row['tarif_maksimal'],0,',','.') : '-' ?></td><td><?=e($row['berlaku_mulai'])?></td><td><span class="badge"><?=e($row['status'])?></span></td><td class="actions"><a class="btn btn-warning btn-sm" href="<?=BASE_URL?>/parking-rates/edit?id=<?=$row['id_tarif']?>">Edit</a><a class="btn btn-danger btn-sm" href="<?=BASE_URL?>/parking-rates/delete?id=<?=$row['id_tarif']?>" onclick="return confirm('Hapus tarif ini?')">Hapus</a></td></tr><?php endforeach;?>
<?php if(!$items):?><tr><td colspan="7" class="empty">Belum ada data.</td></tr><?php endif;?>
</tbody></table></div></main></div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
