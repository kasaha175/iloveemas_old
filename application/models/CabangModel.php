<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class CabangModel extends CI_Model
{
    protected $table = 'tb_cabang';

    public function getActiveCabang()
    {
        return $this->db
            ->select('id, nama_cabang, alamat_cabang, urutan_cabang')
            ->where('status', 'ENABLE')
            ->order_by('urutan_cabang', 'ASC')
            ->get($this->table)
            ->result();
    }

    public function getAllCabang()
    {
        return $this->db
            ->order_by('urutan_cabang', 'ASC')
            ->get($this->table)
            ->result();
    }

    public function getCabangById($id)
    {
        return $this->db
            ->where('id', (int) $id)   // 🔥 FIX DI SINI
            ->get($this->table)
            ->row();
    }

    public function insertCabang($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function updateCabang($id, $data)
    {
        return $this->db
            ->where('id', (int) $id)   // 🔥 FIX DI SINI
            ->update($this->table, $data);
    }

    public function deleteCabang($id)
    {
        return $this->db
            ->where('id', (int) $id)   // 🔥 FIX DI SINI
            ->update($this->table, ['status' => 'DISABLE']);
    }
}