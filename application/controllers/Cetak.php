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
            
            $id=$this->uri->segment(3);
            $penjualanById=$this->m_penjualan->penjualanGetById($id);
            $penjualanDetail=$this->m_penjualan->penjualanGetDetail($id);
            $detailClient=$this->m_client->clientGetById($penjualanById->idClient);
            $product=$this->m_product->productGetAll();
            
            $data=array(
                'penjualanById'=>$penjualanById,
                'penjualanDetail'=>$penjualanDetail,
                'detailClient'=>$detailClient,
                'product'=>$product
            );
            
            $this->load->view('cetak/v_faktur.php',$data); 
	}	
        
        
}
