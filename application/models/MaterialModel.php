<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');
class MaterialModel extends CI_Model
{
  function materialData($type)
  {
    $query = $this->db->query("SELECT *
    FROM tb_material a
    WHERE a.m_type LIKE '%$type%'");
    return $query;
  }
  function materialDataBy($parameter, $idMaterial, $type)
  {
    $query = $this->db->query("SELECT *
    FROM tb_material a
    WHERE a.$parameter='$idMaterial' AND a.m_type='$type'");
    return $query;
  }
  function materialTypeData()
  {
    $query = $this->db->query("SELECT *
    FROM tb_material_type a");
    return $query;
  }
  function caratData($idMaterial)
  {
    $query = $this->db->query("SELECT *
    FROM tb_carat a
    WHERE a.c_type='$idMaterial'
    ORDER BY a.c_id DESC");
    return $query;
  }
  function potonganData($idMaterial)
  {
    $query = $this->db->query("SELECT *
    FROM tb_potongan a
    WHERE a.material_id='$idMaterial'
    ORDER BY a.id DESC");
    return $query;
  }
  function formulaData($f_id = 1)
  {
    $query = $this->db->query("SELECT *
    FROM tb_formula a
    WHERE a.f_id='$f_id'");
    return $query;
  }
  function formulaUpdate($parameter, $value)
  {
    $query = $this->db->query("UPDATE 
    tb_formula a
    SET a.$parameter = '$value'
    WHERE a.f_id=1");
    return $query;
  }
  function formulaUpdateArray($data, $f_id = 1)
  {
    $this->db->where('f_id=', $f_id);
    $this->db->update('tb_formula', $data);
  }
}
?>