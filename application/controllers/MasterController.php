<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MasterController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('MasterModel');
        $this->load->model('MaterialModel');
        $this->load->model('mmodel');
        $this->data["title"] = "";
        date_default_timezone_set("Asia/Jakarta");
        $this->dateToday = date("Y-m-d H:i:s");
        $this->load->library('cart');
    }

    function master()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        $this->data["title"] = "MASTER";
        if ($authUser == true)
        {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $this->data['content'] = $this->load->view('Master', $this->data, true);
            $this->load->view("UserTemplate", $this->data);
        }
        else
        {
            redirect(base_url());
        }
    }
    function customer()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        $this->data["title"] = "MASTER CUSTOMER";
        if ($authUser == true)
        {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $this->data['content'] = $this->load->view('MasterCustomer', $this->data, true);
            $this->load->view("UserTemplate", $this->data);
        }
        else
        {
            redirect(base_url());
        }
    }

    public function customer_datatable()
    {
        $authUser = $this->session->userdata("authUser");
        if (!$authUser) {
            echo json_encode(['data' => [], 'draw' => 1, 'recordsTotal' => 0, 'recordsFiltered' => 0]);
            return;
        }

        $draw = intval($this->input->get('draw'));
        $start = intval($this->input->get('start'));
        $length = intval($this->input->get('length'));
        $search_value = $this->input->get('search')['value'] ?? '';
        $order_col = $this->input->get('order')[0]['column'] ?? 0;
        $order_dir = $this->input->get('order')[0]['dir'] ?? 'asc';

        $columns = ['c_no_order', 'c_name', 'c_address', 'c_resident_address', 'c_phone', 'c_date_created', 'u_name'];
        $order_column = $columns[$order_col] ?? 'c.c_id';

        $total_records = $this->MasterModel->count_all_customers();
        $filtered_records = $this->MasterModel->count_filtered_customers($search_value);
        $data = $this->MasterModel->get_customers_datatable($start, $length, $search_value, $order_column, $order_dir);

        echo json_encode([
            'draw' => $draw,
            'recordsTotal' => $total_records,
            'recordsFiltered' => $filtered_records,
            'data' => $data
        ]);
    }
    function detailCustomer()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        $this->data["title"] = "MASTER CUSTOMER DETAIL";
        if ($authUser == true)
        {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $id = $this->uri->segment(3);
            $this->data['detail'] = $this->data['customerDetail'] = $this->MasterModel->customerDetail($id)->result();
            $this->data['content'] = $this->load->view('CustomerDetail', $this->data, true);
            $this->load->view("UserTemplate", $this->data);
        }
        else
        {
            redirect(base_url());
        }
    }
    function editCustomerProcess()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        if ($authUser == true)
        {
            $idCustomer = $this->input->post('idCustomer');
            $data = array(
                'c_name' => strtoupper($this->input->post("name")),
                'c_id_number' => strtoupper($this->input->post("idNumber")),
                'c_address' => strtoupper($this->input->post("address")),
                'c_resident_address' => strtoupper($this->input->post("resident_address")),
                'c_phone' => $this->input->post("phone"),
                'c_u_id' => $idUser,
                'c_no_order' => $this->input->post("noOrder"),
            );
            $this->MasterModel->editCustomerProces($data, $idCustomer);
            $data_session = array(
                'status' => 'success',
                'message' => "Edit customer is success!",
            );
            $this->session->set_userdata($data_session);
            redirect(base_url() . "master/customer/$idCustomer/");
        }
        else
        {
            redirect(base_url());
        }
    }
    function deleteCustomerProcess()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        if ($authUser == true)
        {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $data_session = array(
                'status' => 'success',
                'message' => "Delete customer is success!",
            );
            $id = $this->uri->segment(3);
            $this->MasterModel->deleteCustomerProcess($id);
            $this->session->set_userdata($data_session);
            redirect(base_url() . "master/customer/");
        }
        else
        {
            redirect(base_url());
        }
    }
    function archive()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        $this->data["title"] = "ARCHIVE";
        if ($authUser == true)
        {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $this->data['content'] = $this->load->view('Archive', $this->data, true);
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
        $this->data["title"] = "ARCHIVE BUY";
        if ($authUser == true)
        {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $key = $this->input->get('key');
            if (in_array($key, array("rti-au", "rti-pt", "rti-ag", "rti-lm", "rti-ru", "rti-ta")))
            {
                $type = $this->input->get('type');
                if ($key == "rti-au")
                {
                    if ($type == "change")
                    {
                        $this->data['data'] = $this->MasterModel->formulasData($key)->result();
                        $this->data['content'] = $this->load->view('ArchiveBuyKeyChange', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }
                    else
                    {
                        $this->data['value'] = $this->MaterialModel->formulaData()->row("f_rti_au");
                        $this->data['content'] = $this->load->view('ArchiveBuyKey', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }
                }
                else if ($key == "rti-pt")
                {
                    if ($type == "change")
                    {
                        $this->data['data'] = $this->MasterModel->formulasData($key)->result();
                        $this->data['data2'] = $this->MasterModel->formulasData('rti-pt-low')->result();
                        $this->data['content'] = $this->load->view('ArchiveBuyKeyChange', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }
                    else
                    {
                        $this->data['value'] = $this->MaterialModel->formulaData()->row("f_rti_pt");
                        $this->data['content'] = $this->load->view('ArchiveBuyKey', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }
                }
                else if ($key == "rti-ag")
                {
                    if ($type == "change")
                    {
                        $this->data['data'] = $this->MasterModel->formulasData($key)->result();
                        $this->data['data2'] = $this->MasterModel->formulasData('rti-ag-low')->result();
                        $this->data['content'] = $this->load->view('ArchiveBuyKeyChange', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }
                    else
                    {
                        $this->data['value'] = $this->MaterialModel->formulaData()->row("f_rti_ag");
                        $this->data['content'] = $this->load->view('ArchiveBuyKey', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }
                }
                else if ($key == "rti-ru")
                {
                    if ($type == "change")
                    {
                        $this->data['data'] = $this->MasterModel->formulasData($key)->result();
                        $this->data['data2'] = $this->MasterModel->formulasData('rti-ru-low')->result();
                        $this->data['content'] = $this->load->view('ArchiveBuyKeyChange', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }
                    else
                    {
                        $this->data['value'] = $this->MaterialModel->formulaData()->row("f_rti_ru");
                        $this->data['content'] = $this->load->view('ArchiveBuyKey', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }
                }
                else
                {
                    if ($type == "change")
                    {
                        $this->data['data'] = $this->MasterModel->formulasData($key)->result();
                        $this->data['content'] = $this->load->view('ArchiveBuyKeyChange', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }
                    else
                    {
                        $parameter = 'f_' . str_replace('-', '_', $key);
                        $this->data['value'] = $this->MaterialModel->formulaData()->row($parameter);
                        $this->data['content'] = $this->load->view('ArchiveBuyKey', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }
                }
            }
            else
            {
                $this->data['content'] = $this->load->view('ArchiveBuy', $this->data, true);
                $this->load->view("UserTemplate", $this->data);
            }
        }
        else
        {
            redirect(base_url());
        }
    }
    function buySave()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");

        // Set JSON header for AJAX response
        header('Content-Type: application/json');

        if ($authUser != true)
        {
            log_message('error', 'buySave: Unauthorized access attempt');
            echo json_encode([
                'status' => 'error',
                'message' => 'Session expired. Please login again.'
            ]);
            return;
        }

        $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();

        // Get data from POST (fixed from GET)
        $key = $this->input->post('key');
        $value = $this->input->post('value');
        $type = $this->input->post('type');

        // Log incoming request payload
        log_message('debug', 'buySave: Received key=' . $key . ', value=' . $value . ', type=' . $type);
        log_message('debug', 'buySave: POST data = ' . json_encode($this->input->post()));

        if (empty($key))
        {
            log_message('error', 'buySave: Empty key parameter');
            echo json_encode([
                'status' => 'error',
                'message' => 'Parameter key tidak valid!'
            ]);
            return;
        }

        if (!in_array($key, array("rti-au", "rti-pt", "rti-ag", "rti-lm", "rti-ru", "rti-ta")))
        {
            log_message('error', 'buySave: Invalid key = ' . $key);
            echo json_encode([
                'status' => 'error',
                'message' => 'Key tidak valid!'
            ]);
            return;
        }

        try
        {
            if ($key == "rti-au")
            {
                $parameter = 'f_' . str_replace('-', '_', $key);
                if ($type == "change")
                {
                    $data = array(
                        'a' => $this->input->post('a'),
                        'c' => $this->input->post('c'),
                        'd' => $this->input->post('d'),
                        'e' => $this->input->post('e'),
                        'f' => $this->input->post('f'),
                        'g' => $this->input->post('g'),
                        'h' => $this->input->post('h'),
                        'gb_99' => $this->input->post('gb_99'),
                        'gb_99_9' => $this->input->post('gb_99_9'),
                        'potongan_lm' => json_encode($this->input->post('potongan_lm')),
                        'k23' => $this->input->post('k23'),
                        'k22' => $this->input->post('k22'),
                        'k21' => $this->input->post('k21'),
                        'k20' => $this->input->post('k20'),
                        'k19' => $this->input->post('k19'),
                        'k18' => $this->input->post('k18'),
                        'k17' => $this->input->post('k17'),
                        'k16' => $this->input->post('k16'),
                        'k15' => $this->input->post('k15'),
                        'k14' => $this->input->post('k14'),
                        'k13' => $this->input->post('k13'),
                        'k12' => $this->input->post('k12'),
                        'k11' => $this->input->post('k11'),
                        'k10' => $this->input->post('k10'),
                        'k9' => $this->input->post('k9'),
                        'k8' => $this->input->post('k8'),
                        'k7' => $this->input->post('k7'),
                        'k6' => $this->input->post('k6'),
                        'k5' => $this->input->post('k5'),
                        'k4' => $this->input->post('k4'),
                        'k3' => $this->input->post('k3'),
                        'k2' => $this->input->post('k2'),
                    );
                    
                    log_message('debug', 'buySave: rti-au change - updating with data = ' . json_encode($data));
                    $affectedRows = $this->MasterModel->formulasUpdate($key, $data);
                    log_message('debug', 'buySave: rti-au change - affected rows = ' . $affectedRows);

                    if ($affectedRows > 0)
                    {
                        log_message('info', 'buySave: rti-au change - SUCCESS, affected rows = ' . $affectedRows);
                        echo json_encode([
                            'status' => 'success',
                            'message' => 'Data berhasil disimpan!',
                            'redirect' => base_url() . "archive/buy/?key=$key&type=change"
                        ]);
                    }
                    else
                    {
                        log_message('error', 'buySave: rti-au change - FAILED, no rows affected');
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Gagal menyimpan data! Tidak ada perubahan data.'
                        ]);
                    }
                    return;
                }
                else
                {
                    if (empty($value))
                    {
                        log_message('error', 'buySave: rti-au - Empty value parameter');
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Value tidak boleh kosong!'
                        ]);
                        return;
                    }

                    log_message('debug', 'buySave: rti-au - updating f_rti_au with value = ' . $value);
                    $result1 = $this->MaterialModel->formulaUpdate($parameter, $value);
                    
                    $parameter = 'f_rti_au_sell';
                    log_message('debug', 'buySave: rti-au - updating f_rti_au_sell with value = ' . $value);
                    $result2 = $this->MaterialModel->formulaUpdate($parameter, $value);
                    
                    log_message('debug', 'buySave: rti-au - result1 = ' . $result1 . ', result2 = ' . $result2);

                    if ($result1 > 0 || $result2 > 0)
                    {
                        log_message('info', 'buySave: rti-au - SUCCESS');
                        echo json_encode([
                            'status' => 'success',
                            'message' => 'Data berhasil disimpan!',
                            'redirect' => base_url() . "archive/buy/?key=$key"
                        ]);
                    }
                    else
                    {
                        log_message('error', 'buySave: rti-au - FAILED, no rows affected');
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Gagal menyimpan data! Tidak ada perubahan data.'
                        ]);
                    }
                    return;
                }
            }
            else if ($key == "rti-ag")
            {
                $parameter = 'f_' . str_replace('-', '_', $key);
                if ($type == "change")
                {
                    $data = array(
                        'a' => $this->input->post('a'),
                        'b' => $this->input->post('b'),
                        'c' => $this->input->post('c'),
                        'd' => $this->input->post('d'),
                        'e' => $this->input->post('e'),
                    );
                    $this->MasterModel->formulasUpdate($key, $data);
                    $data = array(
                        'a' => $this->input->post('aa'),
                        'b' => $this->input->post('bb'),
                        'c' => $this->input->post('cc'),
                        'd' => $this->input->post('dd'),
                        'e' => $this->input->post('ee'),
                    );
                    $this->MasterModel->formulasUpdate('rti-ag-low', $data);
                    
                    log_message('info', 'buySave: rti-ag change - SUCCESS');
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil disimpan!',
                        'redirect' => base_url() . "archive/buy/?key=$key&type=change"
                    ]);
                    return;
                }
                else
                {
                    $this->MaterialModel->formulaUpdate($parameter, $value);
                    $parameter = 'f_rti_ag_sell';
                    $this->MaterialModel->formulaUpdate($parameter, $value);
                    
                    log_message('info', 'buySave: rti-ag - SUCCESS');
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil disimpan!',
                        'redirect' => base_url() . "archive/buy/?key=$key"
                    ]);
                    return;
                }
            }
            else if ($key == "rti-pt")
            {
                $parameter = 'f_' . str_replace('-', '_', $key);
                if ($type == "change")
                {
                    $data = array(
                        'a' => $this->input->post('a'),
                        'b' => $this->input->post('b'),
                        'c' => $this->input->post('c'),
                        'd' => $this->input->post('d'),
                        'e' => $this->input->post('e'),
                    );
                    $this->MasterModel->formulasUpdate($key, $data);
                    $data = array(
                        'a' => $this->input->post('aa'),
                        'b' => $this->input->post('bb'),
                        'c' => $this->input->post('cc'),
                        'd' => $this->input->post('dd'),
                        'e' => $this->input->post('ee'),
                    );
                    $this->MasterModel->formulasUpdate('rti-pt-low', $data);
                    
                    log_message('info', 'buySave: rti-pt change - SUCCESS');
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil disimpan!',
                        'redirect' => base_url() . "archive/buy/?key=$key&type=change"
                    ]);
                    return;
                }
                else
                {
                    $this->MaterialModel->formulaUpdate($parameter, $value);
                    
                    log_message('info', 'buySave: rti-pt - SUCCESS');
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil disimpan!',
                        'redirect' => base_url() . "archive/buy/?key=$key"
                    ]);
                    return;
                }
            }
            else if ($key == "rti-ru")
            {
                $parameter = 'f_' . str_replace('-', '_', $key);
                if ($type == "change")
                {
                    $data = array(
                        'a' => $this->input->post('a')
                    );
                    $this->MasterModel->formulasUpdate($key, $data);
                    $data = array(
                        'a' => $this->input->post('aa'),
                    );
                    $this->MasterModel->formulasUpdate('rti-ru-low', $data);
                    
                    log_message('info', 'buySave: rti-ru change - SUCCESS');
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil disimpan!',
                        'redirect' => base_url() . "archive/buy/?key=$key&type=change"
                    ]);
                    return;
                }
                else
                {
                    $this->MaterialModel->formulaUpdate($parameter, $value);
                    
                    log_message('info', 'buySave: rti-ru - SUCCESS');
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil disimpan!',
                        'redirect' => base_url() . "archive/buy/?key=$key"
                    ]);
                    return;
                }
            }
            else
            {
                $parameter = 'f_' . str_replace('-', '_', $key);
                if ($type == "change")
                {
                    $data = array(
                        'a' => $this->input->post('a')
                    );
                    $this->MasterModel->formulasUpdate($key, $data);
                    
                    log_message('info', 'buySave: rti-ta change - SUCCESS');
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil disimpan!',
                        'redirect' => base_url() . "archive/buy/?key=$key&type=change"
                    ]);
                    return;
                }
                else
                {
                    $this->MaterialModel->formulaUpdate($parameter, $value);
                    
                    log_message('info', 'buySave: rti-ta - SUCCESS');
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil disimpan!',
                        'redirect' => base_url() . "archive/buy/?key=$key"
                    ]);
                    return;
                }
            }
        }
        catch (Exception $e)
        {
            log_message('error', 'buySave: Exception occurred - ' . $e->getMessage());
            echo json_encode([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
            return;
        }
    }
    function sell()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        $this->data["title"] = "ARCHIVE SELL";
        if ($authUser == true)
        {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $key = $this->input->get('key');
            if (in_array($key, array("lm", "material-au", "material-ag", "material-ubs")))
            {
                $type = $this->input->get('type');
                if ($key == "lm")
                {
                    if ($type == "change")
                    {
                        $this->data['data'] = $this->MasterModel->formulasData($key)->result();
                        $this->data['content'] = $this->load->view('ArchiveSellKeyChange', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }
                    else
                    {
                        $this->data["f_nol5"] = $this->MaterialModel->formulaData()->row("f_nol5");
                        $this->data["f_1"] = $this->MaterialModel->formulaData()->row("f_1");
                        $this->data["f_2"] = $this->MaterialModel->formulaData()->row("f_2");
                        $this->data["f_2_coma_5"] = $this->MaterialModel->formulaData()->row("f_2_coma_5");
                        $this->data["f_3"] = $this->MaterialModel->formulaData()->row("f_3");
                        $this->data["f_5"] = $this->MaterialModel->formulaData()->row("f_5");
                        $this->data["f_10"] = $this->MaterialModel->formulaData()->row("f_10");
                        $this->data["f_25"] = $this->MaterialModel->formulaData()->row("f_25");
                        $this->data["f_50"] = $this->MaterialModel->formulaData()->row("f_50");
                        $this->data["f_100"] = $this->MaterialModel->formulaData()->row("f_100");
                        $this->data["f_250"] = $this->MaterialModel->formulaData()->row("f_250");
                        $this->data["f_500"] = $this->MaterialModel->formulaData()->row("f_500");
                        $this->data["f_1000"] = $this->MaterialModel->formulaData()->row("f_1000");
                        $this->data['content'] = $this->load->view('ArchiveSellKey', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }
                }
                else if ($key == "material-au")
                {
                    if ($type == "change")
                    {
                        $this->data['data'] = $this->MasterModel->formulasData($key)->result();
                        $this->data['content'] = $this->load->view('ArchiveSellKeyChange', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }
                    else
                    {
                        $this->data['value'] = $this->MaterialModel->formulaData()->row("f_rti_au_sell");
                        $this->data['content'] = $this->load->view('ArchiveSellKey', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }
                }
                else if ($key == "material-ag")
                {
                    if ($type == "change")
                    {
                        $this->data['data'] = $this->MasterModel->formulasData($key)->result();
                        $this->data['content'] = $this->load->view('ArchiveSellKeyChange', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }
                    else
                    {
                        $this->data['value'] = $this->MaterialModel->formulaData()->row("f_rti_ag_sell");
                        $this->data['content'] = $this->load->view('ArchiveSellKey', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }
                }
                else if ($key == "material-ubs")
                {
                    $this->data['configMaterial'] = $this->mmodel->selectWhere('config_material', ['key_material' => 'sell-ubs'])->result();
                    if ($type == "change")
                    {
                        $this->data['content'] = $this->load->view('ArchiveSellKeyChange', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }
                    else
                    {
                        $this->data['content'] = $this->load->view('ArchiveSellKey', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }
                }
                else
                {
                    if ($type == "change")
                    {
                        $this->data['data'] = $this->MasterModel->formulasData($key)->result();
                        $this->data['content'] = $this->load->view('ArchiveSellKeyChange', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }
                    else
                    {
                        $parameter = 'f_' . str_replace('-', '_', $key);
                        $this->data['value'] = $this->MaterialModel->formulaData()->row($parameter);
                        $this->data['content'] = $this->load->view('ArchiveSellKey', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }
                }
            }
            else
            {
                $this->data['content'] = $this->load->view('ArchiveSell', $this->data, true);
                $this->load->view("UserTemplate", $this->data);
            }
        }
        else
        {
            redirect(base_url());
        }
    }
    function sellSave()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        
        // Set JSON header for AJAX response
        header('Content-Type: application/json');

        if ($authUser != true)
        {
            log_message('error', 'sellSave: Unauthorized access attempt');
            echo json_encode([
                'status' => 'error',
                'message' => 'Session expired. Please login again.'
            ]);
            return;
        }

        $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
        
        // Get data from POST (fixed from GET)
        $key = $this->input->post('key');
        $value = $this->input->post('value');
        $type = $this->input->post('type');

        // Log incoming request payload
        log_message('debug', 'sellSave: Received key=' . $key . ', value=' . $value . ', type=' . $type);
        log_message('debug', 'sellSave: POST data = ' . json_encode($this->input->post()));

        if (empty($key))
        {
            log_message('error', 'sellSave: Empty key parameter');
            echo json_encode([
                'status' => 'error',
                'message' => 'Parameter key tidak valid!'
            ]);
            return;
        }

        if (!in_array($key, array("lm", "material-au", "material-ag", "material-ubs")))
        {
            log_message('error', 'sellSave: Invalid key = ' . $key);
            echo json_encode([
                'status' => 'error',
                'message' => 'Key tidak valid!'
            ]);
            return;
        }

        try
        {
            if ($key == "lm")
            {
                $parameter = 'f_' . str_replace('-', '_', $key);
                if ($type == "change")
                {
                    $data = array(
                        'a' => $this->input->post('a'),
                        'b' => $this->input->post('b'),
                        'c' => $this->input->post('c'),
                        'd' => $this->input->post('d'),
                        'e' => $this->input->post('e'),
                        'f' => $this->input->post('f'),
                        'g' => $this->input->post('g'),
                        'h' => $this->input->post('h'),
                        'potongan_lm' => json_encode($this->input->post('potongan_lm')),
                    );
                    $this->MasterModel->formulasUpdate($key, $data);
                    
                    log_message('info', 'sellSave: lm change - SUCCESS');
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil disimpan!',
                        'redirect' => base_url() . "archive/sell/?key=$key&type=change"
                    ]);
                    return;
                }
                else
                {
                    $data = array(
                        "f_nol5" => $this->input->post("f_nol5"),
                        "f_1" => $this->input->post("f_1"),
                        "f_2" => $this->input->post("f_2"),
                        "f_3" => $this->input->post("f_3"),
                        "f_2_coma_5" => $this->input->post("f_2_coma_5"),
                        "f_5" => $this->input->post("f_5"),
                        "f_10" => $this->input->post("f_10"),
                        "f_25" => $this->input->post("f_25"),
                        "f_50" => $this->input->post("f_50"),
                        "f_100" => $this->input->post("f_100"),
                        "f_250" => $this->input->post("f_250"),
                        "f_500" => $this->input->post("f_500"),
                        "f_1000" => $this->input->post("f_1000"),
                    );
                    
                    log_message('debug', 'sellSave: lm - updating with data = ' . json_encode($data));
                    $affectedRows = $this->MaterialModel->formulaUpdateArray($data);
                    log_message('debug', 'sellSave: lm - affected rows = ' . $affectedRows);

                    if ($affectedRows > 0)
                    {
                        log_message('info', 'sellSave: lm - SUCCESS');
                        echo json_encode([
                            'status' => 'success',
                            'message' => 'Data berhasil disimpan!',
                            'redirect' => base_url() . "archive/sell/?key=$key"
                        ]);
                    }
                    else
                    {
                        log_message('error', 'sellSave: lm - FAILED, no rows affected');
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Gagal menyimpan data! Tidak ada perubahan data.'
                        ]);
                    }
                    return;
                }
            }
            else if ($key == "material-au")
            {
                $parameter = 'f_rti_au_sell';
                if ($type == "change")
                {
                    $data = array(
                        'a' => $this->input->post('a'),
                        'b' => $this->input->post('b'),
                        'c' => $this->input->post('c'),
                        'd' => $this->input->post('d'),
                        'e' => $this->input->post('e'),
                        'f' => $this->input->post('f'),
                        'g' => $this->input->post('g')
                    );
                    $this->MasterModel->formulasUpdate($key, $data);
                    
                    log_message('info', 'sellSave: material-au change - SUCCESS');
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil disimpan!',
                        'redirect' => base_url() . "archive/sell/?key=$key&type=change"
                    ]);
                    return;
                }
                else
                {
                    if (empty($value))
                    {
                        log_message('error', 'sellSave: material-au - Empty value parameter');
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Value tidak boleh kosong!'
                        ]);
                        return;
                    }

                    log_message('debug', 'sellSave: material-au - updating with value = ' . $value);
                    $affectedRows = $this->MaterialModel->formulaUpdate($parameter, $value);
                    
                    log_message('debug', 'sellSave: material-au - affected rows = ' . $affectedRows);

                    if ($affectedRows > 0)
                    {
                        log_message('info', 'sellSave: material-au - SUCCESS');
                        echo json_encode([
                            'status' => 'success',
                            'message' => 'Data berhasil disimpan!',
                            'redirect' => base_url() . "archive/sell/?key=$key"
                        ]);
                    }
                    else
                    {
                        log_message('error', 'sellSave: material-au - FAILED, no rows affected');
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Gagal menyimpan data! Tidak ada perubahan data.'
                        ]);
                    }
                    return;
                }
            }
            else if ($key == "material-ag")
            {
                $parameter = 'f_rti_ag_sell';
                if ($type == "change")
                {
                    $data = array(
                        'a' => $this->input->post('a'),
                        'b' => $this->input->post('b'),
                        'c' => $this->input->post('c'),
                        'd' => $this->input->post('d'),
                        'e' => $this->input->post('e'),
                    );
                    $this->MasterModel->formulasUpdate($key, $data);
                    
                    log_message('info', 'sellSave: material-ag change - SUCCESS');
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil disimpan!',
                        'redirect' => base_url() . "archive/sell/?key=$key&type=change"
                    ]);
                    return;
                }
                else
                {
                    if (empty($value))
                    {
                        log_message('error', 'sellSave: material-ag - Empty value parameter');
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Value tidak boleh kosong!'
                        ]);
                        return;
                    }

                    log_message('debug', 'sellSave: material-ag - updating with value = ' . $value);
                    $affectedRows = $this->MaterialModel->formulaUpdate($parameter, $value);
                    
                    log_message('debug', 'sellSave: material-ag - affected rows = ' . $affectedRows);

                    if ($affectedRows > 0)
                    {
                        log_message('info', 'sellSave: material-ag - SUCCESS');
                        echo json_encode([
                            'status' => 'success',
                            'message' => 'Data berhasil disimpan!',
                            'redirect' => base_url() . "archive/sell/?key=$key"
                        ]);
                    }
                    else
                    {
                        log_message('error', 'sellSave: material-ag - FAILED, no rows affected');
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Gagal menyimpan data! Tidak ada perubahan data.'
                        ]);
                    }
                    return;
                }
            }
            else if ($key == "material-ubs")
            {
                $dataPost = $this->input->post();
                
                if ($type == "change")
                {
                    if (empty($dataPost['configMaterial']))
                    {
                        log_message('error', 'sellSave: material-ubs change - Empty configMaterial');
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Data potongan tidak valid!'
                        ]);
                        return;
                    }
                    
                    foreach ($dataPost['configMaterial'] as $keyGet => $valueGet)
                    {
                        $dataUpdate = array(
                            'potongan' => $valueGet,
                        );
                        $this->db->update('config_material', $dataUpdate, ['id' => $keyGet]);
                    }
                    
                    log_message('info', 'sellSave: material-ubs change - SUCCESS');
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil disimpan!',
                        'redirect' => base_url() . "archive/sell/?key=$key&type=change"
                    ]);
                    return;
                }
                else
                {
                    if (empty($dataPost['configMaterial']))
                    {
                        log_message('error', 'sellSave: material-ubs - Empty configMaterial');
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Data harga tidak valid!'
                        ]);
                        return;
                    }
                    
                    foreach ($dataPost['configMaterial'] as $keyGet => $valueGet)
                    {
                        $dataUpdate = array(
                            'harga' => $valueGet,
                        );
                        $this->db->update('config_material', $dataUpdate, ['id' => $keyGet]);
                    }
                    
                    log_message('info', 'sellSave: material-ubs - SUCCESS');
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil disimpan!',
                        'redirect' => base_url() . "archive/sell/?key=$key"
                    ]);
                    return;
                }
            }
            else
            {
                log_message('error', 'sellSave: Unknown key = ' . $key);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Key tidak valid!'
                ]);
                return;
            }
        }
        catch (Exception $e)
        {
            log_message('error', 'sellSave: Exception occurred - ' . $e->getMessage());
            echo json_encode([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
            return;
        }
    }
    public function memo()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        $this->data["title"] = "MASTER";
        if ($authUser == true)
        {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $this->data['content'] = $this->load->view('Memo', $this->data, true);
            $this->load->view("UserTemplate", $this->data);
        }
        else
        {
            redirect(base_url());
        }
    }
    public function addmemo()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        $this->data["title"] = "MASTER";
        if ($authUser == true)
        {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $this->data['content'] = $this->load->view('addMemo', $this->data, true);
            $this->load->view("UserTemplate", $this->data);
        }
        else
        {
            redirect(base_url());
        }
    }

    public function saveMemo()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");

        header('Content-Type: application/json');

        if ($authUser != true)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Session expired. Please login again.'
            ]);
            return;
        }

        $datapost = $this->input->post();

        // Validation: Check required fields
        if (empty($datapost['dt']['tm_value']))
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Isi Syarat & Ketentuan tidak boleh kosong!'
            ]);
            return;
        }

        if (empty($datapost['dt']['tm_priority']))
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Priority tidak boleh kosong!'
            ]);
            return;
        }

        // Validation: Check duplicate priority
        $this->db->where('tm_priority', $datapost['dt']['tm_priority']);
        $duplicate = $this->db->get('tb_memo')->row();

        if ($duplicate)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Priority "' . $datapost['dt']['tm_priority'] . '" sudah digunakan!'
            ]);
            return;
        }

        // Save data
        $this->db->insert('tb_memo', $datapost['dt']);

        echo json_encode([
            'status' => 'success',
            'message' => 'Syarat & Ketentuan Berhasil Disimpan!'
        ]);
    }

    public function detailMemo($idmemo = '')
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        if ($authUser == true)
        {
            $this->db->where('tm_id', $idmemo);
            $this->data['memo'] = $this->db->get('tb_memo')->row();
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $this->data['content'] = $this->load->view('editMemo', $this->data, true);
            $this->load->view("UserTemplate", $this->data);
        }
        else
        {
            redirect(base_url());
        }
    }
    public function saveUpdateMemo()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");

        header('Content-Type: application/json');

        if ($authUser != true)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Session expired. Please login again.'
            ]);
            return;
        }

        $datapost = $this->input->post();

        // Validation: Check required fields
        if (empty($datapost['dt']['tm_value']))
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Isi Syarat & Ketentuan tidak boleh kosong!'
            ]);
            return;
        }

        if (empty($datapost['dt']['tm_priority']))
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Priority tidak boleh kosong!'
            ]);
            return;
        }

        // Validation: Check duplicate priority (exclude current ID)
        $this->db->where('tm_priority', $datapost['dt']['tm_priority']);
        $this->db->where('tm_id !=', $datapost['id']);
        $duplicate = $this->db->get('tb_memo')->row();

        if ($duplicate)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Priority "' . $datapost['dt']['tm_priority'] . '" sudah digunakan!'
            ]);
            return;
        }

        // Update data
        $this->db->where('tm_id', $datapost['id']);
        $this->db->update('tb_memo', $datapost['dt']);

        echo json_encode([
            'status' => 'success',
            'message' => 'Syarat & Ketentuan Berhasil Diupdate!'
        ]);
    }
    public function deleteMemo($idmemo = '')
    {
        $this->db->where('tm_id', $idmemo);
        $this->db->delete('tb_memo');
        $data_session = array(
            'status' => 'success',
            'message' => "Memo Is Deleted!",
        );
        $this->session->set_userdata($data_session);
        redirect(base_url() . "master/memo");
    }
    public function potongan()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        $this->data["title"] = "MASTER";
        if ($authUser == true)
        {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $this->data['content'] = $this->load->view('Potongan', $this->data, true);
            $this->load->view("UserTemplate", $this->data);
        }
        else
        {
            redirect(base_url());
        }
    }
    public function addPotongan()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        $this->data["title"] = "MASTER";
        if ($authUser == true)
        {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $this->data['content'] = $this->load->view('addPotongan', $this->data, true);
            $this->load->view("UserTemplate", $this->data);
        }
        else
        {
            redirect(base_url());
        }
    }
    public function savePotongan()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        if ($authUser == true)
        {
            $datapost = $this->input->post();
            $datapost['dt']['status'] = 'ENABLE';
            $datapost['dt']['created_at'] = date("Y-m-d H:i:s");
            $this->db->insert('tb_potongan', $datapost['dt']);
            $data_session = array(
                'status' => 'success',
                'message' => "Potongan Berhasil Disimpan",
            );
            $this->session->set_userdata($data_session);
            redirect(base_url() . "master/potongan");
        }
        else
        {
            redirect(base_url());
        }
    }
    public function deletePotongan($idpotongan = '')
    {
        $this->db->update('tb_potongan', ['status' => 'DISABLE'], ['id' => $idpotongan]);
        $data_session = array(
            'status' => 'success',
            'message' => "Potongan Berhasil Dihapus",
        );
        $this->session->set_userdata($data_session);
        redirect(base_url() . "master/memo");
    }
    public function detailPotongan($idpotongan = '')
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        if ($authUser == true)
        {
            $this->db->where('id', $idpotongan);
            $this->data['potongan'] = $this->db->get('tb_potongan')->row();
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $this->data['content'] = $this->load->view('editPotongan', $this->data, true);
            $this->load->view("UserTemplate", $this->data);
        }
        else
        {
            redirect(base_url());
        }
    }
    public function saveUpdatePotongan()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        if ($authUser == true)
        {
            $datapost = $this->input->post();
            $datapost['dt']['status'] = 'ENABLE';
            $datapost['dt']['updated_at'] = date("Y-m-d H:i:s");
            $this->db->where('id', $datapost['id']);
            $this->db->update('tb_potongan', $datapost['dt']);
            $data_session = array(
                'status' => 'success',
                'message' => "Potongan Berhasil Disimpan",
            );
            $this->session->set_userdata($data_session);
            redirect(base_url() . "master/potongan");
        }
        else
        {
            redirect(base_url());
        }
    }
    public function cabang()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        $this->data["title"] = "MASTER";
        if ($authUser == true)
        {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $this->data['content'] = $this->load->view('Cabang', $this->data, true);
            $this->load->view("UserTemplate", $this->data);
        }
        else
        {
            redirect(base_url());
        }
    }
    public function addCabang()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        $this->data["title"] = "MASTER";
        if ($authUser == true)
        {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $this->data['content'] = $this->load->view('addCabang', $this->data, true);
            $this->load->view("UserTemplate", $this->data);
        }
        else
        {
            redirect(base_url());
        }
    }
    public function saveCabang()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");

        header('Content-Type: application/json');

        if ($authUser != true)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Session expired. Please login again.'
            ]);
            return;
        }

        $datapost = $this->input->post();

        // Validation: Check required fields
        if (empty($datapost['dt']['nama_cabang']))
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Nama Cabang tidak boleh kosong!'
            ]);
            return;
        }

        if (empty($datapost['dt']['urutan_cabang']))
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Urutan tidak boleh kosong!'
            ]);
            return;
        }

        // Validation: Check duplicate nama_cabang
        $this->db->where('nama_cabang', $datapost['dt']['nama_cabang']);
        $this->db->where('status', 'ENABLE');
        $duplicate = $this->db->get('tb_cabang')->row();

        if ($duplicate)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Nama Cabang "' . $datapost['dt']['nama_cabang'] . '" sudah ada!'
            ]);
            return;
        }

        // Validation: Check duplicate urutan_cabang
        $this->db->where('urutan_cabang', $datapost['dt']['urutan_cabang']);
        $this->db->where('status', 'ENABLE');
        $duplicateUrutan = $this->db->get('tb_cabang')->row();

        if ($duplicateUrutan)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Urutan "' . $datapost['dt']['urutan_cabang'] . '" sudah digunakan!'
            ]);
            return;
        }

        // Save data
        $datapost['dt']['status'] = 'ENABLE';
        $datapost['dt']['created_at'] = date("Y-m-d H:i:s");
        $this->db->insert('tb_cabang', $datapost['dt']);

        echo json_encode([
            'status' => 'success',
            'message' => 'Cabang Berhasil Disimpan!'
        ]);
    }
    public function deleteCabang($idcabang = '')
    {
        $this->db->update('tb_cabang', ['status' => 'DISABLE'], ['id' => $idcabang]);
        $data_session = array(
            'status' => 'success',
            'message' => "Cabang Berhasil Dihapus",
        );
        $this->session->set_userdata($data_session);
        redirect(base_url() . "master/memo");
    }
    public function detailCabang($idcabang = '')
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        if ($authUser == true)
        {
            $this->db->where('id', $idcabang);
            $this->data['cabang'] = $this->db->get('tb_cabang')->row();
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $this->data['content'] = $this->load->view('editCabang', $this->data, true);
            $this->load->view("UserTemplate", $this->data);
        }
        else
        {
            redirect(base_url());
        }
    }
    public function saveUpdateCabang()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");

        header('Content-Type: application/json');

        if ($authUser != true)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Session expired. Please login again.'
            ]);
            return;
        }

        $datapost = $this->input->post();

        // Validation: Check required fields
        if (empty($datapost['dt']['nama_cabang']))
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Nama Cabang tidak boleh kosong!'
            ]);
            return;
        }

        if (empty($datapost['dt']['urutan_cabang']))
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Urutan tidak boleh kosong!'
            ]);
            return;
        }

        // Validation: Check duplicate nama_cabang (exclude current ID)
        $this->db->where('nama_cabang', $datapost['dt']['nama_cabang']);
        $this->db->where('status', 'ENABLE');
        $this->db->where('id !=', $datapost['id']);
        $duplicate = $this->db->get('tb_cabang')->row();

        if ($duplicate)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Nama Cabang "' . $datapost['dt']['nama_cabang'] . '" sudah ada!'
            ]);
            return;
        }

        // Validation: Check duplicate urutan_cabang (exclude current ID)
        $this->db->where('urutan_cabang', $datapost['dt']['urutan_cabang']);
        $this->db->where('status', 'ENABLE');
        $this->db->where('id !=', $datapost['id']);
        $duplicateUrutan = $this->db->get('tb_cabang')->row();

        if ($duplicateUrutan)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Urutan "' . $datapost['dt']['urutan_cabang'] . '" sudah digunakan!'
            ]);
            return;
        }

        // Update data
        $datapost['dt']['status'] = 'ENABLE';
        $datapost['dt']['updated_at'] = date("Y-m-d H:i:s");
        $this->db->where('id', $datapost['id']);
        $this->db->update('tb_cabang', $datapost['dt']);

        echo json_encode([
            'status' => 'success',
            'message' => 'Cabang Berhasil Diupdate!'
        ]);
    }

    // API: Check duplicate customer for add
    public function checkDuplicateCustomer()
    {
        $authUser = $this->session->userdata("authUser");

        header('Content-Type: application/json');

        if ($authUser != true)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Session expired. Please login again.'
            ]);
            return;
        }

        $type = $this->input->post('type');
        $value = $this->input->post('value');

        if (empty($type) || empty($value))
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Parameter tidak valid!'
            ]);
            return;
        }

        // Check based on type
        else if ($type == 'id_number')
        {
            $this->db->where('c_id_number', strtoupper($value));
        }
        else
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Tipe validasi tidak valid!'
            ]);
            return;
        }

        $result = $this->db->get('tb_customer')->row();

        if ($result)
        {
            echo json_encode([
                'status' => 'duplicate',
                'message' => 'Data "' . $value . '" sudah digunakan!'
            ]);
        }
        else
        {
            echo json_encode([
                'status' => 'available',
                'message' => 'Data tersedia!'
            ]);
        }
    }

    // API: Check duplicate customer for edit
    public function checkDuplicateCustomerEdit()
    {
        $authUser = $this->session->userdata("authUser");

        header('Content-Type: application/json');

        if ($authUser != true)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Session expired. Please login again.'
            ]);
            return;
        }

        $type = $this->input->post('type');
        $value = $this->input->post('value');
        $idCustomer = $this->input->post('idCustomer');

        if (empty($type) || empty($value) || empty($idCustomer))
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Parameter tidak valid!'
            ]);
            return;
        }

        // Check based on type (exclude current customer)
        else if ($type == 'id_number')
        {
            $this->db->where('c_id_number', strtoupper($value));
        }
        else
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Tipe validasi tidak valid!'
            ]);
            return;
        }

        $this->db->where('c_id !=', $idCustomer);
        $result = $this->db->get('tb_customer')->row();

        if ($result)
        {
            echo json_encode([
                'status' => 'duplicate',
                'message' => 'Data "' . $value . '" sudah digunakan!'
            ]);
        }
        else
        {
            echo json_encode([
                'status' => 'available',
                'message' => 'Data tersedia!'
            ]);
        }
    }

    // API: Check duplicate memo for edit
    public function checkDuplicateMemoEdit()
    {
        $authUser = $this->session->userdata("authUser");

        header('Content-Type: application/json');

        if ($authUser != true)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Session expired. Please login again.'
            ]);
            return;
        }

        $priority = $this->input->post('priority');
        $idMemo = $this->input->post('idMemo');

        if (empty($priority) || empty($idMemo))
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Parameter tidak valid!'
            ]);
            return;
        }

        // Check duplicate priority (exclude current memo)
        $this->db->where('tm_priority', $priority);
        $this->db->where('tm_id !=', $idMemo);
        $result = $this->db->get('tb_memo')->row();

        if ($result)
        {
            echo json_encode([
                'status' => 'duplicate',
                'message' => 'Priority "' . $priority . '" sudah digunakan!'
            ]);
        }
        else
        {
            echo json_encode([
                'status' => 'available',
                'message' => 'Data tersedia!'
            ]);
        }
    }

    // Save customer with validation
    public function saveCustomerWithValidation()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");

        header('Content-Type: application/json');

        if ($authUser != true)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Session expired. Please login again.'
            ]);
            return;
        }

        $name = strtoupper($this->input->post('name'));
        $idNumber = strtoupper($this->input->post('idNumber'));
        $phone = $this->input->post('phone');

        // Validation: Check required fields
        if (empty($name))
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Nama tidak boleh kosong!'
            ]);
            return;
        }

        if (empty($idNumber))
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Nomor KTP tidak boleh kosong!'
            ]);
            return;
        }

        if (empty($phone))
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Nomor HP tidak boleh kosong!'
            ]);
            return;
        }

        // Validation: Check duplicate id number
        $this->db->where('c_id_number', $idNumber);
        $duplicateIdNumber = $this->db->get('tb_customer')->row();

        if ($duplicateIdNumber)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Nomor KTP "' . $idNumber . '" sudah digunakan!'
            ]);
            return;
        }

        // Get max no_order
        $this->db->select_max('c_no_order');
        $maxOrder = $this->db->get('tb_customer')->row()->c_no_order;
        $newNoOrder = $maxOrder ? $maxOrder + 1 : 1;

        // Save data
        $data = array(
            'c_name' => $name,
            'c_id_number' => $idNumber,
            'c_address' => strtoupper($this->input->post('address')),
            'c_resident_address' => strtoupper($this->input->post('resident_address')),
            'c_phone' => $phone,
            'c_u_id' => $idUser,
            'c_no_order' => $newNoOrder,
            'c_date_created' => date("Y-m-d H:i:s"),
        );

        $this->db->insert('tb_customer', $data);

        echo json_encode([
            'status' => 'success',
            'message' => 'Customer Berhasil Disimpan!'
        ]);
    }

    // Save customer edit with validation
    public function saveCustomerEditWithValidation()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");

        header('Content-Type: application/json');

        if ($authUser != true)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Session expired. Please login again.'
            ]);
            return;
        }

        $idCustomer = $this->input->post('idCustomer');
        $name = strtoupper($this->input->post('name'));
        $idNumber = strtoupper($this->input->post('idNumber'));
        $phone = $this->input->post('phone');

        // Validation: Check required fields
        if (empty($name))
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Nama tidak boleh kosong!'
            ]);
            return;
        }

        if (empty($idNumber))
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Nomor KTP tidak boleh kosong!'
            ]);
            return;
        }

        if (empty($phone))
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Nomor HP tidak boleh kosong!'
            ]);
            return;
        }

        // Validation: Check duplicate id number (exclude current customer)
        $this->db->where('c_id_number', $idNumber);
        $this->db->where('c_id !=', $idCustomer);
        $duplicateIdNumber = $this->db->get('tb_customer')->row();

        if ($duplicateIdNumber)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Nomor KTP "' . $idNumber . '" sudah digunakan!'
            ]);
            return;
        }

        // Update data
        $data = array(
            'c_name' => $name,
            'c_id_number' => $idNumber,
            'c_address' => strtoupper($this->input->post('address')),
            'c_resident_address' => strtoupper($this->input->post('resident_address')),
            'c_phone' => $phone,
            'c_u_id' => $idUser,
            'c_no_order' => $this->input->post('noOrder'),
        );

        $this->db->where('c_id', $idCustomer);
        $this->db->update('tb_customer', $data);

        echo json_encode([
            'status' => 'success',
            'message' => 'Customer Berhasil Diupdate!'
        ]);
    }

    // Delete customer with SWAL response
    public function deleteCustomerWithSwal()
    {
        $authUser = $this->session->userdata("authUser");

        header('Content-Type: application/json');

        if ($authUser != true)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Session expired. Please login again.'
            ]);
            return;
        }

        $id = $this->input->post('id');

        if (empty($id))
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'ID tidak valid!'
            ]);
            return;
        }

        $this->db->where('c_id', $id);
        $this->db->delete('tb_customer');

        echo json_encode([
            'status' => 'success',
            'message' => 'Customer Berhasil Dihapus!'
        ]);
    }

    // Delete memo with SWAL response
    public function deleteMemoWithSwal()
    {
        $authUser = $this->session->userdata("authUser");

        header('Content-Type: application/json');

        if ($authUser != true)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Session expired. Please login again.'
            ]);
            return;
        }

        $id = $this->input->post('id');

        if (empty($id))
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'ID tidak valid!'
            ]);
            return;
        }

        $this->db->where('tm_id', $id);
        $this->db->delete('tb_memo');

        echo json_encode([
            'status' => 'success',
            'message' => 'Syarat & Ketentuan Berhasil Dihapus!'
        ]);
    }

    public function exportCustomerExcel()
    {
        $authUser = $this->session->userdata("authUser");

        if (!$authUser) {
            redirect(base_url());
            return;
        }

        $customers = $this->MasterModel->customerData()->result();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Customer');

        // Title
        $sheet->mergeCells('A1:E1');
        $sheet->setCellValue('A1', 'DATA MASTER CUSTOMER');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getRowDimension(1)->setRowHeight(30);

        // Date row
        $sheet->mergeCells('A2:E2');
        $sheet->setCellValue('A2', 'Tanggal Export: ' . date('d/m/Y H:i:s'));
        $sheet->getStyle('A2')->getFont()->setItalic(true);
        $sheet->getRowDimension(2)->setRowHeight(18);

        // Header
        $headers = ['No', 'ID Customer', 'Nama', 'Alamat', 'No. HP'];
        $sheet->fromArray($headers, null, 'A3');

        // Style header
        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
            'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '2C3E50']],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
        ];
        $sheet->getStyle('A3:E3')->applyFromArray($headerStyle);
        $sheet->getRowDimension(3)->setRowHeight(22);

        // Column width
        $sheet->getColumnDimension('A')->setWidth(6);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(35);
        $sheet->getColumnDimension('D')->setWidth(50);
        $sheet->getColumnDimension('E')->setWidth(20);

        // Data rows
        $row = 4;
        $no = 1;
        foreach ($customers as $c) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $c->c_id);
            $sheet->setCellValue('C' . $row, $c->c_name);
            $sheet->setCellValue('D' . $row, $c->c_address);
            $sheet->setCellValue('E' . $row, $c->c_phone);

            // Alternate row color
            if ($no % 2 == 0) {
                $sheet->getStyle('A'.$row.':E'.$row)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('F2F2F2');
            }

            // Data border and alignment
            $dataStyle = [
                'alignment' => ['vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER],
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
            ];
            $sheet->getStyle('A'.$row.':E'.$row)->applyFromArray($dataStyle);
            $sheet->getStyle('A'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('B'.$row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getRowDimension($row)->setRowHeight(18);

            $row++;
        }

        // Output file
        $filename = 'Data_Master_Customer_' . date('Ymd_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    // Delete cabang with SWAL response
    public function deleteCabangWithSwal()
    {
        $authUser = $this->session->userdata("authUser");

        header('Content-Type: application/json');

        if ($authUser != true)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Session expired. Please login again.'
            ]);
            return;
        }

        $id = $this->input->post('id');

        if (empty($id))
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'ID tidak valid!'
            ]);
            return;
        }

        $this->db->update('tb_cabang', ['status' => 'DISABLE'], ['id' => $id]);

        echo json_encode([
            'status' => 'success',
            'message' => 'Cabang Berhasil Dihapus!'
        ]);
    }

    public function exportMasterExcel()
{
    $authUser = $this->session->userdata("authUser");
    if (!$authUser) {
        redirect(base_url());
        exit;
    }

    // Clear all buffers
    while (ob_get_level()) {
        ob_end_clean();
    }

    // ======================
    // Ambil data
    // ======================

    $customers = $this->MasterModel->customerData()->result();

    $this->db->group_start();
    $this->db->where('status !=', 'DISABLE');
    $this->db->or_where('status IS NULL', null, false);
    $this->db->group_end();
    $memos = $this->db->get('tb_memo')->result();

    $cabangs = $this->db->where('status', 'ENABLE')->get('tb_cabang')->result();

    // Preview data
    $customersPreview = array_slice($customers, 0, 15);
    $memosPreview = array_slice($memos, 0, 10);

    // ======================
    // Spreadsheet
    // ======================

    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Ringkasan Master');

    // Judul
    $sheet->mergeCells('A1:H1');
    $sheet->setCellValue('A1', 'RINGKASAN DATA MASTER');
    $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);

    // Tanggal
    $sheet->mergeCells('A2:H2');
    $sheet->setCellValue('A2', 'Ekspor: ' . date('d/m/Y H:i:s'));
    $sheet->getStyle('A2')->getFont()->setItalic(true);

    $row = 4;

    // ======================
    // CUSTOMER
    // ======================

    $sheet->setCellValue('A'.$row, 'CUSTOMER (Total: '.count($customers).')');
    $sheet->mergeCells('A'.$row.':H'.$row);
    $sheet->getStyle('A'.$row)->getFont()->setBold(true);
    $row++;

    $sheet->fromArray(['No','ID','Nama','KTP','Alamat','HP'], NULL, 'A'.$row);
    $sheet->getStyle('A'.$row.':F'.$row)->getFont()->setBold(true);
    $row++;

    $no = 1;
    foreach ($customersPreview as $c) {
        $sheet->fromArray([
            $no++,
            $c->c_id,
            $c->c_name,
            $c->c_id_number,
            $c->c_address,
            $c->c_phone
        ], NULL, 'A'.$row);
        $row++;
    }

    $row += 2;

    // ======================
    // MEMO
    // ======================

    $sheet->setCellValue('A'.$row, 'MEMO (Total: '.count($memos).')');
    $sheet->mergeCells('A'.$row.':H'.$row);
    $sheet->getStyle('A'.$row)->getFont()->setBold(true);
    $row++;

    $sheet->fromArray(['No','Priority','Isi Memo'], NULL, 'A'.$row);
    $sheet->getStyle('A'.$row.':C'.$row)->getFont()->setBold(true);
    $row++;

    $no = 1;

    foreach ($memosPreview as $m) {

        $preview = strlen($m->tm_value) > 80
            ? substr($m->tm_value,0,80).'...'
            : $m->tm_value;

        $priority = !empty($m->tm_priority) ? $m->tm_priority : '-';

        $sheet->fromArray([
            $no++,
            $priority,
            $preview
        ], NULL, 'A'.$row);

        $row++;
    }

    $row += 2;

    // ======================
    // CABANG
    // ======================

    $sheet->setCellValue('A'.$row, 'CABANG (Total: '.count($cabangs).')');
    $sheet->mergeCells('A'.$row.':H'.$row);
    $sheet->getStyle('A'.$row)->getFont()->setBold(true);
    $row++;

    $sheet->fromArray(['No','ID','Nama Cabang','Urutan'], NULL, 'A'.$row);
    $sheet->getStyle('A'.$row.':D'.$row)->getFont()->setBold(true);
    $row++;

    $no = 1;
    foreach ($cabangs as $cb) {

        $sheet->fromArray([
            $no++,
            $cb->id,
            $cb->nama_cabang,
            $cb->urutan_cabang
        ], NULL, 'A'.$row);

        $row++;
    }

    // Auto size
    foreach (range('A','H') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // Footer
    $sheet->mergeCells('A'.($row+1).':H'.($row+1));
    $sheet->setCellValue(
        'A'.($row+1),
        'Total Rekap: Customer='.count($customers).', Memo='.count($memos).', Cabang='.count($cabangs)
    );

    // ======================
    // Download
    // ======================

    $filename = 'Ringkasan_Master_'.date('Ymd_His').'.xlsx';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=UTF-8');
    header('Content-Disposition: attachment; filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
    header('Pragma: public');

    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');

    $spreadsheet->disconnectWorksheets();
    unset($spreadsheet);

    exit;
}
}

