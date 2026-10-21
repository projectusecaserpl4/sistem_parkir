<?php
class ParkingSlot extends Model
{
    public function all(): array
    {
        return $this->db->query(
            "SELECT ps.*, pa.nama_area
             FROM parking_slots ps
             INNER JOIN parking_areas pa ON pa.id_area = ps.id_area
             ORDER BY ps.id_slot DESC"
        )->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM parking_slots WHERE id_slot = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO parking_slots (id_area, kode_slot, jenis_kendaraan, status)
             VALUES (?, ?, ?, ?)"
        );
        return $stmt->execute([
            $data['id_area'], strtoupper($data['kode_slot']),
            $data['jenis_kendaraan'], $data['status']
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE parking_slots SET id_area = ?, kode_slot = ?,
             jenis_kendaraan = ?, status = ? WHERE id_slot = ?"
        );
        return $stmt->execute([
            $data['id_area'], strtoupper($data['kode_slot']),
            $data['jenis_kendaraan'], $data['status'], $id
        ]);
    }

    public function delete(int $id): bool
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM parking_slots WHERE id_slot = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            return false;
        }
    }
}
