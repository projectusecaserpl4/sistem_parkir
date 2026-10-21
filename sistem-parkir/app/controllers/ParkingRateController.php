<?php
class ParkingRateController extends Controller
{
    public function index(): void
    {
        requireLogin();
        $this->view('parking_rates/index',[
            'title'=>'Tarif Parkir','items'=>$this->model('ParkingRate')->all()
        ]);
    }

    public function create(): void
    {
        requireLogin();
        $this->view('parking_rates/form',[
            'title'=>'Tambah Tarif','item'=>null,'action'=>'create',
            'types'=>$this->model('VehicleType')->all()
        ]);
    }

    public function store(): void
    {
        requireLogin();
        try {
            $this->model('ParkingRate')->create($this->input());
            flash('success','Tarif berhasil ditambahkan.');
        } catch(PDOException $e) {
            flash('error','Gagal menambahkan tarif.');
        }
        $this->redirect('parking-rates');
    }

    public function edit(): void
    {
        requireLogin();
        $id=(int)($_GET['id']??0);
        $item=$this->model('ParkingRate')->find($id);
        if(!$item) $this->redirect('parking-rates');
        $this->view('parking_rates/form',[
            'title'=>'Edit Tarif','item'=>$item,'action'=>'edit',
            'types'=>$this->model('VehicleType')->all()
        ]);
    }

    public function update(): void
    {
        requireLogin();
        $id=(int)($_GET['id']??0);
        try {
            $this->model('ParkingRate')->update($id,$this->input());
            flash('success','Tarif berhasil diubah.');
        } catch(PDOException $e) {
            flash('error','Gagal mengubah tarif.');
        }
        $this->redirect('parking-rates');
    }

    public function delete(): void
    {
        requireLogin();
        $id=(int)($_GET['id']??0);
        $ok=$this->model('ParkingRate')->delete($id);
        flash($ok?'success':'error',$ok?'Tarif berhasil dihapus.':'Tarif masih digunakan dan tidak dapat dihapus.');
        $this->redirect('parking-rates');
    }

    private function input(): array
    {
        return [
            'id_jenis_kendaraan'=>(int)($_POST['id_jenis_kendaraan']??0),
            'tarif_per_jam'=>(float)($_POST['tarif_per_jam']??0),
            'tarif_maksimal'=>trim($_POST['tarif_maksimal']??''),
            'berlaku_mulai'=>trim($_POST['berlaku_mulai']??date('Y-m-d H:i:s')),
            'status'=>$_POST['status']??'aktif'
        ];
    }
}
