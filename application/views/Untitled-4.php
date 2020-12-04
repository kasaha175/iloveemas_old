<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Biro_admin_bem extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library("PHPExcel");
	//	$this->load->model("phpexcel_model");
	}
	function index(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=base_url()."biro-admin-bem";
		if($autnadmin==true){
			$home=$home=base_url().'biro-admin-bem/dashboard/';
			redirect($home);
		}else{
		$data_session = array(
		'menuDashboard' => true,
		'menuTambahDataSkk' => false,
		'menuDataSkkProbinmaba' => false,
		'menuDataSkkKegiatan' => false,
		'menuDataSkkLainlain' => false,
		'menuDataDetailKelulusan' => false
		);
		$this->session->set_userdata($data_session);
        $this->load->view('admin/v_index');
		}
	}
	function dashboard(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
		$data_session = array(
		'menuDashboard' => true,
		'menuTambahDataSkk' => false,
		'menuDataSkkProbinmaba' => false,
		'menuDataSkkKegiatan' => false,
		'menuDataSkkLainlain' => false,
		'menuDataDetailKelulusan' => false
		);
		$this->session->set_userdata($data_session);
		$this->load->model('M_skk_fk');
		 $data['total_mahasiswa'] = count($this->M_skk_fk->data_mahasiswa()->result());	
		 $data['total_probinmaba'] = count($this->M_skk_fk->data_probinmabaa()->result());	
		 
		 $data['total_organisasi'] = count($this->M_skk_fk->data_skk('organisasi')->result());		
		 $data['total_penalaran'] = count($this->M_skk_fk->data_skk('penalaran')->result());	
		$data['total_penmas'] = count($this->M_skk_fk->data_skk('penmas')->result());	
		$data['total_lain_lain'] = count($this->M_skk_fk->data_skk('lain-lain')->result());
		$data['total_lulus'] = count($this->M_skk_fk->data_mahasiswaa('LULUS')->result());
		$data['total_tidak_lulus'] = count($this->M_skk_fk->data_mahasiswaa('TIDAK LULUS')->result());
		$data['total_belum_login'] = count($this->M_skk_fk->data_mahasiswaa('0')->result());
		$data['total_login'] = count($this->M_skk_fk->data_visitor()->result());
		date_default_timezone_set('Asia/Jakarta');
		$today = date("Y-m-d");
		$data['total_login_today'] = count($this->M_skk_fk->data_visitor_today($today)->result());	
		$data['total_viewer'] = count($this->M_skk_fk->data_viewer()->result());
		date_default_timezone_set('Asia/Jakarta');
		$today = date("Y-m-d");
		$data['total_viewer_today'] = count($this->M_skk_fk->data_viewer_today($today)->result());			
		 $this->load->view('admin/v_dashboard',$data);

		}
	}
	function skk_probinmaba(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
		$data_session = array(
		'menuDashboard' => false,
		'menuTambahDataSkk' => false,
		'menuDataSkkProbinmaba' => true,
		'menuDataSkkKegiatan' => false,
		'menuDataSkkLainlain' => false,
		'menuDataDetailKelulusan' => false
		);
		$this->session->set_userdata($data_session);	
		 $this->load->model('M_skk_fk');
		 $data['data_probinmaba_admin'] = $this->M_skk_fk->data_probinmaba_admin()->result();
		 $this->load->view('admin/v_skk_probinmaba',$data);

		}
	}
	function filter_probinmaba(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
		$jurusan = $this->input->post('jurusan'); 
		$angkatan = $this->input->post('angkatan'); 
		$data_session = array(
			'autn' => false,
			'probinmaba_angkatan' => $angkatan,
			'probinmaba_jurusan' => $jurusan,
			);
			$this->session->set_userdata($data_session);
		redirect($home."/skk-probinmaba/");

		}
	}
	function reset_probinmaba(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
		$jurusan = $this->input->post('jurusan'); 
		$angkatan = $this->input->post('angkatan'); 
		$data_session = array(
			'autn' => false,
			'probinmaba_angkatan' => '2015',
			'probinmaba_jurusan' => 'PSIK',
			);
			$this->session->set_userdata($data_session);
		redirect($home."/skk-probinmaba/");

		}
	}
	
	function update_skk_probinmaba(){
        $id=$this->input->post('id'); 
        $text = $this->input->post('text'); 
		$column_name = $this->input->post('column_name');  
		if($column_name=='dor_issue' || $column_name=='dor_further_action'){
		 $text = str_replace("\n","</br>","$text");
		 		}
				 $this->load->model('M_skk_fk');
		$data=$this->M_skk_fk->update_skk_probinmaba($id,$text,$column_name);
        
		echo 'Data Updated';  
    }
	

	function skk_kegiatan(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
		$data_session = array(
		'menuDashboard' => false,
		'menuTambahDataSkk' => false,
		'menuDataSkkProbinmaba' => false,
		'menuDataSkkKegiatan' => true,
		'menuDataSkkLainlain' => false,
		'menuDataDetailKelulusan' => false
		);
		$this->session->set_userdata($data_session);		
		 $this->load->model('M_skk_fk');
		 $data['data_kegiatan_admin'] = $this->M_skk_fk->data_kegiatan_admin()->result();
		 $this->load->view('admin/v_skk_kegiatan',$data);

		}
	}
	
	function update_skk_kegiatan(){
        $id=$this->input->post('id'); 
        $text = $this->input->post('text'); 
		$column_name = $this->input->post('column_name');  
		if($column_name=='dor_issue' || $column_name=='dor_further_action'){
		 $text = str_replace("\n","</br>","$text");
		 		}
		$this->load->model('M_skk_fk');
		$data=$this->M_skk_fk->update_skk_kegiatan($id,$text,$column_name);
        
		echo 'Data Updated';  
    }
	function filter_kegiatan(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
		echo $jurusan = $this->input->post('jurusan'); 
		echo $angkatan = $this->input->post('angkatan'); 
		echo $jenis = $this->input->post('jenis'); 
		$data_session = array(
			'autn' => false,
			'kegiatan_angkatan' => $angkatan,
			'kegiatan_jurusan' => $jurusan,
			'kegiatan_jenis' => $jenis,
			
			);
			$this->session->set_userdata($data_session);
		redirect($home."/skk-kegiatan/");

		}
	}
	function reset_kegiatan(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
		$jurusan = $this->input->post('jurusan'); 
		$angkatan = $this->input->post('angkatan'); 
		$data_session = array(
			'autn' => false,
			'kegiatan_angkatan' => '2015',
			'kegiatan_jurusan' => 'PSIK',
			'kegiatan_jenis' => 'SEMUA JENIS',
			);
			$this->session->set_userdata($data_session);
		redirect($home."/skk-kegiatan/");

		}
	}
		
	function data_detail_kelulusan(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
			$data_session = array(
		'menuDashboard' => false,
		'menuTambahDataSkk' => false,
		'menuDataSkkProbinmaba' => false,
		'menuDataSkkKegiatan' => false,
		'menuDataSkkLainlain' => false,
		'menuDataDetailKelulusan' => true
		);
		$this->session->set_userdata($data_session);
		 $this->load->model('M_skk_fk');
		 $data['data_mahasiswa'] = $this->M_skk_fk->data_mahasiswa()->result();
		 $this->load->view('admin/v_detail_kelulusan',$data);

		}
	}
	
	function skk_lain_lain(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
		$data_session = array(
		'menuDashboard' => false,
		'menuTambahDataSkk' => false,
		'menuDataSkkProbinmaba' => false,
		'menuDataSkkKegiatan' => false,
		'menuDataSkkLainlain' => true,
		'menuDataDetailKelulusan' => false
		);
		$this->session->set_userdata($data_session);		
		 $this->load->model('M_skk_fk');
		 $data['data_lain_lain_admin'] = $this->M_skk_fk->data_lain_lain_admin()->result();
		 $this->load->view('admin/v_skk_lain_lain',$data);

		}
	}
	function filter_lain_lain(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
		echo $jurusan = $this->input->post('jurusan'); 
		echo $angkatan = $this->input->post('angkatan'); 
		$data_session = array(
			'autn' => false,
			'lain_lain_angkatan' => $angkatan,
			'lain_lain_jurusan' => $jurusan,
			
			);
			$this->session->set_userdata($data_session);
		redirect($home."/skk-lain-lain/");

		}
	}
	function reset_lain_lain(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
		$jurusan = $this->input->post('jurusan'); 
		$angkatan = $this->input->post('angkatan'); 
		$data_session = array(
			'autn' => false,
			'lain_lain_angkatan' => '2015',
			'lain_lain_jurusan' => 'PSIK',
			);
			$this->session->set_userdata($data_session);
		redirect($home."/skk-lain-lain/");

		}
	}
	function hapus_kegiatan_minat(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{

		   $id =  $nim = $this->uri->segment(3);
		   $jenis =  $nim = $this->uri->segment(4);

		 $this->load->model('M_skk_fk');

		 $this->M_skk_fk->hapus_skk($id);

			if($jenis=="kegiatan"){
				redirect(base_url()."biro-admin-bem/skk-kegiatan/");
			}else if($jenis=="lain-lain"){
				redirect(base_url()."biro-admin-bem/skk-lain-lain/");
			}

		}		
	}
	function hapus_kegiatan_minat_mahasiswa(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{

		   $id = $this->uri->segment(3);
		   $jenis = $this->uri->segment(4);
		   $nim = $this->uri->segment(5);

		 $this->load->model('M_skk_fk');

		 $this->M_skk_fk->hapus_skk($id);

			if($jenis=="ORGANISASI" || $jenis=="PENALARAN" || $jenis=="PENMAS"){
				redirect(base_url()."biro-admin-bem/tambah-skk-kegiatan-form/$nim/");
			}else if($jenis=="LAIN-LAIN"){
				redirect(base_url()."biro-admin-bem//tambah-skk-lain-lain-form/$nim/");
			}

		}		
	}
	//
	

	function edit_skk_probinmaba(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{

		$nim = $this->uri->segment(3);

		$this->load->model('M_skk_fk');

		$data['edit_data_mahasiswa'] = $this->M_skk_fk->edit_data_mahasiswa($nim)->result();

		$this->load->view('admin/v_edit_skk_probinmaba',$data);

		}
	}

	function edit_skk(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{

		$id = $this->uri->segment(3);
		$this->load->model('M_skk_fk');

		$data['edit_skk'] = $this->M_skk_fk->edit_skk($id)->result();

		$this->load->view('admin/v_edit_skk',$data);

		}
	}
	function tambah_data_skk(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
		$data_session = array(
		'menuDashboard' => false,
		'menuTambahDataSkk' => true,
		'menuDataSkkProbinmaba' => false,
		'menuDataSkkKegiatan' => false,
		'menuDataSkkLainlain' => false,
		'menuDataDetailKelulusan' => false
		);
		$this->session->set_userdata($data_session);
		$this->load->model('M_skk_fk');
		$data['data_mahasiswa'] = $this->M_skk_fk->data_mahasiswa()->result();

		$this->load->view('admin/v_tambah_data_skk',$data);

		}
	}

	
	function tambah_data_skk_form(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{

		$nim = $this->uri->segment(3);
		$this->load->model('M_skk_fk');
		$data['detail_mahasiswa'] = $this->M_skk_fk->detail_mahasiswa($nim)->result();
		$data['data_skk_mahasiswa'] = $this->M_skk_fk->data_skk_mahasiswa($nim)->result();
		$this->load->view('admin/v_tambah_data_skk_form',$data);

		}
	}
	function tambah_data_skk_form_query(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
		$this->load->view('admin/v_tambah_data_skk_form_query');
		}
	}

	function simpan_skk_probinmaba(){	

		 $autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{

		  $nim = $this->input->post('nim');	
		  $pk2maba = $this->input->post('pk2maba');	
		  $bkm = $this->input->post('bkm');	
		  $pkmmaba = $this->input->post('pkmmaba');	
		  $penmas = $this->input->post('penmas');

		 $this->load->model('M_skk_fk');
		 $this->M_skk_fk->simpan_data_mahasiswa($nim,$pk2maba,$bkm,$pkmmaba,$penmas);
		 redirect(base_url()."biro-admin-bem/skk-probinmaba/");

		}		
	}
	function simpan_data_skk_query(){	

		 $autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{

		 $sintaks = $this->input->post('sintaks');
		 if(!empty($sintaks)){
		 $this->load->model('M_skk_fk');
		 if($this->M_skk_fk->simpan_data_skk_query($sintaks)){
			$data_session = array(
				'query' => 'berhasil'
			);
			$this->session->set_userdata($data_session);
		 }else{
			$data_session = array(
				'query' => 'gagal'
			);
			$this->session->set_userdata($data_session);
		 }}
		 
		 redirect(base_url()."biro-admin-bem/tambah_data_skk_form_query/");

		}		
	}

	function hapus_skk(){	

		 $autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{

		   $id =  $nim = $this->uri->segment(3);
		  $jenis =  $nim = $this->uri->segment(4);

		 $this->load->model('M_skk_fk');

		 $this->M_skk_fk->hapus_skk($id);

			if($jenis=="kegiatan"){
				redirect(base_url()."biro-admin-bem/skk-kegiatan/");
			}else if($jenis=="lain-lain"){
				redirect(base_url()."biro-admin-bem/skk-lain-lain/");
			}

		}		
	}
	function simpan_data_skk(){	

		 $autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
			 $nim = $this->input->post('nim');	
			$jenis = strtoupper($this->input->post('jenis'));	
			$jabatan = $this->input->post('jabatan');	
			 $jabatan = str_replace("'","",$jabatan);		
			$nama_kegiatan = $this->input->post('nama_kegiatan');
			 $nama_kegiatan = str_replace("'","",$nama_kegiatan);			
			$nilai = $this->input->post('nilai');
			 $nilai = str_replace(",",".",$nilai);
			$this->load->model('M_skk_fk');
			$this->M_skk_fk->simpan_skk($nim,$jabatan,$nilai,$nama_kegiatan,$jenis);

			redirect(base_url()."biro-admin-bem/tambah-data-skk-form/$nim/");
			
		}

	}
	function tambah_skk_simpan(){	

		 $autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
	        $nim = $this->input->post('nim');	
		     $jenis = strtolower($this->input->post('jenis'));	
		     $jabatan = $this->input->post('jabatan');	
			 $jabatan = str_replace("'","",$jabatan);		
		    $nama_kegiatan = $this->input->post('nama_kegiatan');
			$nama_kegiatan = str_replace("'","",$nama_kegiatan);			
		    $nilai = $this->input->post('nilai');
			$nilai = str_replace(",",".",$nilai);
		 $this->load->model('M_skk_fk');
		 $this->M_skk_fk->tambah_skk_simpan($nim,$jabatan,$nilai,$nama_kegiatan,$jenis);

		if($jenis=='lain-lain'){
			redirect(base_url()."biro-admin-bem/skk-lain-lain/");
		}else{
			redirect(base_url()."biro-admin-bem/skk-kegiatan/");
		}

			}		
	}
	function download_data(){
	$this->load->model('M_skk_fk');
	$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
		 echo $kode =  $nim = $this->uri->segment(3);

		if(!empty($kode)){
			if($kode=='pspd-2014'){

		$ambildata = $this->M_skk_fk->export_kontak();

            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()
                  ->setCreator("Aang Muammar Zein") //creator
                  ->setTitle("CEO kitaolahraga.com");  //file title
            $objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
            $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object

            $objget->setTitle('Sample Sheet'); //sheet title

            $objget->getStyle("A2:O2")->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'green')
                    ),
                    'font' => array(
                        'color' => array('rgb' => '000000')
                    )
                )
            );
			
			//header
			
			$objPHPExcel->getActiveSheet()->mergeCells('A3:A4');
			$objPHPExcel->getActiveSheet()->setCellValue('A3','NO');
            $objPHPExcel->getActiveSheet()->mergeCells('B3:B4');
			$objPHPExcel->getActiveSheet()->setCellValue('B3','NIM');
            $objPHPExcel->getActiveSheet()->mergeCells('C3:C4');
			$objPHPExcel->getActiveSheet()->setCellValue('C3','NAMA');
			$objPHPExcel->getActiveSheet()->mergeCells('D3:H3');
			$objPHPExcel->getActiveSheet()->setCellValue('D3','SKK PROBINMABA');
			$objPHPExcel->getActiveSheet()->mergeCells('I3:L3');
			$objPHPExcel->getActiveSheet()->setCellValue('I3','SKK KEGIATAN');
			
            $objPHPExcel->getActiveSheet()->mergeCells('M3:M4');
			$objPHPExcel->getActiveSheet()->setCellValue('M3','SKK MINAT BAKAT');
			
            $objPHPExcel->getActiveSheet()->mergeCells('N3:N4');
			$objPHPExcel->getActiveSheet()->setCellValue('N3','TOTAL');
			
            $objPHPExcel->getActiveSheet()->mergeCells('O3:O4');
			$objPHPExcel->getActiveSheet()->setCellValue('O3','KELULUSAN AKHIR');
			
			$objPHPExcel->getActiveSheet()->mergeCells('A1:O1');
			// add some text
			$objPHPExcel->getActiveSheet()->setCellValue('A1','HASIL KELULUSAN SKK');
            
			//table header
            $cols = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O");

            $val = array("NO ","NIM","NAMA","PK2MABA","BKM","PKMMABA","PENMAS","KELULUSAN","ORGANISASI & KELEMBAGAAN","PENALARAN","PENGABDIAN MASYARAKAT","KELULUSAN","SKK MINAT BAKAT","TOTAL NILAI","KELULUSAN");

            for ($a=0;$a<15; $a++) 
            {
                $objset->setCellValue($cols[$a].'4', $val[$a]);

                //Setting lebar cell
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
				
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Kontak
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // NAMA
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25); // Kontak
				$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25); // NAMA
                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25); // ALAMAT
				$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25); // ALAMAT
				$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
				$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(25); // ALAMAT
				$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(25);
				$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(25); // ALAMAT
				$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(25);
				$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(25);
				
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
				$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight('-1');

		}
		

			
            $baris  = 5;
			$no=0;
            foreach ($ambildata as $frow){
                 $no++;
                //pemanggilan sesuaikan dengan nama kolom tabel
                $objset->setCellValue("A".$baris, $no); //membaca data nama
                $objset->setCellValue("B".$baris, $frow->nim); //membaca data alamat
                $objset->setCellValue("C".$baris, $frow->nama); //membaca data kontak
                $objset->setCellValue("D".$baris, $frow->pk2maba);
				$objset->setCellValue("E".$baris, $frow->bkm);
				$objset->setCellValue("F".$baris, $frow->pkmmaba);
				$objset->setCellValue("G".$baris, $frow->penmas);
				$status='TIDAK LULUS';
				if($frow->pk2maba=='LULUS'&&$frow->bkm=='LULUS'&&$frow->pkmmaba=='LULUS'&&$frow->penmas=='LULUS'){
				$status='LULUS';
				}
				$objset->setCellValue("H".$baris, $status);
				$objset->setCellValue("I".$baris, $frow->n_organisasi);
				$objset->setCellValue("J".$baris, $frow->n_penalaran);
				$objset->setCellValue("K".$baris, $frow->n_penmas);
				$status='TIDAK LULUS';
				if($frow->n_organisasi>0 && $frow->n_penalaran>0 && $frow->n_penmas>0){
				$status='LULUS';
				}
				$objset->setCellValue("L".$baris, $frow->status);
				$objset->setCellValue("M".$baris, $frow->lain);
				$objset->setCellValue("N".$baris, $frow->nilai);
				$objset->setCellValue("O".$baris, $frow->status);
                //Set number value
                $objPHPExcel->getActiveSheet()->getStyle('C1:C'.$baris)->getNumberFormat()->setFormatCode('0');

                $baris++;
            }

            $objPHPExcel->getActiveSheet()->setTitle('Data Export');

            $objPHPExcel->setActiveSheetIndex(0);  
            $filename = urlencode("PSPD 2014 - ".date("Y-m-d H:i:s").".xls");

              header('Content-Type: application/vnd.ms-excel'); //mime type
              header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
              header('Cache-Control: max-age=0'); //no cache

            $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');                
			ob_end_clean();           
		    $objWriter->save('php://output');

			}else{
				//redirect($home);
			}
		}else{
			$this->load->model('M_skk_fk');
			$this->load->view('admin/v_download');
		}
		}
	}
	//stop

	function data_skk_kegiatan_organisasi(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
		 $this->load->model('M_skk_fk');
		 $data['data_kegiatan_organisasi_admin'] = $this->M_skk_fk->data_kegiatan_organisasi_admin()->result();
		 $this->load->view('v_skk_kegiatan_organisasi_admin',$data);

		}
	}
	function data_skk_kegiatan_penmas(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
		 $this->load->model('M_skk_fk');
		 $data['data_kegiatan_penmas_admin'] = $this->M_skk_fk->data_kegiatan_penmas_admin()->result();
		 $this->load->view('v_skk_kegiatan_penmas_admin',$data);

		}
	}
	function data_skk_kegiatan_penalaran(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
		 $this->load->model('M_skk_fk');
		 $data['data_kegiatan_penalaran_admin'] = $this->M_skk_fk->data_kegiatan_penalaran_admin()->result();
		 $this->load->view('v_skk_kegiatan_penalaran_admin',$data);

		}
	}

	function edit_probinmaba(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{

		 $nim = $this->uri->segment(3);
		 $this->load->model('M_skk_fk');
		 $data['data_probinmaba_admin_edit'] = $this->M_skk_fk->data_probinmaba_admin_edit($nim)->result();
		 $this->load->view('v_skk_probinmaba_admin_edit',$data);

		}
	}

	function data_skk_kegiatan_tambah(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
		 $this->load->model('M_skk_fk');
		 $data['data_mahasiswa'] = $this->M_skk_fk->data_mahasiswa()->result();
		 $this->load->view('v_skk_kegiatan_admin_tambah',$data);

		}
	}
	function data_skk_minat_bakat_tambah(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
		 $this->load->model('M_skk_fk');
		 $data['data_mahasiswa'] = $this->M_skk_fk->data_mahasiswa()->result();
		 $this->load->view('v_skk_minat_admin_tambah',$data);

		}
	}

	function data_skk_minat_bakat(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
		 $this->load->model('M_skk_fk');
		 $data['data_minat_bakat_admin'] = $this->M_skk_fk->data_minat_bakat_admin()->result();
		 $this->load->view('v_skk_minat_bakat_admin',$data);

		}
	}

	function tambah_kegiatan(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{

		 $nim = $this->uri->segment(3);
		 $this->load->model('M_skk_fk');
		 $data['data_probinmaba_admin_tambah'] = $this->M_skk_fk->data_probinmaba_admin_tambah($nim)->result();
		 $this->load->view('v_skk_kegiatan_admin_tambah_form',$data);

		}
	}

	function tambah_minat_bakat(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{

		 $nim = $this->uri->segment(3);
		 $this->load->model('M_skk_fk');
		 $data['data_minat_admin_tambah'] = $this->M_skk_fk->data_minat_admin_tambah($nim)->result();
		 $this->load->view('v_skk_minat_admin_tambah_form',$data);

		}
	}

	function edit_kegiatan(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{

		$id = $this->uri->segment(3);
		$jenis = $this->uri->segment(4);
		$this->load->model('M_skk_fk');

		 $data['data_kegiatan_admin_edit'] = $this->M_skk_fk->data_kegiatan_admin_edit($id,$jenis)->result();
		 $this->load->view('v_skk_kegiatan_admin_edit',$data);

		}
	}
	function edit_minat(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{

		$id = $this->uri->segment(3);
		$jenis = $this->uri->segment(4);
		$this->load->model('M_skk_fk');

		 $data['data_kegiatan_admin_edit'] = $this->M_skk_fk->data_kegiatan_admin_edit($id,$jenis)->result();
		 $this->load->view('v_skk_minat_admin_edit',$data);

		}
	}

	function simpan_probin(){	

		 $autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{

		 $nim = $this->input->post('nim');	
		 $pk2maba = $this->input->post('pk2maba');	
		 $bkm = $this->input->post('bkm');	
		 $pkmmaba = $this->input->post('pkmmaba');	
		 $penmas = $this->input->post('penmas');

		 $this->load->model('M_skk_fk');
		 $this->M_skk_fk->data_probinmaba_admin_simpan($nim,$pk2maba,$bkm,$pkmmaba,$penmas);
		 $this->data_skk_probinmaba();

		}		
	}

	function simpan_edit_kegiatan(){	

		 $autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
	       $id = $this->input->post('id');	
		  $jenis = $this->input->post('jenis');	
		  $jabatan = $this->input->post('jabatan');	
		  $nama_kegiatan = $this->input->post('nama_kegiatan');	
		  $nilai = $this->input->post('nilai');

		 $this->load->model('M_skk_fk');
		  $this->M_skk_fk->simpan_edit_kegiatan($id,$jabatan,$nilai,$nama_kegiatan,$jenis);
		 if($jenis=="organisasi"){
			 redirect(base_url()."biro-admin-bem/data-skk-kegiatan-organisasi");
			}else if($jenis=="penalaran"){
			 redirect(base_url()."biro-admin-bem/data-skk-kegiatan-penalaran");
			}else if($jenis=="penmas"){
				redirect(base_url()."biro-admin-bem/data-skk-kegiatan-penmas");
			}else{
				redirect(base_url()."biro-admin-bem/data-skk-minat-bakat");
			}

		}		
	}

		function simpan_kegiatan(){	

		 $autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{

		  $nim = $this->input->post('nim');	
		  $jenis = $this->input->post('jenis');	
		  $jabatan = $this->input->post('jabatan');	
		  $nama_kegiatan = $this->input->post('nama_kegiatan');	
		  $nilai = $this->input->post('nilai');

		 $this->load->model('M_skk_fk');

		 $this->M_skk_fk->simpan_kegiatan($nim,$jabatan,$nilai,$nama_kegiatan,$jenis);
		 	if($jenis=="organisasi"){
			 redirect(base_url()."biro-admin-bem/data-skk-kegiatan-organisasi");
			}else if($jenis=="penalaran"){
			 redirect(base_url()."biro-admin-bem/data-skk-kegiatan-penalaran");
			}else if($jenis=="penmas"){
				redirect(base_url()."biro-admin-bem/data-skk-kegiatan-penmas");
			}else{
				redirect(base_url()."biro-admin-bem/data-skk-minat-bakat");
			}

		}		
	}

	function simpan_penmas(){	

		 $autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{

		  $nim = $this->input->post('nim');	
		  $jenis = $this->input->post('jenis');	
		  $jabatan = $this->input->post('jabatan');	
		  $nama_kegiatan = $this->input->post('nama_kegiatan');	
		  $nilai = $this->input->post('nilai');

		 $this->load->model('M_skk_fk');

		 $this->M_skk_fk->simpan_kegiatan($nim,$jabatan,$nilai,$nama_kegiatan,$jenis);
		 	if($jenis=="organisasi"){
			 redirect(base_url()."biro-admin-bem/data-skk-kegiatan-organisasi");
			}else if($jenis=="penalaran"){
			 redirect(base_url()."biro-admin-bem/data-skk-kegiatan-penalaran");
			}else if($jenis=="penmas"){
				redirect(base_url()."biro-admin-bem/data-skk-kegiatan-penmas");
			}else{
				redirect(base_url()."biro-admin-bem/data-skk-minat-bakat");
			}

		}		
	}

	function hapus_kegiatan(){	

		 $autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{

		  $id =  $nim = $this->uri->segment(3);
		  $jenis =  $nim = $this->uri->segment(4);

		 $this->load->model('M_skk_fk');

		 $this->M_skk_fk->hapus_kegiatan($id);
			if($jenis=="organisasi"){
			 redirect(base_url()."biro-admin-bem/data-skk-kegiatan-organisasi");
			}else if($jenis=="penalaran"){
			 redirect(base_url()."biro-admin-bem/data-skk-kegiatan-penalaran");
			}else if($jenis=="penmas"){
				redirect(base_url()."biro-admin-bem/data-skk-kegiatan-penmas");
			}else{
				redirect(base_url()."biro-admin-bem/data-skk-minat-bakat");
			}
		}		
	}

	function test_excel(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
		 $this->load->model('M_skk_fk');
		 $data['data_test'] = $this->M_skk_fk->data_test()->result();
		 $this->load->view('admin/v_test_excel',$data);

		}
	}
	function upload_excel_proses(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
			$config['upload_path'] = './assets/uploads/';
			$config['allowed_types'] = 'xlsx|xls';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload()){
				$error = array('error' => $this->upload->display_errors());
			}
			else{
				$this->load->model('M_skk_fk');
				$data = array('upload_data' => $this->upload->data());
				$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
				$filename = $upload_data['file_name'];
				$this->M_skk_fk->upload_data_final($filename);
				unlink('./assets/uploads/'.$filename);
			}
			$data['data_test'] = $this->M_skk_fk->data_test()->result();
			redirect($home);
		}
	}

	function test_excel_proses(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
			$config['upload_path'] = './assets/uploads/';
			$config['allowed_types'] = 'xlsx|xls';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload()){
				$error = array('error' => $this->upload->display_errors());
			}
			else{
				$this->load->model('M_skk_fk');
				$data = array('upload_data' => $this->upload->data());
				$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
				$filename = $upload_data['file_name'];
				$this->M_skk_fk->upload_data_test($filename);
				//unlink('./assets/uploads/'.$filename);
			}
			$data['data_test'] = $this->M_skk_fk->data_test()->result();
			redirect($home."test-excel/");

		}
	}
	function hapus_data_test(){
		$autnadmin=$this->session->userdata("autnadmin");
		$home=$home=base_url().'biro-admin-bem/';
		if($autnadmin==false){
				redirect($home);
		}else{
		 $this->load->model('M_skk_fk');
		 $this->M_skk_fk->hapus_data_test();
		 redirect($home."test-excel/");
		}		
	}

	
}
?>
