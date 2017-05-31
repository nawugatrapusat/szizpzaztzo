<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_rekap extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	        
         function rekapGetAll() {    
            $query=$this->db->get('rekap');
            if($query->num_rows() != 0) return $query->result(); else return false;
        } 
	        
         function rekapGetById($id) {            
            $this->db->where('id',$id);
            $query=$this->db->get('rekap');
            if($query->num_rows() != 0) return $query->row(); else return false;
        }        
	        
         function rekapGetByDate($idE,$m,$y) { 
            $this->db->where('idEmployee',$idE);        
            $this->db->where('m',$m);        
            $this->db->where('y',$y);
            $query=$this->db->get('rekap');
            if($query->num_rows() != 0) return $query->row(); else return false;
        }        
        
        function rekapAddSave($data) {            
            $this->db->trans_start();
                $this->db->insert('rekap',$data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
        
        function rekapEditSave($data) {            
            $this->db->trans_start();
                $this->db->where('id',$data['id']);
                $this->db->update('rekap',$data);
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