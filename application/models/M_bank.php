<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_bank extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	        
         function bankGetById($id) {            
            $this->db->where('deleted','0');
            $this->db->where('id',$id);
            $query=$this->db->get('bank');
            if($query->num_rows() != 0) return $query->row(); else return false;
        }        
	        
         function bankGetAll() {            
            $this->db->where('deleted','0');
            $this->db->order_by('namaBank','ASC');
            $query=$this->db->get('bank');
            if($query->num_rows() != 0) return $query->result(); else return false;
        }      
        
        function bankAddSave($data) {            
            $this->db->trans_start();
                $array = array_merge($data, ["id_admin" => $this->session->userdata('id_admin')]);
                $this->db->insert('bank',$array);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
        
        function bankEditSave($data) {            
            $this->db->trans_start();
                $this->db->where('id',$data['id']);
                $this->db->update('bank',$data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
        
         function bankDelete($id) {            
            $this->db->trans_start();
                $this->db->where('id',$id);
                $this->db->set('deleted',1);
                $this->db->update('bank');
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