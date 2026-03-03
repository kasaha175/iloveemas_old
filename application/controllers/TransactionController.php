<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class TransactionController extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('MasterModel');
		$this->load->model('TransactionModel');
		$this->load->model('MaterialModel');
		$this->load->model('CabangModel');
		$this->data["title"] = "";
		date_default_timezone_set("Asia/Jakarta");
		$this->dateToday = date("Y-m-d H:i:s");
		$this->load->library('Pdf');
		$this->load->library('cart');
	}
	function index()
	{
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		$this->data["title"] = "TRANSACTION";
		if ($authUser == true)
		{
			$this->data['customer'] = $this->MasterModel->customerData()->result();
			$this->data['content'] = $this->load->view('CustomerSelect', $this->data, true);
			$this->load->view("UserTemplate", $this->data);
		}
		else
		{
			redirect(base_url());
		}
	}
	function list()
	{
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		$this->data["title"] = "TRANSACTION";
		if ($authUser == true)
		{

			if (@$this->input->get('dateStart'))
			{
				$this->db->where('t_date_created >=', $this->input->get('dateStart'));

			}
			if (@$this->input->get('dateEnd'))
			{
				$this->db->where('t_date_created =<', $this->input->get('dateEnd'));

			}
			$this->db->where('t_status !=', 'SELESAI');
			// $this->db->where('is_delete', null);
			$this->data['transaction'] = $this->db->get('all_transaction')->result();
			$this->data['content'] = $this->load->view('ListTransaction', $this->data, true);
			$this->load->view("UserTemplate", $this->data);
		}
		else
		{
			redirect(base_url());
		}
	}
	function redirectTransaction($no_order)
	{
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		$this->data["title"] = "TRANSACTION";
		if ($authUser == true)
		{
			$this->session->unset_userdata('idCustomer');
			$this->session->unset_userdata('idTransaction');
			$this->cart->destroy();
			$this->db->where('t_no_order', $no_order);
			$transaction = $this->db->get('all_transaction')->row();
			if ($transaction->t_type == 'SELL')
			{
				$this->db->where('t_no_order', $no_order);
				$cek_tr = $this->db->get('tb_transaction_sell')->row();

				$id = $cek_tr->t_customer;
				$data_session = array(
				 'idCustomer' => $id,
				 'idTransaction' => $cek_tr->t_id,
				 'jenis_transaksi' => 'sell'
				);
				$this->session->set_userdata($data_session);
				$this->db->where('ti_t_id', $cek_tr->t_id);
				$barang = $this->db->get('tb_transaction_items')->result();
				foreach ($barang as $key => $value)
				{

					$data = array(
					 'id' => $value->ti_id,
					 'qty' => $value->ti_weight,
					 'price' => $value->ti_price,
					 'prices' => $value->ti_price,
					 'name' => 'T-Shirt',
					 'materialName' => $value->ti_material,
					 'materialType' => $value->ti_material_type,
					 'carat' => $value->ti_carat,
					 'weight' => $value->ti_weight,
					 'priceTotal' => $value->ti_price_total,
					);

					$this->cart->insert($data);
					// echo "<pre>";
					// print_r($data);
					// echo "</pre>";
				}
				redirect(base_url('transaction/sell/'));
			}
			else
			{
				$this->db->where('t_no_order', $no_order);
				$cek_tr = $this->db->get('tb_transaction')->row();
				$id = $cek_tr->t_customer;
				$data_session = array(
				 'idCustomer' => $id,
				 'idTransaction' => $cek_tr->t_id,
				 'jenis_transaksi' => 'buy'
				);
				$this->session->set_userdata($data_session);
				$this->db->where('ti_t_id', $cek_tr->t_id);
				$barang = $this->db->get('tb_transaction_items')->result();
				foreach ($barang as $key => $value)
				{

					$data = array(
					 'id' => $value->ti_id,
					 'qty' => $value->ti_weight,
					 'price' => $value->ti_price,
					 'prices' => $value->ti_price,
					 'name' => 'T-Shirt',
					 'materialName' => $value->ti_material,
					 'materialType' => $value->ti_material_type,
					 'carat' => $value->ti_carat,
					 'weight' => $value->ti_weight,
					 'priceTotal' => $value->ti_price_total,
					);

					$this->cart->insert($data);
					// echo "<pre>";
					// print_r($data);
					// echo "</pre>";
				}
				// echo "<pre>";
				// 	print_r($this->cart->contents());
				// 	echo "</pre>";
				// print_r($this->cart->contents());

				redirect(base_url('transaction/buy/'));
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	function confirmEdit()
	{
		$datapost = $this->input->post();
		$idUser = $this->session->userdata("idUser");
		$userData = $this->UserModel->userDataById($idUser)->row();
		if ($userData->u_password == md5($datapost['password']))
		{
			$data = array(
			 't_alasan' => $datapost['alasan']
			);
			if ($datapost['type'] == 'sell')
			{
				$this->db->update('tb_transaction_sell', $data, ['t_id' => $datapost['id']]);
				$this->db->where('t_id', $datapost['id']);
				$cek_data = $this->db->get('tb_transaction_sell')->row();
			}
			else
			{
				$this->db->update('tb_transaction', $data, ['t_id' => $datapost['id']]);
				$this->db->where('t_id', $datapost['id']);
				$cek_data = $this->db->get('tb_transaction')->row();
			}
			echo json_encode([
			 'status' => 'berhasil',
			 'no_transaksi' => $cek_data->t_no_order,
			]);
			// $this->redirectTransaction($cek_data->t_no_order);
		}
		else
		{
			echo json_encode([
			 'status' => 'gagal'
			]);
		}
	}
	function deleteTransaction($no_order)
	{
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		$this->data["title"] = "TRANSACTION BUY";
		if ($authUser == true)
		{
			$this->db->where('t_no_order', $no_order);
			$transaction = $this->db->get('all_transaction')->row();
			if ($transaction->t_type == 'SELL')
			{
				$this->db->where('t_no_order', $no_order);
				$this->db->update('tb_transaction_sell', ['is_delete' => 'TRUE']);

			}
			else
			{
				$this->db->where('t_no_order', $no_order);
				$this->db->update('tb_transaction', ['is_delete' => 'TRUE']);
			}
			$data_session = array(
			 'status' => 'success',
			 'message' => "Transaksi Berhasil Dihapus",
			);
			$this->session->set_userdata($data_session);
			redirect(base_url() . "transaction-list");
		}
		else
		{
			redirect(base_url());
		}
	}
	function lm()
	{
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		$this->data["title"] = "TRANSACTION BUY";
		if ($authUser == true)
		{
			$this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
			$this->data['content'] = $this->load->view('BuyLM', $this->data, true);
			$this->load->view("UserTemplate", $this->data);
		}
		else
		{
			redirect(base_url());
		}
	}
	function platinum()
	{
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		$this->data["title"] = "TRANSACTION BUY";
		if ($authUser == true)
		{
			$this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
			$this->data['content'] = $this->load->view('BuyHighLow', $this->data, true);
			$this->load->view("UserTemplate", $this->data);
		}
		else
		{
			redirect(base_url());
		}
	}
	function paladium()
	{
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		$this->data["title"] = "TRANSACTION BUY";
		if ($authUser == true)
		{
			$this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
			$this->data['content'] = $this->load->view('BuyHighLow', $this->data, true);
			$this->load->view("UserTemplate", $this->data);
		}
		else
		{
			redirect(base_url());
		}
	}
	function iridium()
	{
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		$this->data["title"] = "TRANSACTION BUY";
		if ($authUser == true)
		{
			$this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
			$this->data['content'] = $this->load->view('BuyHighLow', $this->data, true);
			$this->load->view("UserTemplate", $this->data);
		}
		else
		{
			redirect(base_url());
		}
	}
	function rhodium()
	{
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		$this->data["title"] = "TRANSACTION BUY";
		if ($authUser == true)
		{
			$this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
			$this->data['content'] = $this->load->view('BuyHighLow', $this->data, true);
			$this->load->view("UserTemplate", $this->data);
		}
		else
		{
			redirect(base_url());
		}
	}
	function ruthenium()
	{
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		$this->data["title"] = "TRANSACTION BUY";
		if ($authUser == true)
		{
			$this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
			$this->data['content'] = $this->load->view('BuyHighLow', $this->data, true);
			$this->load->view("UserTemplate", $this->data);
		}
		else
		{
			redirect(base_url());
		}
	}
	function silver()
	{
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		$this->data["title"] = "TRANSACTION BUY";
		if ($authUser == true)
		{
			$this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
			$this->data['content'] = $this->load->view('BuyHighLow', $this->data, true);
			$this->load->view("UserTemplate", $this->data);
		}
		else
		{
			redirect(base_url());
		}
	}
	function buy()
	{
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		$this->data["title"] = "TRANSACTION BUY";
		// echo "<pre>";
		// print_r ($authUser);
		// echo "</pre>";
		// die();
		if ($authUser == true)
		{
			$this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
			//$this->data['data'] = $this->MaterialModel->materialData('Buy')->result();
			$this->data['content'] = $this->load->view('Buy', $this->data, true);
			$this->load->view("UserTemplate", $this->data);
		}
		else
		{
			redirect(base_url());
		}
	}
	function newCustomer()
	{
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		$this->data["title"] = "TRANSACTION";
		if ($authUser == true)
		{
			$this->data['content'] = $this->load->view('CustomerNew', $this->data, true);
			$this->load->view("UserTemplate", $this->data);
		}
		else
		{
			redirect(base_url());
		}
	}
	function numberToRomanRepresentation($number)
	{
		$map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
		$returnValue = '';
		while ($number > 0)
		{
			foreach ($map as $roman => $int)
			{
				if ($number >= $int)
				{
					$number -= $int;
					$returnValue .= $roman;
					break;
				}
			}
		}
		return $returnValue;
	}
	function newCustomerProcess()
	{
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		if ($authUser == true)
		{
			$month = $this->numberToRomanRepresentation(date('m', strtotime($this->dateToday)));
			$noUrut = $this->MasterModel->lastCustomer()->row("c_id");
			if ($noUrut > 0)
			{
				$noUrut = $noUrut + 1;
			}
			else
			{
				$noUrut = 1;
			}
			$year = date('Y', strtotime($this->dateToday));
			$year = $year[2] . $year[3];
			echo $noOrder = "ILE/" . $noUrut . "/" . $month . "/" . $year;
			$data = array(
			 'c_name' => strtoupper($this->input->post("name")),
			 'c_id_number' => strtoupper($this->input->post("idNumber")),
			 'c_address' => strtoupper($this->input->post("address")),
			 'c_resident_address' => strtoupper($this->input->post("resident_address")),
			 'c_phone' => $this->input->post("phone"),
			 'c_u_id' => $idUser,
			 'c_no_order' => $noOrder,
			 'c_date_created' => $this->dateToday,
			 'cabang_id' => $this->session->userdata("cabang_id")
			);
			$this->MasterModel->customerAdd($data);
			$data_session = array(
			 'status' => 'success',
			 'message' => "Add customer is success!",
			);
			$this->session->set_userdata($data_session);
			$key = $this->input->post('key');
			if ($key != 'add')
			{
				redirect(base_url() . "transaction");
			}
			else
			{
				redirect(base_url() . "master/customer");
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	function updateLive()
	{
		$id = $this->input->post('id');
		$id = explode(" ", $id);
		$id = $id[0];
		$this->session->unset_userdata('idTransaction');
		$data_session = array(
		 'idCustomer' => $id
		);
		$this->session->set_userdata($data_session);
		$this->cart->destroy();
	}
	
	function buyCart()
	{
		// 🔐 Cek Auth
		if (!$this->session->userdata("authUser")) {
			redirect(base_url());
		}

		$idUser     = $this->session->userdata("idUser");
		$idMaterial = (int) $this->uri->segment(3);

		// 🔎 Ambil Nama Material
		$materialName = $this->MaterialModel
			->materialDataBy('m_id', $idMaterial, 'Buy')
			->row("m_name");

		// Jika material tidak ditemukan
		if (empty($materialName)) {
			redirect(base_url("transaction/buy/"));
		}

		// 👤 Default Customer
		$idCustomer = $this->session->userdata("idCustomer") ?? 7;

		$this->data = [
			"title"        => "TRANSACTION BUY",
			"userData"     => $this->UserModel->userDataById($idUser)->result(),
			"nameCustomer" => $this->MasterModel->customerDatas($idCustomer)->row("c_name"),
			"materianName" => $materialName,  // FIX: Menggunakan materianName agar sesuai dengan view
			"materialName" => $materialName,
			"materialType" => $this->MaterialModel->materialTypeData()->result(),
			"carat"        => $this->MaterialModel->caratData($idMaterial)->result(),
			"potongan"     => $this->MaterialModel->potonganData($idMaterial)->result(),
			"cabang"       => $this->CabangModel->getActiveCabang()
		];

		$this->data['content'] = $this->load->view('BuyCart', $this->data, true);
		$this->load->view("UserTemplate", $this->data);
	}
	function buyAddToCart()
	{
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		if ($authUser == true)
		{
			$idMaterial = $this->input->post('idMaterial');
			$dt = $this->input->post();
			$types = $this->input->post('types');
			$materialType = $this->input->post('materialType');
			$carat = $this->input->post('carat');
			$weight = $this->input->post('weight');
			$percentage = $this->input->post('percentage');
			$this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
			$materialName = $this->MaterialModel->materialDataBy('m_id', $idMaterial, 'Buy')->row("m_name");
			//formula
			$rtiAU = abs($this->MaterialModel->formulaData()->row("f_rti_au"));
			$rtiAG = abs($this->MaterialModel->formulaData()->row("f_rti_ag"));
			$rtiPT = abs($this->MaterialModel->formulaData()->row("f_rti_pt"));
			$rtiRU = abs($this->MaterialModel->formulaData()->row("f_rti_ru"));
			$rtiTA = abs($this->MaterialModel->formulaData()->row("f_rti_ta"));
			$AUpotonganrulow = $this->MasterModel->formulasData('rti-ru-low')->row('a');
			$AUpotonganruhigh = $this->MasterModel->formulasData('rti-ru')->row('a');
			$formulaRTIAu = $this->MasterModel->formulasData('rti-au')->row();

			$AUpotonganK24 = $formulaRTIAu->a;
			$AUpotonganK2499 = $formulaRTIAu->h;
			$AUpresentasePotonganK24 = $formulaRTIAu->b;
			$AUpresentasePotonganCustProf = $formulaRTIAu->f;
			$AUpresentaseLMBaru = $formulaRTIAu->d;
			$AUpresentaseLMLama = $formulaRTIAu->e;
			$AUpotonganubs = $formulaRTIAu->g;
			$AUgb_99 = $formulaRTIAu->gb_99;
			$AUgb_99_9 = $formulaRTIAu->gb_99_9;
			$potongan_lm = $formulaRTIAu->potongan_lm;
			$AGpresentasePotonganAG = $this->MasterModel->formulasData('rti-ag')->row('a');
			$AGpresentasePotonganAGLow = $this->MasterModel->formulasData('rti-ag-low')->row('a');
			$PTpresentasePotonganPt = $this->MasterModel->formulasData('rti-pt')->row('a');
			$PTpresentasePotonganPtLow = $this->MasterModel->formulasData('rti-pt-low')->row('a');
			$PTpresentasePotonganPd = $this->MasterModel->formulasData('rti-pt')->row('b');
			$PTpresentasePotonganPdLow = $this->MasterModel->formulasData('rti-pt-low')->row('b');
			$PTpresentasePotonganRh = $this->MasterModel->formulasData('rti-pt')->row('c');
			$PTpresentasePotonganRhLow = $this->MasterModel->formulasData('rti-pt-low')->row('c');
			$PTpresentasePotonganIr = $this->MasterModel->formulasData('rti-pt')->row('d');
			$PTpresentasePotonganIrLow = $this->MasterModel->formulasData('rti-pt-low')->row('d');

			//cart

			foreach ($this->cart->contents() as $a)
			{
				$idLast = ($a['id']);
			}
			if (!empty($idLast))
			{
				$idLast = $idLast + 1;
			}
			else
			{
				$idLast = 1;
			}
			if ($idMaterial != 1)
			{
				if ($idMaterial == 2)
				{
					// ====== GOLD BUY PRICE CALCULATION (LEGACY COMPATIBLE) ======
					if ($carat == '24(99.9)')
					{
						$price = round($rtiAU + $AUpotonganK2499);
					} 
					else if ($carat == '24(99)') 
					{
						$price = round($rtiAU + $AUpotonganK24);
					} 
					else 
					{
						// Convert carat to float
						$carat = (float)$carat;
						
						// TRUNCATE to 3 decimal places (legacy behavior)
						// 16/24 = 0.6666667 -> 0.666
						// 17/24 = 0.7083333 -> 0.708
						$kadar = floor(($carat / 24) * 1000) / 1000;
						
						// Get potongan percentage for this karat from dynamic field (k16, k17, etc.)
						$potonganKarat = 'k' . $carat;
						$potonganKaratValue = isset($formulaRTIAu->$potonganKarat) ? $formulaRTIAu->$potonganKarat : 0;
						
						// Legacy compatible formula:
						// price = round((kadar * rtiAU) + (kadar * rtiAU * (potonganKarat / 100)))
						$baseValue = $kadar * $rtiAU;
						$adjustment = $baseValue * ($potonganKaratValue / 100);
						$price = round($baseValue + $adjustment);
						
						// Debug logging for verification
						log_message('debug', '[BUY GOLD] Carat: ' . $carat);
						log_message('debug', '[BUY GOLD] Kadar (truncated): ' . $kadar);
						log_message('debug', '[BUY GOLD] Base Value: ' . $baseValue);
						log_message('debug', '[BUY GOLD] Adjustment (' . $potonganKaratValue . '%): ' . $adjustment);
						log_message('debug', '[BUY GOLD] Final Price: ' . $price);
					}
					
					$priceTotal = round($price * $weight);
					
					// Prepare cart data array
					$data = array(
						'id' => $idLast,
						'qty' => (float)$weight,
						'price' => (float)$price,
						'prices' => (float)$price,
						'name' => 'T-Shirt',
						'materialName' => $materialName,
						'materialType' => $materialType,
						'carat' => $carat,
						'weight' => (float)$weight,
						'priceTotal' => (float)$priceTotal,
					);
					
					// Debug logging before cart insert
					log_message('debug', '[BUY GOLD] CART DATA: ' . print_r($data, true));
				}
				else if ($idMaterial == 3)
				{

					// Rumus Lama
					// // if($weight<1){
					// 	$pricepergram = $rtiAU + $AUpresentaseLMBaru;
					// 	$price = $pricepergram*$weight;

					// // }else{
					// // 	$price = $rtiAU;
					// // 	$priceTotal = round($price * $weight);
					// // }
					// End Rumus Lama
					// Rumus Baru
					$tahun_potongan = $this->input->post('tahun_potongan');
					$harga_potongan = json_decode($potongan_lm, true)[$tahun_potongan];
					$pricepergram = $rtiAU + $harga_potongan;
					$price = $pricepergram * $weight;

					// End Rumus Baru
					$priceTotal = round($price);
					$data = array(
					 'id' => $idLast,
					 'qty' => $weight,
					 'price' => $pricepergram,
					 'prices' => $pricepergram,
					 'name' => 'T-Shirt',
					 'materialName' => $materialName,
					 'materialType' => $tahun_potongan,
					 'carat' => '24',
					 'weight' => $weight,
					 'priceTotal' => $priceTotal,
					);
				}
				else if ($idMaterial == 4)
				{
					// if($weight<1){
					$pricepergram = $rtiAU + $AUpresentaseLMLama;
					$price = $pricepergram * $weight;
					$priceTotal = round($price);
					// }else{
					// 	$price = $rtiAU + $AUpresentaseLMLama;
					// 	$priceTotal = round($price * $weight);
					// }
					$data = array(
					 'id' => $idLast,
					 'qty' => $weight,
					 'price' => $pricepergram,
					 'prices' => $pricepergram,
					 'name' => 'T-Shirt',
					 'materialName' => $materialName,
					 'materialType' => '-',
					 'carat' => '24',
					 'weight' => $weight,
					 'priceTotal' => $priceTotal,
					);
				}
				else if ($idMaterial == 5)
				{
					// echo $AGpresentasePotonganAGLow;
					// die;
					if ($types == 'high')
					{
						// echo $types;die;
						// if ($carat == 1000) { 
						// 	$price = round($rtiAG + ($rtiAG * $AGpresentasePotonganAG/100));
						// }
						// else if ($carat == 925) {
						// 	$price = round((0.925 * $rtiAG) + (0.925  * $rtiAG * ($AGpresentasePotonganAG/100)));
						// }
						// else if ($carat == 900) {
						// 	$price = round((0.90 * $rtiAG) + (0.90  * $rtiAG * ($AGpresentasePotonganAG/100)));
						// }else if ($carat == 500) {
						// 	$price = round((0.50 * $rtiAG) + (0.50  * $rtiAG * ($AGpresentasePotonganAG/100)));
						// }
						// else {
						echo $price = floor((($carat / 100) * $rtiAG) + floor(($carat / 100) * $rtiAG * ($AGpresentasePotonganAG / 100)));
						// }
					}
					else
					{
						// if ($carat == 1000) { 
						// 	$price = round($rtiAG + ($rtiAG * $AGpresentasePotonganAGLow/100));
						// }
						// else if ($carat == 925) {
						// 	$price = round((0.925 * $rtiAG) + (0.925  * $rtiAG * ($AGpresentasePotonganAGLow/100)));
						// }
						// else if ($carat == 900) {
						// 	$price = round((0.90 * $rtiAG) + (0.90  * $rtiAG * ($AGpresentasePotonganAGLow/100)));
						// }else if ($carat == 500) {
						// 	$price = round((0.50 * $rtiAG) + (0.50  * $rtiAG * ($AGpresentasePotonganAGLow/100)));
						// }
						// else {
						$price = round((($carat / 100) * $rtiAG) + round(($carat / 100) * $rtiAG * ($AGpresentasePotonganAGLow / 100)));
						// }
					}
					$priceTotal = round($price * $weight);
					// echo $carat;
					// die;
					$data = array(
					 'id' => $idLast,
					 'qty' => $weight,
					 'price' => $price,
					 'prices' => $price,
					 'name' => 'T-Shirt',
					 'types' => $types,
					 'materialName' => $materialName,
					 'materialType' => $materialType,
					 'carat' => 'Ag ' . $carat . ' %',
					 'weight' => $weight,
					 'priceTotal' => $priceTotal,
					);
				}
				else if ($idMaterial == 6)
				{
					if ($types == 'high')
					{
						if ($percentage < 100)
						{
							// $price = floor((($percentage/100) * $rtiPT) - (($percentage/100) * $rtiPT *  ($PTpresentasePotonganPt/100)));
							// $price = floor(($percentage/100) * floor(($rtiPT) +  (($rtiPT) * $PTpresentasePotonganPt/100)));
							// 99.98% * (373.052 - (373.052*-15%))
							$price = floor(($percentage / 100) * floor($rtiPT + ($rtiPT * ($PTpresentasePotonganPt / 100))));
							$priceTotal = floor($price * $weight);
						}
						else
						{
							// $price = round((($percentage/100) * $rtiPT) - (($percentage/100) * $rtiPT *  ($PTpresentasePotonganPt/100)));
							// $price = round(($percentage/100) * round(($rtiPT) +  (($rtiPT) * $PTpresentasePotonganPt/100)));
							$price = round($rtiPT + ($rtiPT * ($PTpresentasePotonganPt / 100)));
							$priceTotal = round($price * $weight);
						}
					}
					else
					{
						if ($percentage < 100)
						{
							// $price = floor((($percentage/100) * $rtiPT) - (($percentage/100) * $rtiPT *  ($PTpresentasePotonganPt/100)));
							// $price = floor(($percentage/100) * floor(($rtiPT) +  (($rtiPT) * $PTpresentasePotonganPt/100)));
							// 99.98% * (373.052 - (373.052*-15%))
							$price = floor(($percentage / 100) * floor($rtiPT + ($rtiPT * ($PTpresentasePotonganPtLow / 100))));
							$priceTotal = floor($price * $weight);
						}
						else
						{
							// $price = round((($percentage/100) * $rtiPT) - (($percentage/100) * $rtiPT *  ($PTpresentasePotonganPt/100)));
							// $price = round(($percentage/100) * round(($rtiPT) +  (($rtiPT) * $PTpresentasePotonganPt/100)));
							$price = round($rtiPT + ($rtiPT * ($PTpresentasePotonganPtLow / 100)));
							$priceTotal = round($price * $weight);
						}
					}
					$data = array(
					'id' => $idLast,
					'qty' => $weight,
					'price' => $price,
					'prices' => $price,
					'name' => 'T-Shirt',
					'types' => $types,
					'materialName' => $materialName,
					'materialType' => $materialType,
					'carat' => 'Pt ' . $percentage . ' %',
					'weight' => $weight,
					'priceTotal' => $priceTotal,
					);
				}
				else if ($idMaterial == 7)
				{
					if ($types == 'high')
					{
						if ($percentage < 100)
						{
							//	persentase * (rti pt + (rti pt* potongan))
							//  $weight.' '.$percentage;
							// $price = ((($percentage/100) * $rtiPT) + (($percentage/100) * $rtiPT *  ($PTpresentasePotonganPd/100)));
							$price = floor(($percentage / 100) * floor(($rtiPT) + (($rtiPT) * $PTpresentasePotonganPd / 100)));
							$priceTotal = floor($price * $weight);
						}
						else
						{
							// $price = round((($percentage/100) * $rtiPT) + (($percentage/100) * $rtiPT *  ($PTpresentasePotonganPd/100)));
							$price = round(($percentage / 100) * round(($rtiPT) + (($rtiPT) * $PTpresentasePotonganPd / 100)));
							$priceTotal = round($price * $weight);
						}
					}
					else
					{
						if ($percentage < 100)
						{
							//	persentase * (rti pt + (rti pt* potongan))
							//  $weight.' '.$percentage;
							// $price = ((($percentage/100) * $rtiPT) + (($percentage/100) * $rtiPT *  ($PTpresentasePotonganPd/100)));
							$price = floor(($percentage / 100) * floor(($rtiPT) + (($rtiPT) * $PTpresentasePotonganPdLow / 100)));
							$priceTotal = floor($price * $weight);
						}
						else
						{
							// $price = round((($percentage/100) * $rtiPT) + (($percentage/100) * $rtiPT *  ($PTpresentasePotonganPd/100)));
							$price = round(($percentage / 100) * round(($rtiPT) + (($rtiPT) * $PTpresentasePotonganPdLow / 100)));
							$priceTotal = round($price * $weight);
						}
					}
					$data = array(
					'id' => $idLast,
					'qty' => $weight,
					'price' => $price,
					'prices' => $price,
					'name' => 'T-Shirt',
					'types' => $types,
					'materialName' => $materialName,
					'materialType' => $materialType,
					'carat' => 'Pd ' . $percentage . ' %',
					'weight' => $weight,
					'priceTotal' => $priceTotal,
					);
				}
				else if ($idMaterial == 8)
				{
					// $price = (($percentage/100) * $rtiPT) - (($percentage/100) * $rtiPT *  ($PTpresentasePotonganIr/100));
					// -	Harga platinum 	= RTI Pt – (harga RTI Pt x 15 %) 
					// -	Rumus ir 		= harga platinum - (harga platinum x 30%) 
					// Rumus : total price 	= persentasi*(harga platinum-(harga platinum*potongan harga))
					// = 69.3%*(349009-(349009*30%))
					// = 169304
					if ($types == 'high')
					{
						// if($percentage<100){
						$pricePlatinum = floor($rtiPT + ($rtiPT * ($PTpresentasePotonganPt / 100)));


						$price = round(($rtiPT + ($rtiPT * ($PTpresentasePotonganIr / 100))) * $percentage / 100);
						// 451625 +/- (451625 * (80/100)) *100 / 100
						$priceTotal = ($price * $weight);
						// }else{
						// 	$priceold = $rtiPT * 40 / 100 * $percentage / 100;
						// 	// $pricePlatinum = round($rtiPT + ($rtiPT * -($PTpresentasePotonganPt/100)));
						// 	$price = floor($rtiPT - $priceold);
						// 	echo "<pre>";
						// 	print_r ($rtiPT);
						// 	echo "</pre>";
						// 	$priceTotal = round($price * $weight);	
						// }
					}
					else
					{
						// if($percentage<100){
						// $pricePlatinum = floor($rtiPT + ($rtiPT * -($PTpresentasePotonganPt/100)));
						$price = round(($rtiPT + ($rtiPT * ($PTpresentasePotonganIrLow / 100))) * $percentage / 100);
						$priceTotal = ($price * $weight);
						// }else{
						// 	$pricePlatinum = round($rtiPT + ($rtiPT * -($PTpresentasePotonganPtLow/100)));
						// 	$price = round(($percentage/100) * round($pricePlatinum - ($pricePlatinum * ($PTpresentasePotonganIrLow/100))));
						// 	$priceTotal = round($price * $weight);	
						// }
					}
					// 	die;
					$data = array(
					'id' => $idLast,
					'qty' => $weight,
					'price' => $price,
					'prices' => $price,
					'name' => 'T-Shirt',
					'types' => $types,
					'materialName' => $materialName,
					'materialType' => $materialType,
					'carat' => 'Ir ' . $percentage . ' %',
					'weight' => $weight,
					'priceTotal' => $priceTotal,
					);
				}
				else if ($idMaterial == 9)
				{
					if ($types == 'high')
					{
						if ($percentage < 100)
						{
							// $price = floor((($percentage/100) * $rtiPT) + (($percentage/100) * $rtiPT *  ($PTpresentasePotonganRh/100)));
							$price = floor(($percentage / 100) * floor(($rtiPT) + (($rtiPT) * $PTpresentasePotonganRh / 100)));
							$priceTotal = floor($price * $weight);
						}
						else
						{
							// $price = round((($percentage/100) * $rtiPT) + (($percentage/100) * $rtiPT *  ($PTpresentasePotonganRh/100)));
							$price = round(($percentage / 100) * round(($rtiPT) + (($rtiPT) * $PTpresentasePotonganRh / 100)));
							$priceTotal = round($price * $weight);
						}
					}
					else
					{
						if ($percentage < 100)
						{
							// $price = floor((($percentage/100) * $rtiPT) + (($percentage/100) * $rtiPT *  ($PTpresentasePotonganRh/100)));
							$price = floor(($percentage / 100) * floor(($rtiPT) + (($rtiPT) * $PTpresentasePotonganRhLow / 100)));
							$priceTotal = floor($price * $weight);
						}
						else
						{
							// $price = round((($percentage/100) * $rtiPT) + (($percentage/100) * $rtiPT *  ($PTpresentasePotonganRh/100)));
							$price = round(($percentage / 100) * round(($rtiPT) + (($rtiPT) * $PTpresentasePotonganRhLow / 100)));
							$priceTotal = round($price * $weight);
						}
					}
					$data = array(
					'id' => $idLast,
					'qty' => $weight,
					'price' => $price,
					'prices' => $price,
					'name' => 'T-Shirt',
					'types' => $types,
					'materialName' => $materialName,
					'materialType' => $materialType,
					'carat' => 'Rh ' . $percentage . ' %',
					'weight' => $weight,
					'priceTotal' => $priceTotal,
					);
				}
				else if ($idMaterial == 10)
				{
					// if($percentage<100){
					// // $price = floor((($percentage/100) * $rtiPT) + (($percentage/100) * $rtiPT *  ($PTpresentasePotonganRh/100)));
					// // echo $price = floor(($rtiAU/100) - floor((($rtiAU/100)-$AUpresentasePotonganCustProf)));
					// // echo $rtiAU;
					// $price = floor($rtiAU - ($rtiAU * ($AUpresentasePotonganCustProf/100)));
					// // $price = floor((($percentage/100) * ($price)));
					// $priceTotal = $price * $weight; 	
					// }else{
					// // $price = round((($percentage/100) * $rtiPT) + (($percentage/100) * $rtiPT *  ($PTpresentasePotonganRh/100)));
					// $price = round($rtiAU - ($rtiAU * ($AUpresentasePotonganCustProf/100)));
					// $price = round((($percentage/100) * ($price)));
					// $priceTotal = $price * $weight; 	
					// }
					$price = ($rtiAU + ($rtiAU * $AUpresentasePotonganCustProf / 100)) * $percentage / 100;
					$priceTotal = ($price * $weight);
					$data = array(
					 'id' => $idLast,
					 'qty' => $weight,
					 'price' => $price,
					 'prices' => $price,
					 'name' => 'T-Shirt',
					 'materialName' => $materialName,
					 'materialType' => $materialType,
					 'carat' => 'Au ' . $percentage . ' %',
					 'weight' => $weight,
					 'priceTotal' => $priceTotal,
					);
				}
				else if ($idMaterial == 17)
				{
					$price = ($rtiAU + $AUpotonganubs);
					$priceTotal = $price * $weight;
					$data = array(
					 'id' => $idLast,
					 'qty' => $weight,
					 'price' => $price,
					 'prices' => $price,
					 'name' => 'T-Shirt',
					 'materialName' => $materialName,
					 'materialType' => '-',
					 'carat' => '',
					 'weight' => $weight,
					 'priceTotal' => $priceTotal,
					);
				}
				else if ($idMaterial == 19)
				{
					if ($types == 'high')
					{
						$pricepergram = floor((($percentage / 100) * $rtiRU) + floor(($percentage / 100) * $rtiRU * ($AUpotonganruhigh / 100)));
					}
					else
					{
						$pricepergram = floor((($percentage / 100) * $rtiRU) + floor(($percentage / 100) * $rtiRU * ($AUpotonganrulow / 100)));
					}

					$price = $pricepergram * $weight;

					// End Rumus Baru
					$priceTotal = round($price);
					$data = array(
					 'id' => $idLast,
					 'qty' => $weight,
					 'price' => $pricepergram,
					 'prices' => $pricepergram,
					 'name' => 'T-Shirt',
					 'materialName' => $materialName,
					 'types' => $types,
					 'materialType' => '-',
					 'carat' => 'RU ' . $percentage . '%',
					 'weight' => $weight,
					 'priceTotal' => $priceTotal,
					);
				}
				else if ($idMaterial == 21)
				{


					$pricepergram = $rtiTA * $percentage / 100;
					$priceTotal = $pricepergram * $weight;

					// End Rumus Baru
					$priceTotal = round($priceTotal);
					$data = array(
					 'id' => $idLast,
					 'qty' => $weight,
					 'price' => $pricepergram,
					 'prices' => $pricepergram,
					 'name' => 'T-Shirt',
					 'materialName' => $materialName,
					 'materialType' => '-',
					 'carat' => $percentage . "%",
					 'weight' => $weight,
					 'priceTotal' => $priceTotal,
					);
				}
				else if ($idMaterial == 23)
				{
					if ($carat == '24(99.9)')
					{


						$pricepergram = $rtiAU + $AUgb_99_9;
						// $price = round(($rtiAU + ($rtiAU * - (16/100))) * $percentage/100);
						// $priceTotal = ($price * $weight);
					}
					else
					{
						$pricepergram = $rtiAU + $AUgb_99;
					}
					$price = $pricepergram * $weight;

					// End Rumus Baru
					$priceTotal = round($price);
					$data = array(
					 'id' => $idLast,
					 'qty' => $weight,
					 'price' => $pricepergram,
					 'prices' => $pricepergram,
					 'name' => 'T-Shirt',
					 'materialName' => $materialName,
					 'materialType' => '-',
					 'carat' => 'K' . $carat,
					 'weight' => $weight,
					 'priceTotal' => $priceTotal,
					);
				}

			}
			else
			{
				$weight = 1;
				$price = $this->input->post('price');
				$priceTotal = $price * $weight;
				$data = array(
				 'id' => $idLast,
				 'qty' => $weight,
				 'price' => $price,
				 'prices' => $price,
				 'name' => 'T-Shirt',
				 'materialName' => $materialName,
				 'materialType' => '-',
				 'carat' => '-',
				 'weight' => '-',
				 'priceTotal' => $priceTotal,
				);
			}
			// if($idMaterial <= 10 || $idMaterial == 17){
			$this->cart->insert($data);
			// }
			// Add To Transaction

			$idTransaction = $this->session->userdata("idTransaction");
			$total = 0;
			$qtt = 0;
			foreach ($this->cart->contents() as $a)
			{
				$total = $total + $a["priceTotal"];
				$qtt = $qtt + 1;
			}
			
			// DEBUG: Log cart calculation
			log_message('debug', '[BUY ADD TO CART] Cart Total: ' . $total);
			log_message('debug', '[BUY ADD TO CART] Cart Qty: ' . $qtt);
			log_message('debug', '[BUY ADD TO CART] Session idTransaction BEFORE: ' . $idTransaction);
			
			if(!$idTransaction){
				log_message('debug', '[BUY ADD TO CART] Creating NEW transaction - no existing idTransaction');
				
				$idCustomer = $this->session->userdata("idCustomer");
				if(empty($idCustomer)){
					$idCustomer = 7;
				}
				$this->data['nameCustomer'] = $this->MasterModel->customerDatas($idCustomer)->row("c_name");
				$this->data['phoneCustomer'] = $this->MasterModel->customerDatas($idCustomer)->row("c_phone");
				
				$year = date('Y',strtotime($this->dateToday));
				$noOrder = $this->db->query("SELECT COUNT(*) as count FROM tb_transaction WHERE YEAR(t_date_created)='$year'")->row('count');
				if(!empty($noOrder)){
					$noOrderNew = "PB-".substr(date('Y',strtotime($this->dateToday)),2).date('m',strtotime($this->dateToday))."-".($noOrder+1);
				}else{
					$noOrderNew = "PB-".substr(date('Y',strtotime($this->dateToday)),2).date('m',strtotime($this->dateToday))."-1";
				}
				
				log_message('debug', '[BUY ADD TO CART] New order number: ' . $noOrderNew);
				
				$data = array(
					't_no_order' => $noOrderNew,
					't_date_created' => $this->dateToday,
					't_status' => 'PROSES',
					't_created_at' => date('H:i:s',strtotime($this->dateToday)),
					't_created_by' => $idUser,
					't_customer' => $idCustomer,
					't_phone' => $this->data['phoneCustomer'],
					't_note' => '',
					't_type' => 'BUY',
					't_paid_by' => $this->data['nameCustomer'],
					't_receive_by' => $idUser,
					't_price_total' => $total,
					't_qtt' => $qtt,
					't_visible' => 1,
				);
				
				log_message('debug', '[BUY ADD TO CART] Inserting transaction data: ' . json_encode($data));
				
				$idTransaction = $this->TransactionModel->buyCheckout($data);
				
				log_message('debug', '[BUY ADD TO CART] New transaction ID from model: ' . $idTransaction);
				
				$data_session = array(
					'idTransaction' => $idTransaction,
					'jenis_transaksi' => "buy"
				);
				$this->session->set_userdata($data_session);
				
				log_message('debug', '[BUY ADD TO CART] Session updated with idTransaction: ' . $idTransaction);
			}
			else
			{
				// DEBUG: Log update transaction
				log_message('debug', '[BUY ADD TO CART] Updating existing transaction ID: ' . $idTransaction);
				
				$data = array(
				 't_price_total' => $total,
				 't_qtt' => $qtt,
				);
				
				// DEBUG: Log update data
				log_message('debug', '[BUY ADD TO CART] Update Data: ' . json_encode($data));
				
				$this->db->update('tb_transaction', $data, ['t_id' => $idTransaction]);
				
				// DEBUG: Log update result
				$affected = $this->db->affected_rows();
				log_message('debug', '[BUY ADD TO CART] Update affected rows: ' . $affected);
			}
			
			// DEBUG: Log items insert start
			log_message('debug', '[BUY ADD TO CART] Starting to insert ' . count($this->cart->contents()) . ' items');
			
			$this->db->where('ti_t_id', $idTransaction);
			$this->db->delete('tb_transaction_items');
			foreach ($this->cart->contents() as $a)
			{
				$dataItems = array(
				 'ti_t_id' => $idTransaction,
				 'ti_material' => $a['materialName'],
				 'ti_material_type' => $a['materialType'],
				 'ti_carat' => $a['carat'],
				 'ti_weight' => $a['weight'],
				 'ti_price' => $a['prices'],
				 'ti_high_low' => strval($a['types']),
				 'ti_price_total' => $a['priceTotal'],
				 'ti_date_created' => $this->dateToday,
				 'ti_rumus' => @$a['rumus'],
				);
				
				// DEBUG: Log each item
				log_message('debug', '[BUY ADD TO CART] Inserting item: ' . json_encode($dataItems));
				
				$this->TransactionModel->buyCheckoutItems($dataItems);
			}
			
			// DEBUG: Log completion
			log_message('debug', '[BUY ADD TO CART] Completed! Items inserted: ' . count($this->cart->contents()));
			// echo "<pre>";
			// print_r ($idTransaction);
			// echo "</pre>";
			redirect(base_url() . "transaction/buy/$idMaterial/?t=$types");
		}
		else
		{
			redirect(base_url());
		}
	}
	function buyAddToCartReset()
	{
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		if ($authUser == true)
		{
			$idMaterial = $this->input->get('idMaterial');
			$idRow = $this->input->get('idRow');
			$t = $this->input->get('t');
			// die;
			$idTransaction = $this->session->userdata("idTransaction");
			$this->db->where('ti_t_id', $idTransaction);
			$this->db->delete('tb_transaction_items');

			if (!empty($idRow))
			{
				$qty = 0;
				$array = array(
				 'rowid' => $idRow,
				 'qty' => $qty
				);
				print_r($array);
				$this->cart->update($array);
				foreach ($this->cart->contents() as $a)
				{
					$dataItems = array(
					 'ti_t_id' => $idTransaction,
					 'ti_material' => $a['materialName'],
					 'ti_material_type' => $a['materialType'],
					 'ti_carat' => $a['carat'],
					 'ti_weight' => $a['weight'],
					 'ti_price' => $a['prices'],
					 'ti_high_low' => strval($a['types']),
					 'ti_price_total' => $a['priceTotal'],
					 'ti_date_created' => $this->dateToday,
					 'ti_rumus' => @$a['rumus'],
					);
					$this->TransactionModel->buyCheckoutItems($dataItems);
				}
			}
			else
			{
				$this->cart->destroy();
			}
			redirect(base_url() . "transaction/buy/$idMaterial/?t=$t");
		}
		else
		{
			redirect(base_url());
		}
	}
	function buyCheckout()
	{
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		if ($authUser == true)
		{
			$idTransaction = $this->session->userdata("idTransaction");
			
			// DEBUG: Log start of buyCheckout
			log_message('debug', '[BUY CHECKOUT] =======================================');
			log_message('debug', '[BUY CHECKOUT] Transaction ID: ' . $idTransaction);
			log_message('debug', '[BUY CHECKOUT] User ID: ' . $idUser);
			
			// VALIDATION: Check if idTransaction is valid
			// Note: session stores as string "0" not integer 0
			if (empty($idTransaction) || $idTransaction == 0 || $idTransaction == "0") {
				log_message('debug', '[BUY CHECKOUT] ERROR: Invalid Transaction ID: "' . $idTransaction . '" (type: ' . gettype($idTransaction) . ')');
				log_message('debug', '[BUY CHECKOUT] Session data: ' . json_encode($this->session->userdata()));
				
				$this->session->set_userdata([
					'status' => 'error',
					'message' => 'Transaksi tidak valid. Silakan tambah item ke cart terlebih dahulu.'
				]);
				redirect(base_url() . 'transaction/buy/');
				return;
			}
			
			// Check if transaction exists in database
			$cek_transaksi = $this->db->get_where('tb_transaction', ['t_id' => $idTransaction])->row();
			if (!$cek_transaksi) {
				log_message('debug', '[BUY CHECKOUT] ERROR: Transaction not found in database!');
				$this->session->set_userdata([
					'status' => 'error',
					'message' => 'Transaksi tidak ditemukan di database.'
				]);
				redirect(base_url() . 'transaction/buy/');
				return;
			}
			
			$this->db->where('ti_t_id', $idTransaction);
			$this->db->delete('tb_transaction_items');
			
			// DEBUG: Log deleted items
			log_message('debug', '[BUY CHECKOUT] Deleted existing items for ti_t_id: ' . $idTransaction);
			
			// Get POST data
			$biayaAdmin = $this->input->post('operator') . '' . $this->input->post('biayaAdmin');
			$cabang_id = (int) $this->input->post('cabang_id');
			$payment_method = $this->input->post('payment_method');
			
			// DEBUG: Log POST data
			log_message('debug', '[BUY CHECKOUT] POST Data: ' . json_encode([
				'operator' => $this->input->post('operator'),
				'biayaAdmin' => $this->input->post('biayaAdmin'),
				'biayaAdmin_concat' => $biayaAdmin,
				'cabang_id' => $cabang_id,
				'payment_method' => $payment_method
			]));
			
			// Validate cabang exists in database
			if ($cabang_id > 0) {
				$cek_cabang = $this->db->get_where('tb_cabang', ['id' => $cabang_id])->row();
				if (!$cek_cabang) {
					// Use session cabang_id if invalid
					$cabang_id = (int) $this->session->userdata("cabang_id");
					log_message('debug', '[BUY CHECKOUT] Invalid cabang_id, using session: ' . $cabang_id);
				}
			}
			
			$total = 0;
			$qtt = 0;
			foreach ($this->cart->contents() as $a)
			{
				$total = $total + $a["priceTotal"];
				$qtt = $qtt + 1;
			}
			
			// DEBUG: Log calculated totals
			log_message('debug', '[BUY CHECKOUT] Cart Total: ' . $total);
			log_message('debug', '[BUY CHECKOUT] Cart Qty: ' . $qtt);
			
			$data = array(
			 't_status' => 'CHECKOUT',
			 't_price_total' => $total,
			 't_price_admin' => $biayaAdmin,
			 't_qtt' => $qtt,
			 't_cabang_id' => $cabang_id > 0 ? $cabang_id : NULL,
			 't_payment_method' => !empty($payment_method) ? $payment_method : NULL,
			);
			
			// DEBUG: Log update data
			log_message('debug', '[BUY CHECKOUT] Update Data: ' . json_encode($data));
			
			$this->db->update('tb_transaction', $data, ['t_id' => $idTransaction]);
			
			// DEBUG: Log update result
			$affected = $this->db->affected_rows();
			log_message('debug', '[BUY CHECKOUT] Update affected rows: ' . $affected);
			
			// DEBUG: Log cart items before insert
			log_message('debug', '[BUY CHECKOUT] Cart Contents: ' . json_encode($this->cart->contents()));
			
			foreach ($this->cart->contents() as $a)
			{
				$dataItems = array(
				 'ti_t_id' => $idTransaction,
				 'ti_material' => $a['materialName'],
				 'ti_material_type' => $a['materialType'],
				 'ti_carat' => $a['carat'],
				 'ti_weight' => $a['weight'],
				 'ti_price' => $a['prices'],
				 'ti_high_low' => strval($a['types']),
				 'ti_price_total' => $a['priceTotal'],
				 'ti_date_created' => $this->dateToday,
				 'ti_rumus' => @$a['rumus'],
				);
				
				// DEBUG: Log each item before insert
				log_message('debug', '[BUY CHECKOUT] Inserting Item: ' . json_encode($dataItems));
				
				$this->TransactionModel->buyCheckoutItems($dataItems);
				
				// DEBUG: Log item insert result
				log_message('debug', '[BUY CHECKOUT] Item inserted for material: ' . $a['materialName']);
			}
			
			$this->session->unset_userdata('idCustomer');
			$this->cart->destroy();
			$data_session = array(
			 'status' => 'success',
			 'message' => "Checkout no order is success!!",
			);
			$this->session->set_userdata($data_session);
			
			// DEBUG: Log completion
			log_message('debug', '[BUY CHECKOUT] Completed successfully!');
			log_message('debug', '[BUY CHECKOUT] =======================================');
			
			// Generate and save PDF
			$pdfResult = $this->generateBuyPdf($idTransaction);
			if ($pdfResult['success']) {
				log_message('debug', '[BUY CHECKOUT] PDF generated successfully: ' . $pdfResult['pdf_filename']);
			} else {
				log_message('error', '[BUY CHECKOUT] PDF generation failed: ' . $pdfResult['message']);
			}
			
			redirect(base_url() . "report/buy-print/$idTransaction/");
		}
		else
		{
			redirect(base_url());
		}
	}
	function sell()
	{
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		$this->data["title"] = "TRANSACTION SELL";
		if ($authUser == true)
		{
			$this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
			$type = $this->UserModel->userDataById($idUser)->row("u_rule");
			$id = $this->input->get('id');
			$this->data['data'] = $this->MaterialModel->materialData('Sell')->result();
			$this->data['content'] = $this->load->view('Sell', $this->data, true);
			$this->load->view("UserTemplate", $this->data);
		}
		else
		{
			redirect(base_url());
		}
	}
	function sellCart()
	{
		if (!$this->session->userdata("authUser")) {
			redirect(base_url());
		}

		$idUser = $this->session->userdata("idUser");
		$idMaterial = (int) $this->uri->segment(3);

		$materialName = $this->MaterialModel
			->materialDataBy('m_id', $idMaterial, 'Sell')
			->row("m_name");

		if (empty($materialName)) {
			redirect(base_url("transaction/sell/"));
		}

		$idCustomer = $this->session->userdata("idCustomer") ?? 7;

		$this->data = [
			"title"          => "TRANSACTION SELL",
			"nameCustomer"   => $this->MasterModel->customerDatas($idCustomer)->row("c_name"),
			"materianName"   => $materialName,  // FIX: Menggunakan materianName agar sesuai dengan view
			"materialName"   => $materialName,
			"userData"       => $this->UserModel->userDataById($idUser)->result(),
			"materialType"   => $this->MaterialModel->materialTypeData()->result(),
			"potongan"       => $this->MaterialModel->potonganData($idMaterial)->result(),
			"carat"          => $this->MaterialModel->caratData($idMaterial)->result(),
			"configMaterial" => $this->mmodel
									->selectWhere('config_material', ['material_id' => $idMaterial])
									->result(),
			"cabang"         => $this->CabangModel->getActiveCabang()
		];

		$this->data['content'] = $this->load->view('SellCart', $this->data, true);
		$this->load->view("UserTemplate", $this->data);
	}
	
	function sellAddToCart()
	{
		if (!$this->session->userdata("authUser")) {
			redirect(base_url());
		}

		$idUser        = $this->session->userdata("idUser");
		$idMaterial    = (int) $this->input->post('idMaterial');
		$idCustomer    = $this->session->userdata("idCustomer") ?? 7;
		$idTransaction = $this->session->userdata("idTransaction");
		$weight        = (float) $this->input->post('weight');
		$percentage    = (float) $this->input->post('percentage');

		log_message('debug', '=========== SELL ADD TO CART START ===========');
		log_message('debug', 'POST: ' . json_encode($this->input->post()));

		if ($weight <= 0) {
			log_message('error', '[SELL] Invalid weight');
			redirect($_SERVER['HTTP_REFERER']);
			return;
		}

		$material = $this->MaterialModel
			->materialDataBy('m_id', $idMaterial, 'Sell')
			->row();

		if (!$material) {
			log_message('error', '[SELL] Material not found: ' . $idMaterial);
			redirect($_SERVER['HTTP_REFERER']);
			return;
		}

		$materialName = $material->m_name;
		$mType        = $material->m_type;

		$idLast = 1;
		foreach ($this->cart->contents() as $a) {
			$idLast = $a['id'] + 1;
		}

		$formula = $this->MaterialModel->formulaData()->row();
		if (!$formula) {
			log_message('error', '[SELL] Formula not found');
			redirect($_SERVER['HTTP_REFERER']);
			return;
		}

		$data = null;

		/* ==============================================
		SPECIAL MATERIAL 18 (CONFIG BASED)
		============================================== */
		if ($idMaterial === 18) {

			$idConfig = (int) $this->input->post('idConfig');
			$config = $this->mmodel
				->selectWhere('config_material', ['id' => $idConfig])
				->row();

			if (!$config) {
				log_message('error', '[SELL] Config not found');
				redirect($_SERVER['HTTP_REFERER']);
				return;
			}

			$pricePerGram = (float) $config->price;
			$weight       = (float) ($config->weight ?? 1);
		}

		/* ==============================================
		SPECIAL MATERIAL 13 (LM FORMULA)
		============================================== */
		elseif ($idMaterial === 13) {

			$field = 'f_' . str_replace('.', '_coma_', $weight);

			if (!isset($formula->$field)) {
				log_message('error', '[SELL] Formula field not found: ' . $field);
				redirect($_SERVER['HTTP_REFERER']);
				return;
			}

			$basePrice = (float) $formula->$field;

			$potongan_lm = $this->MasterModel
				->formulasData('lm')
				->row('potongan_lm');

			$tahun = $this->input->post('tahun_potongan');
			$potArr = json_decode($potongan_lm, true);

			if (!isset($potArr[$tahun])) {
				log_message('error', '[SELL] Potongan tahun invalid');
				redirect($_SERVER['HTTP_REFERER']);
				return;
			}

			$pricePerGram = $basePrice + (float) $potArr[$tahun];
		}

		/* ==============================================
		GENERIC BASED ON M_TYPE
		============================================== */
		else {

			switch ($mType) {

				case 'AU':
					$rti = $formula->f_rti_au_sell ?? 0;
					$pricePerGram = round(($percentage / 100) * $rti);
					break;

				case 'AG':
					$rti = $formula->f_rti_ag_sell ?? 0;
					$pricePerGram = round(($percentage / 100) * $rti);
					break;

				case 'PT':
				case 'PD':
				case 'RH':
				case 'IR':
					$rti = $formula->f_rti_pt_sell ?? 0;
					$pricePerGram = round(($percentage / 100) * $rti);
					break;

				case 'RU':
					$rti = $formula->f_rti_ru_sell ?? 0;
					$pricePerGram = round(($percentage / 100) * $rti);
					break;

				case 'TA':
					$rti = $formula->f_rti_ta_sell ?? 0;
					$pricePerGram = round(($percentage / 100) * $rti);
					break;

				case 'UBS':
					$pricePerGram = round($formula->f_material_ubs_sell ?? 0);
					break;

				default:
					log_message('error', '[SELL] Unsupported m_type: ' . $mType);
					redirect($_SERVER['HTTP_REFERER']);
					return;
			}
		}

		$priceTotal = round($pricePerGram * $weight);

		$data = [
			'id'           => $idLast,
			'qty'          => $weight,
			'price'        => $pricePerGram,
			'prices'       => $pricePerGram,
			'name'         => 'T-Shirt',
			'materialName' => $materialName,
			'materialType' => '-',
			'carat'        => $percentage ? $percentage . '%' : '-',
			'weight'       => $weight,
			'priceTotal'   => $priceTotal,
		];

		$this->cart->insert($data);

		log_message('debug', '[SELL] Inserted item: ' . json_encode($data));

		/* ==============================================
		RECALCULATE TOTAL
		============================================== */
		$total = 0;
		$qtt   = 0;

		foreach ($this->cart->contents() as $item) {
			$total += $item["priceTotal"];
			$qtt++;
		}

		/* ==============================================
		CREATE OR UPDATE HEADER
		============================================== */
		if (!$idTransaction) {

			$year  = date('Y');
			$count = $this->db
				->where('YEAR(t_date_created)', $year)
				->count_all_results('tb_transaction_sell');

			$noOrderNew = "PJ-" . substr($year, 2) . date('m') . "-" . ($count + 1);

			$phoneCustomer = $this->MasterModel
				->customerDatas($idCustomer)
				->row("c_phone");

			$dataHeader = [
				't_no_order'     => $noOrderNew,
				't_date_created' => $this->dateToday,
				't_status'       => 'PROSES',
				't_created_at'   => date('H:i:s'),
				't_created_by'   => $idUser,
				't_customer'     => $idCustomer,
				't_phone'        => $phoneCustomer,
				't_note'         => '',
				't_type'         => 'SELL',
				't_price_total'  => $total,
				't_qtt'          => $qtt,
				't_visible'      => 1,
			];

			$idTransaction = $this->TransactionModel->sellCheckout($dataHeader);

			$this->session->set_userdata([
				'idTransaction'   => $idTransaction,
				'jenis_transaksi' => "sell"
			]);
		} else {

			$this->db->update(
				'tb_transaction_sell',
				[
					't_price_total' => $total,
					't_qtt'         => $qtt,
				],
				['t_id' => $idTransaction]
			);
		}

		/* ==============================================
		INSERT ITEMS
		============================================== */
		$this->db->where('ti_t_id', $idTransaction)
				->delete('tb_transaction_items_sell');

		foreach ($this->cart->contents() as $item) {

			$dataItems = [
				'ti_t_id'        => $idTransaction,
				'ti_material'    => $item['materialName'],
				'ti_material_type'=> $item['materialType'],
				'ti_carat'       => $item['carat'],
				'ti_weight'      => $item['weight'],
				'ti_price'       => $item['prices'],
				'ti_price_total' => $item['priceTotal'],
				'ti_date_created'=> $this->dateToday,
			];

			$this->TransactionModel->sellCheckoutItems($dataItems);
		}

		log_message('debug', '=========== SELL ADD TO CART END ===========');

		redirect(base_url() . "transaction/sell/$idMaterial/");
	}

	function sellAddToCartReset()
	{
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		if ($authUser == true)
		{
			$idMaterial = $this->input->get('idMaterial');
			$idRow = $this->input->get('idRow');

			$idTransaction = $this->session->userdata("idTransaction");
			$this->db->where('ti_t_id', $idTransaction);
			$this->db->delete('tb_transaction_items_sell');


			if (!empty($idRow))
			{
				$qty = 0;
				$array = array(
				 'rowid' => $idRow,
				 'qty' => $qty
				);
				print_r($array);
				$this->cart->update($array);

				foreach ($this->cart->contents() as $a)
				{
					$dataItems = array(
					 'ti_t_id' => $idTransaction,
					 'ti_material' => $a['materialName'],
					 'ti_material_type' => $a['materialType'],
					 'ti_carat' => $a['carat'],
					 'ti_weight' => $a['weight'],
					 'ti_price' => $a['prices'],
					 'ti_price_total' => $a['priceTotal'],
					 'ti_date_created' => $this->dateToday,
					 'ti_rumus' => @$a['rumus'],
					);
					$this->TransactionModel->sellCheckoutItems($dataItems);
				}
			}
			else
			{
				$this->cart->destroy();
			}
			redirect(base_url() . "transaction/sell/$idMaterial/");
		}
		else
		{
			redirect(base_url());
		}
	}
	
	function sellCheckout()
	{
		if (!$this->session->userdata("authUser")) {
			redirect(base_url());
		}

		$idUser = $this->session->userdata("idUser");
		$idTransaction = $this->session->userdata("idTransaction");

		log_message('debug', '[SELL CHECKOUT] ===============================');
		log_message('debug', '[SELL CHECKOUT] Start Checkout');
		log_message('debug', '[SELL CHECKOUT] Transaction ID: ' . $idTransaction);

		if (empty($idTransaction) || $idTransaction == 0 || $idTransaction == "0") {
			log_message('error', '[SELL CHECKOUT] Invalid Transaction ID');
			redirect(base_url() . 'transaction/sell/');
			return;
		}

		$cabang_id = (int) $this->input->post('cabang_id');
		$payment_method = $this->input->post('payment_method');
		$biayaAdmin = $this->input->post('operator') . $this->input->post('biayaAdmin');

		$total = 0;
		$qtt = 0;

		foreach ($this->cart->contents() as $item) {
			$total += $item["priceTotal"];
			$qtt++;
		}

		$dataUpdate = [
			't_status'        => 'CHECKOUT',
			't_price_total'   => $total,
			't_price_admin'   => $biayaAdmin,
			't_qtt'           => $qtt,
			't_cabang_id'     => $cabang_id > 0 ? $cabang_id : NULL,
			't_payment_method'=> !empty($payment_method) ? $payment_method : NULL,
		];

		log_message('debug', '[SELL CHECKOUT] Update Header: ' . json_encode($dataUpdate));

		$this->db->update('tb_transaction_sell', $dataUpdate, ['t_id' => $idTransaction]);

		log_message('debug', '[SELL CHECKOUT] Checkout Success');

		// Generate and save PDF
		$pdfResult = $this->generateSellPdf($idTransaction);
		if ($pdfResult['success']) {
			log_message('debug', '[SELL CHECKOUT] PDF generated successfully: ' . $pdfResult['pdf_filename']);
		} else {
			log_message('error', '[SELL CHECKOUT] PDF generation failed: ' . $pdfResult['message']);
		}

		$this->session->unset_userdata('idCustomer');
		$this->cart->destroy();

		$this->session->set_userdata([
			'status'  => 'success',
			'message' => "Checkout no order is success!!",
		]);

		log_message('debug', '[SELL CHECKOUT] ===============================');

		redirect(base_url() . "report/sell-print/$idTransaction/");
	}

	/**
	 * Generate and save PDF for Buy transaction
	 * 
	 * @param int $idTransaction Transaction ID
	 * @return array ['success' => bool, 'pdf_path' => string, 'pdf_filename' => string]
	 */
	private function generateBuyPdf($idTransaction)
	{
		try {
			// Get transaction data
			$this->data['data'] = $this->TransactionModel->buyTransactionData($idTransaction)->result();
			if (empty($this->data['data'])) {
				return ['success' => false, 'message' => 'Transaction not found'];
			}
			
			$noOrder = $this->TransactionModel->buyTransactionData($idTransaction)->row("t_no_order");
			$this->data['title'] = $noOrder;
			$this->data['detail'] = $this->TransactionModel->buyTransactionItemsData($idTransaction)->result();
			$this->data['transaction_header'] = $this->TransactionModel->buyTransactionData($idTransaction)->row();
			
			// Load TCPDF library
			$this->load->library('Pdf');
			$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
			
			// PDF Configuration
			$pdf->SetCreator('I Love Emas');
			$pdf->SetAuthor('I Love Emas');
			$pdf->SetTitle('Invoice ' . $noOrder);
			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);
			$pdf->SetMargins(20, 20, 20, 20);
			
			// Disable font subsetting to avoid chr() errors
			$pdf->setFontSubsetting(false);
			
			// Set default font
			$pdf->SetFont('helvetica', '', 10);
			
			$pdf->AddPage();

		// Get HTML content from view - use simplified PDF view
			$html = $this->load->view('PrintBuyPdf', $this->data, true);
			
			// Clean HTML content - remove problematic characters
			$html = $this->cleanHtmlForPdf($html);
			
			$pdf->writeHTML($html, true, false, true, false, '');
			
			// Generate filename - sanitize for filesystem
			$safeNoOrder = preg_replace('/[^a-zA-Z0-9_-]/', '_', $noOrder);
			$pdfFilename = 'BUY_' . $safeNoOrder . '_' . date('YmdHis') . '.pdf';
			$pdfPath = FCPATH . 'assets/pdf/' . $pdfFilename;

			// Save PDF to file
			@$pdf->Output($pdfPath, 'F');

			log_message('debug', '[PDF BUY] Generated PDF: ' . $pdfPath);
			
			// Update database with PDF path
			$this->TransactionModel->updateBuyPdfPath($idTransaction, 'assets/pdf/' . $pdfFilename, $pdfFilename);
			
			return [
				'success' => true,
				'pdf_path' => 'assets/pdf/' . $pdfFilename,
				'pdf_filename' => $pdfFilename
			];
			
		} catch (Exception $e) {
			log_message('error', '[PDF BUY] Error generating PDF: ' . $e->getMessage());
			$this->TransactionModel->updateBuyPdfFailed($idTransaction);
			return ['success' => false, 'message' => $e->getMessage()];
		}
	}
	
	/**
	 * Clean HTML content for TCPDF to avoid chr() errors
	 * 
	 * @param string $html Raw HTML content
	 * @return string Cleaned HTML
	 */
	private function cleanHtmlForPdf($html) {
		if (empty($html)) {
			return '';
		}
		
		// Remove ALL control characters except tab, newline, carriage return
		$html = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $html);
		
		// Remove BOM (Byte Order Mark)
		$html = str_replace("\xEF\xBB\xBF", '', $html);
		
		// Strip PHP tags to prevent code execution issues
		$html = preg_replace('/<\?php.*?\?>/is', '', $html);
		$html = preg_replace('/<script.*?\/script>/is', '', $html);
		
		// Remove excessive whitespace that can cause issues
		$html = preg_replace('/\s+/', ' ', $html);
		
		// NOTE: Do NOT use htmlspecialchars() here!
		// TCPDF's writeHTML() method already handles HTML entities properly.
		// Using htmlspecialchars() will convert HTML tags to escaped text,
		// causing the PDF to display raw HTML code instead of rendered content.
		
		return $html;
	}

	/**
	 * Generate and save PDF for Sell transaction
	 * 
	 * @param int $idTransaction Transaction ID
	 * @return array ['success' => bool, 'pdf_path' => string, 'pdf_filename' => string]
	 */
	private function generateSellPdf($idTransaction)
	{
		try {
			// Get transaction data
			$this->data['data'] = $this->TransactionModel->sellTransactionData($idTransaction)->result();
			if (empty($this->data['data'])) {
				return ['success' => false, 'message' => 'Transaction not found'];
			}
			
			$noOrder = $this->TransactionModel->sellTransactionData($idTransaction)->row("t_no_order");
			$this->data['title'] = $noOrder;
			$this->data['detail'] = $this->TransactionModel->sellTransactionItemsData($idTransaction)->result();
			$this->data['transaction_header'] = $this->TransactionModel->sellTransactionData($idTransaction)->row();
			
			// Load TCPDF library
			$this->load->library('Pdf');
			$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
			
			// PDF Configuration
			$pdf->SetCreator('I Love Emas');
			$pdf->SetAuthor('I Love Emas');
			$pdf->SetTitle('Invoice ' . $noOrder);
			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);
			$pdf->SetMargins(20, 20, 20, 20);
			
			// Disable font subsetting to avoid chr() errors
			$pdf->setFontSubsetting(false);
			
			// Set default font
			$pdf->SetFont('helvetica', '', 10);
			
			$pdf->AddPage();

		// Get HTML content from view - use simplified PDF view
			$html = $this->load->view('PrintSellPdf', $this->data, true);
			
			// Clean HTML content - remove problematic characters
			$html = $this->cleanHtmlForPdf($html);
			
			$pdf->writeHTML($html, true, false, true, false, '');
			
			// Generate filename - sanitize for filesystem
			$safeNoOrder = preg_replace('/[^a-zA-Z0-9_-]/', '_', $noOrder);
			$pdfFilename = 'SELL_' . $safeNoOrder . '_' . date('YmdHis') . '.pdf';
			$pdfPath = FCPATH . 'assets/pdf/' . $pdfFilename;

			// Save PDF to file
			@$pdf->Output($pdfPath, 'F');

			log_message('debug', '[PDF SELL] Generated PDF: ' . $pdfPath);
			
			// Update database with PDF path
			$this->TransactionModel->updateSellPdfPath($idTransaction, 'assets/pdf/' . $pdfFilename, $pdfFilename);
			
			return [
				'success' => true,
				'pdf_path' => 'assets/pdf/' . $pdfFilename,
				'pdf_filename' => $pdfFilename
			];
			
		} catch (Exception $e) {
			log_message('error', '[PDF SELL] Error generating PDF: ' . $e->getMessage());
			$this->TransactionModel->updateSellPdfFailed($idTransaction);
			return ['success' => false, 'message' => $e->getMessage()];
		}
	}

function sellDeleteTransaction()
	{
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		if ($authUser == true)
		{
			$idTransaction = $this->uri->segment(3);
			$this->TransactionModel->sellDeleteTransaction($idTransaction);
			$data_session = array(
			 'status' => 'success',
			 'message' => "Delete transaction is success!!",
			);
			$this->session->set_userdata($data_session);
			redirect(base_url() . "report/sell/");
		}
		else
		{
			redirect(base_url());
		}
	}
	
	function storePreviewData()
	{
		// Store preview data in session for PDF preview
		$cabang_id = $this->input->post('cabang_id');
		$payment_method = $this->input->post('payment_method');
		$biaya_admin = $this->input->post('biaya_admin');
		$operator = $this->input->post('operator');
		
		// Calculate admin fee with operator
		$admin_fee = 0;
		if (!empty($biaya_admin)) {
			$admin_fee = ($operator == '-') ? -floatval($biaya_admin) : floatval($biaya_admin);
		}
		
		$this->session->set_userdata('preview_data', [
			'cabang_id' => $cabang_id,
			'payment_method' => $payment_method,
			'admin_fee' => $admin_fee
		]);
		
		echo json_encode(['status' => 'success']);
	}
	function buyDeleteTransaction()
	{
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		if ($authUser == true)
		{
			$idTransaction = $this->uri->segment(3);
			$this->TransactionModel->buyDeleteTransaction($idTransaction);
			$data_session = array(
			 'status' => 'success',
			 'message' => "Delete transaction is success!!",
			);
			$this->session->set_userdata($data_session);
			redirect(base_url() . "report/buy/");
		}
		else
		{
			redirect(base_url());
		}
	}
	function buyPrint()
	{
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		if ($authUser == true)
		{
			$idTransaction = $this->uri->segment(3);
			$this->data['data'] = $this->TransactionModel->buyTransactionData($idTransaction)->result();
			if (empty($this->data['data']))
			{
				redirect(base_url() . "report/buy/");
			}
			$noOrder = $this->TransactionModel->buyTransactionData($idTransaction)->row("t_no_order");
			$this->data['title'] = $noOrder;
			$this->data['detail'] = $this->TransactionModel->buyTransactionItemsData($idTransaction)->result();
			
			// Get transaction header data for cabang and payment method
			$this->data['transaction_header'] = $this->TransactionModel->buyTransactionData($idTransaction)->row();
			
			$this->load->view("PrintBuy", $this->data);
		}
		else
		{
			redirect(base_url());
		}
	}
	
function buyPrintPreview()
	{
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		if ($authUser == true)
		{
			$idTransaction = $this->uri->segment(3);
			$this->data['data'] = $this->TransactionModel->buyTransactionData($idTransaction)->result();
			if (empty($this->data['data']))
			{
				redirect(base_url() . "report/buy/");
			}
			$noOrder = $this->TransactionModel->buyTransactionData($idTransaction)->row("t_no_order");
			$this->data['title'] = $noOrder;
			$this->data['detail'] = $this->TransactionModel->buyTransactionItemsData($idTransaction)->result();

			// Get transaction header data for cabang and payment method
			$this->data['transaction_header'] = $this->TransactionModel->buyTransactionData($idTransaction)->row();
			
			// Get preview data from session (set via AJAX from checkout modal)
			$previewData = $this->session->userdata('preview_data');
			if (!empty($previewData)) {
				$this->data['preview_cabang_id'] = $previewData['cabang_id'] ?? null;
				$this->data['preview_payment_method'] = $previewData['payment_method'] ?? null;
				$this->data['preview_admin_fee'] = $previewData['admin_fee'] ?? 0;
			} else {
				$this->data['preview_cabang_id'] = null;
				$this->data['preview_payment_method'] = null;
				$this->data['preview_admin_fee'] = 0;
			}

			$this->load->view("PrintBuyPreview", $this->data);
		}
		else
		{
			redirect(base_url());
		}
	}

	function sellPrint()
	{
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		if ($authUser == true)
		{
			$idTransaction = $this->uri->segment(3);
			$this->data['data'] = $this->TransactionModel->sellTransactionData($idTransaction)->result();
			if (empty($this->data['data']))
			{
				redirect(base_url() . "report/sell/");
			}
			$noOrder = $this->TransactionModel->sellTransactionData($idTransaction)->row("t_no_order");
			$this->data['title'] = $noOrder;
			$this->data['detail'] = $this->TransactionModel->sellTransactionItemsData($idTransaction)->result();
			
			// Get transaction header data for cabang and payment method
			$this->data['transaction_header'] = $this->TransactionModel->sellTransactionData($idTransaction)->row();
			
			$this->load->view("PrintSell", $this->data);
		}
		else
		{
			redirect(base_url());
		}
	}
	
function sellPrintPreview()
	{
		$authUser = $this->session->userdata("authUser");
		$idUser = $this->session->userdata("idUser");
		if ($authUser == true)
		{
			$idTransaction = $this->uri->segment(3);
			$this->data['data'] = $this->TransactionModel->sellTransactionData($idTransaction)->result();
			if (empty($this->data['data']))
			{
				redirect(base_url() . "report/sell/");
			}
			$noOrder = $this->TransactionModel->sellTransactionData($idTransaction)->row("t_no_order");
			$this->data['title'] = $noOrder;
			$this->data['detail'] = $this->TransactionModel->sellTransactionItemsData($idTransaction)->result();

			// Get transaction header data for cabang and payment method
			$this->data['transaction_header'] = $this->TransactionModel->sellTransactionData($idTransaction)->row();
			
			// Get preview data from session (set via AJAX from checkout modal)
			$previewData = $this->session->userdata('preview_data');
			if (!empty($previewData)) {
				$this->data['preview_cabang_id'] = $previewData['cabang_id'] ?? null;
				$this->data['preview_payment_method'] = $previewData['payment_method'] ?? null;
				$this->data['preview_admin_fee'] = $previewData['admin_fee'] ?? 0;
			} else {
				$this->data['preview_cabang_id'] = null;
				$this->data['preview_payment_method'] = null;
				$this->data['preview_admin_fee'] = 0;
			}

			$this->load->view("PrintSellPreview", $this->data);
		}
		else
		{
			redirect(base_url());
		}
	}

	function keep()
	{
		$this->load->library('Pdf');
		$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
		ob_start();
		$pdf->SetTitle('INV BUY');
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetMargins(20, 20, 20, 20);
		$pdf->AddPage();
		$text = "";
		for ($i = 1; $i < 100; $i++)
		{
			$text = $text . '<tr>
			<th style="width:5%;">' . $i . '</th>
			<th colspan="2" style="width:90%;">LAMPIRAN PENDUKUNG BUY</th>
	</tr>';
		}
		;
		$lmpiranAkhir5 = '
		<table border="0.7" style="font-family: Arial Narrow;font-size:8sp; width:104%;">
			' . $text . '
		</table>';
		$pdf->writeHTML($lmpiranAkhir5, true, true, true, true, '');
		$pdf->Output('Dupak_Print.pdf', 'I');
	}
	public function chartDestroy()
	{
		$idTransaction = $this->session->userdata("idTransaction");
		$jenis = $this->session->userdata("jenis_transaksi");
		if ($jenis == "sell")
		{
			$this->db->update('tb_transaction_sell', ['t_status' => 'SELESAI'], ['t_id' => $idTransaction]);
		}
		else
		{
			$this->db->update('tb_transaction', ['t_status' => 'SELESAI'], ['t_id' => $idTransaction]);
		}
		$this->cart->destroy();
	}

	public function getTransactions()
	{
		$this->load->model('TransactionModel');
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$search = $this->input->post('search')['value'] ?? '';
		
		// Get filter parameters from GET request
		$type = $this->input->get('type') ?? '';
		$date_from = $this->input->get('date_from') ?? '';
		$date_to = $this->input->get('date_to') ?? '';

		$transactions = $this->TransactionModel->getTransactions($start, $length, $search, $type, $date_from, $date_to);
		$totalRecords = $this->TransactionModel->getTotalRecords();
		$filteredRecords = $this->TransactionModel->getFilteredRecords($search, $type, $date_from, $date_to);

		// Tambahkan default value jika price_total tidak ada
		$data = [];
		foreach ($transactions as $key => $transaction)
		{
			$data[] = [
			 'no' => $start + $key + 1,
			 'action' => '<a href="' . base_url('transaction/redirect/' . $transaction->t_no_order) . '" class="btn btn-primary btn-sm">Action</a>',
			 'transaction' => $transaction->t_type ?? 'N/A',
			 'no_order' => $transaction->t_no_order ?? 'N/A',
			 'status' => $transaction->t_status ?? 'N/A',
			 'date' => $transaction->t_date_created ?? 'N/A',
			 'customer' => $transaction->t_paid_by ?? 'N/A',
			 'qty' => intval($transaction->t_qtt ?? 0),
			 'price_total' => $transaction->t_price_total ?? 0
			];
		}

		// Log untuk debugging
		log_message('debug', json_encode($data));

		echo json_encode([
		 'draw' => intval($this->input->post('draw')),
		 'recordsTotal' => $totalRecords,
		 'recordsFiltered' => $filteredRecords,
		 'data' => $data
		]);
	}

	public function getCustomers()
	{
		$search = $this->input->get('search'); // Kata kunci pencarian
		$page = $this->input->get('page'); // Halaman untuk pagination
		$limit = 10; // Jumlah data per halaman
		$offset = ($page - 1) * $limit;

		// Query untuk mengambil data pelanggan
		$this->db->select('c_id, c_name, c_id_number');
		if (!empty($search))
		{
			$this->db->like('c_name', $search); // Filter berdasarkan nama pelanggan
			$this->db->or_like('c_id_number', $search); // Filter berdasarkan nomor ID pelanggan
		}
		$this->db->limit($limit, $offset);
		$query = $this->db->get('tb_customer'); // Ganti 'tb_customer' dengan nama tabel Anda

		$results = $query->result();

		// Hitung total data untuk pagination
		$total = $this->db->from('tb_customer')->count_all_results();

		// Struktur data yang sesuai dengan Select2
		$data = [
		 'results' => $results,
		 'pagination' => [
		  'more' => ($offset + $limit) < $total // Cek apakah ada halaman berikutnya
		 ]
		];

		// Kirim data dalam format JSON
		echo json_encode($data);
	}

	public function updateAllStatus()
	{
		$this->load->model('TransactionModel'); // Pastikan model sudah dibuat
		try
		{
			// Proses update status di model
			$result = $this->TransactionModel->updateAllToSelesai();

			// Kirimkan respons sukses
			echo json_encode([
			 'success' => true,
			 'message' => 'All transactions have been updated to SELESAI.'
			]);
		}
		catch (Exception $e)
		{
			// Kirimkan respons error
			echo json_encode([
			 'success' => false,
			 'message' => $e->getMessage()
			]);
		}
	}

	public function updateSelectedStatus()
	{
		$this->load->model('TransactionModel');
		try
		{
			$no_orders = $this->input->post('no_orders');
			
			if (empty($no_orders)) {
				echo json_encode([
					'success' => false,
					'message' => 'No transactions selected.'
				]);
				return;
			}

			// Proses update status untuk transaksi yang dipilih
			$result = $this->TransactionModel->updateSelectedToSelesai($no_orders);

			// Kirimkan respons sukses
			echo json_encode([
			 'success' => true,
			 'message' => $result . ' transaction(s) have been updated to SELESAI.'
			]);
		}
		catch (Exception $e)
		{
			// Kirimkan respons error
			echo json_encode([
			 'success' => false,
			 'message' => $e->getMessage()
			]);
		}
	}

}
