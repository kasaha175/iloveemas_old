<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//masukan nomor token Anda di sini
define('TOKEN','741780759:AAFjHma9oR3W3kJHKwVkWOWJVJlizy3E5Xo');

class PendapatanController extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('UserModel');
        $this->load->model('ProductModel');
        $this->load->model('PendapatanModel');
        $this->data["title"] = "";
        date_default_timezone_set("Asia/Jakarta"); 
        $this->dateToday = date("Y-m-d");
        $this->load->library('Pdf');
    }
    public function data(){
		$authUser = $this->session->userdata("authUser");	
		$idUser = $this->session->userdata("idUser");
		$this->data["title"] = "DATA PENDAPATAN";
        if ($authUser == true) {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $type = $this->UserModel->userDataById($idUser)->row("u_rule");
            $id = $this->input->get('id');
            $this->data['data'] = $this->PendapatanModel->data()->result();
            $this->data['detail'] = $this->PendapatanModel->dataById($id)->result();
            $this->data['sidebar'] = $this->load->view('Sidebar', $this->data, true);
			$this->data['content'] = $this->load->view('PendapatanData', $this->data, true);
			$this->load->view("UserTemplate", $this->data);
        }else {
            redirect($base_url()); 
        }
    }
    function telegramBot(){
        $this->JalankanBot();
    }

    function BotKirim($perintah){
        return 'https://api.telegram.org/bot'.TOKEN.'/'.$perintah;
    }
 
    /* Fungsi untuk mengirim "perintah" ke Telegram
     * Perintah tersebut bisa berupa
     *  -SendMessage = Untuk mengirim atau membalas pesan
     *  -SendSticker = Untuk mengirim pesan
     *  -Dan sebagainya, Anda bisa memm
     * 
     * Adapun dua fungsi di sini yakni pertama menggunakan
     * stream dan yang kedua menggunkan curl
     * 
     * */
    
    function KirimPerintahCurl($perintah,$data){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$this->BotKirim($perintah));
        curl_setopt($ch, CURLOPT_POST, count($data));
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        $kembali = curl_exec ($ch);
        curl_close ($ch);
 
        return $kembali;
    }
 
    /*  Perintah untuk mendapatkan Update dari Api Telegram.
     *  Fungsi ini menjadi penting karena kita menggunakan metode "Long-Polling".
     *  Jika Anda menggunakan webhooks, fungsi ini tidaklah diperlukan lagi.
     */
     
    function DapatkanUpdate($offset) 
    {
        //kirim ke Bot
        $url = $this->BotKirim("getUpdates")."?offset=".$offset;
        //dapatkan hasilnya berupa JSON
        $kirim = file_get_contents($url);
        //kemudian decode JSON tersebut
        $hasil = json_decode($kirim, true);
        if ($hasil["ok"]==1)
            {
                /* Jika hasil["ok"] bernilai satu maka berikan isi JSONnya.
                 * Untuk dipergunakan mengirim perintah balik ke Telegram
                 */
                return $hasil["result"];
            }
        else
            {   /* Jika tidak maka kosongkan hasilnya.
                 * Hasil harus berupa Array karena kita menggunakan JSON.
                 */
                return array();
            }
    }
 
    function JalankanBot()
        {
            $update_id  = 0; //mula-mula tepatkan nilai offset pada nol
         
            //cek file apakah terdapat file "last_update_id"
            if (file_exists("last_update_id")) {
                //jika ada, maka baca offset tersebut dari file "last_update_id"
                $update_id = (int)file_get_contents("last_update_id");
            }
            //baca JSON dari bot, cek dan dapatkan pembaharuan JSON nya
            $updates = $this->DapatkanUpdate($update_id);
                    
            foreach ($updates as $message)
            {
                    $update_id = $message["update_id"];;
                    $message_data = $message["message"];
                    
                    //jika terdapat text dari Pengirim
                     if (isset($message_data["text"])) {
                            $chatid = $message_data["chat"]["id"];
                            $message_id = $message_data["message_id"];
                            $text = $message_data["text"];
                            $string="";
                            if($message_data['text']=='INFO'){
                                $string=$string."------------------------------------------------------- \n";
                                $string=$string."*SELAMAT DATANG DI SISTEM KEBOEN KOPI KARANGANJAR BLITAR.* \n";
                                $string=$string."------------------------------------------------------- \n";
                                $string=$string."*MENU :*  \n";
                                $string=$string."*1. INFO*  \n";
                                $string=$string."--> Ketik INFO  \n";
                                $string=$string."*2. PENDAPATAN TOTAL* \n";
                                $string=$string."--> Ketik INFO  PENDAPATAN \n";
                                $string=$string."*3. PENDAPATAN HARIAN* \n";
                                $string=$string."--> Ketik INFO PENDAPATAN HARIAN \n";
                                $string=$string."*4. PENDAPATAN HARIAN PER DEVISI* \n";
                                $string=$string."--> Ketik INFO PENDAPATAN HARIAN KODE DEVISI\n";
                                $string=$string."------------------------------------------------------- \n";
                                $string=$string."*By : Karya Studio Developers*";
                                $myReply=$string;
                            }else if($message_data['text']=='INFO PENDAPATAN'){
                                $pendapatanAll = $this->PendapatanModel->data()->result();
                                $string=$string."------------------------------------------------------- \n";
                                $string=$string."*INFO PENDAPATAN TOTAL.* \n";
                                $string=$string."------------------------------------------------------- \n";
                                foreach($pendapatanAll as $p){
                                    $string = $string."* Devisi ".$p->u_rule." *\n";
                                    $string = $string." --> : ";
                                    $string = $string.$this->rupiah($p->pendapatan)."\n";
                                    $string = $string." --> : ";
                                    $string = $string.$this->rupiah($p->hargaBeli)."\n";
                                    $string = $string." --> : ";
                                    $string = $string.$this->rupiah($p->keuntungan)."\n";
                                }
                                $string=$string."------------------------------------------------------- \n";
                                $string=$string."*By : Karya Studio Developers*";
                                $myReply=$string;
                            }else if($message_data['text']=='INFO PENDAPATAN HARIAN'){
                                $pendapatanAll = $this->PendapatanModel->dataHarian()->result();
                                $string=$string."------------------------------------------------------- \n";
                                $string=$string."*INFO PENDAPATAN HARIAN ($this->dateToday).* \n";
                                $string=$string."------------------------------------------------------- \n";
                                foreach($pendapatanAll as $p){
                                    $string = $string."*Devisi ".$p->u_rule."* \n";
                                    $string = $string." --> : ";
                                    $string = $string.$this->rupiah($p->pendapatan)."\n";
                                    $string = $string." --> : ";
                                    $string = $string.$this->rupiah($p->hargaBeli)."\n";
                                    $string = $string." --> : ";
                                    $string = $string.$this->rupiah($p->keuntungan)."\n";
                                }
                                $string=$string."------------------------------------------------------- \n";
                                $string=$string."*By : Karya Studio Developers*";
                                $myReply=$string;
                            }else if($message_data['text']=='INFO PENDAPATAN HARIAN CAFE'){
                                $pendapatanAll = $this->PendapatanModel->dataHarian()->result();
                                $string=$string."------------------------------------------------------- \n";
                                $string=$string."*INFO PENDAPATAN HARIAN CAFE* \n";
                                $string=$string."------------------------------------------------------- \n";
                                $string=$string."Fitur dalam pengembangan. \n";
                                $string=$string."------------------------------------------------------- \n";
                                $string=$string."*By : Karya Studio Developers*";
                                $myReply=$string;
                            }
                            else{
                                $string=$string."------------------------------------------------------- \n";
                                $string=$string."*KEYWORD TIDAK DITEMUKAN.* \n";
                                $string=$string."------------------------------------------------------- \n";
                                $string=$string."Ketik INFO untuk melihat daftar menu. \n";
                                $string=$string."------------------------------------------------------- \n";
                                $string=$string."*By : Karya Studio Developers*";
                                $myReply=$string;
                            }
                            $data = array(
                                'chat_id' => $chatid,
                                'text'=> $myReply,
                                'parse_mode'=>'Markdown',
                                'reply_to_message_id' => $message_id
                            );
                            //kita gunakan Kirim Perintah menggunakan metode Curl
                            $this->KirimPerintahCurl('sendMessage',$data);
                        }
                    
            }
            //tulis dan tandai updatenya yang nanti digunakan untuk nilai offset
            file_put_contents("last_update_id", $update_id + 1);
        }

        function rupiah($angka){
            $hasil_rupiah = "Rp " . number_format($angka,0,'','.');
            return $hasil_rupiah;
         
        }
}
