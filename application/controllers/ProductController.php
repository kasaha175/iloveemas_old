<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('ProductModel');
        $this->data["title"] = "";
        date_default_timezone_set("Asia/Jakarta"); 
        $this->dateToday = date("Y-m-d H:i:s");
	}
    public function data(){
		$authUser = $this->session->userdata("authUser");	
		$idUser = $this->session->userdata("idUser");
		$this->data["title"] = "TAMBAH PRODUK";
        if ($authUser == true) {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $type = $this->UserModel->userDataById($idUser)->row("u_rule");
            $this->data['data'] = $this->ProductModel->data($type)->result();
            $this->data['sidebar'] = $this->load->view('Sidebar', $this->data, true);
			$this->data['content'] = $this->load->view('ProductData', $this->data, true);
			$this->load->view("UserTemplate", $this->data);
        }else {
            redirect($base_url()); 
        }
    }
    function updateLive(){
        $id=$this->input->post('id'); 
        $text = $this->input->post('text'); 
        $column_name = $this->input->post('column_name');  
        if($column_name=='p_price'){
            $hasil=$this->db->query("UPDATE tb_product SET $column_name='$text', p_price_in='$text' WHERE p_id='$id'");
        }else{
            $hasil=$this->db->query("UPDATE tb_product SET $column_name='$text' WHERE p_id='$id'");
        }
        
        echo 'Data Updated';  
    }
    public function tambahProcess(){
		$authUser = $this->session->userdata("authUser");	
		$idUser = $this->session->userdata("idUser");
        if ($authUser == true) {
            $name = $this->input->post("name");
            $price_in = $this->input->post("price_in");
            $price_out = $this->input->post("price_out");
            $stock = $this->input->post("stock");
            $category = $this->input->post("category");
            $code = $idUser.date('dmYHis');
            $code = md5($code);
            $type = $this->UserModel->userDataById($idUser)->row("u_rule");
            if(!empty($name)){
                $data1 = array (	
                    'p_creator_id' => $idUser,
                    'p_code' => $code,
                    'p_price' => $price_in,
                    'p_price_in' => $price_in,
                    'p_category' => $category,
                    'p_name' => $name,
                    'p_type' => $type,
                    'p_date_created' => $this->dateToday,
                    'p_date_updated' => $this->dateToday     
                );
                $idProduct = $this->ProductModel->tambahProcess($data1);
            }
            redirect(base_url()."produk/data/");
        }else {
            redirect($base_url()); 
        }
    }
    public function dataStock(){
		$authUser = $this->session->userdata("authUser");	
		$idUser = $this->session->userdata("idUser");
		$this->data["title"] = "TAMBAH STOK PRODUK";
        if ($authUser == true) {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $type = $this->UserModel->userDataById($idUser)->row("u_rule");
            $this->data['select'] = $this->ProductModel->data($type)->result();
            $this->data['data'] = $this->ProductModel->dataHistory($type)->result();
            $this->data['sidebar'] = $this->load->view('Sidebar', $this->data, true);
			$this->data['content'] = $this->load->view('ProductStockData', $this->data, true);
			$this->load->view("UserTemplate", $this->data);
        }else {
            redirect($base_url()); 
        }
    }

    public function hapusProcess(){
		$authUser = $this->session->userdata("authUser");	
		$idUser = $this->session->userdata("idUser");
        if ($authUser == true) {
            $id = $this->uri->segment(3);
            $this->ProductModel->hapusProcess($id);
            redirect(base_url()."produk/data/");
        }else {
            redirect($base_url()); 
        }
    }
}