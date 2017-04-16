<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
                date_default_timezone_set('Asia/Jakarta');
                $this->load->model('m_log', '', TRUE);
                $this->load->model('m_agenda', '', TRUE);
	}
        
        
    
	public function index()
	{
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            
            $agenda1=$this->m_agenda->agendaGetByDate(date('m'),date('Y'));
            $agenda2=$this->m_agenda->agendaGetByDate(date('m', strtotime('+1 month')),date('Y', strtotime('+1 month')));
            if($agenda2 == false) {
                $dataInsert=new stdClass();
                $dataInsert->m=date('m', strtotime('+1 month'));
                $dataInsert->y=date('Y', strtotime('+1 month'));
                $this->m_agenda->agendaAddSave($dataInsert);
                $agenda2=$this->m_agenda->agendaGetByDate(date('m', strtotime('+1 month')),date('Y', strtotime('+1 month')));
            }
            $date1=date('m')."-".date('Y');
            $date2=date('m', strtotime('+1 month'))."-".date('Y', strtotime('+1 month'));
            $dayAgenda1 = date("l", strtotime(date('Y')."-".date('m')."-1"));
            $dayAgenda2 = date("l", strtotime(date('Y', strtotime('+1 month'))."-".date('m', strtotime('+1 month'))."-1"));
            $daysAgenda1=cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
            $daysAgenda2=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime('+1 month')),date('Y', strtotime('+1 month')));
            
//            if($this->m_penjualan->histPenjualan($penjualanById,$penjualanDetail) != false){
//                $this->m_log->insert_log('Hist Penjualan',json_encode((array_merge(["statusAction" => 'sukses'],$penjualanDetail))));
//            }else{
//                $this->m_log->insert_log('Hist Penjualan',json_encode((array_merge(["statusAction" => 'sukses'],$penjualanDetail))));
//            }
            $data=array(
                'agenda1'=>$agenda1,
                'agenda2'=>$agenda2,
                'dayAgenda1'=>$dayAgenda1,
                'dayAgenda2'=>$dayAgenda2,
                'daysAgenda1'=>$daysAgenda1,
                'daysAgenda2'=>$daysAgenda2,
                'date1'=>$date1,
                'date2'=>$date2,
                'bulanNow'=>$this->namaBulan(date('m')).'-'.date('Y'),
                'bulanNext'=>$this->namaBulan(date('m', strtotime('+1 month'))).'-'.date('Y', strtotime('+1 month'))
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js'),'css'=>array('jquery-ui-1.8.22.custom','style',));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('agenda/v_agenda.php',$data); 
            $this->load->view('template/footer.php');  
	}	
        
        
        function agendaForm(){
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            
            $tab=$this->uri->segment(3);
            $date=$this->uri->segment(4);
            $exDate= explode('-', $date);
            $dateDetail=$this->m_agenda->agendaGetByDate($exDate[1],$exDate[2]);
            $data=array(
                'dateDetail'=>$dateDetail,
                'exDate'=>$exDate,
                'tanggal'=>$exDate[0].'-'.$this->namaBulan(date('m')).'-'.date('Y'),
                'tab'=>$tab
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js'),'css'=>array('jquery-ui-1.8.22.custom','style'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('agenda/v_agendaForm.php',$data);
            $this->load->view('template/footer.php');  
        }
        
        function agendaFormSave(){
            $this->load->view('v_loading.php');
                
            if($this->input->post()){
                $tab=$this->uri->segment(3);
                echo $tab;
                $t=$this->input->post('day');
                $data=array();
                $data['id']=$this->input->post('id');
                $data[$t]= str_replace("\n","<br/>",$this->input->post('isi'));
                if($this->m_agenda->agendaEditSave($data) != false){
                    $this->m_log->insert_log('simpan agenda',json_encode((array_merge(["statusAction" => 'sukses'],$data))));
                    $this->input->set_cookie('successNotif','Sukses Tambah Data',time()+6000);
                }else{
                    $this->m_agenda->insert_log('simpan agenda',json_encode((array_merge(["statusAction" => 'gagal'],$data))));
                    $this->input->set_cookie('failedNotif','Tambah Data Gagal !!!',time()+6000);
                }
                $this->input->set_cookie('tab',$tab,time()+6000);
                redirect(site_url('agenda'));
            }else{
                redirect('login');
            }
        }
        
        function namaBulan($a){
            if($a == 1) return 'Januari';
            if($a == 2) return 'Februari';
            if($a == 3) return 'Maret';
            if($a == 4) return 'April';
            if($a == 5) return 'Mei';
            if($a == 6) return 'Juni';
            if($a == 7) return 'Juli';
            if($a == 8) return 'Agustus';
            if($a == 9) return 'September';
            if($a == 10) return 'Oktober';
            if($a == 11) return 'November';
            if($a == 12) return 'Desember';
        }
        
        
        
        
    
	public function suratJalan()
	{
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            if($this->session->userdata('id_admin') != '1') redirect (site_url());
            
            $id=$this->uri->segment(3);
            $fakturNama=$this->uri->segment(4);
            $penjualanById=$this->m_penjualan->penjualanGetById($id);
            $penjualanDetail=$this->m_penjualan->penjualanGetDetail($id);
            $detailClient=$this->m_client->clientGetById($penjualanById->idClient);
            $product=$this->m_product->productGetAll();
            
            $data=array(
                'penjualanById'=>$penjualanById,
                'penjualanDetail'=>$penjualanDetail,
                'detailClient'=>$detailClient,
                'product'=>$product,
                'fakturNama'=>$fakturNama
            );
            
            $this->load->view('cetak/v_suratJalan.php',$data); 
	}	
    
	public function tukarFaktur()
	{
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            if($this->session->userdata('id_admin') != '1') redirect (site_url());
            
            $b=0;
            $datas['inject']=0;
            $datas['failedNotif']='';
            $fakturNama=$this->uri->segment(3);
            $fakturTgl=$this->uri->segment(4);
            for($a=5;$a<=15;$a++){
                    $id=$this->uri->segment($a);
                if($id != ''){
                    $penjualanById=$this->m_penjualan->penjualanGetById($id);
                    if($penjualanById != false){
                        if($penjualanById->diskon == 'nominal'){
                            $nom= $penjualanById->nominalFaktur-$penjualanById->jumlahDiskon;
                        }else if($penjualanById->diskon == 'persen'){
                            $nom= $penjualanById->nominalFaktur-($penjualanById->jumlahDiskon*$penjualanById->nominalFaktur/100);
                        }else if ($penjualanById->diskon == 'tidak'){
                            $nom= $penjualanById->nominalFaktur;
                        }
                        $datas[$a]['tanggal']=date("d-M-Y",strtotime($penjualanById->d.'-'.$penjualanById->m.'-'.$penjualanById->y));
                        $datas[$a]['noFaktur']=$penjualanById->noFaktur;
                        $datas[$a]['totalBayar']=$nom;
                        $b++;
                        if($penjualanById->status == 'manual close' || $penjualanById->status == 'ambil uang'){
                            $datas['inject']=1;
                            $datas['failedNotif']='Data Ilegal, Silahkan Hubungi Administrator Website';
                        }
                    }
                }
            }
            $datas['jumlah']=$b;
            
            $penjualanById=$this->m_penjualan->penjualanGetById($this->uri->segment(5));
            $detailClient=$this->m_client->clientGetById($penjualanById->idClient);
            $product=$this->m_product->productGetAll();
            
            $data=array(
                'detailClient'=>$detailClient,
                'datas'=>$datas,
                'product'=>$product,
                'fakturNama'=>$fakturNama,
                'fakturTgl'=>$fakturTgl
            );
            
            $this->load->view('cetak/v_tukarFaktur.php',$data); 
	}	
    
	public function kwitansiForm()
	{
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            if($this->session->userdata('id_admin') != '1') redirect (site_url());
            
            $id=$this->uri->segment(3);
            $fakturNama=$this->uri->segment(4);
            $penjualanById=$this->m_penjualan->penjualanGetById($id);
            $penjualanDetail=$this->m_penjualan->penjualanGetDetail($id);
            $detailClient=$this->m_client->clientGetById($penjualanById->idClient);
            $product=$this->m_product->productGetAll();
//            print_r($penjualanById);
            $data=array(
                'penjualanById'=>$penjualanById,
                'penjualanDetail'=>$penjualanDetail,
                'detailClient'=>$detailClient,
                'product'=>$product,
                'id'=>$id,
                'fakturNama'=>$fakturNama
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js'),'css'=>array('jquery-ui-1.8.22.custom','style'));
            $this->load->view('template/header.php',$header);    
            $this->load->view('cetak/v_kwitansiForm.php',$data);
            $this->load->view('template/footer.php');  
	}
    
	public function kwitansi()
	{
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            if($this->session->userdata('id_admin') != '1') redirect (site_url());
            
            $id=$this->uri->segment(3);
            $fakturNama=$this->uri->segment(4);
            $penjualanById=$this->m_penjualan->penjualanGetById($id);
            $penjualanDetail=$this->m_penjualan->penjualanGetDetail($id);
            $detailClient=$this->m_client->clientGetById($penjualanById->idClient);
            $product=$this->m_product->productGetAll();
            
            $data=array(
                'penjualanById'=>$penjualanById,
                'penjualanDetail'=>$penjualanDetail,
                'detailClient'=>$detailClient,
                'product'=>$product,
                'fakturNama'=>$fakturNama
            );
            
            $this->load->view('cetak/v_kwitansi.php',$data); 
	}
    
	public function kwitansiManualForm()
	{
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            if($this->session->userdata('id_admin') != '1') redirect (site_url());
            
            $id=$this->uri->segment(3);
            $fakturNama=$this->uri->segment(4);
            $penjualanById=$this->m_penjualan->penjualanGetById($id);
            $penjualanDetail=$this->m_penjualan->penjualanGetDetail($id);
            $detailClient=$this->m_client->clientGetById($penjualanById->idClient);
            $product=$this->m_product->productGetAll();
//            print_r($penjualanById);
            $data=array(
                'penjualanById'=>$penjualanById,
                'penjualanDetail'=>$penjualanDetail,
                'detailClient'=>$detailClient,
                'product'=>$product,
                'id'=>$id,
                'fakturNama'=>$fakturNama
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js'),'css'=>array('jquery-ui-1.8.22.custom','style'));
            $this->load->view('template/header.php',$header);    
            $this->load->view('cetak/v_kwitansiManualForm.php',$data);
            $this->load->view('template/footer.php');  
	}
    
	public function kwitansiManual()
	{
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            if($this->session->userdata('id_admin') != '1') redirect (site_url());
            
            $id=$this->uri->segment(3);
            $fakturNama=$this->uri->segment(4);
            $penjualanById=$this->m_penjualan->penjualanGetById($id);
            $penjualanDetail=$this->m_penjualan->penjualanGetDetail($id);
            $detailClient=$this->m_client->clientGetById($penjualanById->idClient);
            $product=$this->m_product->productGetAll();
            
            $data=array(
                'penjualanById'=>$penjualanById,
                'penjualanDetail'=>$penjualanDetail,
                'detailClient'=>$detailClient,
                'product'=>$product,
                'fakturNama'=>$fakturNama
            );
            
            $this->load->view('cetak/v_kwitansiManual.php',$data); 
	}
        
        
}
