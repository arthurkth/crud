<?php

class My_Model extends CI_Model
{
    protected $table = null;

    public function save($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function getById(int $id): stdClass
    {
        return $this->db->from($this->table)
            ->where('id', $id)
            ->get()->row();
    }

    public function all(): array
    {
        return $this->db->from($this->table)->get()->result();
    }

    public function getWhere(array $where): array
    {
        return $this->db->from($this->table)
            ->where($where)
            ->get()->result();
    }

    public function delete(int $id)
    {
        $this->db->where('id', $id);
        $this->db->delete('game');
    }

    public function update(array $data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update($this->table, $data);
    }
}
