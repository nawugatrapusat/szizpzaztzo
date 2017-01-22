<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_client extends CI_Model {

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
	        
         function clientGetById($id) {            
            $this->db->where('deleted','0');
            $this->db->where('id',$id);
            $query=$this->db->get('client');
            if($query->num_rows() != 0) return $query->row(); else return false;
        }        
	        
         function clientPriceGetByIdClient($id) {            
            $this->db->where('deleted','0');
            $this->db->where('idClient',$id);
            $this->db->order_by('id','ASC');
            $query=$this->db->get('clientprice');
            if($query->num_rows() != 0) return $query->result(); else return false;
        }
        
         function clientGetAll() {            
            $this->db->where('deleted','0');
            $this->db->order_by('nama','ASC');
            $query=$this->db->get('client');
            if($query->num_rows() != 0) return $query->result(); else return false;
        }
        
        function clientAddSave($data) {  
            
            $this->db->trans_start();
            $client=new stdClass();
            $client->nama=$data['nama'];
            $client->alamat=$data['alamat'];
            $client->noTelp=$data['noTelp'];
            $client->noHp=$data['noHp'];
            $client->picPembelian=$data['picPembelian'];
            $client->picTagihan=$data['picTagihan'];
            $client->id_admin=$this->session->userdata('id_admin');
            
                $this->db->insert('client',$client);
                $insertId=$this->db->insert_id();
            
            for($a=1;$a<=5;$a++){
                $clientPrice=new stdClass();
                $clientPrice->idClient=$insertId;
                $clientPrice->idProduct=$data['clientPriceProduct'.$a];
                $clientPrice->hargaJual=$data['hargaJual'.$a];
                $clientPrice->id_admin=$this->session->userdata('id_admin');
                $this->db->insert('clientprice',$clientPrice);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
        
        function clientEditSave($data) {   
            
            $this->db->trans_start();
            $client=new stdClass();
            $client->nama=$data['nama'];
            $client->alamat=$data['alamat'];
            $client->noTelp=$data['noTelp'];
            $client->noHp=$data['noHp'];
            $client->picPembelian=$data['picPembelian'];
            $client->picTagihan=$data['picTagihan'];
            $client->id=$data['id'];
            
                $this->db->where('id',$client->id);
                $this->db->update('client',$client);
            
            for($a=1;$a<=5;$a++){
                if($data['idClientPrice'.$a] == ''){
                    $clientPrice=new stdClass();
                    $clientPrice->idClient=$client->id;
                    $clientPrice->idProduct=$data['clientPriceProduct'.$a];
                    $clientPrice->hargaJual=$data['hargaJual'.$a];
                    $this->db->insert('clientprice',$clientPrice);
                }else{
                    $clientPrice=new stdClass();
                    $clientPrice->id=$data['idClientPrice'.$a];
                    $clientPrice->idProduct=$data['clientPriceProduct'.$a];
                    $clientPrice->hargaJual=$data['hargaJual'.$a];

                    $this->db->where('id',$clientPrice->id);
                    $this->db->update('clientprice',$clientPrice);
                }
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
        
        function clientPriceAdd($data) {  
            $data1=new stdClass();
            $data1->idClient=$data;
            
            $this->db->trans_start();
                $this->db->insert('clientprice',$data1);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
        
         function clientDelete($id) {            
            $this->db->trans_start();
                $this->db->where('id',$id);
                $this->db->set('deleted',1);
                $this->db->update('client');
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