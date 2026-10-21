<?php

class ParkingPaymentController extends Controller
{
    public function index(): void
    {
        requireLogin();

        $model = $this->model('ParkingPayment');
        $this->view('parking_payments/index', [
            'title' => 'Pembayaran',
            'payments' => $model->all(),
            'summary' => $model->summary(),
        ]);
    }

    public function create(): void
    {
        requireLogin();

        $id = (int) ($_GET['id'] ?? 0);
        $payment = $this->model('ParkingPayment')->find($id);

        if (!$payment) {
            flash('error', 'Data pembayaran tidak ditemukan.');
            $this->redirect('parking-payments');
        }

        if ($payment['status'] === 'lunas') {
            flash('error', 'Pembayaran tersebut sudah lunas.');
            $this->redirect('parking-payments');
        }

        $this->view('parking_payments/form', [
            'title' => 'Proses Pembayaran',
            'payment' => $payment,
        ]);
    }

    public function store(): void
    {
        requireLogin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('parking-payments');
        }

        $paymentId = (int) ($_POST['id_payment'] ?? 0);
        $method = trim($_POST['metode_pembayaran'] ?? 'cash');
        $amountRaw = trim($_POST['jumlah_dibayar'] ?? '');
        $amount = $amountRaw === '' ? null : (float) str_replace(',', '.', $amountRaw);

        try {
            $this->model('ParkingPayment')->markPaid(
                $paymentId,
                $method,
                $amount,
                (int) $_SESSION['user']['id_user']
            );

            flash('success', 'Pembayaran berhasil dicatat sebagai LUNAS.');
            $this->redirect('parking-payments');
        } catch (Throwable $e) {
            flash('error', $e->getMessage());
            $this->redirect('parking-payments/create?id=' . $paymentId);
        }
    }

    public function receipt(): void
    {
        requireLogin();

        $id = (int) ($_GET['id'] ?? 0);
        $payment = $this->model('ParkingPayment')->find($id);

        if (!$payment || $payment['status'] !== 'lunas') {
            flash('error', 'Struk hanya dapat dicetak untuk pembayaran yang sudah lunas.');
            $this->redirect('parking-payments');
        }

        $this->view('parking_payments/receipt', [
            'title' => 'Struk Pembayaran',
            'payment' => $payment,
        ]);
    }
}
