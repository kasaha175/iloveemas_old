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
				$status = $this->input->get('status');
				
				$this->data['data'] = $this->TransactionModel->buyTransaction($dateStart, $dateEnd, $status)->result();
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
				$status = $this->input->get('status');
				
				$this->data['data'] = $this->TransactionModel->sellTransaction($dateStart, $dateEnd, $status)->result();
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
		
		/**
		 * API: Get Buy Transaction Detail via AJAX
		 * Returns JSON data for modal display
		 */
		function getBuyTransactionDetail()
		{
			$authUser = $this->session->userdata("authUser");
			if ($authUser == true) {
				$idTransaction = $this->input->get('id');
				
				if (empty($idTransaction)) {
					echo json_encode(['status' => 'error', 'message' => 'Transaction ID required']);
					return;
				}
				
				// Get main transaction data
				$transaction = $this->TransactionModel->buyTransactionData($idTransaction)->row();
				
				if (empty($transaction)) {
					echo json_encode(['status' => 'error', 'message' => 'Transaction not found']);
					return;
				}
				
				// Get transaction items
				$items = $this->TransactionModel->buyTransactionItemsData($idTransaction)->result();
				
				// Get admin fee - try multiple field names
				$adminFee = 0;
				if (isset($transaction->t_price_admin) && !empty($transaction->t_price_admin)) {
					$adminFee = $transaction->t_price_admin;
				} elseif (isset($transaction->admin_fee) && !empty($transaction->admin_fee)) {
					$adminFee = $transaction->admin_fee;
				}
				
				// Get payment method
				$paymentMethod = '';
				if (isset($transaction->t_payment_method)) {
					$paymentMethod = $transaction->t_payment_method;
				}
				
				// Calculate grand total
				$priceTotal = floatval($transaction->t_price_total ?? 0);
				$grandTotal = $priceTotal + floatval($adminFee);
				
				// Build response
				$response = [
					'status' => 'success',
					'data' => [
						'transaction' => [
							'id' => $transaction->t_id,
							'no_order' => $transaction->t_no_order,
							'date_created' => $transaction->t_date_created,
							'status' => $transaction->t_status,
							'qtt' => $transaction->t_qtt,
							'price_total' => $priceTotal,
							'admin_fee' => $adminFee,
							'grand_total' => $grandTotal,
							'paid_by' => $transaction->t_paid_by,
							'payment_method' => $paymentMethod,
							'customer_name' => $transaction->nameCustomer,
							'created_by' => $transaction->nameCreator,
							'receive_by' => $transaction->nameReceive,
							'cabang' => $transaction->nama_cabang,
							'pdf_path' => $transaction->t_pdf_path ?? '',
							'pdf_filename' => $transaction->t_pdf_filename ?? ''
						],
						'items' => $items
					]
				];
				
				echo json_encode($response);
			}
			else {
				echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
			}
		}
		
		/**
		 * API: Update Transaction Status via AJAX
		 * Used for VOID functionality in Report pages
		 */
		function updateTransactionStatus()
		{
			$authUser = $this->session->userdata("authUser");
			if ($authUser == true) {
				$id = $this->input->post('id');
				$type = $this->input->post('type');
				$status = $this->input->post('status');
				
				if (empty($id) || empty($type) || empty($status)) {
					echo json_encode(['status' => 'error', 'message' => 'Missing required parameters']);
					return;
				}
				
				$result = $this->TransactionModel->updateTransactionStatus($id, $status, $type);
				
				if ($result) {
					echo json_encode(['status' => 'success', 'message' => 'Transaction status updated successfully']);
				} else {
					echo json_encode(['status' => 'error', 'message' => 'Failed to update transaction status']);
				}
			}
			else {
				echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
			}
		}
}
?>
