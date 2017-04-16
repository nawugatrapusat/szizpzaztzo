<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_agenda extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	        
         function agendaGetById($id) {            
            $this->db->where('id',$id);
            $query=$this->db->get('agenda');
            if($query->num_rows() != 0) return $query->row(); else return false;
        }        
	        
         function agendaGetByDate($m,$y) {            
            $this->db->where('m',$m);        
            $this->db->where('y',$y);
            $query=$this->db->get('agenda');
            if($query->num_rows() != 0) return $query->row(); else return false;
        }        
        
        function agendaAddSave($data) {            
            $this->db->trans_start();
                $this->db->insert('agenda',$data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
        
        function agendaEditSave($data) {            
            $this->db->trans_start();
                $this->db->where('id',$data['id']);
                $this->db->update('agenda',$data);
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