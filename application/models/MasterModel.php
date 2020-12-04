<?php
 if (!defined('BASEPATH'))
 	exit('No direct script access allowed');

class MasterModel extends CI_Model {

    function yearData(){
        $query = $this->db->query("SELECT *
        FROM tb_year");
        return $query;
    }
    function customerDetail($id){
        $query = $this->db->query("SELECT * FROM tb_customer WHERE c_id='$id'");
        return $query;
    }
    function editCustomerProces($data,$idCustomer){
        $this->db->where('c_id', $idCustomer);
        $this->db->update('tb_customer', $data);
    }
    function deleteCustomerProcess($id){
        $query = $this->db->query("DELETE FROM tb_customer WHERE c_id='$id'");
        return $query;
    }
    function lastCustomer(){
        $query = $this->db->query("SELECT *
        FROM tb_customer c
        ORDER BY c.c_id DESC
        LIMIT 1");
        return $query;
    }
    function formulasData($type){
        $query = $this->db->query("SELECT *
        FROM tb_formulas a
        WHERE a.f_name = '$type'");
        return $query;
    }
    function formulasUpdate($key,$data){
        $this->db->where('f_name', $key);
        $this->db->update('tb_formulas', $data);
    }
    function customerData(){
        $query = $this->db->query("SELECT *
        FROM tb_customer a
        LEFT OUTER JOIN tb_user b
        ON a.c_u_id = b.u_id
        WHERE a.c_id_number!='999999999999999'
        ORDER BY a.c_name ASC");
        return $query;
    }
    function customerAdd($data){
        $this->db->insert('tb_customer', $data);
    }
    function customerDatas($idCustomer){
        $query = $this->db->query("SELECT *
        FROM tb_customer a
        WHERE a.c_id = '$idCustomer'");
        return $query;
    }
}
?>