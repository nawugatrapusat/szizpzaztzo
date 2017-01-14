<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	        
        public function validasi($name,$pass) {
            $this->db->where('nama',$name);
            $this->db->where('pass',$pass);
            $query=$this->db->get('admin');
            if($query->num_rows() != 0) return $query->row(); else return false;
        }
        
        public function add_log_login($data) {
            $this->db->trans_start();
        
            $this->db->insert('log_login',$data);
            
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
        
        public function cek_ip($ip) {
            $this->db->where('comp_name',$ip);
            $query=$this->db->get('log_login');
            if($query->num_rows() != 0) return $query->row(); else return false;
        }
        
        public function update_log_login($ip,$count,$block) {
            $this->db->trans_start();
        
            $this->db->set('comp_name',$ip);
            $this->db->set('count',$count);
            $this->db->set('block',$block);
            $this->db->where('comp_name',$ip);
            $this->db->update('log_login');
            
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
        
        public function delete_log_login_from_ip($ip) {
            $this->db->trans_start();
        
            $this->db->where('comp_name',$ip);
            $this->db->delete('log_login');
            
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
        
        public function inc_log_login($ip) {
            $this->db->trans_start();
        
            $this->db->set('count','count+1',false);
            $this->db->update('log_login');
            
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */