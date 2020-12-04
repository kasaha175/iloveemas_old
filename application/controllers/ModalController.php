<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModalController extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('ModalModel');
        $this->data["title"] = "";
        date_default_timezone_set("Asia/Jakarta"); 
        $this->dateToday = date("Y-m-d H:i:s");
	}
    public function data(){
		$authUser = $this->session->userdata("authUser");	
		$idUser = $this->session->userdata("idUser");
		$this->data["title"] = "TAMBAH MODAL";
        if ($authUser == true) {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $type = $this->UserModel->userDataById($idUser)->row("m_rule");
            $this->data['data'] = $this->ModalModel->data()->result();
            $this->data['sidebar'] = $this->load->view('Sidebar', $this->data, true);
			$this->data['content'] = $this->load->view('ModalData', $this->data, true);
			$this->load->view("UserTemplate", $this->data);
        }else {
            redirect($base_url()); 
        }
    }
    public function tambahProcess(){
		$authUser = $this->session->userdata("authUser");	
		$idUser = $this->session->userdata("idUser");
        if ($authUser == true) {
            $devisi = $this->input->post("devisi");
            $nominal = $this->input->post("nominal");;
            $code = $devisi.date('dmYHis');
            $code = md5($code);
            $type = $this->UserModel->userDataById($idUser)->row("m_rule");
            if(!empty($nominal)){
                $data1 = array (	
                    'm_creator_id' => $idUser,
                    'm_devisi' => $devisi,
                    'm_nominal' => $nominal,
                    'm_code' => $code,
                    'm_date_created' => $this->dateToday    
                );
                //print_r($data1);
                $this->ModalModel->tambahProcess($data1);
            }
            redirect(base_url()."modal/data/");
        }else {
            redirect($base_url()); 
        }
    }
    public function hapusProcess(){
		$authUser = $this->session->userdata("authUser");	
		$idUser = $this->session->userdata("idUser");
        if ($authUser == true) {
            $id = $this->uri->segment(3);
            $this->ModalModel->hapusProcess($id);
            redirect(base_url()."modal/data/");
        }else {
            redirect($base_url()); 
        }
    }
}