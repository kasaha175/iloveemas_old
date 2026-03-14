<?php
 if (!defined('BASEPATH'))
 	exit('No direct script access allowed');

class UserModel extends CI_Model {

	public function __construct() {
        parent::__construct();
        $this->load->database(); // Memuat database
    }

	function cabangData(){
		$query = $this->db->get('tb_cabang');
		return $query;
	}
	function userData($username, $password) {
		$this->db->where("u_username = '$username' and u_password='$password'");
		$query = $this->db->get('tb_user');
		return $query;
	}
	function userDataById($user_id) {
		$query = $this->db->query("SELECT a.*
		FROM tb_user a 
		WHERE a.u_id='$user_id'");
		return $query;
	}
	function petugasCountData(){
		$query = $this->db->query("SELECT COUNT(*) as count
		FROM tb_user a 
		WHERE a.u_rule='Petugas'");
		return $query;
	}
	function petugasData(){
		$query = $this->db->query("SELECT a.*,  c.*, b.u_name as creator
		FROM tb_user a 
		LEFT OUTER JOIN tb_user b
		ON a.u_creator_id = b.u_id
		LEFT OUTER JOIN tb_cabang c
		ON a.u_ca_id = c.ca_id
		WHERE a.u_rule='Petugas'");
		return $query;
	}
	function petugasTambahProcess($data){
		$query = $this->db->insert('tb_user', $data);
		return $query;
	}
	function petugasUbahProcess($data, $idPetugas){
		$this->db->update('tb_user', $data, "u_id = '$idPetugas'");
	}
	function petugasHapusProcess($id){
		$this->db->query("DELETE FROM tb_user WHERE u_id='$id'");
	}
}
?>