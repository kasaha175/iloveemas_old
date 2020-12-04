<?php
 if (!defined('BASEPATH'))
 	exit('No direct script access allowed');

class PendapatanModel extends CI_Model {

	function data(){
		$query = $this->db->query("SELECT x.d_name as u_rule,SUM(t_price) as pendapatan, SUM(t_price_buy) as hargaBeli, (SUM(t_price)-SUM(t_price_buy)) as keuntungan, COUNT(a.t_id)  as countTransaction, SUM(a.t_quantity_total) as countQuantity
        FROM tb_devisi x
        LEFT OUTER JOIN tb_transaction a
        ON x.d_name = a.t_type
        GROUP BY x.d_name");
		return $query;
    }
    function dataHarian(){
        date_default_timezone_set("Asia/Jakarta"); 
		$dateToday = date("Y-m-d");
		$query = $this->db->query("SELECT *
        FROM (SELECT a.d_id, a.d_name as u_rule
        FROM tb_devisi a) o
        LEFT OUTER JOIN
        (SELECT x.d_id, SUM(t_price) as pendapatan, SUM(t_price_buy) as hargaBeli, (SUM(t_price)-SUM(t_price_buy)) as keuntungan, COUNT(a.t_id)  as countTransaction, SUM(a.t_quantity_total) as countQuantity
                FROM tb_devisi x
                LEFT OUTER JOIN tb_transaction a
                ON x.d_name = a.t_type
                WHERE DATE(a.t_date_created)='$dateToday'
                GROUP BY x.d_name) p
        ON o.d_id = p.d_id");
		return $query;
    }
    function dataById($id){
        $query = $this->db->query("SELECT MONTHNAME(a.t_date_created) as month, YEAR(a.t_date_created) as year, SUM(t_price) as pendapatan, SUM(t_price_buy) as hargaBeli, (SUM(t_price)-SUM(t_price_buy)) as keuntungan, COUNT(a.t_id)  as countTransaction, SUM(a.t_quantity_total) as countQuantity, date(a.t_date_created) as date
        FROM tb_transaction a
        LEFT OUTER JOIN tb_user b
        ON a.t_creator_id = b.u_id
        WHERE b.u_rule='$id'
		GROUP BY DATE(a.t_date_created)
		ORDER BY a.t_id DESC");
		return $query;
    }
	
}
?>