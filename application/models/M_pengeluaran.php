<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_pengeluaran extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	        
         function pengeluaranGetById($id) {            
            $this->db->where('deleted','0');
            $this->db->where('id',$id);
            $query=$this->db->get('pengeluaran');
            if($query->num_rows() != 0) return $query->row(); else return false;
        }        
	        
         function pengeluaranGetAll() {            
            $this->db->where('deleted','0');
            $this->db->order_by('namaPengeluaran','ASC');
            $query=$this->db->get('pengeluaran');
            if($query->num_rows() != 0) return $query->result(); else return false;
        }      
        
        function pengeluaranAddSave($data) {            
            $this->db->trans_start();
                $array = array_merge($data, ["id_admin" => $this->session->userdata('id_admin')]);
                $this->db->insert('pengeluaran',$array);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
        
        function pengeluaranEditSave($data) {            
            $this->db->trans_start();
                $this->db->where('id',$data['id']);
                $this->db->update('pengeluaran',$data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
        
         function pengeluaranDelete($id) {            
            $this->db->trans_start();
                $this->db->where('id',$id);
                $this->db->set('deleted',1);
                $this->db->update('pengeluaran');
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