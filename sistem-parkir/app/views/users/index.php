<?php require __DIR__ . '/../layouts/header.php'; require __DIR__ . '/../layouts/navbar.php'; ?>
<div class="app-layout"><?php require __DIR__ . '/../layouts/sidebar.php'; ?><main class="content">
<div class="page-header"><div><h1>Data User</h1><p>Kelola akun Admin, Petugas, dan Owner.</p></div><a href="<?=BASE_URL?>/users/create" class="btn btn-primary">+ Tambah User</a></div>
<?php if($msg=flash('success')):?><div class="alert alert-success"><?=e($msg)?></div><?php endif;?>
<?php if($msg=flash('error')):?><div class="alert alert-danger"><?=e($msg)?></div><?php endif;?>
<div class="panel table-wrap"><table><thead><tr><th>No</th><th>Nama</th><th>Username</th><th>Role</th><th>No. HP</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
<?php foreach($items as $i=>$row):?><tr><td><?=$i+1?></td><td><?=e($row['nama_lengkap'])?></td><td><?=e($row['username'])?></td><td><?=e($row['nama_role'])?></td><td><?=e($row['no_hp'])?></td><td><span class="badge"><?=e($row['status'])?></span></td><td class="actions"><a class="btn btn-warning btn-sm" href="<?=BASE_URL?>/users/edit?id=<?=$row['id_user']?>">Edit</a><a class="btn btn-danger btn-sm" href="<?=BASE_URL?>/users/delete?id=<?=$row['id_user']?>" onclick="return confirm('Hapus user ini?')">Hapus</a></td></tr><?php endforeach;?>
<?php if(!$items):?><tr><td colspan="7" class="empty">Belum ada data.</td></tr><?php endif;?>
</tbody></table></div></main></div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
