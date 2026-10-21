<?php
class VehicleController extends Controller
{
    private function formData(): array
    {
        return [
            'customers'=>$this->model('Customer')->all(),
            'types'=>$this->model('VehicleType')->all()
        ];
    }

    public function index(): void
    {
        requireLogin();
        $this->view('vehicles/index', [
            'title'=>'Data Kendaraan',
            'vehicles'=>$this->model('Vehicle')->all()
        ]);
    }

    public function create(): void
    {
        requireLogin();
        $this->view('vehicles/form', array_merge(
            ['title'=>'Tambah Kendaraan','vehicle'=>null,'action'=>'create'],
            $this->formData()
        ));
    }

    public function store(): void
    {
        requireLogin();
        $data=$this->input();
        try {
            $this->model('Vehicle')->create($data);
            flash('success','Kendaraan berhasil ditambahkan.');
        } catch(PDOException $e) {
            flash('error','Gagal menambahkan kendaraan. Nomor polisi mungkin sudah digunakan.');
        }
        $this->redirect('vehicles');
    }

    public function edit(): void
    {
        requireLogin();
        $id=(int)($_GET['id']??0);
        $vehicle=$this->model('Vehicle')->find($id);
        if(!$vehicle) $this->redirect('vehicles');
        $this->view('vehicles/form', array_merge(
            ['title'=>'Edit Kendaraan','vehicle'=>$vehicle,'action'=>'edit'],
            $this->formData()
        ));
    }

    public function update(): void
    {
        requireLogin();
        $id=(int)($_GET['id']??0);
        try {
            $this->model('Vehicle')->update($id,$this->input());
            flash('success','Kendaraan berhasil diubah.');
        } catch(PDOException $e) {
            flash('error','Gagal mengubah kendaraan.');
        }
        $this->redirect('vehicles');
    }

    public function delete(): void
    {
        requireLogin();
        $id=(int)($_GET['id']??0);
        $ok=$this->model('Vehicle')->delete($id);
        flash($ok?'success':'error',$ok?'Kendaraan berhasil dihapus.':'Kendaraan masih memiliki transaksi dan tidak dapat dihapus.');
        $this->redirect('vehicles');
    }

    private function input(): array
    {
        return [
            'id_customer'=>(int)($_POST['id_customer']??0),
            'id_jenis_kendaraan'=>(int)($_POST['id_jenis_kendaraan']??0),
            'nomor_polisi'=>trim($_POST['nomor_polisi']??''),
            'merk'=>trim($_POST['merk']??''),
            'model'=>trim($_POST['model']??''),
            'warna'=>trim($_POST['warna']??''),
            'tahun'=>trim($_POST['tahun']??''),
            'status'=>$_POST['status']??'aktif'
        ];
    }
}
