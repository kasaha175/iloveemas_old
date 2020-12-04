<?php
 if (!defined('BASEPATH'))
 	exit('No direct script access allowed');

class VendorModel extends CI_Model {
	function vendorCountData(){
		$query = $this->db->query("SELECT COUNT(*) as count
		FROM tb_vendor a");
		return $query;
	}
	function vendorData(){
		$query = $this->db->query("SELECT a.*, b.u_name as creator
		FROM tb_vendor a 
		LEFT OUTER JOIN tb_user b
		on a.v_creator_id = b.u_id");
		return $query;
	}
	function vendorDataById($id) {
		$this->db->insert('tb_', $post_data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	function vendorTambahProcess($data){
		$query = $this->db->insert('tb_vendor', $data);
		return $query;
	}
	function vendorUbahProcess($data, $id){
		$this->db->update('tb_vendor', $data, "v_id = '$id'");
	}
	function vendorHapusProcess($id){
		$this->db->query("DELETE FROM tb_vendor WHERE v_id='$id'");
	}
}
?>