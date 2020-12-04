<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('TransactionModel');
		$this->load->model('ProductModel');
        $this->data["title"] = "And Team Andromeda Tours";
        date_default_timezone_set("Asia/Jakarta"); 
        $this->dateToday = date("Y-m-d H:i:s");
	}
    function loginProcess(){
        $authUser = $this->session->userdata("authUser");	
		$idUser = $this->session->userdata("idUser");
		if($authUser==true){
			redirect(base_url()."dashboard/");
		}else{
            $username      = $this->input->post('username');
            $username      = str_replace(' ', '-', $username);
            $username      = preg_replace('/[^A-Za-z0-9]/', '', $username);
            $password      = $this->input->post('password');
            $password      = str_replace(' ', '-', $password);
            $password      = preg_replace('/[^A-Za-z0-9]/', '', $password);
            $password      = md5($password);
            $userData = $this->UserModel->userData($username, $password)->result();
            $cek = count($userData);
            $data_session = array(
                'authUser' => false
            );
            if ($cek > 0) {
                foreach ($userData as $a) {
                };
                $data_session = array(
                    'authUser' => true,
                    'idUser' => $a->u_id,
                );
                $this->session->set_userdata($data_session);
                redirect(base_url()."dashboard/");
            } else {
                $data_session = array(
                    'autn' => false,
                    'failedLogin' => true
                );
                $this->session->set_userdata($data_session);
                redirect(base_url());
            }
        }
    }
    function logoutProcess()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }
  
}

?>