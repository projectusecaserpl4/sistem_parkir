<?php

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function isLoggedIn(): bool
{
    return isset($_SESSION['user']);
}

function requireLogin(): void
{
    if (!isLoggedIn()) {
        header('Location: ' . BASE_URL . '/login');
        exit;
    }
}

/**
 * Normalisasi role agar tetap cocok jika database menyimpan "Petugas",
 * "petugas", atau variasi kapitalisasi lainnya.
 */
function currentRole(): string
{
    return strtolower(trim((string) ($_SESSION['user']['nama_role'] ?? '')));
}

function requireRole(array $allowedRoles): void
{
    requireLogin();

    $allowed = array_map(
        static fn ($role) => strtolower(trim((string) $role)),
        $allowedRoles
    );

    if (!in_array(currentRole(), $allowed, true)) {
        http_response_code(403);
        $title = 'Akses Ditolak';
        require __DIR__ . '/../views/errors/403.php';
        exit;
    }
}

function flash(string $key, ?string $message = null): ?string
{
    if ($message !== null) {
        $_SESSION['_flash'][$key] = $message;
        return null;
    }

    $value = $_SESSION['_flash'][$key] ?? null;
    unset($_SESSION['_flash'][$key]);

    return $value;
}


/**
 * Hak akses per role:
 * - owner: fitur pemantauan/pengelolaan sesuai menu Owner, tanpa Aktivitas Parkir dan Rekap Transaksi
 * - admin: master data, operasional, Aktivitas Parkir, dan Rekap Transaksi
 * - petugas: transaksi operasional saja
 */
function authorizeRoute(string $method, string $path): void
{
    if (!isLoggedIn() || $path === '/login' || $path === '/logout') {
        return;
    }

    $role = currentRole();

    // Aktivitas Parkir dan Rekap Transaksi khusus ADMIN.
    if (in_array($path, ['/parking-history', '/rekap-transaksi'], true) && $role !== 'admin') {
        http_response_code(403);
        $title = 'Akses Ditolak';
        require __DIR__ . '/../views/errors/403.php';
        exit;
    }

    if ($role === 'owner') {
        return; // Owner dapat mengakses seluruh modul.
    }

    if ($role === 'admin') {
        return; // Admin mengelola data dan operasional.
    }

    $petugasRoutes = [
        '/dashboard',
        '/parking-entries',
        '/parking-entries/create',
        '/parking-entries/slots',
        '/parking-entries/store',
        '/parking-exits',
        '/parking-exits/create',
        '/parking-exits/store',
        '/parking-payments',
        '/parking-payments/create',
        '/parking-payments/store',
        '/parking-payments/receipt',
        '/parking-history',
    ];

    if ($role === 'petugas' && in_array($path, $petugasRoutes, true)) {
        return;
    }

    http_response_code(403);
    $title = 'Akses Ditolak';
    require __DIR__ . '/../views/errors/403.php';
    exit;
}
