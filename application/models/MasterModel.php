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
        return $this->db->affected_rows();
    }
function customerData(){
        $query = $this->db->query("SELECT *
        FROM tb_customer a
        WHERE a.c_id_number!='999999999999999'
        ORDER BY a.c_id ASC");
        return $query;
    }

    function count_all_customers() {
        $this->db->where('c_id_number !=', '999999999999999');
        return $this->db->count_all_results('tb_customer');
    }

    function count_filtered_customers($search_value) {
        $this->db->group_start();
        $this->db->like('c_name', $search_value);
        $this->db->or_like('c_id_number', $search_value);
        $this->db->or_like('c_phone', $search_value);
        $this->db->or_like('c_no_order', $search_value);
        $this->db->group_end();
        $this->db->where('c_id_number !=', '999999999999999');
        return $this->db->count_all_results('tb_customer');
    }

    function get_customers_datatable($start, $length, $search_value, $order_col, $order_dir) {
        $this->db->select('c.*');
        $this->db->from('tb_customer c');
        $this->db->where('c.c_u_id >', 0);
        $this->db->where('c.c_id_number !=', '999999999999999');
        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('c.c_name', $search_value);
            $this->db->or_like('c.c_id_number', $search_value);
            $this->db->or_like('c.c_phone', $search_value);
            $this->db->or_like('CAST(c.c_no_order AS CHAR)', $search_value);
            $this->db->group_end();
        }
        $this->db->order_by('c.' . $order_col, $order_dir);
        $this->db->limit($length, $start);
        $query = $this->db->get();
        if ($query) {
            return $query->result();
        }
        return [];
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