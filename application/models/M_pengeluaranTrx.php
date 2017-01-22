<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_pengeluarantrx extends CI_Model {

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
	        
         function pengeluarantrxGetById($id) {            
            $this->db->where('deleted','0');
            $this->db->where('id',$id);
            $query=$this->db->get('pengeluarantrx');
            if($query->num_rows() != 0) return $query->row(); else return false;
        }        
	        
         function pengeluarantrxGetAll() {            
            $this->db->where('deleted','0');
            $this->db->order_by('date','desc');
            $query=$this->db->get('pengeluarantrx');
            if($query->num_rows() != 0) return $query->result(); else return false;
        }      
        
        function pengeluarantrxAddSave($data) {   
            $subs_date= explode('-', date("d-m-Y")); 
            $pengeluarantrx=new stdClass();     
            
            $this->db->trans_start();
            $pengeluarantrx->idPengeluaran=$data['idPengeluaran'];
            $pengeluarantrx->d=$subs_date[0];
            $pengeluarantrx->m=$subs_date[1];
            $pengeluarantrx->y=$subs_date[2];
            $pengeluarantrx->date=time();
            $pengeluarantrx->time=  date("d-m-Y H:i:s");
            $pengeluarantrx->id_admin=$this->session->userdata('id_admin');
            $pengeluarantrx->keterangan=$data['keterangan'];
            $pengeluarantrx->jumlah=$data['jumlah'];
            
                $this->db->insert('pengeluarantrx',$pengeluarantrx);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
        
        function pengeluarantrxEditSave($data) {      
            $pengeluarantrx=new stdClass();
            
            $this->db->trans_start();
            $pengeluarantrx->id=$data['id'];
            $pengeluarantrx->idPengeluaran=$data['idPengeluaran'];
            $pengeluarantrx->keterangan=$data['keterangan'];
            $pengeluarantrx->jumlah=$data['jumlah'];
            
                $this->db->where('id',$pengeluarantrx->id);
                $this->db->update('pengeluarantrx',$pengeluarantrx);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
        
         function pengeluarantrxDelete($id) {            
            $this->db->trans_start();
                $this->db->where('id',$id);
                $this->db->set('deleted',1);
                $this->db->update('pengeluarantrx');
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