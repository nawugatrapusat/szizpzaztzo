<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_penjualan extends CI_Model {

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
        
        function penjualanGetById($id) {            
            $this->db->where('deleted','0');
            $this->db->where('id',$id);
            $query=$this->db->get('penjualan');
            if($query->num_rows() != 0) return $query->row(); else return false;
        }  
        
        function TFGetByIdPenjualan($id) {            
            $this->db->where('deleted','0');
            $this->db->where('idPenjualan',$id);
            $query=$this->db->get('tukarfaktur');
            if($query->num_rows() != 0) return $query->row(); else return false;
        }  
        
        function AUGetByIdPenjualan($id) {            
            $this->db->where('deleted','0');
            $this->db->where('idPenjualan',$id);
            $query=$this->db->get('ambiluang');
            if($query->num_rows() != 0) return $query->row(); else return false;
        }  
        
        function penjualanNo($m,$y) {            
//            $this->db->where('m',$m);             
            $this->db->where('deleted','0');
            $this->db->where('y',$y);
            $this->db->order_by('no','DESC');
            $query=$this->db->get('penjualan');
            $no=$query->first_row();
            if($query->num_rows() != 0) return $no->no; else return false;
        }  
        
        function penjualanGetAll() {            
            $this->db->where('deleted','0');
            $this->db->order_by('id','DESC');
            $query=$this->db->get('penjualan');
            if($query->num_rows() != 0) return $query->result(); else return false;
        }      
	        
        function penjualanGetDetail($id) {            
            $this->db->where('deleted','0');
            $this->db->where('idPenjualan',$id);
            $this->db->order_by('id','ASC');
            $query=$this->db->get('penjualandetail');
            if($query->num_rows() != 0) return $query->result(); else return false;
        }
        
        function penjualanAddSave($data) {
            $tglFaktur=explode('-',$data['tanggalFaktur']);
            $subs_date= explode('-', date("d-m-Y"));
            $subs_dateFaktur= explode('-', date("d-m-y"));
            $no=$this->penjualanNo($subs_dateFaktur[1],$subs_date[2]);
            $no1 = $no == false ? 1 : $no+1;
            $no2=str_pad($no1, 4, '0', STR_PAD_LEFT);
            
            $this->db->trans_start();
            
            $penjualan=new stdClass();
            $penjualan->no=$no1;
            $penjualan->noFaktur=$subs_dateFaktur[2].$subs_dateFaktur[1].$no2;
            $penjualan->noPo=$data['noPo'];
            $penjualan->idClient=$data['idClient'];
            $penjualan->idEmployeePic=$data['idEmployeePic'];
            $penjualan->hash=substr(md5($penjualan->noFaktur), 0, 8);
            $penjualan->d=$tglFaktur[0];
            $penjualan->m=$tglFaktur[1];
            $penjualan->y=$tglFaktur[2];
            $penjualan->date=time();
            $penjualan->time=  date("d-m-Y H:i:s");
            $penjualan->diskon=$data['diskon'];
            $penjualan->jumlahDiskon=$data['jumlahDiskon'];
            $penjualan->id_admin=$this->session->userdata('id_admin');
            $penjualan->keterangan=$data['keterangan'];
            $penjualan->status='kirim barang';
            
                $this->db->insert('penjualan',$penjualan);
                $insertId=$this->db->insert_id();
            
            $nominalFaktur=0;
            for($a=1;$a<=50;$a++){
                if($data['idProduct'.$a] != '' && $data['hargaBeli'.$a] != '' && $data['hargaJual'.$a] != '' && $data['jumlah'.$a] != ''){
                    $penjualandetail=new stdClass();
                    $penjualandetail->idPenjualan=$insertId;
                    $penjualandetail->idProduct=$data['idProduct'.$a];
                    $penjualandetail->hargaBeli=$data['hargaBeli'.$a];
                    $penjualandetail->hargaJual=$data['hargaJual'.$a];
                    $penjualandetail->hargaEmployee=$data['hargaEmployee'.$a];
                    $penjualandetail->scheme=$data['scheme'.$a];
                    $penjualandetail->jumlah=$data['jumlah'.$a];
                    $penjualandetail->id_admin=$this->session->userdata('id_admin');
                    $this->db->insert('penjualandetail',$penjualandetail);
                    $nominalFaktur=$nominalFaktur+($penjualandetail->hargaJual*$penjualandetail->jumlah);
                }
            }
            $updatePenjualan=new stdClass();
            $updatePenjualan->nominalFaktur=$nominalFaktur;
            $this->db->where('id',$insertId);
            $this->db->update('penjualan',$updatePenjualan);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
        
        function penjualanEditSave($data) {   
            $this->db->trans_start();
            $subs_date= explode('-', date("d-m-Y"));
            $tglFaktur=explode('-',$data['tanggalFaktur']);
            
            $penjualan=new stdClass();
            $penjualan->d=$tglFaktur[0];
            $penjualan->m=$tglFaktur[1];
            $penjualan->y=$tglFaktur[2];
            $penjualan->noPo=$data['noPo'];
            $penjualan->idClient=$data['idClient'];
            $penjualan->idEmployeePic=$data['idEmployeePic'];
            $penjualan->keterangan=$data['keterangan'];
            $penjualan->id=$data['id'];
            $penjualan->diskon=$data['diskon'];
            $penjualan->jumlahDiskon=empty($data['jumlahDiskon']) ? '' : $data['jumlahDiskon'];
            
                $this->db->where('id',$penjualan->id);
                $this->db->update('penjualan',$penjualan);
            
            $nominalFaktur=0;
            for($a=1;$a<=50;$a++){
                if($data['id'.$a] == ''){
                    if($data['idProduct'.$a] != '' && $data['hargaBeli'.$a] != '' && $data['hargaJual'.$a] != '' && $data['jumlah'.$a] != ''){
                        $penjualandetail=new stdClass();
                        $penjualandetail->idPenjualan=$penjualan->id;
                        $penjualandetail->idProduct=$data['idProduct'.$a];
                        $penjualandetail->hargaBeli=$data['hargaBeli'.$a];
                        $penjualandetail->hargaJual=$data['hargaJual'.$a];
                        $penjualandetail->hargaEmployee=$data['hargaEmployee'.$a];
                        $penjualandetail->scheme=$data['scheme'.$a];
                        $penjualandetail->jumlah=$data['jumlah'.$a];
                        $penjualandetail->id_admin=$this->session->userdata('id_admin');
                        
                        $nominalFaktur=$nominalFaktur+($penjualandetail->hargaJual*$penjualandetail->jumlah);
                
                        $this->db->insert('penjualandetail',$penjualandetail);
                    }
                }else{
                    $penjualandetail=new stdClass();
                    $penjualandetail->id=$data['id'.$a];
                    $penjualandetail->idProduct=$data['idProduct'.$a];
                    $penjualandetail->hargaBeli=$data['hargaBeli'.$a];
                    $penjualandetail->hargaJual=$data['hargaJual'.$a];
                    $penjualandetail->hargaEmployee=$data['hargaEmployee'.$a];
                    $penjualandetail->scheme=$data['scheme'.$a];
                    $penjualandetail->jumlah=$data['jumlah'.$a];
                    $penjualandetail->id_admin=$this->session->userdata('id_admin');

                    $nominalFaktur=$nominalFaktur+($penjualandetail->hargaJual*$penjualandetail->jumlah);
                    
                    $this->db->where('id',$penjualandetail->id);
                    $this->db->update('penjualandetail',$penjualandetail);
                }
            }
            $updatePenjualan=new stdClass();
            $updatePenjualan->nominalFaktur=$nominalFaktur;
            $this->db->where('id',$penjualan->id);
            $this->db->update('penjualan',$updatePenjualan);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
        
         function penjualanDelete($id) {            
            $this->db->trans_start();
                $this->db->where('id',$id);
                $this->db->set('deleted',1);
                $this->db->update('penjualan');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
        
        function tukarFakturGetByIdPenjualan($id) {            
            $this->db->where('deleted','0');
            $this->db->where('idPenjualan',$id);
            $query=$this->db->get('tukarfaktur');
            if($query->num_rows() != 0) return $query->row(); else return false;
        }  
        
        function ambilUangGetByIdPenjualan($id) {            
            $this->db->where('deleted','0');
            $this->db->where('idPenjualan',$id);
            $query=$this->db->get('ambiluang');
            if($query->num_rows() != 0) return $query->row(); else return false;
        }  
        
        function TFAUAddSave($data) {  
            $penjualan=new stdClass();
            $dataPenjualan=new stdClass();
            
            $this->db->trans_start();
            $penjualan->idPenjualan=$data['idPenjualan'];
            $penjualan->idEmployeePic=$data['idEmployeePic'];
            $penjualan->date=time();
            $penjualan->time=  date("d-m-Y H:i:s");
            $penjualan->id_admin=$this->session->userdata('id_admin');
            $penjualan->keterangan=$data['keterangan'];
            
            if($data['typeForm'] == 'tukarfaktur'){
                $tglTF=explode('-',$data['tanggalTF']);
                $dataPenjualan->status='tukar faktur';
                $penjualan->tanggalKembali=$data['tanggalKembali'];
                $penjualan->d=$tglTF[0];
                $penjualan->m=$tglTF[1];
                $penjualan->y=$tglTF[2];
                
                $this->db->where('id',$data['idPenjualan']);
                $this->db->update('penjualan',$dataPenjualan);
                $this->db->insert('tukarfaktur',$penjualan);
            }else{
                $tglAU=explode('-',$data['tanggalAU']);
                $penjualan->d=$tglAU[0];
                $penjualan->m=$tglAU[1];
                $penjualan->y=$tglAU[2];
                
                $dataPenjualan->status=$data['status'];
                $dataPenjualan->nominal=$data['nominal'];
                $dataPenjualan->biayaLain=$data['biayaLain'] == '' ? '0' : $data['biayaLain'];
                $dataPenjualan->tipePembayaran=$data['tipePembayaran'];
                $dataPenjualan->idBank=$data['idBank'];
                $dataPenjualan->noGiro=$data['noGiro'];
                if($dataPenjualan->status == 'ambil uang'){
                    $dataPenjualan->totalBayar=$data['totalBayar']-$dataPenjualan->biayaLain;
                }if($dataPenjualan->status == 'manual close' ){
                    $dataPenjualan->totalBayar=$data['nominal']-$dataPenjualan->biayaLain;
                }
                $this->db->where('id',$data['idPenjualan']);
                $this->db->update('penjualan',$dataPenjualan);
                $this->db->insert('ambiluang',$penjualan);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
        
        function TFAUEditSave($data) {            
            $penjualan=new stdClass();
            $dataPenjualan=new stdClass();
            
            $this->db->trans_start();
            $penjualan->idEmployeePic=$data['idEmployeePic'];
            $penjualan->keterangan=$data['keterangan'];
            if($data['typeForm'] == 'tukarfaktur'){
                $penjualan->tanggalKembali=$data['tanggalKembali'];
                $this->db->where('id',$data['idTFAU']);
                $this->db->update('tukarfaktur',$penjualan);
            }else{
//                $dataPenjualan->status=$data['status'];
//                $dataPenjualan->nominal=$data['nominal'];
//                $dataPenjualan->biayaLain=$data['biayaLain'];
//                $dataPenjualan->tipePembayaran=$data['tipePembayaran'];
//                $dataPenjualan->idBank=$data['idBank'];
//                $dataPenjualan->noGiro=$data['noGiro'];
//                
//                $this->db->where('id',$data['idPenjualan']);
//                $this->db->update('penjualan',$dataPenjualan);
//                $this->db->where('id',$data['idTFAU']);
//                $this->db->update('ambiluang',$penjualan);
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }else{
                return true;
            }
        }
        
        function histPenjualan($p,$pd) {
            $this->db->trans_start();
            
            $this->db->where('idPenjualan',$p->id);
            $this->db->delete('histpenjualan');
            $this->db->where('idPenjualan',$p->id);
            $this->db->delete('histpenjualandetail');
            
            $penjualan=new stdClass();
            $penjualan->idPenjualan=$p->id;
            $penjualan->no=$p->no;
            $penjualan->noFaktur=$p->noFaktur;
            $penjualan->noPo=$p->noPo;
            $penjualan->idClient=$p->idClient;
            $penjualan->idEmployeePic=$p->idEmployeePic;
            $penjualan->hash=$p->hash;
            $penjualan->d=$p->d;
            $penjualan->m=$p->m;
            $penjualan->y=$p->y;
            $penjualan->date=$p->date;
            $penjualan->time=$p->time;
            $penjualan->id_admin=$p->id_admin;
            $penjualan->keterangan=$p->keterangan;
            $penjualan->diskon=$p->diskon;
            $penjualan->jumlahDiskon=$p->jumlahDiskon;
            $penjualan->tipePembayaran=$p->tipePembayaran;
            $penjualan->idBank=$p->idBank;
            $penjualan->noGiro=$p->noGiro;
            $penjualan->status=$p->status;
            $penjualan->nominal=$p->nominal;
            $penjualan->biayaLain=$p->biayaLain;
            $penjualan->nominalFaktur=$p->nominalFaktur;
            $penjualan->totalBayar=$p->totalBayar;
            
            $this->db->insert('histpenjualan',$penjualan);
            
            foreach($pd as $detail){
                $penjualandetail=new stdClass();
                $penjualandetail->idPenjualanDetail=$detail->id;
                $penjualandetail->idPenjualan=$detail->idPenjualan;
                $penjualandetail->idProduct=$detail->idProduct;
                $penjualandetail->hargaBeli=$detail->hargaBeli;
                $penjualandetail->hargaJual=$detail->hargaJual;
                $penjualandetail->hargaEmployee=$detail->hargaEmployee;
                $penjualandetail->scheme=$detail->scheme;
                $penjualandetail->jumlah=$detail->jumlah;
                $penjualandetail->id_admin=$detail->id_admin;

                $this->db->insert('histpenjualandetail',$penjualandetail);
            }
                    
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