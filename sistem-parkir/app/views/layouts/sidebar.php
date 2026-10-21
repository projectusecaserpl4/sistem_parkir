<?php if (isLoggedIn()): ?>
<?php $role = currentRole(); ?>
<aside class="sidebar sidebar-<?= e($role) ?>">
    <div class="sidebar-heading">
        <span class="sidebar-mark">SP</span>
        <div><strong><?= e(ucfirst($role)) ?></strong><small>Panel <?= e(ucfirst($role)) ?></small></div>
    </div>
    <a href="<?= BASE_URL ?>/dashboard" class="menu-title">Dashboard</a>
    <?php if (in_array($role, ['owner', 'admin'], true)): ?>
        <div class="menu-section">Master Data</div>
        <a href="<?= BASE_URL ?>/customers">Customer</a>
        <a href="<?= BASE_URL ?>/vehicles">Kendaraan</a>
        <a href="<?= BASE_URL ?>/vehicle-types">Jenis Kendaraan</a>
        <a href="<?= BASE_URL ?>/parking-areas">Area Parkir</a>
        <a href="<?= BASE_URL ?>/parking-slots">Slot Parkir</a>
        <a href="<?= BASE_URL ?>/parking-rates">Tarif Parkir</a>
        <a href="<?= BASE_URL ?>/users">User & Hak Akses</a>
    <?php endif; ?>
    <div class="menu-section">Operasional</div>
    <a href="<?= BASE_URL ?>/parking-entries">Kendaraan Masuk</a>
    <a href="<?= BASE_URL ?>/parking-exits">Kendaraan Keluar</a>
    <a href="<?= BASE_URL ?>/parking-payments">Pembayaran</a>
    <?php if ($role === 'admin'): ?>
        <div class="menu-section">Monitoring & Laporan</div>
        <a href="<?= BASE_URL ?>/parking-history">Aktivitas Parkir</a>
        <a href="<?= BASE_URL ?>/rekap-transaksi">Rekap Transaksi</a>
    <?php endif; ?>
</aside>
<?php endif; ?>
