<?php
class Vehicle extends Model
{
    public function all(): array
    {
        return $this->db->query(
            "SELECT v.*, c.nama_customer, vt.nama_jenis
             FROM vehicles v
             INNER JOIN customers c ON c.id_customer = v.id_customer
             INNER JOIN vehicle_types vt ON vt.id_jenis_kendaraan = v.id_jenis_kendaraan
             ORDER BY v.id_vehicle DESC"
        )->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM vehicles WHERE id_vehicle = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO vehicles
             (id_customer, id_jenis_kendaraan, nomor_polisi, merk, model, warna, tahun, status)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([
            $data['id_customer'],
            $data['id_jenis_kendaraan'],
            strtoupper($data['nomor_polisi']),
            $data['merk'] ?: null,
            $data['model'] ?: null,
            $data['warna'] ?: null,
            $data['tahun'] ?: null,
            $data['status']
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE vehicles SET
             id_customer = ?, id_jenis_kendaraan = ?, nomor_polisi = ?,
             merk = ?, model = ?, warna = ?, tahun = ?, status = ?
             WHERE id_vehicle = ?"
        );
        return $stmt->execute([
            $data['id_customer'],
            $data['id_jenis_kendaraan'],
            strtoupper($data['nomor_polisi']),
            $data['merk'] ?: null,
            $data['model'] ?: null,
            $data['warna'] ?: null,
            $data['tahun'] ?: null,
            $data['status'],
            $id
        ]);
    }

    public function delete(int $id): bool
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM vehicles WHERE id_vehicle = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            return false;
        }
    }
}
