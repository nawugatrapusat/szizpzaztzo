<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

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
    
        public function sessVerif()
        {
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            if($this->session->userdata('id_admin') != '1') redirect (site_url());
        }
    
	function index()
	{
            if($this->session->userdata('id_admin') == '') redirect (site_url());
                        
//            $penjualan=$this->m_penjualan->penjualanGetAll();
//            $data=array(
//                'penjualan'=>$penjualan
//            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js','flexigrid.pack','cookie'),'css'=>array('jquery-ui-1.8.22.custom','style','flexigrid.pack'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('penjualan/v_penjualan.php');
            $this->load->view('template/footer.php');  
	}
        
        function cekHarga(){
            if($_POST){
                $data=new stdClass();
                
                $idProduct=  $this->input->post('idProduct');
                $idClient=  $this->input->post('idClient');
                $cetak='';
                $c=0;

                $client=$this->m_client->clientGetById($idClient);
                $clientPrice=$this->m_client->clientPriceGetByIdClient($client->id);
                $product=$this->m_product->productGetById($idProduct);

                if ($clientPrice != '') {
                    foreach ($clientPrice as $hasil) {
                        if(($hasil->idProduct != '' && $hasil->hargaJualDiskon != '') && ($hasil->idProduct == $idProduct)){
                            $data->cetakHargaJual='Rp. '.number_format($hasil->hargaJualDiskon,0,',','.');
                            $data->hargaJual=$hasil->hargaJual;
                            $data->hargaJualDiskon=$hasil->hargaJualDiskon;
                            $data->perhitungan=$hasil->perhitungan;
                            $data->cetakHargaEmployee=$hasil->hargaEmployee == '' ? '' : 'Rp. '.number_format($hasil->hargaEmployee,0,',','.');
                            $data->hargaEmployee=$hasil->hargaEmployee;
                            $c++;
                        }
                    }    
                }
                if($c == 0){
                    $data->cetakHargaJual='Rp. '.number_format($product->hargaJualDiskon,0,',','.');
                    $data->hargaJual=$product->hargaJual;
                    $data->hargaJualDiskon=$product->hargaJualDiskon;
                    $data->perhitungan='default';
                    $data->cetakHargaEmployee=$product->hargaEmployee == '' ? '' : 'Rp. '.number_format($product->hargaEmployee,0,',','.');
                    $data->hargaEmployee=$product->hargaEmployee;
                }
                $data->scheme=$product->scheme;
                $data->hargaBeli=$product->hargaBeli;
                        
                echo json_encode($data);
            }
        }
        
        function numberFormat(){
            $data=new stdClass();
            $data->val='Rp. ' . number_format($this->input->post('val'), 0, ',', '.');
            echo json_encode($data);
        }
        
//-------------------------------------------------------------------------------------------------------------------------------------------------------        
        
        function penjualanForm(){
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            
            $typeForm=$this->uri->segment(3);
            $id=$this->uri->segment(4);
            $client=$this->m_client->clientGetAll();
            $product=$this->m_product->productGetAll();
            $penjualanById=$this->m_penjualan->penjualanGetById($id);
            $penjualanDetail=$this->m_penjualan->penjualanGetDetail($id);
            $employee=$this->m_employee->empGetAll();
            $data=array(
                'client'=>$client,
                'typeForm'=>$typeForm,
                'product'=>$product,
                'penjualanById'=>$penjualanById,
                'penjualanDetail'=>$penjualanDetail,
                'employee'=>$employee
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js'),'css'=>array('jquery-ui-1.8.22.custom','style'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('penjualan/v_penjualanForm.php',$data);
            $this->load->view('template/footer.php');  
        }
        
        function penjualanFormSave(){
            $this->load->view('v_loading.php');
                
//            print_r($this->input->post());
            if($this->input->post()){
//                echo str_replace(',','<br/>',json_encode((json_encode((array_merge(["statusAction" => 'sukses'],$this->input->post()))));
                if($this->input->post('id') == ''){
                    if($this->m_penjualan->penjualanAddSave(array_map('strtolower', $this->input->post())) != false){
                        $this->m_log->insert_log('simpan penjualan',json_encode((array_merge(["statusAction" => 'sukses'],$this->input->post()))));
                        $this->input->set_cookie('successNotif','Sukses Tambah Data',time()+6000);
                    }else{
                        $this->m_log->insert_log('simpan penjualan',json_encode((array_merge(["statusAction" => 'gagal'],$this->input->post()))));
                        $this->input->set_cookie('failedNotif','Tambah Data Gagal !!!',time()+6000);
                    }
                }else{
                    if($this->m_penjualan->penjualanEditSave(array_map('strtolower', $this->input->post())) != false){
                        $this->m_log->insert_log('edit penjualan',json_encode((array_merge(["statusAction" => 'sukses'],$this->input->post()))));
                        $this->input->set_cookie('successNotif','Sukses Edit Data',time()+6000);
                    }else{
                        $this->m_log->insert_log('edit penjualan',json_encode((array_merge(["statusAction" => 'gagal'],$this->input->post()))));
                        $this->input->set_cookie('failedNotif','Edit Data Gagal !!!',time()+6000);
                    }
                }
                redirect('penjualan');
            }else{
                redirect('login');
            }
        }
        
        function penjualanDelete(){
            $this->load->view('v_loading.php');
                
            $this->sessVerif();
            
            $data=$this->uri->segment(3);
            
            if($this->m_penjualan->penjualanDelete($data) != false){
                $this->m_log->insert_log('delete penjualan',json_encode((array_merge(["statusAction" => 'sukses'],$this->input->post()))));
                $this->input->set_cookie('successNotif','Sukses Hapus Data',time()+6000);
            }else{
                $this->m_log->insert_log('delete penjualan',json_encode((array_merge(["statusAction" => 'gagal'],$this->input->post()))));
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
            $TF=$this->m_penjualan->tukarFakturGetByIdPenjualan($penjualanById->id);
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
                'TF'=>$TF
                
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js'),'css'=>array('jquery-ui-1.8.22.custom','style'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('penjualan/v_TFAUForm.php',$data);
            $this->load->view('template/footer.php');  
        }
        
        function TFAUFormSave(){
            $this->load->view('v_loading.php');
                
            if($this->input->post()){
                if($this->input->post('typeForm') == 'tukarFaktur'){
                    if($this->input->post('addEdit') == 'add'){
                        if($this->m_penjualan->TFAUAddSave(array_map('strtolower', $this->input->post())) != false){
                            $this->m_log->insert_log('simpan TF',json_encode((array_merge(["statusAction" => 'sukses'],$this->input->post()))));
                            $this->input->set_cookie('successNotif','Sukses Tambah Data',time()+6000);
                        }else{
                            $this->m_log->insert_log('simpan TF',json_encode((array_merge(["statusAction" => 'gagal'],$this->input->post()))));
                            $this->input->set_cookie('failedNotif','Tambah Data Gagal !!!',time()+6000);
                        }
                    }else{
                        if($this->m_penjualan->TFAUEditSave(array_map('strtolower', $this->input->post())) != false){
                            $this->m_log->insert_log('edit TF',json_encode((array_merge(["statusAction" => 'sukses'],$this->input->post()))));
                            $this->input->set_cookie('successNotif','Sukses Edit Data',time()+6000);
                        }else{
                            $this->m_log->insert_log('edit TF',json_encode((array_merge(["statusAction" => 'gagal'],$this->input->post()))));
                            $this->input->set_cookie('failedNotif','Edit Data Gagal !!!',time()+6000);
                        }
                    }
                }else{
                    if($this->input->post('addEdit') == 'add'){
                        if($this->m_penjualan->TFAUAddSave(array_map('strtolower', $this->input->post())) != false){
                            $this->m_log->insert_log('simpan AU',json_encode((array_merge(["statusAction" => 'sukses'],$this->input->post()))));
                            $this->input->set_cookie('successNotif','Sukses Tambah Data',time()+6000);
                        }else{
                            $this->m_log->insert_log('simpan AU',json_encode((array_merge(["statusAction" => 'gagal'],$this->input->post()))));
                            $this->input->set_cookie('failedNotif','Tambah Data Gagal !!!',time()+6000);
                        }
                    }else{
                        if($this->m_penjualan->TFAUEditSave(array_map('strtolower', $this->input->post())) != false){
                            $this->m_log->insert_log('edit AU',json_encode((array_merge(["statusAction" => 'sukses'],$this->input->post()))));
                            $this->input->set_cookie('successNotif','Sukses Edit Data',time()+6000);
                        }else{
                            $this->m_log->insert_log('edit AU',json_encode((array_merge(["statusAction" => 'gagal'],$this->input->post()))));
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
            $client=$this->m_client->clientGetAllAll();
            $product=$this->m_product->productGetAllAll();
            $penjualanById=$this->m_penjualan->penjualanGetById($id);
            $penjualanDetail=$this->m_penjualan->penjualanGetDetail($id);
            $employee=$this->m_employee->empGetAllAll();
            $TF=$this->m_penjualan->TFGetByIdPenjualan($penjualanById->id);
            $AU=$this->m_penjualan->AUGetByIdPenjualan($penjualanById->id);
            $bank=$this->m_bank->bankGetAllAll();
            
            $data=array(
                'client'=>$client,
                'product'=>$product,
                'penjualanById'=>$penjualanById,
                'penjualanDetail'=>$penjualanDetail,
                'employee'=>$employee,
                'TF'=>$TF,
                'AU'=>$AU,
                'bank'=>$bank,
                'cashback'=>$this->cashback($id)
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js'),'css'=>array('jquery-ui-1.8.22.custom','style'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('penjualan/v_penjualanDetail.php',$data);
            $this->load->view('template/footer.php');  
        }
        
	function penjualanPrint()
	{
            $this->sessVerif();
                        
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
        
        function cashback($id){
            $client=$this->m_client->clientGetAll();
            $product=$this->m_product->productGetAll();
            $penjualanById=$this->m_penjualan->penjualanGetById($id);
            $penjualanDetail=$this->m_penjualan->penjualanGetDetail($id);
            $employee=$this->m_employee->empGetAll();
            $TF=$this->m_penjualan->TFGetByIdPenjualan($penjualanById->id);
            $AU=$this->m_penjualan->AUGetByIdPenjualan($penjualanById->id);
            $bank=$this->m_bank->bankGetAll();
            $cashback=0;
            
            if($penjualanDetail != false){
                foreach ($penjualanDetail as $penj) {
                    $temp=0;
                    $temp1=0;
                    if($penj->scheme == 'cashback'){
                        $temp=((($penj->hargaJual-$penj->hargaEmployee)/2)*$penj->jumlah);
                        $temp1=$penj->perhitungan == 'default' ? $temp : 0;
                        $cashback=$cashback+$temp1;
                    }
                }
            }
            return $cashback;
        }
        
//-------------------------------------------------------------------------------------------------------------------------------------------------------        
        
        function penjualanTable()
	{
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            
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
            if($qtype == 'penjualan.idEmployeePic'){
                if(strtolower($query) == 'bawa sendiri' || strtolower($query) == 'sendiri'){
                    $query='0';
                }
            }
//            $employeeInput = $this->session->userdata('id_admin') == '1' ? '' : 'AND penjualan.time like "'.date("d-m-Y").'%" AND penjualan.id_admin="'.$this->session->userdata('id_admin').'"' ;
            $employeeInput = $this->session->userdata('id_admin') == '1' ? '' : 'AND penjualan.id_admin="'.$this->session->userdata('id_admin').'"' ;
            if($qtype == 'time' && $query != ''){
                $ttime=explode('-', $query);
                $whereSql = ($qtype != '' && $query != '') ? "where d=$ttime[0] AND m=$ttime[1] AND y=$ttime[2] AND client.id=penjualan.idClient $employeeInput AND penjualan.deleted='0'" : "WHERE  client.id=penjualan.idClient $employeeInput AND penjualan.deleted='0'";
            }else{
                $whereSql = ($qtype != '' && $query != '') ? "where $qtype LIKE '%$query%' AND client.id=penjualan.idClient $employeeInput AND penjualan.deleted='0'" : "WHERE  client.id=penjualan.idClient $employeeInput AND penjualan.deleted='0'";
            }

            // Setup paging SQL
            $pageStart = ($page-1)*$rp;
            $limitSql = "limit $pageStart, $rp";
            
            // Create JSON data
            $data = array();
            $data['page'] = $page;
            $data['rows'] = array();
            $select = "client.nama,penjualan.noFaktur,penjualan.diskon,penjualan.jumlahDiskon,penjualan.noPo,penjualan.d,penjualan.m,penjualan.y,penjualan.status,penjualan.id,penjualan.totalBayar,penjualan.idEmployeePic,penjualan.nominalFaktur";
            $sql = "SELECT $select FROM penjualan,client $whereSql $sortSql $limitSql";
            $sqlcount = "SELECT $select FROM penjualan,client $whereSql $sortSql";
//            echo $sql;
            // Get total count of records
            $total = $this->m_penjualan->get_count_query($sqlcount);
            $data['total'] = $total;
            
            $results = $this->m_penjualan->get_query($sql);

            $no=$pageStart+1;
            if($results != false){
                foreach($results as $row){
                    if($row->idEmployeePic == '0'){
                        $employeePic='Bawa Sendiri';
                    }else{
                        $a=$this->m_employee->empGetById($row->idEmployeePic);
                        $employeePic=$a->nama;
                    }
                    if($row->totalBayar != '') $totByr='Rp. ' . number_format($row->totalBayar, 0, ',', '.'); else $totByr='';
                    if($row->diskon == 'nominal'){
                        $nominalFaktur='Rp. ' . number_format($row->nominalFaktur-$row->jumlahDiskon, 0, ',', '.');
                    }else if($row->diskon == 'persen'){
                        $nominalFaktur='Rp. ' . number_format($row->nominalFaktur-($row->jumlahDiskon*$row->nominalFaktur/100), 0, ',', '.');
                    }else if ($row->diskon == 'tidak'){
                        $nominalFaktur='Rp. ' . number_format($row->nominalFaktur, 0, ',', '.');
                    }
                    $data['rows'][] = array(
                    'id' => $row->id,
                    'cell' => array($no,$row->noFaktur,  strtoupper($row->noPo),  ucwords($row->nama), ucwords($employeePic),date("d-M-Y",strtotime($row->d.'-'.$row->m.'-'.$row->y)),$nominalFaktur,$totByr,ucwords($row->status))
                    );
                    $no++;
                }        
            }

            echo json_encode($data);  
        }   
        
        function penjualanPrintTable()
	{
            $this->sessVerif();
            
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
            if($qtype == 'time' && $query != ''){
                $ttime=explode('-', $query);
                $whereSql = ($qtype != '' && $query != '') ? "where d=$ttime[0] AND m=$ttime[1] AND y=$ttime[2] AND client.id=penjualan.idClient AND penjualan.idClient='$idClient' AND penjualan.deleted='0'" : "WHERE  client.id=penjualan.idClient AND penjualan.idClient='$idClient' AND penjualan.deleted='0'";
            }else{
                $whereSql = ($qtype != '' && $query != '') ? "where $qtype LIKE '%$query%' AND client.id=penjualan.idClient AND penjualan.idClient='$idClient' AND penjualan.deleted='0'" : "WHERE  client.id=penjualan.idClient AND penjualan.idClient='$idClient' AND penjualan.deleted='0'";
            }

            // Setup paging SQL
            $pageStart = ($page-1)*$rp;
            $limitSql = "limit $pageStart, $rp";

            // Create JSON data
            $data = array();
            $data['page'] = $page;
            $data['rows'] = array();
            $select = "client.nama,penjualan.noFaktur,penjualan.diskon,penjualan.jumlahDiskon,penjualan.noPo,penjualan.d,penjualan.m,penjualan.y,penjualan.status,penjualan.id,penjualan.nominalFaktur,penjualan.idEmployeePic";
            $sql = "SELECT $select FROM penjualan,client $whereSql $sortSql $limitSql";
            $sqlcount = "SELECT $select FROM penjualan,client $whereSql $sortSql";
//            echo $sql;
            // Get total count of records
            $total = $this->m_penjualan->get_count_query($sqlcount);
            $data['total'] = $total;

            $results = $this->m_penjualan->get_query($sql);

            $no=$pageStart+1;
            if($results != false){
                foreach($results as $row){
                    if($row->status != 'ambil uang' && $row->status != 'manual close' ){
                        if($row->idEmployeePic == '0'){
                            $employeePic='Bawa Sendiri';
                        }else{
                            $a=$this->m_employee->empGetById($row->idEmployeePic);
                            $employeePic=$a->nama;
                        }
                        if($row->diskon == 'nominal'){
                            $nominalFaktur='Rp. ' . number_format($row->nominalFaktur-$row->jumlahDiskon, 0, ',', '.');
                        }else if($row->diskon == 'persen'){
                            $nominalFaktur='Rp. ' . number_format($row->nominalFaktur-($row->jumlahDiskon*$row->nominalFaktur/100), 0, ',', '.');
                        }else if ($row->diskon == 'tidak'){
                            $nominalFaktur='Rp. ' . number_format($row->nominalFaktur, 0, ',', '.');
                        }
                        $data['rows'][] = array(
                        'id' => $row->id,
                        'cell' => array($no,$row->noFaktur,$row->noPo,  ucwords($row->nama), ucwords($employeePic),date("d-M-Y",strtotime($row->d.'-'.$row->m.'-'.$row->y)),$nominalFaktur,ucwords($row->status))
                        );
                        $no++;
                    }
                }        
            }

            echo json_encode($data);  
        }
}
