<?php
class UserController extends Controller
{
    public function index(): void
    {
        requireLogin();
        $this->view('users/index',[
            'title'=>'Data User','items'=>$this->model('User')->all()
        ]);
    }

    public function create(): void
    {
        requireLogin();
        $this->view('users/form',[
            'title'=>'Tambah User','item'=>null,'action'=>'create',
            'roles'=>$this->model('Role')->all()
        ]);
    }

    public function store(): void
    {
        requireLogin();
        $data=$this->input();
        if ($data['password']==='') {
            flash('error','Password wajib diisi.');
            $this->redirect('users/create');
        }
        try {
            $this->model('User')->create($data);
            flash('success','User berhasil ditambahkan.');
        } catch(PDOException $e) {
            flash('error','Gagal menambahkan user. Username mungkin sudah digunakan.');
        }
        $this->redirect('users');
    }

    public function edit(): void
    {
        requireLogin();
        $id=(int)($_GET['id']??0);
        $item=$this->model('User')->find($id);
        if(!$item) $this->redirect('users');
        $this->view('users/form',[
            'title'=>'Edit User','item'=>$item,'action'=>'edit',
            'roles'=>$this->model('Role')->all()
        ]);
    }

    public function update(): void
    {
        requireLogin();
        $id=(int)($_GET['id']??0);
        try {
            $this->model('User')->update($id,$this->input());
            flash('success','User berhasil diubah.');
        } catch(PDOException $e) {
            flash('error','Gagal mengubah user.');
        }
        $this->redirect('users');
    }

    public function delete(): void
    {
        requireLogin();
        $id=(int)($_GET['id']??0);
        if ($id === (int)$_SESSION['user']['id_user']) {
            flash('error','Anda tidak dapat menghapus akun yang sedang digunakan.');
            $this->redirect('users');
        }
        $ok=$this->model('User')->delete($id);
        flash($ok?'success':'error',$ok?'User berhasil dihapus.':'User tidak dapat dihapus karena masih memiliki data transaksi.');
        $this->redirect('users');
    }

    private function input(): array
    {
        return [
            'id_role'=>(int)($_POST['id_role']??0),
            'nama_lengkap'=>trim($_POST['nama_lengkap']??''),
            'username'=>trim($_POST['username']??''),
            'password'=>$_POST['password']??'',
            'no_hp'=>trim($_POST['no_hp']??''),
            'status'=>$_POST['status']??'aktif'
        ];
    }
}
