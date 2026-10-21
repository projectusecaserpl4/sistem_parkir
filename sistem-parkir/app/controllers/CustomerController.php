<?php
class CustomerController extends Controller
{
    public function index(): void
    {
        requireLogin();
        $model = $this->model('Customer');
        $this->view('customers/index', ['title'=>'Data Customer', 'customers'=>$model->all()]);
    }

    public function create(): void
    {
        requireLogin();
        $this->view('customers/form', [
            'title'=>'Tambah Customer',
            'customer'=>null,
            'action'=>'create'
        ]);
    }

    public function store(): void
    {
        requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') $this->redirect('customers');

        $data = [
            'nama_customer'=>trim($_POST['nama_customer'] ?? ''),
            'nik'=>trim($_POST['nik'] ?? ''),
            'no_hp'=>trim($_POST['no_hp'] ?? ''),
            'alamat'=>trim($_POST['alamat'] ?? '')
        ];

        if ($data['nama_customer'] === '') {
            flash('error', 'Nama customer wajib diisi.');
            $this->redirect('customers/create');
        }

        try {
            $this->model('Customer')->create($data);
            flash('success', 'Customer berhasil ditambahkan.');
        } catch (PDOException $e) {
            flash('error', 'Gagal menambahkan customer. NIK mungkin sudah digunakan.');
        }
        $this->redirect('customers');
    }

    public function edit(): void
    {
        requireLogin();
        $id = (int)($_GET['id'] ?? 0);
        $customer = $this->model('Customer')->find($id);
        if (!$customer) $this->redirect('customers');

        $this->view('customers/form', [
            'title'=>'Edit Customer', 'customer'=>$customer, 'action'=>'edit'
        ]);
    }

    public function update(): void
    {
        requireLogin();
        $id = (int)($_GET['id'] ?? 0);
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') $this->redirect('customers');

        $data = [
            'nama_customer'=>trim($_POST['nama_customer'] ?? ''),
            'nik'=>trim($_POST['nik'] ?? ''),
            'no_hp'=>trim($_POST['no_hp'] ?? ''),
            'alamat'=>trim($_POST['alamat'] ?? '')
        ];

        try {
            $this->model('Customer')->update($id, $data);
            flash('success', 'Customer berhasil diubah.');
        } catch (PDOException $e) {
            flash('error', 'Gagal mengubah customer.');
        }
        $this->redirect('customers');
    }

    public function delete(): void
    {
        requireLogin();
        $id = (int)($_GET['id'] ?? 0);
        $ok = $this->model('Customer')->delete($id);
        flash($ok ? 'success' : 'error', $ok ? 'Customer berhasil dihapus.' : 'Customer tidak dapat dihapus karena masih digunakan.');
        $this->redirect('customers');
    }
}
