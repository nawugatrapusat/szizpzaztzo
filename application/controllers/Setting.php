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
                $this->load->model('m_product', '', TRUE);
                $this->load->model('m_employee', '', TRUE);
                $this->load->model('m_bank', '', TRUE);
	}
    
	function index()
	{
            if($this->session->userdata('id_admin') == '') redirect (site_url());
                        
            
            $client=$this->m_client->clientGetAll();
            $product=$this->m_product->productGetAll();
            $emp=$this->m_employee->empGetAll();
            $bank=$this->m_bank->bankGetAll();
            $data=array(
                'client'=>$client,
                'product'=>$product,
                'emp'=>$emp,
                'bank'=>$bank
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js'),'css'=>array('jquery-ui-1.8.22.custom','style'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('setting/v_setting.php',$data);
            $this->load->view('template/footer.php');  
	}	
        
        function clientForm(){
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            
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
            if($this->input->post()){
                $tab=$this->uri->segment(3);
//                print_r($this->input->post());
                if($this->input->post('id') == ''){
//                    for($a=1;$a<=5;$a++) if($this->m_client->clientPriceAdd($add) == true) $b++;
//                    if($b != 5) $this->input->set_cookie('failedNotif','Sukses Menambahkan Data, Namun Ada Kesalahan Dalam Penambahan Data, Hubungi Administrator Website !!!',time()+6000);
                    if($this->m_client->clientAddSave(array_map('strtolower', $this->input->post())) != false){
                        $this->input->set_cookie('successNotif','Sukses Tambah Data',time()+6000);
                    }else{
                        $this->input->set_cookie('failedNotif','Tambah Data Gagal !!!',time()+6000);
                    }
                }else{
                    if($this->m_client->clientEditSave(array_map('strtolower', $this->input->post())) != false){
                        $this->input->set_cookie('successNotif','Sukses Edit Data',time()+6000);
                    }else{
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
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            
            $tab=$this->uri->segment(3);
            $data=$this->uri->segment(4);
            
            if($this->m_client->clientDelete($data) != false){
                $this->input->set_cookie('successNotif','Sukses Hapus Data',time()+6000);
            }else{
                $this->input->set_cookie('failedNotif','Hapus Data Gagal !!!',time()+6000);
            }
            $this->input->set_cookie('tab',$tab,time()+6000);
            redirect(site_url('setting'));
        }
        
//------------------------------------------------------------------------------------------------------------------------------------------------------------------
        
        function productForm(){
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            
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
            if($this->input->post()){
                $tab=$this->uri->segment(3);
                if($this->input->post('id') == ''){
                    if($this->m_product->productAddSave(array_map('strtolower', $this->input->post())) != false){
                        $this->input->set_cookie('successNotif','Sukses Tambah Data',time()+6000);
                    }else{
                        $this->input->set_cookie('failedNotif','Tambah Data Gagal !!!',time()+6000);
                    }
                }else{
                    if($this->m_product->productEditSave(array_map('strtolower', $this->input->post())) != false){
                        $this->input->set_cookie('successNotif','Sukses Edit Data',time()+6000);
                    }else{
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
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            
            $tab=$this->uri->segment(3);
            $data=$this->uri->segment(4);
            
            if($this->m_product->productDelete($data) != false){
                $this->input->set_cookie('successNotif','Sukses Hapus Data',time()+6000);
            }else{
                $this->input->set_cookie('failedNotif','Hapus Data Gagal !!!',time()+6000);
            }
            $this->input->set_cookie('tab',$tab,time()+6000);
            redirect(site_url('setting'));
        }
        
//------------------------------------------------------------------------------------------------------------------------------------------------------------------
        
        function empForm(){
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            
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
            if($this->input->post()){
                $tab=$this->uri->segment(3);
                
                if($this->input->post('id') == ''){
                    if($this->m_employee->empAddSave(array_map('strtolower', $this->input->post())) != false){
                        $this->input->set_cookie('successNotif','Sukses Tambah Data',time()+6000);
                    }else{
                        $this->input->set_cookie('failedNotif','Tambah Data Gagal !!!',time()+6000);
                    }
                }else{
                    if($$this->m_employee->empEditSave(array_map('strtolower', $this->input->post())) != false){
                        $this->input->set_cookie('successNotif','Sukses Edit Data',time()+6000);
                    }else{
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
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            
            $tab=$this->uri->segment(3);
            $data=$this->uri->segment(4);
            
            if($this->m_employee->empDelete($data) != false){
                $this->input->set_cookie('successNotif','Sukses Hapus Data',time()+6000);
            }else{
                $this->input->set_cookie('failedNotif','Hapus Data Gagal !!!',time()+6000);
            }
            $this->input->set_cookie('tab',$tab,time()+6000);
            redirect(site_url('setting'));
        }
        
//------------------------------------------------------------------------------------------------------------------------------------------------------------------
        
        function bankForm(){
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            
            $typeForm=$this->uri->segment(3);
            $id=$this->uri->segment(4);
            $bank=$this->m_bank->bankGetById($id);
            $data=array(
                'bank'=>$bank,
                'typeForm'=>$typeForm
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js'),'css'=>array('jquery-ui-1.8.22.custom','style'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('setting/v_settingBank.php',$data);
            $this->load->view('template/footer.php');  
        }
        
        function bankFormSave(){
            if($this->input->post()){
                $tab=$this->uri->segment(3);
                if($this->input->post('id') == ''){
                    if($this->m_bank->bankAddSave(array_map('strtolower', $this->input->post())) != false){
                        $this->input->set_cookie('successNotif','Sukses Tambah Data',time()+6000);
                    }else{
                        $this->input->set_cookie('failedNotif','Tambah Data Gagal !!!',time()+6000);
                    }
                }else{
                    if($this->m_bank->bankEditSave(array_map('strtolower', $this->input->post())) != false){
                        $this->input->set_cookie('successNotif','Sukses Edit Data',time()+6000);
                    }else{
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
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            
            $tab=$this->uri->segment(3);
            $data=$this->uri->segment(4);
            
            if($this->m_bank->bankDelete($data) != false){
                $this->input->set_cookie('successNotif','Sukses Hapus Data',time()+6000);
            }else{
                $this->input->set_cookie('failedNotif','Hapus Data Gagal !!!',time()+6000);
            }
            $this->input->set_cookie('tab',$tab,time()+6000);
            redirect(site_url('setting'));
        }
}
