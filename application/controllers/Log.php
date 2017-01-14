<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

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
                $this->load->model('m_produk', '', TRUE);
	}
    
	public function index()
	{
            if($this->session->userdata('id_admin') == '') redirect (site_url());
                        
            $all_produk=$this->m_produk->get_all_produk() == false ? '' : $this->m_produk->get_all_produk();
            
            $data=array(
                'all_produk'=>$all_produk
            );
            
            $header = array('css'=>array('flexigrid.pack','jquery-ui-1.8.22.custom','style'),'js'=>array('jquery-ui-1.8.22.custom.min','flexigrid.pack','cookie','js'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('v_log.php',$data);
            $this->load->view('template/footer.php');  
	}	
        
        
}
