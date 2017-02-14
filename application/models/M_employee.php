<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_employee extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	        
         function empGetById($id) {            
            $this->db->where('deleted','0');
            $this->db->where('id',$id);
            $query=$this->db->get('employee');
            if($query->num_rows() != 0) return $query->row(); else return false;
        }        
	        
         function empGetByIdAdmin($id) {            
            $this->db->where('deleted','0');
            $this->db->where('idAdmin',$id);
            $query=$this->db->get('employee');
            if($query->num_rows() != 0) return $query->row(); else return false;
        }        
	        
         function empGetAll() {            
            $this->db->where('deleted','0');
            $this->db->order_by('nama','ASC');
            $query=$this->db->get('employee');
            if($query->num_rows() != 0) return $query->result(); else return false;
        }      
        
        function empAddSave($data) {            
            $this->db->trans_start();
                $array = array_merge($data, ["id_admin" => $this->session->userdata('id_admin')]);
                $this->db->insert('employee',$array);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
        
        function empEditSave($data) {            
            $this->db->trans_start();
                $this->db->where('id',$data['id']);
                $this->db->update('employee',$data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
        
         function empDelete($id) {            
            $this->db->trans_start();
                $this->db->where('id',$id);
                $this->db->set('deleted',1);
                $this->db->update('employee');
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