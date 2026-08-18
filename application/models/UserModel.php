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
	function userByUsername($username) {
		$this->db->where('u_username', $username);
		$query = $this->db->get('tb_user');
		return $query;
	}

	// Verifies against bcrypt hashes (new) or legacy plain md5 hashes (old).
	// Sanitization matches what login has always applied before hashing, so
	// legacy hashes still verify correctly.
	function verifyPassword($plainPassword, $storedHash) {
		$sanitized = preg_replace('/[^A-Za-z0-9]/', '', str_replace(' ', '-', $plainPassword));
		if (preg_match('/^\$2[aby]\$/', $storedHash)) {
			return password_verify($sanitized, $storedHash);
		}
		return hash_equals((string) $storedHash, md5($sanitized));
	}

	function isBcryptHash($hash) {
		return (bool) preg_match('/^\$2[aby]\$/', $hash);
	}

	function rehashPassword($userId, $plainPassword) {
		$sanitized = preg_replace('/[^A-Za-z0-9]/', '', str_replace(' ', '-', $plainPassword));
		$hash = password_hash($sanitized, PASSWORD_BCRYPT);
		$this->db->update('tb_user', ['u_password' => $hash], ['u_id' => $userId]);
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