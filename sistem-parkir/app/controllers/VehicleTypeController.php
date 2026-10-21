<?php
class VehicleTypeController extends Controller
{
    public function index(): void
    {
        requireLogin();
        $this->view('vehicle_types/index', [
            'title'=>'Jenis Kendaraan',
            'items'=>$this->model('VehicleType')->all()
        ]);
    }

    public function create(): void
    {
        requireLogin();
        $this->view('vehicle_types/form', ['title'=>'Tambah Jenis Kendaraan','item'=>null,'action'=>'create']);
    }

    public function store(): void
    {
        requireLogin();
        $data = [
            'nama_jenis'=>trim($_POST['nama_jenis'] ?? ''),
            'deskripsi'=>trim($_POST['deskripsi'] ?? '')
        ];
        if ($data['nama_jenis'] === '') {
            flash('error','Nama jenis wajib diisi.');
            $this->redirect('vehicle-types/create');
        }
        try {
            $this->model('VehicleType')->create($data);
            flash('success','Jenis kendaraan berhasil ditambahkan.');
        } catch (PDOException $e) {
            flash('error','Gagal menambahkan jenis kendaraan.');
        }
        $this->redirect('vehicle-types');
    }

    public function edit(): void
    {
        requireLogin();
        $id=(int)($_GET['id']??0);
        $item=$this->model('VehicleType')->find($id);
        if(!$item) $this->redirect('vehicle-types');
        $this->view('vehicle_types/form',['title'=>'Edit Jenis Kendaraan','item'=>$item,'action'=>'edit']);
    }

    public function update(): void
    {
        requireLogin();
        $id=(int)($_GET['id']??0);
        $data=[
            'nama_jenis'=>trim($_POST['nama_jenis']??''),
            'deskripsi'=>trim($_POST['deskripsi']??'')
        ];
        try {
            $this->model('VehicleType')->update($id,$data);
            flash('success','Jenis kendaraan berhasil diubah.');
        } catch(PDOException $e) {
            flash('error','Gagal mengubah jenis kendaraan.');
        }
        $this->redirect('vehicle-types');
    }

    public function delete(): void
    {
        requireLogin();
        $id=(int)($_GET['id']??0);
        $ok=$this->model('VehicleType')->delete($id);
        flash($ok?'success':'error',$ok?'Jenis kendaraan berhasil dihapus.':'Jenis kendaraan masih digunakan dan tidak dapat dihapus.');
        $this->redirect('vehicle-types');
    }
}
