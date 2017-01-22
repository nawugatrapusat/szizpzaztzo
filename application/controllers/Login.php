<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
                $this->load->model('m_login', '', TRUE);
                $this->load->model('m_log', '', TRUE);
	}
    
	public function index()
	{
            $this->session->userdata('id_admin','');
            $this->session->sess_destroy();
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js'),'css'=>array('jquery-ui-1.8.22.custom','style'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('v_login.php');
            $this->load->view('template/footer.php');  
	}	
        
        public function Verif()
	{
            if($_POST){
                $name=$this->input->post('user');
                $pass=do_hash($this->input->post('pwd'),'md5');
                $det=$this->m_login->validasi($name,$pass);
                if($det != false){
                    $this->session->set_userdata('id_admin',$det->id);
                    $this->m_log->insert_log('Login','Sukses Login, Nama : '.php_uname('n').', IP '.$this->input->ip_address().' - '.$this->input->post());
                    redirect('beranda');
                }else{
                    $this->m_log->insert_log('Login','Gagal Login, Nama : '.php_uname('n').', IP '.$this->input->ip_address().' - '.$this->input->post());
                    $this->input->set_cookie('notif','0',time()+6000);
                    redirect('login');
                }
            }else{
                redirect('login');
            }
	}
        
        
}
