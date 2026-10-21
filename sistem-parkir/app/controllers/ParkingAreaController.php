<?php
class ParkingAreaController extends Controller
{
    public function index(): void
    {
        requireLogin();
        $this->view('parking_areas/index',[
            'title'=>'Area Parkir','items'=>$this->model('ParkingArea')->all()
        ]);
    }

    public function create(): void
    {
        requireLogin();
        $this->view('parking_areas/form',['title'=>'Tambah Area Parkir','item'=>null,'action'=>'create']);
    }

    public function store(): void
    {
        requireLogin();
        $data=$this->input();
        try {
            $this->model('ParkingArea')->create($data);
            flash('success','Area parkir berhasil ditambahkan.');
        } catch(PDOException $e) {
            flash('error','Gagal menambahkan area parkir.');
        }
        $this->redirect('parking-areas');
    }

    public function edit(): void
    {
        requireLogin();
        $id=(int)($_GET['id']??0);
        $item=$this->model('ParkingArea')->find($id);
        if(!$item) $this->redirect('parking-areas');
        $this->view('parking_areas/form',['title'=>'Edit Area Parkir','item'=>$item,'action'=>'edit']);
    }

    public function update(): void
    {
        requireLogin();
        $id=(int)($_GET['id']??0);
        try {
            $this->model('ParkingArea')->update($id,$this->input());
            flash('success','Area parkir berhasil diubah.');
        } catch(PDOException $e) {
            flash('error','Gagal mengubah area parkir.');
        }
        $this->redirect('parking-areas');
    }

    public function delete(): void
    {
        requireLogin();
        $id=(int)($_GET['id']??0);
        $ok=$this->model('ParkingArea')->delete($id);
        flash($ok?'success':'error',$ok?'Area parkir berhasil dihapus.':'Area masih memiliki slot dan tidak dapat dihapus.');
        $this->redirect('parking-areas');
    }

    private function input(): array
    {
        return [
            'nama_area'=>trim($_POST['nama_area']??''),
            'lokasi'=>trim($_POST['lokasi']??''),
            'kapasitas'=>(int)($_POST['kapasitas']??0),
            'status'=>$_POST['status']??'tersedia'
        ];
    }
}
