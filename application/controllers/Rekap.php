<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap extends CI_Controller {

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
                $this->load->model('m_rekap', '', TRUE);
                $this->load->model('m_employee', '', TRUE);
	}
        
        
    
	public function index()
	{
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            
            $emp=$this->m_employee->empGetAll();
            $a=1;
            $agendax='';
            foreach ($emp as $hasil) {
                $ag=$this->m_rekap->rekapGetByDate($hasil->id,date('m'),date('Y'));
                if($ag == false) {
                    $dataInsert=new stdClass();
                    $dataInsert->idEmployee=$hasil->id;
                    $dataInsert->m=date('m');
                    $dataInsert->y=date('Y');
                    $this->m_rekap->rekapAddSave($dataInsert);
                    $ag=$this->m_rekap->rekapGetByDate($hasil->id,date('m'),date('Y'));
                }
                if($a == 1)  $agenda1=$ag;
                if($a == 2)  $agenda2=$ag;
                if($a == 3)  $agenda3=$ag;
                if($this->session->userdata('id_admin') == $hasil->idAdmin) $agendax=$ag;
                
                $a++;
            }
            
            $date=date('m')."-".date('Y');
            if($this->input->post('kustBulan') != '' && $this->input->post('kustTahun') != ''){
                $date=$this->input->post('kustBulan')."-".$this->input->post('kustTahun');
            }
            $dayAgenda = date("l", strtotime(date('Y')."-".date('m')."-1"));
            $daysAgenda=cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
            
            $agendaKust='';
            $kustEmployee=get_cookie('kustEmployee') != '' ? get_cookie('kustEmployee') : $this->input->post('kustEmployee');
            $kustBulan=get_cookie('kustBulan') != '' ? get_cookie('kustBulan') : $this->input->post('kustBulan');
            $kustTahun=get_cookie('kustTahun') != '' ? get_cookie('kustTahun') : $this->input->post('kustTahun');   
            if($this->input->post('kustBulan') != '' && $this->input->post('kustTahun') != ''){
                $date=$this->input->post('kustBulan')."-".$this->input->post('kustTahun');
            }
            if($kustBulan != '' && $kustTahun != ''){
                $date=$kustBulan."-".$kustTahun;
            }
            delete_cookie('kustEmployee');
            delete_cookie('kustBulan');
            delete_cookie('kustTahun');
            if($kustEmployee != ''){
                $agendaKust=$this->m_rekap->rekapGetByDate($kustEmployee,$kustBulan,$kustTahun);
            }
            $data=array(
                'agenda1'=>$agenda1,
                'agenda2'=>$agenda2,
                'agenda3'=>$agenda3,
                'agendax'=>$agendax,
                'agendaKust'=>$agendaKust,
                'dayAgenda'=>$dayAgenda,
                'daysAgenda'=>$daysAgenda,
                'date'=>$date,
                'bulanNow'=>$this->namaBulan(date('m')).'-'.date('Y'),
                'emp'=>$emp,
                'empAll'=>$this->m_employee->empGetAllAll(),
                'kustEmployee'=>$kustEmployee,
                'kustBulan'=>$kustBulan,
                'kustTahun'=>$kustTahun
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js'),'css'=>array('jquery-ui-1.8.22.custom','style',));
            
            $this->load->view('template/header.php',$header);    
            if($this->session->userdata('id_admin') == '1' || $this->session->userdata('id_admin') == '5') $this->load->view('rekap/v_rekap.php',$data); else $this->load->view('rekap/v_rekapEmployee.php',$data);
            $this->load->view('template/footer.php');  
	}	
        
        
        function rekapForm(){
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            
            $tab=$this->uri->segment(3);
            $idEmp=$this->uri->segment(4);
            $date=$this->uri->segment(5);
            $exDate= explode('-', $date);
            $dateDetail=$this->m_rekap->rekapGetByDate($idEmp,$exDate[1],$exDate[2]);
            $namaEmp=$this->m_employee->empGetById($idEmp);
            $data=array(
                'namaEmp'=>$namaEmp->nama,
                'dateDetail'=>$dateDetail,
                'exDate'=>$exDate,
                'tanggal'=>$exDate[0].'-'.$this->namaBulan($exDate[1]).'-'.$exDate[2],
                'tab'=>$tab,
                'idEmp'=>$idEmp
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js'),'css'=>array('jquery-ui-1.8.22.custom','style'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('rekap/v_rekapForm.php',$data);
            $this->load->view('template/footer.php');  
        }
        
        function rekapFormSave(){
            $this->load->view('v_loading.php');
                
            if($this->input->post()){
                $tab=$this->input->post('tab');
                $t=$this->input->post('day');
                $data=array();
                $data['id']=$this->input->post('id');
                $data['idEmployee']=$this->input->post('idEmp');
                $data[$t]= $this->input->post('isi');
                if($this->m_rekap->rekapEditSave($data) != false){
                    $this->m_log->insert_log('simpan rekap',json_encode((array_merge(["statusAction" => 'sukses'],$data))));
                    $this->input->set_cookie('successNotif','Sukses Tambah Data',time()+6000);
                }else{
                    $this->m_rekap->insert_log('simpan rekap',json_encode((array_merge(["statusAction" => 'gagal'],$data))));
                    $this->input->set_cookie('failedNotif','Tambah Data Gagal !!!',time()+6000);
                }
                $this->input->set_cookie('tab',$tab,time()+6000);
                redirect(site_url('rekap'));
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
        
}
