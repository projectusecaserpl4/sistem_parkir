<?php
class Customer extends Model
{
    public function all(): array
    {
        return $this->db->query(
            "SELECT * FROM customers ORDER BY id_customer DESC"
        )->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM customers WHERE id_customer = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO customers (nama_customer, nik, no_hp, alamat)
             VALUES (?, ?, ?, ?)"
        );
        return $stmt->execute([
            $data['nama_customer'],
            $data['nik'] ?: null,
            $data['no_hp'] ?: null,
            $data['alamat'] ?: null
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE customers
             SET nama_customer = ?, nik = ?, no_hp = ?, alamat = ?
             WHERE id_customer = ?"
        );
        return $stmt->execute([
            $data['nama_customer'],
            $data['nik'] ?: null,
            $data['no_hp'] ?: null,
            $data['alamat'] ?: null,
            $id
        ]);
    }

    public function delete(int $id): bool
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM customers WHERE id_customer = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            return false;
        }
    }
}
