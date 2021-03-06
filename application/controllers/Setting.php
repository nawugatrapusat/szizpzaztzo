<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

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
                $this->load->model('m_client', '', TRUE);
                $this->load->model('m_penjualan', '', TRUE);
                $this->load->model('m_product', '', TRUE);
                $this->load->model('m_employee', '', TRUE);
                $this->load->model('m_bank', '', TRUE);
                $this->load->model('m_pengeluaran', '', TRUE);
	}
    
        public function sessVerif()
        {
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            if($this->session->userdata('id_admin') != '1') redirect (site_url());
        }
    
	function index()
	{
            $this->sessVerif();
                        
            
            $client=$this->m_client->clientGetAll();
            $product=$this->m_product->productGetAll();
            $emp=$this->m_employee->empGetAll();
            $bank=$this->m_bank->bankGetAll();
            $pengeluaran=$this->m_pengeluaran->pengeluaranGetAll();
            $data=array(
                'client'=>$client,
                'product'=>$product,
                'emp'=>$emp,
                'bank'=>$bank,
                'pengeluaran'=>$pengeluaran
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js','flexigrid.pack','cookie'),'css'=>array('jquery-ui-1.8.22.custom','style','flexigrid.pack'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('setting/v_setting.php',$data);
            $this->load->view('template/footer.php');  
	}	
        
        function clientForm(){
            $this->sessVerif();
            
            $typeForm=$this->uri->segment(3);
            $id=$this->uri->segment(4);
            $client=$this->m_client->clientGetById($id);
            $clientPrice=$this->m_client->clientPriceGetByIdClient($id);
            $product=$this->m_product->productGetAll();
            $data=array(
                'client'=>$client,
                'typeForm'=>$typeForm,
                'clientPrice'=>$clientPrice,
                'product'=>$product
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js'),'css'=>array('jquery-ui-1.8.22.custom','style'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('setting/v_settingClientForm.php',$data);
            $this->load->view('template/footer.php');  
        }
        
        function clientFormSave(){
            $this->load->view('v_loading.php');
                
            if($this->input->post()){
                $tab=$this->uri->segment(3);
//                print_r($this->input->post());
                if($this->input->post('id') == ''){
                    if($this->m_client->clientAddSave(array_map('strtolower', $this->input->post())) != false){
                        $this->m_log->insert_log('simpan setting client',json_encode((array_merge(["statusAction" => 'sukses'],$this->input->post()))));
                        $this->input->set_cookie('successNotif','Sukses Tambah Data',time()+6000);
                    }else{
                        $this->m_log->insert_log('simpan setting client',json_encode((array_merge(["statusAction" => 'gagal'],$this->input->post()))));
                        $this->input->set_cookie('failedNotif','Tambah Data Gagal !!!',time()+6000);
                    }
                }else{
                    if($this->m_client->clientEditSave(array_map('strtolower', $this->input->post())) != false){
                        $this->m_log->insert_log('edit setting client',json_encode((array_merge(["statusAction" => 'sukses'],$this->input->post()))));
                        $this->input->set_cookie('successNotif','Sukses Edit Data',time()+6000);
                    }else{
                        $this->m_log->insert_log('edit setting client',json_encode((array_merge(["statusAction" => 'gagal'],$this->input->post()))));
                        $this->input->set_cookie('failedNotif','Edit Data Gagal !!!',time()+6000);
                    }
                }
                $this->input->set_cookie('tab',$tab,time()+6000);
                redirect('setting');
            }else{
                redirect('login');
            }
        }
        
        function clientDelete(){
            $this->load->view('v_loading.php');
                
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            if($this->session->userdata('id_admin') != '1' || $this->session->userdata('id_admin') == '5') redirect (site_url());
            
            $tab=$this->uri->segment(3);
            $data=$this->uri->segment(4);
            
            if($this->m_client->clientDelete($data) != false){
                $this->m_log->insert_log('delete setting client',json_encode((array_merge(["statusAction" => 'sukses'],["data" =>$data]))));
                $this->input->set_cookie('successNotif','Sukses Hapus Data',time()+6000);
            }else{
                $this->m_log->insert_log('delete setting client',json_encode((array_merge(["statusAction" => 'gagal'],["data" =>$data]))));
                $this->input->set_cookie('failedNotif','Hapus Data Gagal !!!',time()+6000);
            }
            $this->input->set_cookie('tab',$tab,time()+6000);
            redirect(site_url('setting'));
        }
        
//------------------------------------------------------------------------------------------------------------------------------------------------------------------
        
        function productForm(){
            $this->sessVerif();
            
            $typeForm=$this->uri->segment(3);
            $id=$this->uri->segment(4);
            $product=$this->m_product->productGetById($id);
            $data=array(
                'product'=>$product,
                'typeForm'=>$typeForm
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js'),'css'=>array('jquery-ui-1.8.22.custom','style'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('setting/v_settingProductForm.php',$data);
            $this->load->view('template/footer.php');  
        }
        
        function productFormSave(){
            $this->load->view('v_loading.php');
                
            if($this->input->post()){
                $tab=$this->uri->segment(3);
                if($this->input->post('id') == ''){
                    if($this->m_product->productAddSave(array_map('strtolower', $this->input->post())) != false){
                        $this->m_log->insert_log('simpan setting product',json_encode((array_merge(["statusAction" => 'sukses'],$this->input->post()))));
                        $this->input->set_cookie('successNotif','Sukses Tambah Data',time()+6000);
                    }else{
                        $this->m_log->insert_log('simpan setting product',json_encode((array_merge(["statusAction" => 'gagal'],$this->input->post()))));
                        $this->input->set_cookie('failedNotif','Tambah Data Gagal !!!',time()+6000);
                    }
                }else{
                    if($this->m_product->productEditSave(array_map('strtolower', $this->input->post())) != false){
                        $this->m_log->insert_log('edit setting product',json_encode((array_merge(["statusAction" => 'sukses'],$this->input->post()))));
                        $this->input->set_cookie('successNotif','Sukses Edit Data',time()+6000);
                    }else{
                        $this->m_log->insert_log('edit setting product',json_encode((array_merge(["statusAction" => 'gagal'],$this->input->post()))));
                        $this->input->set_cookie('failedNotif','Edit Data Gagal !!!',time()+6000);
                    }
                }
                $this->input->set_cookie('tab',$tab,time()+6000);
                redirect(site_url('setting'));
            }else{
                redirect('login');
            }
        }
        
        function productDelete(){
            $this->load->view('v_loading.php');
                
            $this->sessVerif();
            
            $tab=$this->uri->segment(3);
            $data=$this->uri->segment(4);
            
            if($this->m_product->productDelete($data) != false){
                $this->m_log->insert_log('delete setting product',json_encode((array_merge(["statusAction" => 'sukses'],["data" =>$data]))));
                $this->input->set_cookie('successNotif','Sukses Hapus Data',time()+6000);
            }else{
                $this->m_log->insert_log('delete setting product',json_encode((array_merge(["statusAction" => 'gagal'],["data" =>$data]))));
                $this->input->set_cookie('failedNotif','Hapus Data Gagal !!!',time()+6000);
            }
            $this->input->set_cookie('tab',$tab,time()+6000);
            redirect(site_url('setting'));
        }
        
        function productStockForm(){
            $this->sessVerif();
            
            $product=$this->m_product->productGetAll();
            $data=array(
                'product'=>$product
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js'),'css'=>array('jquery-ui-1.8.22.custom','style'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('setting/v_settingProductStockForm.php',$data);
            $this->load->view('template/footer.php');  
        }
        
        function productStockFormSave(){
            $this->load->view('v_loading.php');
                
            if($this->input->post()){
//                print_r($this->input->post());
                $product=$this->m_product->productGetAll();
                $c=0;
                foreach ($product as $detail){
                    $data=new stdClass();
                    $data->minStock=$this->input->post('minStock'.$detail->id);
                    if($this->input->post('jumlah'.$detail->id) != ''){
                        if($this->input->post('tipeStock') == 'tambah'){
                            $data->stock=$detail->stock+$this->input->post('jumlah'.$detail->id);
                        }else if($this->input->post('tipeStock') == 'update'){
                            $data->stock=$this->input->post('jumlah'.$detail->id);
                        }
                    }
                    $tmp=$this->m_product->productStockFormSave($detail->id,$data);
                    if($tmp == false) $c++;
//                    print_r($data);
//                    echo "<br/>";
                }
                if($c == 0){
                    $this->m_log->insert_log('simpan setting product stock',json_encode((array_merge(["statusAction" => 'sukses'],$this->input->post()))));
                    $this->input->set_cookie('successNotif','Sukses Tambah Data',time()+6000);
                }else{
                    $this->m_log->insert_log('simpan setting product stock',json_encode((array_merge(["statusAction" => 'gagal'],$this->input->post()))));
                    $this->input->set_cookie('failedNotif','Tambah Data Gagal !!!',time()+6000);
                }
                
                $this->input->set_cookie('tab',1,time()+6000);
                redirect(site_url('setting'));
            }else{
                redirect('login');
            }
        }
        
//------------------------------------------------------------------------------------------------------------------------------------------------------------------
        
        function empForm(){
            $this->sessVerif();
            
            $typeForm=$this->uri->segment(3);
            $id=$this->uri->segment(4);
            $emp=$this->m_employee->empGetById($id);
            $data=array(
                'emp'=>$emp,
                'typeForm'=>$typeForm
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js'),'css'=>array('jquery-ui-1.8.22.custom','style'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('setting/v_settingEmpForm.php',$data);
            $this->load->view('template/footer.php');  
        }
        
        function empFormSave(){
            $this->load->view('v_loading.php');
                
            if($this->input->post()){
                $tab=$this->uri->segment(3);
                
                if($this->input->post('id') == ''){
                    if($this->m_employee->empAddSave(array_map('strtolower', $this->input->post())) != false){
                        $this->m_log->insert_log('simpan setting employee',json_encode((array_merge(["statusAction" => 'sukses'],$this->input->post()))));
                        $this->input->set_cookie('successNotif','Sukses Tambah Data',time()+6000);
                    }else{
                        $this->m_log->insert_log('simpan setting employee',json_encode((array_merge(["statusAction" => 'gagal'],$this->input->post()))));
                        $this->input->set_cookie('failedNotif','Tambah Data Gagal !!!',time()+6000);
                    }
                }else{
                    if($this->m_employee->empEditSave(array_map('strtolower', $this->input->post())) != false){
                        $this->m_log->insert_log('edit setting employee',json_encode((array_merge(["statusAction" => 'sukses'],$this->input->post()))));
                        $this->input->set_cookie('successNotif','Sukses Edit Data',time()+6000);
                    }else{
                        $this->m_log->insert_log('edit setting employee',json_encode((array_merge(["statusAction" => 'gagal'],$this->input->post()))));
                        $this->input->set_cookie('failedNotif','Edit Data Gagal !!!',time()+6000);
                    }
                }
                $this->input->set_cookie('tab',$tab,time()+6000);
                redirect(site_url('setting'));
            }else{
                redirect('login');
            }
        }
        
        function empDelete(){
            $this->load->view('v_loading.php');
                
            $this->sessVerif();
            
            $tab=$this->uri->segment(3);
            $data=$this->uri->segment(4);
            
            if($this->m_employee->empDelete($data) != false){
                $this->m_log->insert_log('delete setting employee',json_encode((array_merge(["statusAction" => 'sukses'],["data" =>$data]))));
                $this->input->set_cookie('successNotif','Sukses Hapus Data',time()+6000);
            }else{
                $this->m_log->insert_log('delete setting employee',json_encode((array_merge(["statusAction" => 'gagal'],["data" =>$data]))));
                $this->input->set_cookie('failedNotif','Hapus Data Gagal !!!',time()+6000);
            }
            $this->input->set_cookie('tab',$tab,time()+6000);
            redirect(site_url('setting'));
        }
        
//------------------------------------------------------------------------------------------------------------------------------------------------------------------
        
        function bankForm(){
            $this->sessVerif();
            
            $typeForm=$this->uri->segment(3);
            $id=$this->uri->segment(4);
            $bank=$this->m_bank->bankGetById($id);
            $data=array(
                'bank'=>$bank,
                'typeForm'=>$typeForm
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js'),'css'=>array('jquery-ui-1.8.22.custom','style'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('setting/v_settingBankForm.php',$data);
            $this->load->view('template/footer.php');  
        }
        
        function bankFormSave(){
            $this->load->view('v_loading.php');
                
            if($this->input->post()){
                $tab=$this->uri->segment(3);
                if($this->input->post('id') == ''){
                    if($this->m_bank->bankAddSave(array_map('strtolower', $this->input->post())) != false){
                        $this->m_log->insert_log('simpan setting bank',json_encode((array_merge(["statusAction" => 'sukses'],$this->input->post()))));
                        $this->input->set_cookie('successNotif','Sukses Tambah Data',time()+6000);
                    }else{
                        $this->m_log->insert_log('simpan setting bank',json_encode((array_merge(["statusAction" => 'gagal'],$this->input->post()))));
                        $this->input->set_cookie('failedNotif','Tambah Data Gagal !!!',time()+6000);
                    }
                }else{
                    if($this->m_bank->bankEditSave(array_map('strtolower', $this->input->post())) != false){
                        $this->m_log->insert_log('edit setting bank',json_encode((array_merge(["statusAction" => 'sukses'],$this->input->post()))));
                        $this->input->set_cookie('successNotif','Sukses Edit Data',time()+6000);
                    }else{
                        $this->m_log->insert_log('edit setting bank',json_encode((array_merge(["statusAction" => 'gagal'],$this->input->post()))));
                        $this->input->set_cookie('failedNotif','Edit Data Gagal !!!',time()+6000);
                    }
                }
                $this->input->set_cookie('tab',$tab,time()+6000);
                redirect(site_url('setting'));
            }else{
                redirect('login');
            }
        }
        
        function bankDelete(){
            $this->load->view('v_loading.php');
                
            $this->sessVerif();
            
            $tab=$this->uri->segment(3);
            $data=$this->uri->segment(4);
            
            if($this->m_bank->bankDelete($data) != false){
                $this->m_log->insert_log('delete setting bank',json_encode((array_merge(["statusAction" => 'sukses'],["data" =>$data]))));
                $this->input->set_cookie('successNotif','Sukses Hapus Data',time()+6000);
            }else{
                $this->m_log->insert_log('delete setting bank',json_encode((array_merge(["statusAction" => 'gagal'],["data" =>$data]))));
                $this->input->set_cookie('failedNotif','Hapus Data Gagal !!!',time()+6000);
            }
            $this->input->set_cookie('tab',$tab,time()+6000);
            redirect(site_url('setting'));
        }
        
//------------------------------------------------------------------------------------------------------------------------------------------------------------------
        
        function pengeluaranForm(){
            $this->sessVerif();
            
            $typeForm=$this->uri->segment(3);
            $id=$this->uri->segment(4);
            $pengeluaran=$this->m_pengeluaran->pengeluaranGetById($id);
            $data=array(
                'pengeluaran'=>$pengeluaran,
                'typeForm'=>$typeForm
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js'),'css'=>array('jquery-ui-1.8.22.custom','style'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('setting/v_settingPengeluaranForm.php',$data);
            $this->load->view('template/footer.php');  
        }
        
        function pengeluaranFormSave(){
            $this->load->view('v_loading.php');
                
            if($this->input->post()){
                $tab=$this->uri->segment(3);
                if($this->input->post('id') == ''){
                    if($this->m_pengeluaran->pengeluaranAddSave(array_map('strtolower', $this->input->post())) != false){
                        $this->m_log->insert_log('simpan setting pengeluaran',json_encode((array_merge(["statusAction" => 'sukses'],$this->input->post()))));
                        $this->input->set_cookie('successNotif','Sukses Tambah Data',time()+6000);
                    }else{
                        $this->m_log->insert_log('simpan setting pengeluaran',json_encode((array_merge(["statusAction" => 'gagal'],$this->input->post()))));
                        $this->input->set_cookie('failedNotif','Tambah Data Gagal !!!',time()+6000);
                    }
                }else{
                    if($this->m_pengeluaran->pengeluaranEditSave(array_map('strtolower', $this->input->post())) != false){
                        $this->m_log->insert_log('edit setting pengeluaran',json_encode((array_merge(["statusAction" => 'sukses'],$this->input->post()))));
                        $this->input->set_cookie('successNotif','Sukses Edit Data',time()+6000);
                    }else{
                        $this->m_log->insert_log('edit setting pengeluaran',json_encode((array_merge(["statusAction" => 'gagal'],$this->input->post()))));
                        $this->input->set_cookie('failedNotif','Edit Data Gagal !!!',time()+6000);
                    }
                }
                $this->input->set_cookie('tab',$tab,time()+6000);
                redirect(site_url('setting'));
            }else{
                redirect('login');
            }
        }
        
        function pengeluaranDelete(){
            $this->load->view('v_loading.php');
                
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            if($this->session->userdata('id_admin') != '1' || $this->session->userdata('id_admin') == '5') redirect (site_url());
            
            $tab=$this->uri->segment(3);
            $data=$this->uri->segment(4);
            
            if($this->m_pengeluaran->pengeluaranDelete($data) != false){
                $this->m_log->insert_log('delete setting pengeluaran',json_encode((array_merge(["statusAction" => 'sukses'],["data" =>$data]))));
                $this->input->set_cookie('successNotif','Sukses Hapus Data',time()+6000);
            }else{
                $this->m_log->insert_log('delete setting pengeluaran',json_encode((array_merge(["statusAction" => 'gagal'],["data" =>$data]))));
                $this->input->set_cookie('failedNotif','Hapus Data Gagal !!!',time()+6000);
            }
            $this->input->set_cookie('tab',$tab,time()+6000);
            redirect(site_url('setting'));
        }
//------------------------------------------------------------------------------------------------------------------------------------------------------------------
      
        function cekDeleteProduct(){
            if($_POST){
                $data=new stdClass();
                $data->val="Gagal hapus produk dikarenakan ada penjualan yang pending : \n";
                $data->c=0;
                $data->stdelete=true;
                
                $idProduct=  $this->input->post('idProduct');

                $cekProduk=$this->m_penjualan->cekProductGetByIdFromPenjualandetail($idProduct);
                
                if($cekProduk != false){
                    foreach ($cekProduk as $hasil) {
                        $data->val=$data->val."No Faktur : ".$hasil->noFaktur." - ".ucwords($hasil->nama)."\n";
                        $data->c++;
                    }    
                }
                
                if($data->c == 0){
                    $stdelete=$this->m_client->deleteClientpriceUpdateByIdProduct($idProduct);
                    if($stdelete == false) $data->stdelete=false;
                    $this->m_log->insert_log('delete client price product',"id product : ".$idProduct.", status : ".$stdelete);
                }
                
                echo json_encode($data);
            }
        }
        function cekDeleteClient(){
            if($_POST){
                $data=new stdClass();
                $data->val="Gagal hapus client dikarenakan ada penjualan yang pending : \n";
                $data->c=0;
                $data->stdelete=true;
                
                $idClient=  $this->input->post('idClient');

                $cekClient=$this->m_penjualan->cekClientGetByIdFromPenjualan($idClient);
                
                if($cekClient != false){
                    foreach ($cekClient as $hasil) {
                        $data->val=$data->val."No Faktur : ".$hasil->noFaktur." - ".ucwords($hasil->nama)."\n";
                        $data->c++;
                    }    
                }
                
                echo json_encode($data);
            }
        }
        function cekDeleteEmployee(){
            if($_POST){
                $data=new stdClass();
                $data->val="Gagal hapus karyawan dikarenakan ada penjualan yang pending : \n";
                $data->c=0;
                
                $idEmployee=  $this->input->post('idEmployee');

                $cekEmployee=$this->m_penjualan->cekEmployeeGetByIdFromPenjualan($idEmployee);
                if($cekEmployee != false){
                    foreach ($cekEmployee as $hasil) {
                        $data->val=$data->val."No Faktur : ".$hasil->noFaktur." - ".ucwords($hasil->nama)."\n";
                        $data->c++;
                    }    
                }

                $cekEmployee2=$this->m_penjualan->cekEmployeeGetByIdFromTukarfaktur($idEmployee);
                if($cekEmployee2 != false){
                    foreach ($cekEmployee2 as $hasil) {
                        $data->val=$data->val."No Faktur : ".$hasil->noFaktur." - ".ucwords($hasil->nama)."\n";
                        $data->c++;
                    }    
                }
                
                echo json_encode($data);
            }
        }
        
//------------------------------------------------------------------------------------------------------------------------------------------------------------------
        
        function clientTable()
	{
            $this->sessVerif();
            
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
            $whereSql = ($qtype != '' && $query != '') ? "where $qtype LIKE '%$query%' AND deleted='0'" : "WHERE  deleted='0'";

            // Setup paging SQL
            $pageStart = ($page-1)*$rp;
            $limitSql = "limit $pageStart, $rp";

            // Create JSON data
            $data = array();
            $data['page'] = $page;
            $data['rows'] = array();
            $select = "*";
            $sql = "SELECT $select FROM client $whereSql $sortSql $limitSql";
            $sqlcount = "SELECT $select FROM client $whereSql $sortSql";
//            echo $sql;
            // Get total count of records
            $total = $this->m_client->get_count_query($sqlcount);
            $data['total'] = $total;

            $results = $this->m_client->get_query($sql);

            $no=$pageStart+1;
            if($results != false){
                foreach($results as $row){
                    $clientPrice=$this->m_client->clientPriceGetByIdClient($row->id);
                    $print='';
                    if($clientPrice != ''){
                        foreach($clientPrice as $hasil){
                            if($hasil->idProduct != '0'){
                                $product=$this->m_product->productGetById($hasil->idProduct);
                                $print.=ucwords($product->nama).' - '.ucwords($product->berat).' gr => Rp. ' . number_format($hasil->hargaJual, 0, ',', '.').'<br/>';
                            }
                        }
                    }
                    $data['rows'][] = array(
                    'id' => $row->id,
                    'cell' => array($no,  ucwords($row->nama),  ucfirst($row->alamat),$row->noTelp,$row->noHp,ucwords($row->picPembelian),ucwords($row->picTagihan),$print)
                    );
                    $no++;
                }        
            }

            echo json_encode($data);  
        }   
        
        function productTable()
	{
            $this->sessVerif();
            
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
            $whereSql = ($qtype != '' && $query != '') ? "where $qtype LIKE '%$query%' AND deleted='0'" : "WHERE  deleted='0'";

            // Setup paging SQL
            $pageStart = ($page-1)*$rp;
            $limitSql = "limit $pageStart, $rp";

            // Create JSON data
            $data = array();
            $data['page'] = $page;
            $data['rows'] = array();
            $select = "*";
            $sql = "SELECT $select FROM product $whereSql $sortSql $limitSql";
            $sqlcount = "SELECT $select FROM product $whereSql $sortSql";
//            echo $sql;
            // Get total count of records
            $total = $this->m_product->get_count_query($sqlcount);
            $data['total'] = $total;

            $results = $this->m_product->get_query($sql);

            $no=$pageStart+1;
            if($results != false){
                foreach($results as $row){
                    $data['rows'][] = array(
                    'id' => $row->id,
                    'cell' => array($no, ucwords($row->merek),  ucwords($row->nama),$row->berat.' gr',
                    'Rp. '.number_format($row->hargaBeli,0,',','.'),$row->hargaEmployee == '' ? '' : 'Rp. '.number_format($row->hargaEmployee,0,',','.'),
                    'Rp. '.number_format($row->hargaJual,0,',','.'),'Rp. '.number_format($row->hargaJualDiskon,0,',','.'),ucwords($row->scheme))
                    );
                    $no++;
                }        
            }

            echo json_encode($data);  
        }   
}
