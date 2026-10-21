<?php
class Role extends Model
{
    public function all(): array
    {
        return $this->db->query("SELECT * FROM roles ORDER BY id_role")->fetchAll();
    }
}
