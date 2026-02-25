<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MasterController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('MasterModel');
        $this->load->model('MaterialModel');
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
            $this->data['customer'] = $this->MasterModel->customerData()->result();
            $this->data['content'] = $this->load->view('MasterCustomer', $this->data, true);
            $this->load->view("UserTemplate", $this->data);
        }
        else
        {
            redirect(base_url());
        }
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
        if ($authUser == true)
        {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $key = $this->input->get('key');
            $value = $this->input->get('value');
            if (in_array($key, array("rti-au", "rti-pt", "rti-ag", "rti-lm", "rti-ru", "rti-ta")))
            {
                $type = $this->input->get('type');
                if ($key == "rti-au")
                {
                    $parameter = 'f_' . str_replace('-', '_', $key);
                    if ($type == "change")
                    {
                        $data = array(
                            'a' => $this->input->get('a'),
                            'c' => $this->input->get('c'),
                            'd' => $this->input->get('d'),
                            'e' => $this->input->get('e'),
                            'f' => $this->input->get('f'),
                            'g' => $this->input->get('g'),
                            'h' => $this->input->get('h'),
                            'gb_99' => $this->input->get('gb_99'),
                            'gb_99_9' => $this->input->get('gb_99_9'),
                            'potongan_lm' => json_encode($this->input->get('potongan_lm')),
                            'k23' => $this->input->get('k23'),
                            'k22' => $this->input->get('k22'),
                            'k21' => $this->input->get('k21'),
                            'k20' => $this->input->get('k20'),
                            'k19' => $this->input->get('k19'),
                            'k18' => $this->input->get('k18'),
                            'k17' => $this->input->get('k17'),
                            'k16' => $this->input->get('k16'),
                            'k15' => $this->input->get('k15'),
                            'k14' => $this->input->get('k14'),
                            'k13' => $this->input->get('k13'),
                            'k12' => $this->input->get('k12'),
                            'k11' => $this->input->get('k11'),
                            'k10' => $this->input->get('k10'),
                            'k9' => $this->input->get('k9'),
                            'k8' => $this->input->get('k8'),
                            'k7' => $this->input->get('k7'),
                            'k6' => $this->input->get('k6'),
                            'k5' => $this->input->get('k5'),
                            'k4' => $this->input->get('k4'),
                            'k3' => $this->input->get('k3'),
                            'k2' => $this->input->get('k2'),
                        );
                        $this->MasterModel->formulasUpdate($key, $data);
                        redirect(base_url() . "archive/buy/?key=$key&type=change");
                    }
                    else
                    {
                        $this->MaterialModel->formulaUpdate($parameter, $value);
                        $parameter = 'f_rti_au_sell';
                        $this->MaterialModel->formulaUpdate($parameter, $value);
                        redirect(base_url() . "archive/buy/?key=$key");
                    }
                }
                else if ($key == "rti-ag")
                {
                    $parameter = 'f_' . str_replace('-', '_', $key);
                    if ($type == "change")
                    {
                        $data = array(
                            'a' => $this->input->get('a'),
                            'b' => $this->input->get('b'),
                            'c' => $this->input->get('c'),
                            'd' => $this->input->get('d'),
                            'e' => $this->input->get('e'),
                        );
                        $this->MasterModel->formulasUpdate($key, $data);
                        $data = array(
                            'a' => $this->input->get('aa'),
                            'b' => $this->input->get('bb'),
                            'c' => $this->input->get('cc'),
                            'd' => $this->input->get('dd'),
                            'e' => $this->input->get('ee'),
                        );
                        $this->MasterModel->formulasUpdate('rti-ag-low', $data);
                        redirect(base_url() . "archive/buy/?key=$key&type=change");
                    }
                    else
                    {
                        $this->MaterialModel->formulaUpdate($parameter, $value);
                        $parameter = 'f_rti_ag_sell';
                        $this->MaterialModel->formulaUpdate($parameter, $value);
                        redirect(base_url() . "archive/buy/?key=$key");
                    }
                }
                else if ($key == "rti-pt")
                {
                    $parameter = 'f_' . str_replace('-', '_', $key);
                    if ($type == "change")
                    {
                        $data = array(
                            'a' => $this->input->get('a'),
                            'b' => $this->input->get('b'),
                            'c' => $this->input->get('c'),
                            'd' => $this->input->get('d'),
                            'e' => $this->input->get('e'),
                        );
                        $this->MasterModel->formulasUpdate($key, $data);
                        $data = array(
                            'a' => $this->input->get('aa'),
                            'b' => $this->input->get('bb'),
                            'c' => $this->input->get('cc'),
                            'd' => $this->input->get('dd'),
                            'e' => $this->input->get('ee'),
                        );
                        $this->MasterModel->formulasUpdate('rti-pt-low', $data);
                        redirect(base_url() . "archive/buy/?key=$key&type=change");
                    }
                    else
                    {
                        $this->MaterialModel->formulaUpdate($parameter, $value);
                        redirect(base_url() . "archive/buy/?key=$key");
                    }
                }
                else if ($key == "rti-ru")
                {
                    $parameter = 'f_' . str_replace('-', '_', $key);
                    if ($type == "change")
                    {
                        $data = array(
                            'a' => $this->input->get('a')
                        );
                        $this->MasterModel->formulasUpdate($key, $data);
                        $data = array(
                            'a' => $this->input->get('aa'),
                        );
                        $this->MasterModel->formulasUpdate('rti-ru-low', $data);
                        redirect(base_url() . "archive/buy/?key=$key&type=change");
                    }
                    else
                    {
                        $this->MaterialModel->formulaUpdate($parameter, $value);
                        redirect(base_url() . "archive/buy/?key=$key");
                    }
                }
                else
                {
                    $parameter = 'f_' . str_replace('-', '_', $key);
                    if ($type == "change")
                    {
                        $data = array(
                            'a' => $this->input->get('a')
                        );
                        $this->MasterModel->formulasUpdate($key, $data);
                        redirect(base_url() . "archive/buy/?key=$key&type=change");
                    }
                    else
                    {
                        $this->MaterialModel->formulaUpdate($parameter, $value);
                        redirect(base_url() . "archive/buy/?key=$key");
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
        if ($authUser == true)
        {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $key = $this->input->get('key');
            $value = $this->input->get('value');
            if (in_array($key, array("lm", "material-au", "material-ag", "material-ubs")))
            {
                $type = $this->input->get('type');
                if ($key == "lm")
                {
                    $parameter = 'f_' . str_replace('-', '_', $key);
                    if ($type == "change")
                    {
                        $data = array(
                            'a' => $this->input->get('a'),
                            'b' => $this->input->get('b'),
                            'c' => $this->input->get('c'),
                            'd' => $this->input->get('d'),
                            'e' => $this->input->get('e'),
                            'f' => $this->input->get('f'),
                            'g' => $this->input->get('g'),
                            'h' => $this->input->get('h'),
                            'potongan_lm' => json_encode($this->input->get('potongan_lm')),
                        );
                        $this->MasterModel->formulasUpdate($key, $data);
                        redirect(base_url() . "archive/sell/?key=$key&type=change");
                    }
                    else
                    {
                        $data = array(
                            "f_nol5" => $this->input->get("f_nol5"),
                            "f_1" => $this->input->get("f_1"),
                            "f_2" => $this->input->get("f_2"),
                            "f_3" => $this->input->get("f_3"),
                            "f_2_coma_5" => $this->input->get("f_2_coma_5"),
                            "f_5" => $this->input->get("f_5"),
                            "f_10" => $this->input->get("f_10"),
                            "f_25" => $this->input->get("f_25"),
                            "f_50" => $this->input->get("f_50"),
                            "f_100" => $this->input->get("f_100"),
                            "f_250" => $this->input->get("f_250"),
                            "f_500" => $this->input->get("f_500"),
                            "f_1000" => $this->input->get("f_1000"),
                        );
                        $this->MaterialModel->formulaUpdateArray($data);
                        redirect(base_url() . "archive/sell/?key=$key");
                    }
                }
                else if ($key == "material-au")
                {
                    $parameter = 'f_rti_au_sell';
                    if ($type == "change")
                    {
                        $data = array(
                            'a' => $this->input->get('a'),
                            'b' => $this->input->get('b'),
                            'c' => $this->input->get('c'),
                            'd' => $this->input->get('d'),
                            'e' => $this->input->get('e'),
                            'f' => $this->input->get('f'),
                            'g' => $this->input->get('g')
                        );
                        $this->MasterModel->formulasUpdate($key, $data);
                        redirect(base_url() . "archive/sell/?key=$key&type=change");
                    }
                    else
                    {
                        $this->MaterialModel->formulaUpdate($parameter, $value);
                        redirect(base_url() . "archive/sell/?key=$key");
                    }
                }
                else if ($key == "material-ag")
                {
                    $parameter = 'f_rti_ag_sell';
                    if ($type == "change")
                    {
                        $data = array(
                            'a' => $this->input->get('a'),
                            'b' => $this->input->get('b'),
                            'c' => $this->input->get('c'),
                            'd' => $this->input->get('d'),
                            'e' => $this->input->get('e'),
                        );
                        $this->MasterModel->formulasUpdate($key, $data);
                        redirect(base_url() . "archive/sell/?key=$key&type=change");
                    }
                    else
                    {
                        $this->MaterialModel->formulaUpdate($parameter, $value);
                        redirect(base_url() . "archive/sell/?key=$key");
                    }
                }
                else if ($key == "material-ubs")
                {
                    $dataGet = $this->input->get();
                    if ($type == "change")
                    {
                        foreach ($dataGet['configMaterial'] as $keyGet => $valueGet)
                        {
                            $dataUpdate = array(
                                'potongan' => $valueGet,
                            );
                            $this->db->update('config_material', $dataUpdate, ['id' => $keyGet]);
                        }
                        redirect(base_url() . "archive/sell/?key=$key&type=change");
                    }
                    else
                    {
                        foreach ($dataGet['configMaterial'] as $keyGet => $valueGet)
                        {
                            $dataUpdate = array(
                                'harga' => $valueGet,
                            );
                            $this->db->update('config_material', $dataUpdate, ['id' => $keyGet]);
                        }
                        redirect(base_url() . "archive/sell/?key=$key");
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
        if ($type == 'name')
        {
            $this->db->where('c_name', strtoupper($value));
        }
        else if ($type == 'id_number')
        {
            $this->db->where('c_id_number', strtoupper($value));
        }
        else if ($type == 'phone')
        {
            $this->db->where('c_phone', $value);
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
        if ($type == 'name')
        {
            $this->db->where('c_name', strtoupper($value));
        }
        else if ($type == 'id_number')
        {
            $this->db->where('c_id_number', strtoupper($value));
        }
        else if ($type == 'phone')
        {
            $this->db->where('c_phone', $value);
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

        // Validation: Check duplicate name
        $this->db->where('c_name', $name);
        $duplicateName = $this->db->get('tb_customer')->row();

        if ($duplicateName)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Nama "' . $name . '" sudah digunakan!'
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

        // Validation: Check duplicate phone
        $this->db->where('c_phone', $phone);
        $duplicatePhone = $this->db->get('tb_customer')->row();

        if ($duplicatePhone)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Nomor HP "' . $phone . '" sudah digunakan!'
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

        // Validation: Check duplicate name (exclude current customer)
        $this->db->where('c_name', $name);
        $this->db->where('c_id !=', $idCustomer);
        $duplicateName = $this->db->get('tb_customer')->row();

        if ($duplicateName)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Nama "' . $name . '" sudah digunakan!'
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

        // Validation: Check duplicate phone (exclude current customer)
        $this->db->where('c_phone', $phone);
        $this->db->where('c_id !=', $idCustomer);
        $duplicatePhone = $this->db->get('tb_customer')->row();

        if ($duplicatePhone)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Nomor HP "' . $phone . '" sudah digunakan!'
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
}
?>