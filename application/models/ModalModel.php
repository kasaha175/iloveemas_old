<?php
 if (!defined('BASEPATH'))
 	exit('No direct script access allowed');

class ModalModel extends CI_Model {

	function data(){
		$query = $this->db->query("SELECT a.*, b.u_name as creator 
		FROM tb_modal a
		LEFT OUTER JOIN tb_user b
		ON a.m_creator_id = b.u_id
		ORDER BY a.m_date_created DESC");
		return $query;
    }
    function tambahProcess($data){
		$this->db->insert('tb_modal', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
    }
	function hapusProcess($id){
		$this->db->query("DELETE FROM tb_modal WHERE m_id='$id'");
	}
}
?>