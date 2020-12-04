<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ReportController extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('MasterModel');
		$this->load->model('TransactionModel');
		$this->load->model('MaterialModel');
		$this->data["title"] = "";
		date_default_timezone_set("Asia/Jakarta");
		$this->dateToday = date("Y-m-d H:i:s");
		$this->load->library('Pdf');
		$this->load->library('cart');
    }
    function report()
    {
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		$this->data["title"] = "REPORT";
		if ($authUser == true) {
			$this->data['content'] = $this->load->view('Report', $this->data, true);
			$this->load->view("UserTemplate", $this->data);
		}
		else {
			redirect(base_url());
		}
		}
		function buy()
    {
			$authUser = $this->session->userdata("authUser");
			$idUser = $this->session->userdata("idUser");
			$this->data["title"] = "REPORT BUY";
			if ($authUser == true) {
				$dateStart = $this->input->get('dateStart');
				$dateEnd = $this->input->get('dateEnd');
				$this->data['data'] = $this->TransactionModel->buyTransaction($dateStart, $dateEnd)->result();
				$this->data['content'] = $this->load->view('ReportBuy', $this->data, true);
				$this->load->view("UserTemplate", $this->data);
			}
			else {
				redirect(base_url());
			}
		}
	function buyGraph()
    {
			$authUser = $this->session->userdata("authUser");
			$idUser = $this->session->userdata("idUser");
			$this->data["title"] = "REPORT BUY GRAPH";
			if ($authUser == true) {
				$year = $this->input->get('year');
				$material = $this->input->get('material');
				if (!$year) {
					$year = date('Y');
				}
				$this->data['materialData'] = $this->MaterialModel->materialData('Buy')->result();
				$this->data['yearData'] = $this->MasterModel->yearData()->result();
				$this->data['data'] = $this->TransactionModel->buyTransactionGraph($year,$material)->result();
				$this->data['dataCustomer'] = $this->TransactionModel->buyTransactionCustomerGraph($year);
				$this->data['content'] = $this->load->view('ReportBuyGraph', $this->data, true);
				
				$this->load->view("UserTemplate", $this->data);
			}
			else {
				redirect(base_url());
			}
		}
		function sellGraph()
		{
				$authUser = $this->session->userdata("authUser");
				$idUser = $this->session->userdata("idUser");
				$this->data["title"] = "REPORT SELL GRAPH";
				if ($authUser == true) {
					$year = $this->input->get('year');
					$material = $this->input->get('material');
					if (!$year) {
						$year = date('Y');
					}
					$this->data['materialData'] = $this->MaterialModel->materialData('Sell')->result();
					$this->data['dataCustomer'] = $this->TransactionModel->sellTransactionCustomerGraph($year);
					$this->data['yearData'] = $this->MasterModel->yearData()->result();
					$this->data['data'] = $this->TransactionModel->sellTransactionGraph($year,$material)->result();
					$this->data['content'] = $this->load->view('ReportSellGraph', $this->data, true);
					$this->load->view("UserTemplate", $this->data);
				}
				else {
					redirect(base_url());
				}
			}
		function sell()
    {
			$authUser = $this->session->userdata("authUser");
			$idUser = $this->session->userdata("idUser");
			$this->data["title"] = "REPORT SELL";
			if ($authUser == true) {
				$dateStart = $this->input->get('dateStart');
				$dateEnd = $this->input->get('dateEnd');
				$this->data['data'] = $this->TransactionModel->sellTransaction($dateStart, $dateEnd)->result();
				$this->data['content'] = $this->load->view('ReportSell', $this->data, true);
				$this->load->view("UserTemplate", $this->data);
			}
			else {
				redirect(base_url());
			}
		}
		function buyDetail(){
			$authUser = $this->session->userdata("authUser");
			$idUser = $this->session->userdata("idUser");
			if ($authUser == true) {
				$idTransaction = $this->uri->segment(3);
				$this->data['data'] = $this->TransactionModel->buyTransactionData($idTransaction)->result();
				if(empty($this->data['data'])){
					redirect(base_url()."report/buy/");
				}
				$noOrder = $this->TransactionModel->buyTransactionData($idTransaction)->row("t_no_order");
				$this->data['title'] = $noOrder;
				$this->data['detail'] = $this->TransactionModel->buyTransactionItemsData($idTransaction)->result();
				$this->data['content'] = $this->load->view('ReportBuyDetail', $this->data, true);
				$this->load->view("UserTemplate", $this->data);
			}
			else {
				redirect(base_url());
			}
		}
		function sellDetail(){
			$authUser = $this->session->userdata("authUser");
			$idUser = $this->session->userdata("idUser");
			if ($authUser == true) {
				$idTransaction = $this->uri->segment(3);
				$this->data['data'] = $this->TransactionModel->sellTransactionData($idTransaction)->result();
				if(empty($this->data['data'])){
					redirect(base_url()."report/sell/");
				}
				$noOrder = $this->TransactionModel->sellTransactionData($idTransaction)->row("t_no_order");
				$this->data['title'] = $noOrder;
				$this->data['detail'] = $this->TransactionModel->sellTransactionItemsData($idTransaction)->result();
				$this->data['content'] = $this->load->view('ReportSellDetail', $this->data, true);
				$this->load->view("UserTemplate", $this->data);
			}
			else {
				redirect(base_url());
			}
		}
}
?>
