<?php
class ParkingSlotController extends Controller
{
    private function areas(): array
    {
        return $this->model('ParkingArea')->all();
    }

    public function index(): void
    {
        requireLogin();
        $this->view('parking_slots/index',[
            'title'=>'Slot Parkir','items'=>$this->model('ParkingSlot')->all()
        ]);
    }

    public function create(): void
    {
        requireLogin();
        $this->view('parking_slots/form',[
            'title'=>'Tambah Slot Parkir','item'=>null,'action'=>'create','areas'=>$this->areas()
        ]);
    }

    public function store(): void
    {
        requireLogin();
        try {
            $this->model('ParkingSlot')->create($this->input());
            flash('success','Slot parkir berhasil ditambahkan.');
        } catch(PDOException $e) {
            flash('error','Gagal menambahkan slot. Kode slot mungkin sudah digunakan.');
        }
        $this->redirect('parking-slots');
    }

    public function edit(): void
    {
        requireLogin();
        $id=(int)($_GET['id']??0);
        $item=$this->model('ParkingSlot')->find($id);
        if(!$item) $this->redirect('parking-slots');
        $this->view('parking_slots/form',[
            'title'=>'Edit Slot Parkir','item'=>$item,'action'=>'edit','areas'=>$this->areas()
        ]);
    }

    public function update(): void
    {
        requireLogin();
        $id=(int)($_GET['id']??0);
        try {
            $this->model('ParkingSlot')->update($id,$this->input());
            flash('success','Slot parkir berhasil diubah.');
        } catch(PDOException $e) {
            flash('error','Gagal mengubah slot parkir.');
        }
        $this->redirect('parking-slots');
    }

    public function delete(): void
    {
        requireLogin();
        $id=(int)($_GET['id']??0);
        $ok=$this->model('ParkingSlot')->delete($id);
        flash($ok?'success':'error',$ok?'Slot berhasil dihapus.':'Slot masih digunakan dan tidak dapat dihapus.');
        $this->redirect('parking-slots');
    }

    private function input(): array
    {
        return [
            'id_area'=>(int)($_POST['id_area']??0),
            'kode_slot'=>trim($_POST['kode_slot']??''),
            'jenis_kendaraan'=>$_POST['jenis_kendaraan']??'motor',
            'status'=>$_POST['status']??'kosong'
        ];
    }
}
