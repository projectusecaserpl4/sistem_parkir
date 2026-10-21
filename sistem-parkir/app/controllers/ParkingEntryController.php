<?php

class ParkingEntryController extends Controller
{
    public function index(): void
    {
        requireLogin();
        $model = $this->model('ParkingEntry');

        $this->view('parking_entries/index', [
            'title' => 'Kendaraan Masuk',
            'entries' => $model->active(),
        ]);
    }

    public function create(): void
    {
        requireLogin();
        $model = $this->model('ParkingEntry');

        $this->view('parking_entries/form', [
            'title' => 'Kendaraan Masuk',
            'vehicles' => $model->vehicleOptions(),
            'slots' => $model->allAvailableSlots(),
            'vehicleCount' => $model->countAvailableVehicles(),
            'slotCount' => $model->countAvailableSlots(),
        ]);
    }

    public function slots(): void
    {
        requireLogin();
        $type = strtolower(trim($_GET['jenis'] ?? ''));
        $allowed = ['motor', 'mobil', 'lainnya'];

        if (!in_array($type, $allowed, true)) {
            $this->json(['success' => false, 'message' => 'Jenis kendaraan tidak valid.']);
        }

        $slots = $this->model('ParkingEntry')->availableSlots($type);
        $this->json(['success' => true, 'data' => $slots]);
    }

    public function store(): void
    {
        requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('parking-entries');
        }

        $vehicleId = (int) ($_POST['id_vehicle'] ?? 0);
        $slotId = (int) ($_POST['id_slot'] ?? 0);
        $condition = trim($_POST['kondisi_kendaraan_masuk'] ?? '');

        if ($vehicleId <= 0 || $slotId <= 0) {
            flash('error', 'Kendaraan dan slot parkir wajib dipilih.');
            $this->redirect('parking-entries/create');
        }

        try {
            $ticket = $this->model('ParkingEntry')->create(
                $vehicleId,
                $slotId,
                (int) $_SESSION['user']['id_user'],
                $condition
            );
            flash('success', 'Kendaraan berhasil masuk. Nomor tiket: ' . $ticket);
        } catch (Throwable $e) {
            flash('error', $e->getMessage());
        }

        $this->redirect('parking-entries');
    }

    private function json(array $data): never
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }
}
