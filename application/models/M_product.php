<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_product extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
        
        function get_count_query($q) {
            $query=$this->db->query($q);
            return $query->num_rows();
        }

        function get_query($q) {
            $query=$this->db->query($q);
            if($query->num_rows() > 0) return $query->result(); else return false;
        }
	        
         function productGetById($id) {            
            $this->db->where('deleted','0');
            $this->db->where('id',$id);
            $query=$this->db->get('product');
            if($query->num_rows() != 0) return $query->row(); else return false;
        }        
	        
         function productGetAll() {            
            $this->db->where('deleted','0');
            $this->db->order_by('nama','ASC');
            $query=$this->db->get('product');
            if($query->num_rows() != 0) return $query->result(); else return false;
        }      
	        
         function productGetAllAll() {         
            $this->db->order_by('nama','ASC');
            $query=$this->db->get('product');
            if($query->num_rows() != 0) return $query->result(); else return false;
        }      
        
        function productAddSave($data) {            
            $this->db->trans_start();
                $array = array_merge($data, ["id_admin" => $this->session->userdata('id_admin')]);
                $this->db->insert('product',$array);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
        
        function productEditSave($data) {            
            $this->db->trans_start();
                $this->db->where('id',$data['id']);
                $this->db->update('product',$data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
        
        function productUpdate($id,$data) {
            $this->db->trans_start();
        
            $this->db->where('id',$id);
            $this->db->update('product',$data);
            
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
        
         function productDelete($id) {            
            $this->db->trans_start();
                $this->db->where('id',$id);
                $this->db->set('deleted',1);
                $this->db->update('product');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
        
        function productStockFormSave($id,$data) {            
            $this->db->trans_start();
                $this->db->where('id',$id);
                $this->db->update('product',$data);
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