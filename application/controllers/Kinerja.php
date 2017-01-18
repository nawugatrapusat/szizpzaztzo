<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kinerja extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
                date_default_timezone_set('Asia/Jakarta');
                $this->load->model('m_log', '', TRUE);
                $this->load->model('m_penjualan', '', TRUE);
                $this->load->model('m_client', '', TRUE);
                $this->load->model('m_product', '', TRUE);
                $this->load->model('m_employee', '', TRUE);
                $this->load->model('m_bank', '', TRUE);
	}
    
	function index()
	{
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            
            $typeForm=$this->uri->segment(3);
            $id=$this->uri->segment(4);
            $employee=$this->m_employee->empGetAll();
            $data=array(
                'employee'=>$employee
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js',),'css'=>array('jquery-ui-1.8.22.custom','style'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('kinerja/v_kinerja.php',$data);
            $this->load->view('template/footer.php');  
	}
        
//-------------------------------------------------------------------------------------------------------------------------------------------------------        
        
        function employee(){
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            
            $bulan=$this->input->post('bulan');
            $tahun=$this->input->post('tahun');
            $id=$this->input->post('employee');
            
            $client=$this->m_client->clientGetAll();
            $product=$this->m_product->productGetAll();
            $penjualanById=$this->m_penjualan->penjualanGetById($id);
            $penjualanDetail=$this->m_penjualan->penjualanGetDetail($id);
            $employee=$this->m_employee->empGetAll();
            $employeeDetail=$this->m_employee->empGetById($id);
            
            $data=array(
                'client'=>$client,
                'product'=>$product,
                'penjualanById'=>$penjualanById,
                'penjualanDetail'=>$penjualanDetail,
                'employee'=>$employee,
                'employeeDetail'=>$employeeDetail,
                'tahun'=>$tahun,
                'bulan'=>$bulan,
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js'),'css'=>array('jquery-ui-1.8.22.custom','style'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('kinerja/v_kinerja.php',$data);
            $this->load->view('template/footer.php');  
        }
        
        function penjualanFormSave(){
            if($this->input->post()){
                if($this->input->post('id') == ''){
                    if($this->m_penjualan->penjualanAddSave(array_map('strtolower', $this->input->post())) != false){
                        $this->input->set_cookie('successNotif','Sukses Tambah Data',time()+6000);
//                        echo 1;
                    }else{
                        $this->input->set_cookie('failedNotif','Tambah Data Gagal !!!',time()+6000);
                    }
                }else{
                    if($this->m_penjualan->penjualanEditSave(array_map('strtolower', $this->input->post())) != false){
                        $this->input->set_cookie('successNotif','Sukses Edit Data',time()+6000);
                    }else{
                        $this->input->set_cookie('failedNotif','Edit Data Gagal !!!',time()+6000);
                    }
                }
                redirect('penjualan');
            }else{
                redirect('login');
            }
        }
        
        function penjualanDelete(){
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            
            $data=$this->uri->segment(3);
            
            if($this->m_penjualan->penjualanDelete($data) != false){
                $this->input->set_cookie('successNotif','Sukses Hapus Data',time()+6000);
            }else{
                $this->input->set_cookie('failedNotif','Hapus Data Gagal !!!',time()+6000);
            }
            redirect(site_url('penjualan'));
        }
        
        function TFAUForm(){
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            
            $typeForm=$this->uri->segment(3);
            $id=$this->uri->segment(4);
            $client=$this->m_client->clientGetAll();
            $product=$this->m_product->productGetAll();
            $penjualanById=$this->m_penjualan->penjualanGetById($id);
            $penjualanDetail=$this->m_penjualan->penjualanGetDetail($id);
            $employee=$this->m_employee->empGetAll();
            $bank=$this->m_bank->bankGetAll();
            if($typeForm == 0){
                $addEdit=$this->m_penjualan->tukarFakturGetByIdPenjualan($penjualanById->id);
            }else{
                $addEdit=$this->m_penjualan->ambilUangGetByIdPenjualan($penjualanById->id);
            }
//            if($addEdit == 'add'){
//                $dataForm=new stdClass();
//                $dataForm->idEmployeePic='';
//                $dataForm->keterangan='';
//                $dataForm->id='';
//            }else{
//                $dataForm=new stdClass();
//                $dataForm->idEmployeePic=$addEdit->idEmployeePic;
//                $dataForm->keterangan=$addEdit->keterangan;
//                $dataForm->id=$addEdit->id;
//            }
            $data=array(
                'client'=>$client,
                'typeForm'=>$typeForm,
                'product'=>$product,
                'penjualanById'=>$penjualanById,
                'penjualanDetail'=>$penjualanDetail,
                'addEdit'=>$addEdit,
//                'dataForm'=>$dataForm,
                'employee'=>$employee,
                'bank'=>$bank,
                
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js'),'css'=>array('jquery-ui-1.8.22.custom','style'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('penjualan/v_TFAUForm.php',$data);
            $this->load->view('template/footer.php');  
        }
        
        function TFAUFormSave(){
            if($this->input->post()){
                if($this->input->post('typeForm') == 'tukarFaktur'){
                    if($this->input->post('addEdit') == 'add'){
                        if($this->m_penjualan->TFAUAddSave(array_map('strtolower', $this->input->post())) != false){
                            $this->input->set_cookie('successNotif','Sukses Tambah Data',time()+6000);
                        }else{
                            $this->input->set_cookie('failedNotif','Tambah Data Gagal !!!',time()+6000);
                        }
                    }else{
                        if($this->m_penjualan->TFAUEditSave(array_map('strtolower', $this->input->post())) != false){
                            $this->input->set_cookie('successNotif','Sukses Edit Data',time()+6000);
                        }else{
                            $this->input->set_cookie('failedNotif','Edit Data Gagal !!!',time()+6000);
                        }
                    }
                }else{
                    if($this->input->post('addEdit') == 'add'){
                        if($this->m_penjualan->TFAUAddSave(array_map('strtolower', $this->input->post())) != false){
                            $this->input->set_cookie('successNotif','Sukses Tambah Data',time()+6000);
                        }else{
                            $this->input->set_cookie('failedNotif','Tambah Data Gagal !!!',time()+6000);
                        }
                    }else{
                        if($this->m_penjualan->TFAUEditSave(array_map('strtolower', $this->input->post())) != false){
                            $this->input->set_cookie('successNotif','Sukses Edit Data',time()+6000);
                        }else{
                            $this->input->set_cookie('failedNotif','Edit Data Gagal !!!',time()+6000);
                        }
                    }
                }
                redirect('penjualan');
            }else{
                redirect('login');
            }
        }
        
//-------------------------------------------------------------------------------------------------------------------------------------------------------        
        
        function penjualanDetail(){
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            
            $id=$this->uri->segment(3);
            $client=$this->m_client->clientGetAll();
            $product=$this->m_product->productGetAll();
            $penjualanById=$this->m_penjualan->penjualanGetById($id);
            $penjualanDetail=$this->m_penjualan->penjualanGetDetail($id);
            $employee=$this->m_employee->empGetAll();
            $TF=$this->m_penjualan->TFGetByIdPenjualan($penjualanById->id);
            $AU=$this->m_penjualan->AUGetByIdPenjualan($penjualanById->id);
            $data=array(
                'client'=>$client,
                'product'=>$product,
                'penjualanById'=>$penjualanById,
                'penjualanDetail'=>$penjualanDetail,
                'employee'=>$employee,
                'TF'=>$TF,
                'AU'=>$AU
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js'),'css'=>array('jquery-ui-1.8.22.custom','style'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('penjualan/v_penjualanDetail.php',$data);
            $this->load->view('template/footer.php');  
        }
        
	function penjualanPrint()
	{
            if($this->session->userdata('id_admin') == '') redirect (site_url());
                        
//            $penjualan=$this->m_penjualan->penjualanGetAll();
//            $data=array(
//                'penjualan'=>$penjualan
//            );
            $id=$this->uri->segment(3);
            $penjualanById=$this->m_penjualan->penjualanGetById($id);
            
            $data=array(
                'id'=>$id,
                'idClient'=>$penjualanById->idClient
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js','flexigrid.pack','cookie'),'css'=>array('jquery-ui-1.8.22.custom','style','flexigrid.pack'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('penjualan/v_penjualanPrint.php',$data);
            $this->load->view('template/footer.php');  
	}
        
        function penjualanPrintTable()
	{
            $idClient=$this->uri->segment(3);
            $page = 1; // The current page
            $sortname = 'noFaktur'; // Sort column
            $sortorder = 'desc'; // Sort order
            $qtype = ''; // Search column
            $query = ''; // Search string
            $rp = 15;
            // Get posted data
            if (isset($_POST['page'])) {
                    $page = $this->input->post('page',true);
            }
            if (isset($_POST['sortname'])) {
                    $sortname = $this->input->post('sortname',true);
            }
            if (isset($_POST['sortorder'])) {
                    $sortorder = $this->input->post('sortorder',true);
            }
            if (isset($_POST['qtype'])) {
                    $qtype = $this->input->post('qtype',true);
            }
            if (isset($_POST['query'])) {
                    $query = $this->input->post('query',true);
            }
            if (isset($_POST['rp'])) {
                    $rp = $this->input->post('rp',true);
            }
            // Setup sort and search SQL using posted data
            $sortSql = "order by $sortname $sortorder";
            $whereSql = ($qtype != '' && $query != '') ? "where $qtype LIKE '%$query%' AND client.id=penjualan.idClient AND penjualan.idClient='$idClient' AND penjualan. AND penjualan.deleted='0' AND client.deleted='0'" : "WHERE  client.id=penjualan.idClient AND penjualan.idClient='$idClient' AND penjualan.deleted='0' AND client.deleted='0'";

            // Setup paging SQL
            $pageStart = ($page-1)*$rp;
            $limitSql = "limit $pageStart, $rp";

            // Create JSON data
            $data = array();
            $data['page'] = $page;
            $data['rows'] = array();
            $select = "client.nama,penjualan.noFaktur,penjualan.noPo,penjualan.date,penjualan.status,penjualan.id";
            $sql = "SELECT $select FROM penjualan,client $whereSql $sortSql $limitSql";
            $sqlcount = "SELECT $select FROM penjualan,client $whereSql $sortSql";
//            echo $sql;
            // Get total count of records
            $total = $this->m_penjualan->get_count_query($sqlcount);
            $data['total'] = $total;

            $results = $this->m_penjualan->get_query($sql);

            if($results != false){
                foreach($results as $row){
                    if($row->status != 'ambil uang' && $row->status != 'manual close' ){
                        $data['rows'][] = array(
                        'id' => $row->id,
                        'cell' => array($row->noFaktur,$row->noPo,  ucwords($row->nama),unix_to_human($row->date),ucwords($row->status))
                        );
                    }
                }        
            }

            echo json_encode($data);  
        }
}
