<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller
{
    // Konfigurasi login attempt
    private $max_attempts = 5;
    private $lockout_time = 900; // 15 menit dalam detik
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('TransactionModel');
        $this->load->model('ProductModel');
        $this->data["title"] = "And Team Andromeda Tours";
        date_default_timezone_set("Asia/Jakarta");
        $this->dateToday = date("Y-m-d H:i:s");
    }
    
    function loginProcess()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        
        if ($authUser == true)
        {
            redirect(base_url() . "dashboard/");
        }
        else
        {
            // Cek apakah akun terkunci
            $locked_until = $this->session->userdata('locked_until');
            if ($locked_until && time() < $locked_until)
            {
                $remaining_time = ceil(($locked_until - time()) / 60);
                $this->session->set_userdata([
                    'failedLogin' => true,
                    'lockout_message' => "Akun terkunci. Coba lagi dalam {$remaining_time} menit."
                ]);
                redirect(base_url());
                return;
            }
            
            $username = $this->input->post('username');
            $username = str_replace(' ', '-', $username);
            $username = preg_replace('/[^A-Za-z0-9]/', '', $username);
            $password = $this->input->post('password');
            $password = str_replace(' ', '-', $password);
            $password = preg_replace('/[^A-Za-z0-9]/', '', $password);
            $password = md5($password);
            $userData = $this->UserModel->userData($username, $password)->result();
            $cek = count($userData);
            
            if ($cek > 0)
            {
                foreach ($userData as $a)
                {
                }
                
                // Reset attempt counter saat login berhasil
                $this->session->set_userdata([
                    'login_attempts' => 0,
                    'locked_until' => null
                ]);
                
                $data_session = array(
                    'authUser' => true,
                    'idUser' => $a->u_id,
                    'cabang_id' => 1,
                    'last_activity' => time()
                );
                $this->session->set_userdata($data_session);
                redirect(base_url() . "dashboard/");
            }
            else
            {
                // Increment attempt counter
                $attempts = $this->session->userdata('login_attempts') ?: 0;
                $attempts++;
                
                if ($attempts >= $this->max_attempts)
                {
                    // Akun terkunci
                    $locked_until = time() + $this->lockout_time;
                    $this->session->set_userdata([
                        'login_attempts' => $attempts,
                        'locked_until' => $locked_until,
                        'failedLogin' => true,
                        'lockout_message' => "Terlalu banyak percobaan login. Akun terkunci selama 15 menit."
                    ]);
                }
                else
                {
                    $remaining = $this->max_attempts - $attempts;
                    $this->session->set_userdata([
                        'login_attempts' => $attempts,
                        'failedLogin' => true,
                        'lockout_message' => "Username atau password salah! Sisa percobaan: {$remaining}"
                    ]);
                }
                redirect(base_url());
            }
        }
    }
    
    function logoutProcess()
    {
        // Hapus semua data session termasuk attempt counter
        $this->session->sess_destroy();
        redirect(base_url());
    }

}

?>