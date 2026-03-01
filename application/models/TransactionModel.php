<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

	class TransactionModel extends CI_Model
{
    /**
     * Mendapatkan data transaksi berdasarkan pagination dan pencarian
     * 
     * @param int $start Offset data (untuk paginasi)
     * @param int $length Jumlah data per halaman
     * @param string $search Kata kunci pencarian
     * @return array Daftar transaksi
     */
    public function getTransactions($start, $length, $search, $type = '', $date_from = '', $date_to = '')
    {
        // Filter type (SELL/BUY)
        if (!empty($type)) {
            $this->db->where('t_type', $type);
        }
        
        // Filter date range
        if (!empty($date_from)) {
            $this->db->where('DATE(t_date_created) >=', $date_from);
        }
        if (!empty($date_to)) {
            $this->db->where('DATE(t_date_created) <=', $date_to);
        }

        // Pencarian (jika ada kata kunci)
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('t_no_order', $search);
            $this->db->or_like('t_type', $search);
            $this->db->or_like('t_status', $search);
            $this->db->or_like('t_paid_by', $search);
            $this->db->group_end();
        }

        // Pagination
        $this->db->limit($length, $start);

        // Ambil data dari view all_transaction
        return $this->db->get('all_transaction')->result();
    }

    /**
     * Mendapatkan total semua data transaksi (tanpa filter pencarian)
     * 
     * @return int Total semua data
     */
    public function getTotalRecords()
    {
        // Hitung total data dari view all_transaction
        return $this->db->count_all('all_transaction');
    }

    /**
     * Mendapatkan total data transaksi berdasarkan pencarian
     * 
     * @param string $search Kata kunci pencarian
     * @return int Total data yang sesuai pencarian
     */
    public function getFilteredRecords($search)
    {
        // Filter pencarian (jika ada kata kunci)
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('t_no_order', $search);
            $this->db->or_like('t_type', $search);
            $this->db->or_like('t_status', $search);
            $this->db->or_like('t_paid_by', $search);
            $this->db->group_end();
        }

        // Hitung total data dari view all_transaction yang sesuai pencarian
        return $this->db->count_all_results('all_transaction');
    }


	function buyCheckout($data)
	{
		// DEBUG: Log data before insert
		log_message('debug', '[MODEL buyCheckout] Inserting into tb_transaction: ' . json_encode($data));
		
		$this->db->insert('tb_transaction', $data);
		
		$insert_id = $this->db->insert_id();
		
		// DEBUG: Log insert result
		log_message('debug', '[MODEL buyCheckout] Insert successful, ID: ' . $insert_id);
		
		return $insert_id;
	}
	function buyCheckoutItems($data)
	{
		// DEBUG: Log item data before insert
		log_message('debug', '[MODEL buyCheckoutItems] Inserting into tb_transaction_items: ' . json_encode($data));
		
		$this->db->insert('tb_transaction_items', $data);
		
		// DEBUG: Log insert result
		log_message('debug', '[MODEL buyCheckoutItems] Insert result: ' . ($this->db->affected_rows() > 0 ? 'SUCCESS' : 'FAILED'));
	}
	function sellCheckout($data)
	{
		// DEBUG: Log data before insert
		log_message('debug', '[MODEL sellCheckout] Inserting into tb_transaction_sell: ' . json_encode($data));
		
		$this->db->insert('tb_transaction_sell', $data);
		
		$insert_id = $this->db->insert_id();
		
		// DEBUG: Log insert result
		log_message('debug', '[MODEL sellCheckout] Insert successful, ID: ' . $insert_id);
		
		return $insert_id;
	}
	function sellCheckoutItems($data)
	{
		// DEBUG: Log item data before insert
		log_message('debug', '[MODEL sellCheckoutItems] Inserting into tb_transaction_items_sell: ' . json_encode($data));
		
		$this->db->insert('tb_transaction_items_sell', $data);
		
		// DEBUG: Log insert result
		log_message('debug', '[MODEL sellCheckoutItems] Insert result: ' . ($this->db->affected_rows() > 0 ? 'SUCCESS' : 'FAILED'));
	}
	function lastData($year)
	{
		$query = $this->db->query("SELECT a.t_id
		FROM tb_transaction a
		WHERE YEAR(a.t_date_created) = '$year'
		ORDER BY a.t_id DESC
		LIMIT 1");
		return $query;
	}
	function lastDataSell($year)
	{
		$query = $this->db->query("SELECT a.t_id
		FROM tb_transaction_sell a
		WHERE YEAR(a.t_date_created) = '$year'
		ORDER BY a.t_id DESC
		LIMIT 1");
		return $query;
	}
	public function buyTransaction($dateStart = null, $dateEnd = null)
	{
		$this->db->select("
			a.*,
			b.u_name AS nameCreator,
			c.u_name AS nameReceive,
			d.c_name AS nameCustomer,
			e.nama_cabang
		");

		$this->db->from('tb_transaction a');
		$this->db->join('tb_user b', 'a.t_created_by = b.u_id', 'left');
		$this->db->join('tb_user c', 'a.t_receive_by = c.u_id', 'left');
		$this->db->join('tb_customer d', 'a.t_customer = d.c_id', 'left');
		$this->db->join('tb_cabang e', 'a.t_cabang_id = e.id', 'left');

		$this->db->where('a.t_visible', 1);

		// Filter tanggal TANPA DATE() agar index bisa dipakai
		if (!empty($dateStart) && !empty($dateEnd)) {
			$this->db->where('a.t_date_created >=', $dateStart . ' 00:00:00');
			$this->db->where('a.t_date_created <=', $dateEnd . ' 23:59:59');
		}

		$this->db->order_by('a.t_id', 'DESC');

		return $this->db->get();
	}

	public function sellTransaction($dateStart = null, $dateEnd = null)
	{
		$this->db->select("
			a.*,
			b.u_name AS nameCreator,
			c.u_name AS nameReceive,
			d.c_name AS nameCustomer,
			e.nama_cabang
		");

		$this->db->from('tb_transaction_sell a');
		$this->db->join('tb_user b', 'a.t_created_by = b.u_id', 'left');
		$this->db->join('tb_user c', 'a.t_receive_by = c.u_id', 'left');
		$this->db->join('tb_customer d', 'a.t_customer = d.c_id', 'left');
		$this->db->join('tb_cabang e', 'a.t_cabang_id = e.id', 'left');

		$this->db->where('a.t_visible', 1);

		if (!empty($dateStart) && !empty($dateEnd)) {
			$this->db->where('a.t_date_created >=', $dateStart . ' 00:00:00');
			$this->db->where('a.t_date_created <=', $dateEnd . ' 23:59:59');
		}

		$this->db->order_by('a.t_id', 'DESC');

		return $this->db->get();
	}

	function sellDeleteTransaction($idTransaction)
	{
		$query = $this->db->query("UPDATE
		tb_transaction_sell a
		SET a.t_visible=0
		WHERE a.t_id='$idTransaction'");
		return $query;
	}
	function buyTransactionGraph($year, $material)
	{
		$query = $this->db->query("SELECT *
			FROM
			(SELECT *
			FROM tb_month) x
			LEFT OUTER JOIN
			(SELECT a.m_id, SUM(b.ti_price_total) as priceTotal
			FROM tb_month a
			LEFT OUTER JOIN tb_transaction_items b
			ON a.m_id = MONTH(b.ti_date_created)
			WHERE b.ti_material LIKE '%$material%' AND YEAR(b.ti_date_created) LIKE '%$year%'
			GROUP BY a.m_name) y
			ON x.m_id = y.m_id");
		return $query;
	}
	function buyTransactionCustomerGraph($year)
	{
		$bulan = $this->db->query("SELECT a.m_id, a.m_name as month FROM tb_month a")->result();
		$data = array();
		foreach ($bulan as $key => $value) {
			$query = $this->db->query("SELECT COUNT(tb_transaction.t_customer) as countTransaction,m_id FROM `tb_transaction` inner join `tb_customer` right outer join `tb_month` ON tb_transaction.t_customer = tb_customer.c_id AND YEAR(`t_date_created`) = '$year' AND MONTH(tb_transaction.t_date_created) =" . $value->m_id)->row();
			array_push($data, [
				'm_id' => $query->m_id,
				'countTransaction' => $query->countTransaction,
				'month' => $value->m_id,
				'year' => $year
			]);
		}
		return $data;
	}
	function sellTransactionGraph($year, $material)
	{
		$query = $this->db->query("SELECT *
			FROM
			(SELECT *
			FROM tb_month) x
			LEFT OUTER JOIN
			(SELECT a.m_id, SUM(b.ti_price_total) as priceTotal
			FROM tb_month a
			LEFT OUTER JOIN tb_transaction_items_sell b
			ON a.m_id = MONTH(b.ti_date_created)
			WHERE b.ti_material LIKE '%$material%' AND YEAR(b.ti_date_created) LIKE '%$year%'
			GROUP BY a.m_name) y
			ON x.m_id = y.m_id");
		return $query;
	}
	function sellTransactionCustomerGraph($year)
	{
		$bulan = $this->db->query("SELECT a.m_id, a.m_name as month FROM tb_month a")->result();
		$data = array();
		foreach ($bulan as $key => $value) {
			$query = $this->db->query("SELECT COUNT(tb_transaction_sell.t_customer) as countTransaction,m_id FROM `tb_transaction_sell` inner join `tb_customer` right outer join `tb_month` ON tb_transaction_sell.t_customer = tb_customer.c_id AND YEAR(`t_date_created`) = '$year' AND MONTH(tb_transaction_sell.t_date_created) =" . $value->m_id)->row();
			array_push($data, [
				'm_id' => $query->m_id,
				'countTransaction' => $query->countTransaction,
				'month' => $value->m_id,
				'year' => $year
			]);
		}
		return $data;
	}
	function buyDeleteTransaction($idTransaction)
	{
		$query = $this->db->query("UPDATE
		tb_transaction a
		SET a.t_visible=0
		WHERE a.t_id='$idTransaction'");
		return $query;
	}
	function buyTransactionData($idTransaction)
	{
		/*
		$query = $this->db->query("SELECT a.*, b.u_name as nameCreator, c.u_name as nameReceive, d.c_name as nameCustomer, d.*
		FROM tb_transaction a
		LEFT OUTER JOIN tb_user b
		ON a.t_created_by = b.u_id
		LEFT OUTER JOIN tb_user c
		ON a.t_receive_by = c.u_id
		LEFT OUTER JOIN tb_customer d
		ON a.t_customer = d.c_id
		WHERE a.t_id='$idTransaction' AND a.t_visible=1");
		*/

		$query = $this->db->query("SELECT a.*, b.u_name as nameCreator, c.u_name as nameReceive, d.c_name as nameCustomer, d.*
		FROM tb_transaction a
		LEFT OUTER JOIN tb_user b
		ON a.t_created_by = b.u_id
		LEFT OUTER JOIN tb_user c
		ON a.t_receive_by = c.u_id
		LEFT OUTER JOIN tb_customer d
		ON a.t_customer = d.c_id
		WHERE a.t_id='$idTransaction'");

		return $query;
	}
	function buyTransactionItemsData($idTransaction)
	{
		$query = $this->db->query("SELECT a.*
		FROM tb_transaction_items a
		LEFT OUTER JOIN tb_transaction b
		ON a.ti_t_id = b.t_id
		WHERE a.ti_t_id='$idTransaction'  AND b.t_visible=1");
		return $query;
	}
	function sellTransactionData($idTransaction)
	{
		/*
		$query = $this->db->query("SELECT a.*, b.u_name as nameCreator, c.u_name as nameReceive, d.c_name as nameCustomer, d.*
		FROM tb_transaction_sell a
		LEFT OUTER JOIN tb_user b
		ON a.t_created_by = b.u_id
		LEFT OUTER JOIN tb_user c
		ON a.t_receive_by = c.u_id
		LEFT OUTER JOIN tb_customer d
		ON a.t_customer = d.c_id
		
		WHERE a.t_id='$idTransaction' AND a.t_visible=1");
		*/

		$query = $this->db->query("SELECT a.*, b.u_name as nameCreator, c.u_name as nameReceive, d.c_name as nameCustomer, d.*
		FROM tb_transaction_sell a
		LEFT OUTER JOIN tb_user b
		ON a.t_created_by = b.u_id
		LEFT OUTER JOIN tb_user c
		ON a.t_receive_by = c.u_id
		LEFT OUTER JOIN tb_customer d
		ON a.t_customer = d.c_id
		
		WHERE a.t_id='$idTransaction'");
		return $query;
	}
	function sellTransactionItemsData($idTransaction)
	{
		$query = $this->db->query("SELECT a.*
		FROM tb_transaction_items_sell a
		LEFT OUTER JOIN tb_transaction_sell b
		ON a.ti_t_id = b.t_id
		WHERE a.ti_t_id='$idTransaction'  AND b.t_visible=1");
		return $query;
	}

	public function updateAllToSelesai() {
		$this->db->trans_begin();

		// Update hanya yang belum SELESAI di tb_transaction
		$this->db->where('t_status !=', 'SELESAI');
		$this->db->update('tb_transaction', ['t_status' => 'SELESAI']);

		// Update hanya yang belum SELESAI di tb_transaction_sell
		$this->db->where('t_status !=', 'SELESAI');
		$this->db->update('tb_transaction_sell', ['t_status' => 'SELESAI']);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			throw new Exception('Failed to update data.');
		}

		$this->db->trans_commit();
		return true;
	}

	public function updateSelectedToSelesai($no_orders) {
		if (empty($no_orders)) {
			return 0;
		}

		$this->db->trans_begin();

		// Update di tb_transaction berdasarkan no_order
		$this->db->where_in('t_no_order', $no_orders);
		$this->db->where('t_status !=', 'SELESAI');
		$this->db->update('tb_transaction', ['t_status' => 'SELESAI']);
		
		$buy_affected = $this->db->affected_rows();

		// Update di tb_transaction_sell berdasarkan no_order
		$this->db->where_in('t_no_order', $no_orders);
		$this->db->where('t_status !=', 'SELESAI');
		$this->db->update('tb_transaction_sell', ['t_status' => 'SELESAI']);
		
		$sell_affected = $this->db->affected_rows();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			throw new Exception('Failed to update data.');
		}

		$this->db->trans_commit();
		return $buy_affected + $sell_affected;
	}

	/**
	 * Update PDF path for buy transaction (tb_transaction)
	 * 
	 * @param int $transactionId Transaction ID
	 * @param string $pdfPath Full path where PDF is saved
	 * @param string $pdfFilename PDF filename
	 * @return bool Success status
	 */
	public function updateBuyPdfPath($transactionId, $pdfPath, $pdfFilename) {
		$data = [
			't_pdf_path' => $pdfPath,
			't_pdf_filename' => $pdfFilename,
			't_pdf_generated_at' => date('Y-m-d H:i:s'),
			't_pdf_status' => 'generated'
		];
		
		$this->db->where('t_id', $transactionId);
		$result = $this->db->update('tb_transaction', $data);
		
		log_message('debug', '[MODEL updateBuyPdfPath] Updated PDF path for transaction ID: ' . $transactionId);
		
		return $result;
	}

	/**
	 * Update PDF path for sell transaction (tb_transaction_sell)
	 * 
	 * @param int $transactionId Transaction ID
	 * @param string $pdfPath Full path where PDF is saved
	 * @param string $pdfFilename PDF filename
	 * @return bool Success status
	 */
	public function updateSellPdfPath($transactionId, $pdfPath, $pdfFilename) {
		$data = [
			't_pdf_path' => $pdfPath,
			't_pdf_filename' => $pdfFilename,
			't_pdf_generated_at' => date('Y-m-d H:i:s'),
			't_pdf_status' => 'generated'
		];
		
		$this->db->where('t_id', $transactionId);
		$result = $this->db->update('tb_transaction_sell', $data);
		
		log_message('debug', '[MODEL updateSellPdfPath] Updated PDF path for transaction ID: ' . $transactionId);
		
		return $result;
	}

	/**
	 * Update PDF status to failed for buy transaction
	 * 
	 * @param int $transactionId Transaction ID
	 * @return bool Success status
	 */
	public function updateBuyPdfFailed($transactionId) {
		$data = [
			't_pdf_status' => 'failed',
			't_pdf_generated_at' => date('Y-m-d H:i:s')
		];
		
		$this->db->where('t_id', $transactionId);
		return $this->db->update('tb_transaction', $data);
	}

	/**
	 * Update PDF status to failed for sell transaction
	 * 
	 * @param int $transactionId Transaction ID
	 * @return bool Success status
	 */
	public function updateSellPdfFailed($transactionId) {
		$data = [
			't_pdf_status' => 'failed',
			't_pdf_generated_at' => date('Y-m-d H:i:s')
		];
		
		$this->db->where('t_id', $transactionId);
		return $this->db->update('tb_transaction_sell', $data);
	}

	
}
