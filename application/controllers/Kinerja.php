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
            if($this->session->userdata('id_admin') != '1') redirect (site_url());
            
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
            if($this->session->userdata('id_admin') != '1') redirect (site_url());
            
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
            $this->load->view('v_loading.php');
                
            if($this->input->post()){
                if($this->input->post('id') == ''){
                    if($this->m_penjualan->penjualanAddSave(array_map('strtolower', $this->input->post())) != false){
                        $this->m_log->insert_log('simpan penjualan',json_encode((array_merge(["statusAction" => 'sukses'],$this->input->post()))));
                        $this->input->set_cookie('successNotif','Sukses Tambah Data',time()+6000);
//                        echo 1;
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
                
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            if($this->session->userdata('id_admin') != '1') redirect (site_url());
            
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
}
