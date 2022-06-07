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
        if ($authUser == true) {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $this->data['content'] = $this->load->view('Master', $this->data, true);
            $this->load->view("UserTemplate", $this->data);
        }
        else {
            redirect(base_url());
        }
    }
    function customer(){
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        $this->data["title"] = "MASTER CUSTOMER";
        if ($authUser == true) {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $this->data['customer'] = $this->MasterModel->customerData()->result();
            $this->data['content'] = $this->load->view('MasterCustomer', $this->data, true);
            $this->load->view("UserTemplate", $this->data);
        }
        else {
            redirect(base_url());
        }
    }
    function detailCustomer(){
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        $this->data["title"] = "MASTER CUSTOMER DETAIL";
        if ($authUser == true) {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $id = $this->uri->segment(3);
            $this->data['detail'] =  $this->data['customerDetail'] = $this->MasterModel->customerDetail($id)->result();
            $this->data['content'] = $this->load->view('CustomerDetail', $this->data, true);
            $this->load->view("UserTemplate", $this->data);
        }
        else {
            redirect(base_url());
        }
    }
    function editCustomerProcess(){
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        if ($authUser == true) {
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
            $this->MasterModel->editCustomerProces($data,$idCustomer);
            $data_session = array(
                'status' => 'success',
                'message' => "Edit customer is success!",
            );
            $this->session->set_userdata($data_session);
            redirect(base_url()."master/customer/$idCustomer/");
        }
        else {
            redirect(base_url());
        }
    }
    function deleteCustomerProcess(){
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        if ($authUser == true) {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $data_session = array(
                'status' => 'success',
                'message' => "Delete customer is success!",
            );
            $id=$this->uri->segment(3);
            $this->MasterModel->deleteCustomerProcess($id);
            $this->session->set_userdata($data_session);
            redirect(base_url()."master/customer/");
        }
        else {
            redirect(base_url());
        }
    }
    function archive()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        $this->data["title"] = "ARCHIVE";
        if ($authUser == true) {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $this->data['content'] = $this->load->view('Archive', $this->data, true);
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
        $this->data["title"] = "ARCHIVE BUY";
        if ($authUser == true) {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $key = $this->input->get('key');
            if(in_array($key, array("rti-au", "rti-pt", "rti-ag", "rti-lm"))){
                $type = $this->input->get('type');
                if($key=="rti-au"){
                    if($type=="change"){
                        $this->data['data'] = $this->MasterModel->formulasData($key)->result();
                        $this->data['content'] = $this->load->view('ArchiveBuyKeyChange', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }else{
                        $this->data['value'] = $this->MaterialModel->formulaData()->row("f_rti_au");
                        $this->data['content'] = $this->load->view('ArchiveBuyKey', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }
                }else if($key=="rti-pt"){
                    if($type=="change"){
                        $this->data['data'] = $this->MasterModel->formulasData($key)->result();
                        $this->data['data2'] = $this->MasterModel->formulasData('rti-pt-low')->result();
                        $this->data['content'] = $this->load->view('ArchiveBuyKeyChange', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }else{
                        $this->data['value'] = $this->MaterialModel->formulaData()->row("f_rti_pt");
                        $this->data['content'] = $this->load->view('ArchiveBuyKey', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }
                }else if($key=="rti-ag"){
                    if($type=="change"){
                        $this->data['data'] = $this->MasterModel->formulasData($key)->result();
                        $this->data['data2'] = $this->MasterModel->formulasData('rti-ag-low')->result();
                        $this->data['content'] = $this->load->view('ArchiveBuyKeyChange', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }else{
                        $this->data['value'] = $this->MaterialModel->formulaData()->row("f_rti_ag");
                        $this->data['content'] = $this->load->view('ArchiveBuyKey', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }
                }
            }else{
                $this->data['content'] = $this->load->view('ArchiveBuy', $this->data, true);
                $this->load->view("UserTemplate", $this->data);
            }
        }
        else {
            redirect(base_url());
        }
    }
    function buySave()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        if ($authUser == true) {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $key = $this->input->get('key');
            $value = $this->input->get('value');
            if(in_array($key, array("rti-au", "rti-pt", "rti-ag", "rti-lm"))){
                $type = $this->input->get('type');
                if($key=="rti-au"){
                    $parameter = 'f_'.str_replace('-','_',$key);
                    if($type=="change"){
                        $data = array(
                            'a' => $this->input->get('a'),
                            'b' => $this->input->get('b'),
                            'c' => $this->input->get('c'),
                            'd' => $this->input->get('d'),
                            'e' => $this->input->get('e'),
                            'f' => $this->input->get('f'),
                            'g' => $this->input->get('g'),
                            'h' => $this->input->get('h'),
                        );
                        $this->MasterModel->formulasUpdate($key,$data);
                        redirect(base_url()."archive/buy/?key=$key&type=change");
                    }else{
                        $this->MaterialModel->formulaUpdate($parameter,$value);
                        $parameter = 'f_rti_au_sell';
                        $this->MaterialModel->formulaUpdate($parameter,$value);
                        redirect(base_url()."archive/buy/?key=$key");
                    }
                }else if($key=="rti-ag"){
                    echo $parameter = 'f_'.str_replace('-','_',$key);
                    if($type=="change"){
                        $data = array(
                            'a' => $this->input->get('a'),
                            'b' => $this->input->get('b'),
                            'c' => $this->input->get('c'),
                            'd' => $this->input->get('d'),
                            'e' => $this->input->get('e'),
                        );
                        $this->MasterModel->formulasUpdate($key,$data);
                        $data = array(
                            'a' => $this->input->get('aa'),
                            'b' => $this->input->get('bb'),
                            'c' => $this->input->get('cc'),
                            'd' => $this->input->get('dd'),
                            'e' => $this->input->get('ee'),
                        );
                        $this->MasterModel->formulasUpdate('rti-ag-low',$data);
                        redirect(base_url()."archive/buy/?key=$key&type=change");
                    }else{
                        $this->MaterialModel->formulaUpdate($parameter,$value);
                        $parameter = 'f_rti_ag_sell';
                        $this->MaterialModel->formulaUpdate($parameter,$value);
                        redirect(base_url()."archive/buy/?key=$key");
                    }
                }else if($key=="rti-pt"){
                    $parameter = 'f_'.str_replace('-','_',$key);
                    if($type=="change"){
                        $data = array(
                            'a' => $this->input->get('a'),
                            'b' => $this->input->get('b'),
                            'c' => $this->input->get('c'),
                            'd' => $this->input->get('d'),
                            'e' => $this->input->get('e'),
                        );
                        $this->MasterModel->formulasUpdate($key,$data);
                        $data = array(
                            'a' => $this->input->get('aa'),
                            'b' => $this->input->get('bb'),
                            'c' => $this->input->get('cc'),
                            'd' => $this->input->get('dd'),
                            'e' => $this->input->get('ee'),
                        );
                        $this->MasterModel->formulasUpdate('rti-pt-low',$data);
                        redirect(base_url()."archive/buy/?key=$key&type=change");
                    }else{
                        $this->MaterialModel->formulaUpdate($parameter,$value);
                        redirect(base_url()."archive/buy/?key=$key");
                    }
                }
            }else{
                $this->data['content'] = $this->load->view('ArchiveBuy', $this->data, true);
               $this->load->view("UserTemplate", $this->data);
            }
        }
        else {
            redirect(base_url());
        }
    }
    function sell()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        $this->data["title"] = "ARCHIVE SELL";
        if ($authUser == true) {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $key = $this->input->get('key');
            if(in_array($key, array("lm", "material-au", "material-ag"))){
                $type = $this->input->get('type');
                if($key=="lm"){
                    if($type=="change"){
                        $this->data['data'] = $this->MasterModel->formulasData($key)->result();
                        $this->data['content'] = $this->load->view('ArchiveSellKeyChange', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }else{
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
                }else if($key=="material-au"){
                    if($type=="change"){
                        $this->data['data'] = $this->MasterModel->formulasData($key)->result();
                        $this->data['content'] = $this->load->view('ArchiveSellKeyChange', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }else{
                        $this->data['value'] = $this->MaterialModel->formulaData()->row("f_rti_au_sell");
                        $this->data['content'] = $this->load->view('ArchiveSellKey', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }
                }else if($key=="material-ag"){
                    if($type=="change"){
                        $this->data['data'] = $this->MasterModel->formulasData($key)->result();
                        $this->data['content'] = $this->load->view('ArchiveSellKeyChange', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }else{
                        $this->data['value'] = $this->MaterialModel->formulaData()->row("f_rti_ag_sell");
                        $this->data['content'] = $this->load->view('ArchiveSellKey', $this->data, true);
                        $this->load->view("UserTemplate", $this->data);
                    }
                }
            }else{
                $this->data['content'] = $this->load->view('ArchiveSell', $this->data, true);
                $this->load->view("UserTemplate", $this->data);
            }
        }
        else {
            redirect(base_url());
        }
    }
    function sellSave()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        if ($authUser == true) {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $key = $this->input->get('key');
            $value = $this->input->get('value');
            if(in_array($key, array("lm", "material-au", "material-ag"))){
                $type = $this->input->get('type');
                if($key=="lm"){
                    $parameter = 'f_'.str_replace('-','_',$key);
                    if($type=="change"){
                        $data = array(
                            'a' => $this->input->get('a'),
                            'b' => $this->input->get('b'),
                            'c' => $this->input->get('c'),
                            'd' => $this->input->get('d'),
                            'e' => $this->input->get('e'),
                            'f' => $this->input->get('f'),
                            'g' => $this->input->get('g'),
                            'h' => $this->input->get('h'),
                        );
                        $this->MasterModel->formulasUpdate($key,$data);
                        redirect(base_url()."archive/sell/?key=$key&type=change");
                    }else{
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
                        redirect(base_url()."archive/sell/?key=$key");
                    }
                }else if($key=="material-au"){
                    $parameter = 'f_rti_au_sell';
                    if($type=="change"){
                        $data = array(
                            'a' => $this->input->get('a'),
                            'b' => $this->input->get('b'),
                            'c' => $this->input->get('c'),
                            'd' => $this->input->get('d'),
                            'e' => $this->input->get('e'),
                            'f' => $this->input->get('f'),
                            'g' => $this->input->get('g'),
                        );
                        $this->MasterModel->formulasUpdate($key,$data);
                        redirect(base_url()."archive/sell/?key=$key&type=change");
                    }else{
                        $this->MaterialModel->formulaUpdate($parameter,$value);
                        redirect(base_url()."archive/sell/?key=$key");
                    }
                }else if($key=="material-ag"){
                    $parameter = 'f_rti_ag_sell';
                    if($type=="change"){
                        $data = array(
                            'a' => $this->input->get('a'),
                            'b' => $this->input->get('b'),
                            'c' => $this->input->get('c'),
                            'd' => $this->input->get('d'),
                            'e' => $this->input->get('e'),
                        );
                        $this->MasterModel->formulasUpdate($key,$data);
                        redirect(base_url()."archive/sell/?key=$key&type=change");
                    }else{
                        $this->MaterialModel->formulaUpdate($parameter,$value);
                        redirect(base_url()."archive/sell/?key=$key");
                    }
                }
            }else{
                $this->data['content'] = $this->load->view('ArchiveSell', $this->data, true);
               $this->load->view("UserTemplate", $this->data);
            }
        }
        else {
            redirect(base_url());
        }
    }
    public function memo()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        $this->data["title"] = "MASTER";
        if ($authUser == true) {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $this->data['content'] = $this->load->view('Memo', $this->data, true);
            $this->load->view("UserTemplate", $this->data);
        }
        else {
            redirect(base_url());
        }
    }
    public function addmemo()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        $this->data["title"] = "MASTER";
        if ($authUser == true) {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $this->data['content'] = $this->load->view('addMemo', $this->data, true);
            $this->load->view("UserTemplate", $this->data);
        }
        else {
            redirect(base_url());
        }
    }
    public function saveMemo()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        if ($authUser == true) {
            $datapost = $this->input->post();
            $this->db->insert('tb_memo', $datapost['dt']);
            $data_session = array(
                'status' => 'success',
                'message' => "Syarat & Ketentuan Berhasil Disimpan",
            );
            $this->session->set_userdata($data_session);
            redirect(base_url()."master/memo");
        }
        else {
            redirect(base_url());
        }
    }
    public function detailMemo($idmemo='')
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        if ($authUser == true) {
            $this->db->where('tm_id', $idmemo);
            $this->data['memo'] = $this->db->get('tb_memo')->row();
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $this->data['content'] = $this->load->view('editMemo', $this->data, true);
            $this->load->view("UserTemplate", $this->data);
        }
        else {
            redirect(base_url());
        }
    }
    public function saveUpdateMemo()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        if ($authUser == true) {
            $datapost = $this->input->post();
            $this->db->where('tm_id', $datapost['id']);
            $this->db->update('tb_memo', $datapost['dt']);
            $data_session = array(
                'status' => 'success',
                'message' => "Syarat & Ketentuan Berhasil Disimpan",
            );
            $this->session->set_userdata($data_session);
            redirect(base_url()."master/memo");
        }
        else {
            redirect(base_url());
        }
    }
    public function deleteMemo($idmemo='')
    {
        $this->db->where('tm_id', $idmemo);
        $this->db->delete('tb_memo');
        $data_session = array(
            'status' => 'success',
            'message' => "Memo Is Deleted!",
        );
        $this->session->set_userdata($data_session);
        redirect(base_url()."master/memo");
    }
    public function potongan()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        $this->data["title"] = "MASTER";
        if ($authUser == true) {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $this->data['content'] = $this->load->view('Potongan', $this->data, true);
            $this->load->view("UserTemplate", $this->data);
        }
        else {
            redirect(base_url());
        }
    }
    public function addPotongan()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        $this->data["title"] = "MASTER";
        if ($authUser == true) {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $this->data['content'] = $this->load->view('addPotongan', $this->data, true);
            $this->load->view("UserTemplate", $this->data);
        }
        else {
            redirect(base_url());
        }
    }
    public function savePotongan()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        if ($authUser == true) {
            $datapost = $this->input->post();
            $datapost['dt']['status'] = 'ENABLE';
            $datapost['dt']['created_at'] = date("Y-m-d H:i:s");
            $this->db->insert('tb_potongan', $datapost['dt']);
            $data_session = array(
                'status' => 'success',
                'message' => "Potongan Berhasil Disimpan",
            );
            $this->session->set_userdata($data_session);
            redirect(base_url()."master/potongan");
        }
        else {
            redirect(base_url());
        }
    }
    public function deletePotongan($idpotongan='')
    {
        $this->db->update('tb_potongan', ['status' => 'DISABLE'], ['id' => $idpotongan]);
        $data_session = array(
            'status' => 'success',
            'message' => "Potongan Berhasil Dihapus",
        );
        $this->session->set_userdata($data_session);
        redirect(base_url()."master/memo");
    }
    public function detailPotongan($idpotongan='')
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        if ($authUser == true) {
            $this->db->where('id', $idpotongan);
            $this->data['potongan'] = $this->db->get('tb_potongan')->row();
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $this->data['content'] = $this->load->view('editPotongan', $this->data, true);
            $this->load->view("UserTemplate", $this->data);
        }
        else {
            redirect(base_url());
        }
    }
    public function saveUpdatePotongan()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        if ($authUser == true) {
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
            redirect(base_url()."master/potongan");
        }
        else {
            redirect(base_url());
        }
    }
    public function cabang()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        $this->data["title"] = "MASTER";
        if ($authUser == true) {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $this->data['content'] = $this->load->view('Cabang', $this->data, true);
            $this->load->view("UserTemplate", $this->data);
        }
        else {
            redirect(base_url());
        }
    }
    public function addCabang()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        $this->data["title"] = "MASTER";
        if ($authUser == true) {
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $this->data['content'] = $this->load->view('addCabang', $this->data, true);
            $this->load->view("UserTemplate", $this->data);
        }
        else {
            redirect(base_url());
        }
    }
    public function saveCabang()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        if ($authUser == true) {
            $datapost = $this->input->post();
            $datapost['dt']['status'] = 'ENABLE';
            $datapost['dt']['created_at'] = date("Y-m-d H:i:s");
            // print_r($datapost['dt']);
            $this->db->insert('tb_cabang', $datapost['dt']);
            $data_session = array(
                'status' => 'success',
                'message' => "Cabang Berhasil Disimpan",
            );
            $this->session->set_userdata($data_session);
            redirect(base_url()."master/cabang");
        }
        else {
            redirect(base_url());
        }
    }
    public function deleteCabang($idcabang='')
    {
        $this->db->update('tb_cabang', ['status' => 'DISABLE'], ['id' => $idcabang]);
        $data_session = array(
            'status' => 'success',
            'message' => "Cabang Berhasil Dihapus",
        );
        $this->session->set_userdata($data_session);
        redirect(base_url()."master/memo");
    }
    public function detailCabang($idcabang='')
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        if ($authUser == true) {
            $this->db->where('id', $idcabang);
            $this->data['cabang'] = $this->db->get('tb_cabang')->row();
            $this->data['userData'] = $this->UserModel->userDataById($idUser)->result();
            $this->data['content'] = $this->load->view('editCabang', $this->data, true);
            $this->load->view("UserTemplate", $this->data);
        }
        else {
            redirect(base_url());
        }
    }
    public function saveUpdateCabang()
    {
        $authUser = $this->session->userdata("authUser");
        $idUser = $this->session->userdata("idUser");
        if ($authUser == true) {
            $datapost = $this->input->post();
            $datapost['dt']['status'] = 'ENABLE';
            $datapost['dt']['updated_at'] = date("Y-m-d H:i:s");
            $this->db->where('id', $datapost['id']);
            $this->db->update('tb_cabang', $datapost['dt']);
            $data_session = array(
                'status' => 'success',
                'message' => "Cabang Berhasil Disimpan",
            );
            $this->session->set_userdata($data_session);
            redirect(base_url()."master/cabang");
        }
        else {
            redirect(base_url());
        }
    }
}
?>
