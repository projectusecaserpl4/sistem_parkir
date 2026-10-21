<?php
class ParkingArea extends Model
{
    public function all(): array
    {
        return $this->db->query(
            "SELECT * FROM parking_areas ORDER BY id_area DESC"
        )->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM parking_areas WHERE id_area = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO parking_areas (nama_area, lokasi, kapasitas, status)
             VALUES (?, ?, ?, ?)"
        );
        return $stmt->execute([
            $data['nama_area'], $data['lokasi'] ?: null,
            $data['kapasitas'], $data['status']
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE parking_areas SET nama_area = ?, lokasi = ?,
             kapasitas = ?, status = ? WHERE id_area = ?"
        );
        return $stmt->execute([
            $data['nama_area'], $data['lokasi'] ?: null,
            $data['kapasitas'], $data['status'], $id
        ]);
    }

    public function delete(int $id): bool
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM parking_areas WHERE id_area = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            return false;
        }
    }
}
