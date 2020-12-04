<?php
 if (!defined('BASEPATH'))
 	exit('No direct script access allowed');

class ProductModel extends CI_Model {

	function customerCountData(){
		$query = $this->db->query("SELECT COUNT(*) as count
		FROM tb_customer a ");
		return $query;
	}
	function data($type){
		$query = $this->db->query("SELECT a.*, b.u_name as creator 
		FROM tb_product a
		LEFT OUTER JOIN tb_user b
		ON a.p_creator_id = b.u_id
		WHERE a.p_type='$type'
		ORDER BY a.p_category ASC");
		return $query;
	}
	function dataById($id,$type){
		$query = $this->db->query("SELECT a.*, b.u_name as creator 
		FROM tb_product a
		LEFT OUTER JOIN tb_user b
		ON a.p_creator_id = b.u_id
		WHERE a.p_type='$type' AND a.p_code='$id'");
		echo "SELECT a.*, b.u_name as creator 
		FROM tb_product a
		LEFT OUTER JOIN tb_user b
		ON a.p_creator_id = b.u_id
		WHERE a.p_type='$type' AND a.p_code='$id'";
		return $query;
	}
	function dataByCode($code,$type){
		$query = $this->db->query("SELECT a.*, b.u_name as creator 
		FROM tb_product a
		LEFT OUTER JOIN tb_user b
		ON a.p_creator_id = b.u_id
		WHERE a.p_type='$type' AND a.p_code='$code'");
		return $query;
	}
	function dataHistory($type){
		$query = $this->db->query("SELECT a.*,b.*,c.u_name as creator
		FROM tb_product_stock a
		LEFT OUTER JOIN tb_product b
		ON a.ps_p_id = b.p_id
		LEFT OUTER JOIN tb_user c
		ON a.ps_creator_id = c.u_id
		WHERE b.p_type='$type'
		ORDER BY a.ps_id DESC");
		return $query;
	}
	function customerDataById($id) {
		$this->db->where('c_id = "'.$id.'"');
		$query = $this->db->get('tb_customer');
		return $query;
	}
	function tambahProcess($data){
		$this->db->insert('tb_product', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	function tambahStockProcess($data){
		$this->db->insert('tb_product_stock', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	function updateStockInProcess($idProduct,$stock,$date){
		$this->db->query("UPDATE tb_product a 
		SET a.p_stock_in=(a.p_stock_in+'$stock'), a.p_date_updated='$date'
		WHERE a.p_id='$idProduct'");
	}
	function updateStockOutProcess($idProduct,$stock,$date){
		$this->db->query("UPDATE tb_product a 
		SET a.p_stock_out=(a.p_stock_out+'$stock'), a.p_date_updated='$date'
		WHERE a.p_id='$idProduct'");
	}
	function updateStockOutByCodeProcess($idCode,$stock,$date){
		$this->db->query("UPDATE tb_product a 
		SET a.p_stock_out=(a.p_stock_out+'$stock'), a.p_date_updated='$date'
		WHERE a.p_code='$idCode'");
	}
	
	function hapusProcess($id){
		$this->db->query("DELETE FROM tb_product WHERE p_id='$id'");
		$this->db->query("DELETE FROM tb_product_stock WHERE ps_p_id='$id'");
	}
}
?>