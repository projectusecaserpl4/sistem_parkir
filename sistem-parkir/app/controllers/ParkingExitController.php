<?php

class ParkingExitController extends Controller
{
    public function index(): void
    {
        requireLogin();
        $this->view('parking_exits/index', [
            'title' => 'Kendaraan Keluar',
            'entries' => $this->model('ParkingExit')->activeEntries(),
        ]);
    }

    public function create(): void
    {
        requireLogin();
        $id = (int) ($_GET['id'] ?? 0);
        $model = $this->model('ParkingExit');
        $entry = $model->findActive($id);

        if (!$entry) {
            flash('error', 'Data parkir aktif tidak ditemukan.');
            $this->redirect('parking-exits');
        }

        try {
            $calculation = $model->estimate($id);
        } catch (Throwable $e) {
            flash('error', $e->getMessage());
            $this->redirect('parking-exits');
        }

        $this->view('parking_exits/form', [
            'title' => 'Proses Kendaraan Keluar',
            'entry' => $entry,
            'calculation' => $calculation,
        ]);
    }

    public function store(): void
    {
        requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('parking-exits');
        }

        $entryId = (int) ($_POST['id_entry'] ?? 0);
        $condition = trim($_POST['kondisi_kendaraan_keluar'] ?? '');

        try {
            $result = $this->model('ParkingExit')->process(
                $entryId,
                (int) $_SESSION['user']['id_user'],
                $condition
            );

            flash(
                'success',
                'Kendaraan berhasil keluar. Total tarif Rp ' . number_format($result['total_bayar'], 0, ',', '.') . '. Silakan lanjut ke pembayaran.'
            );
        } catch (Throwable $e) {
            flash('error', $e->getMessage());
        }

        $this->redirect('parking-exits');
    }
}
