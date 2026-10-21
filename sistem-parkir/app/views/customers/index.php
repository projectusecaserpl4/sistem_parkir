<?php require __DIR__ . '/../layouts/header.php'; require __DIR__ . '/../layouts/navbar.php'; ?>
<div class="app-layout">
<?php require __DIR__ . '/../layouts/sidebar.php'; ?>
<main class="content">
<div class="page-header">
    <div><h1>Data Customer</h1><p>Kelola pemilik kendaraan.</p></div>
    <a href="<?= BASE_URL ?>/customers/create" class="btn btn-primary">+ Tambah Customer</a>
</div>
<?php if($msg=flash('success')): ?><div class="alert alert-success"><?=e($msg)?></div><?php endif; ?>
<?php if($msg=flash('error')): ?><div class="alert alert-danger"><?=e($msg)?></div><?php endif; ?>
<div class="panel table-wrap">
<table>
<thead><tr><th>No</th><th>Nama</th><th>NIK</th><th>No. HP</th><th>Alamat</th><th>Aksi</th></tr></thead>
<tbody>
<?php foreach($customers as $i=>$row): ?>
<tr>
<td><?=$i+1?></td><td><?=e($row['nama_customer'])?></td><td><?=e($row['nik'])?></td>
<td><?=e($row['no_hp'])?></td><td><?=e($row['alamat'])?></td>
<td class="actions">
<a class="btn btn-warning btn-sm" href="<?=BASE_URL?>/customers/edit?id=<?=$row['id_customer']?>">Edit</a>
<a class="btn btn-danger btn-sm" href="<?=BASE_URL?>/customers/delete?id=<?=$row['id_customer']?>" onclick="return confirm('Hapus customer ini?')">Hapus</a>
</td>
</tr>
<?php endforeach; ?>
<?php if(!$customers): ?><tr><td colspan="6" class="empty">Belum ada data.</td></tr><?php endif; ?>
</tbody></table></div>
</main></div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
