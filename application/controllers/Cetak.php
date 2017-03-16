<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends CI_Controller {

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
	}
    
	public function faktur()
	{
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            if($this->session->userdata('id_admin') != '1') redirect (site_url());
            
            $id=$this->uri->segment(3);
            $fakturNama=$this->uri->segment(4);
            $penjualanById=$this->m_penjualan->penjualanGetById($id);
            $penjualanDetail=$this->m_penjualan->penjualanGetDetail($id);
            $detailClient=$this->m_client->clientGetById($penjualanById->idClient);
            $product=$this->m_product->productGetAll();
            
            if($this->m_penjualan->histPenjualan($penjualanById,$penjualanDetail) != false){
                $this->m_log->insert_log('Hist Penjualan',json_encode((array_merge(["statusAction" => 'sukses'],$penjualanDetail))));
            }else{
                $this->m_log->insert_log('Hist Penjualan',json_encode((array_merge(["statusAction" => 'sukses'],$penjualanDetail))));
            }
            
            $data=array(
                'penjualanById'=>$penjualanById,
                'penjualanDetail'=>$penjualanDetail,
                'detailClient'=>$detailClient,
                'product'=>$product,
                'fakturNama'=>$fakturNama
            );
            
            $this->load->view('cetak/v_faktur.php',$data); 
	}	
    
	public function suratJalan()
	{
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            if($this->session->userdata('id_admin') != '1') redirect (site_url());
            
            $id=$this->uri->segment(3);
            $fakturNama=$this->uri->segment(4);
            $penjualanById=$this->m_penjualan->penjualanGetById($id);
            $penjualanDetail=$this->m_penjualan->penjualanGetDetail($id);
            $detailClient=$this->m_client->clientGetById($penjualanById->idClient);
            $product=$this->m_product->productGetAll();
            
            $data=array(
                'penjualanById'=>$penjualanById,
                'penjualanDetail'=>$penjualanDetail,
                'detailClient'=>$detailClient,
                'product'=>$product,
                'fakturNama'=>$fakturNama
            );
            
            $this->load->view('cetak/v_suratJalan.php',$data); 
	}	
    
	public function tukarFaktur()
	{
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            if($this->session->userdata('id_admin') != '1') redirect (site_url());
            
            $b=0;
            $datas['inject']=0;
            $datas['failedNotif']='';
            $fakturNama=$this->uri->segment(3);
            $fakturTgl=$this->uri->segment(4);
            for($a=5;$a<=15;$a++){
                    $id=$this->uri->segment($a);
                if($id != ''){
                    $penjualanById=$this->m_penjualan->penjualanGetById($id);
                    if($penjualanById != false){
                        if($penjualanById->diskon == 'nominal'){
                            $nom= $penjualanById->nominalFaktur-$penjualanById->jumlahDiskon;
                        }else if($penjualanById->diskon == 'persen'){
                            $nom= $penjualanById->nominalFaktur-($penjualanById->jumlahDiskon*$penjualanById->nominalFaktur/100);
                        }else if ($penjualanById->diskon == 'tidak'){
                            $nom= $penjualanById->nominalFaktur;
                        }
                        $datas[$a]['tanggal']=date("d-M-Y",strtotime($penjualanById->d.'-'.$penjualanById->m.'-'.$penjualanById->y));
                        $datas[$a]['noFaktur']=$penjualanById->noFaktur;
                        $datas[$a]['totalBayar']=$nom;
                        $b++;
                        if($penjualanById->status == 'manual close' || $penjualanById->status == 'ambil uang'){
                            $datas['inject']=1;
                            $datas['failedNotif']='Data Ilegal, Silahkan Hubungi Administrator Website';
                        }
                    }
                }
            }
            $datas['jumlah']=$b;
            
            $penjualanById=$this->m_penjualan->penjualanGetById($this->uri->segment(5));
            $detailClient=$this->m_client->clientGetById($penjualanById->idClient);
            $product=$this->m_product->productGetAll();
            
            $data=array(
                'detailClient'=>$detailClient,
                'datas'=>$datas,
                'product'=>$product,
                'fakturNama'=>$fakturNama,
                'fakturTgl'=>$fakturTgl
            );
            
            $this->load->view('cetak/v_tukarFaktur.php',$data); 
	}	
    
	public function kwitansiForm()
	{
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            if($this->session->userdata('id_admin') != '1') redirect (site_url());
            
            $id=$this->uri->segment(3);
            $fakturNama=$this->uri->segment(4);
            $penjualanById=$this->m_penjualan->penjualanGetById($id);
            $penjualanDetail=$this->m_penjualan->penjualanGetDetail($id);
            $detailClient=$this->m_client->clientGetById($penjualanById->idClient);
            $product=$this->m_product->productGetAll();
//            print_r($penjualanById);
            $data=array(
                'penjualanById'=>$penjualanById,
                'penjualanDetail'=>$penjualanDetail,
                'detailClient'=>$detailClient,
                'product'=>$product,
                'id'=>$id,
                'fakturNama'=>$fakturNama
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js'),'css'=>array('jquery-ui-1.8.22.custom','style'));
            $this->load->view('template/header.php',$header);    
            $this->load->view('cetak/v_kwitansiForm.php',$data);
            $this->load->view('template/footer.php');  
	}
    
	public function kwitansi()
	{
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            if($this->session->userdata('id_admin') != '1') redirect (site_url());
            
            $id=$this->uri->segment(3);
            $fakturNama=$this->uri->segment(4);
            $penjualanById=$this->m_penjualan->penjualanGetById($id);
            $penjualanDetail=$this->m_penjualan->penjualanGetDetail($id);
            $detailClient=$this->m_client->clientGetById($penjualanById->idClient);
            $product=$this->m_product->productGetAll();
            
            $data=array(
                'penjualanById'=>$penjualanById,
                'penjualanDetail'=>$penjualanDetail,
                'detailClient'=>$detailClient,
                'product'=>$product,
                'fakturNama'=>$fakturNama
            );
            
            $this->load->view('cetak/v_kwitansi.php',$data); 
	}
    
	public function kwitansiManualForm()
	{
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            if($this->session->userdata('id_admin') != '1') redirect (site_url());
            
            $id=$this->uri->segment(3);
            $fakturNama=$this->uri->segment(4);
            $penjualanById=$this->m_penjualan->penjualanGetById($id);
            $penjualanDetail=$this->m_penjualan->penjualanGetDetail($id);
            $detailClient=$this->m_client->clientGetById($penjualanById->idClient);
            $product=$this->m_product->productGetAll();
//            print_r($penjualanById);
            $data=array(
                'penjualanById'=>$penjualanById,
                'penjualanDetail'=>$penjualanDetail,
                'detailClient'=>$detailClient,
                'product'=>$product,
                'id'=>$id,
                'fakturNama'=>$fakturNama
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js'),'css'=>array('jquery-ui-1.8.22.custom','style'));
            $this->load->view('template/header.php',$header);    
            $this->load->view('cetak/v_kwitansiManualForm.php',$data);
            $this->load->view('template/footer.php');  
	}
    
	public function kwitansiManual()
	{
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            if($this->session->userdata('id_admin') != '1') redirect (site_url());
            
            $id=$this->uri->segment(3);
            $fakturNama=$this->uri->segment(4);
            $penjualanById=$this->m_penjualan->penjualanGetById($id);
            $penjualanDetail=$this->m_penjualan->penjualanGetDetail($id);
            $detailClient=$this->m_client->clientGetById($penjualanById->idClient);
            $product=$this->m_product->productGetAll();
            
            $data=array(
                'penjualanById'=>$penjualanById,
                'penjualanDetail'=>$penjualanDetail,
                'detailClient'=>$detailClient,
                'product'=>$product,
                'fakturNama'=>$fakturNama
            );
            
            $this->load->view('cetak/v_kwitansiManual.php',$data); 
	}
        
        
}
