<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('UserModel');
		$this->data["title"] = "";
	}
	public function index(){
		$authUser = $this->session->userdata("authUser");	
		$idUser = $this->session->userdata("idUser");
		$this->data["title"] = "I Love Emas";
		if($authUser==true){
			redirect(base_url()."dashboard/");
		}else{
			$this->load->view("Login",$this->data);
		}
	}
	public function dashboard(){
		$authUser = $this->session->userdata("authUser");	
		$idUser = $this->session->userdata("idUser");
		$this->data["title"] = "DASHBOARD";
        if ($authUser == true) {
			// $this->data['countPetugas'] = $this->UserModel->petugasCountData()->row('count');
			// $this->data['countCustomer'] = $this->CustomerModel->customerCountData()->row('count');
			// $this->data['countVendor'] = $this->VendorModel->vendorCountData()->row('count');
			$this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
			$this->data['sidebar'] = $this->load->view('Sidebar', $this->data, true);
			$this->data['content'] = $this->load->view('Dashboard', $this->data, true);
			$this->load->view("UserTemplate", $this->data);
        }else {
            redirect(base_url()); 
        }
	}
	public function error(){
		$this->data['title'] = "404 PAGE NOT FOUND";
		$this->data['content'] = $this->load->view('Error', $this->data, true);
		$this->load->view("UserTemplate", $this->data);
	}
}