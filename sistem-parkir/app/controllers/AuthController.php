<?php

class AuthController extends Controller
{
    public function login(): void
    {
        if (isLoggedIn()) {
            $this->redirect('dashboard');
        }

        $this->view('auth/login');
    }

    public function authenticate(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('login');
        }

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '' || $password === '') {
            flash('error', 'Username dan password wajib diisi.');
            $this->redirect('login');
        }

        $userModel = $this->model('User');
        $user = $userModel->findByUsername($username);

        // Mendukung password_hash() dan sementara mendukung password plaintext
        // untuk data awal proyek.
        $validPassword = $user &&
            (password_verify($password, $user['password']) ||
             hash_equals((string) $user['password'], $password));

        if (!$validPassword || $user['status'] !== 'aktif') {
            flash('error', 'Username atau password salah.');
            $this->redirect('login');
        }

        session_regenerate_id(true);

        $_SESSION['user'] = [
            'id_user' => $user['id_user'],
            'nama_lengkap' => $user['nama_lengkap'],
            'username' => $user['username'],
            'nama_role' => $user['nama_role'],
        ];

        $this->redirect('dashboard');
    }

    public function logout(): void
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();

        header('Location: ' . BASE_URL . '/login');
        exit;
    }
}
