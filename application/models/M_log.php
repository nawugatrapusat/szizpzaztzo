<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_log extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	        
        public function insert_log($ca,$ac) {
            $this->db->trans_start();
        
            $this->db->set('d',date('d'));
            $this->db->set('m',date('m'));
            $this->db->set('y',date('Y'));
            $this->db->set('date',time());
            $this->db->set('time',unix_to_human(time()));
            $this->db->set('category',$ca);
            $this->db->set('activity',$ac);
            $this->db->insert('log');
            
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
	        
        public function get_count_query($q) {
            $query=$this->db->query($q);
            return $query->num_rows();
        }

        public function get_query($q) {
            $query=$this->db->query($q);
            if($query->num_rows() > 0) return $query->result(); else return false;
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */