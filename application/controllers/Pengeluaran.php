<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {

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
                $this->load->model('m_pengeluarantrx', '', TRUE);
                $this->load->model('m_pengeluaran', '', TRUE);
	}
    
        public function sessVerif()
        {
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            if($this->session->userdata('id_admin') != '1') redirect (site_url());
        }
    
	function index()
	{
            $this->sessVerif();
                        
//            $penjualan=$this->m_penjualan->penjualanGetAll();
//            $data=array(
//                'penjualan'=>$penjualan
//            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js','flexigrid.pack','cookie'),'css'=>array('jquery-ui-1.8.22.custom','style','flexigrid.pack'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('pengeluaran/v_pengeluaran.php');
            $this->load->view('template/footer.php');  
	}
        
        function pengeluaranTable()
	{
            $this->sessVerif();
            
            $page = 1; // The current page
            $sortname = 'noFaktur'; // Sort column
            $sortorder = 'desc'; // Sort order
            $qtype = ''; // Search column
            $query = ''; // Search string
            $rp = 15;
            // Get posted data
            if (isset($_POST['page'])) {
                    $page = $this->input->post('page',true);
            }
            if (isset($_POST['sortname'])) {
                    $sortname = $this->input->post('sortname',true);
            }
            if (isset($_POST['sortorder'])) {
                    $sortorder = $this->input->post('sortorder',true);
            }
            if (isset($_POST['qtype'])) {
                    $qtype = $this->input->post('qtype',true);
            }
            if (isset($_POST['query'])) {
                    $query = $this->input->post('query',true);
            }
            if (isset($_POST['rp'])) {
                    $rp = $this->input->post('rp',true);
            }
            // Setup sort and search SQL using posted data
            $sortSql = "order by $sortname $sortorder";
            if($qtype == 'time' && $query != ''){
                $ttime=explode('-', $query);
                $whereSql = ($qtype != '' && $query != '') ? "where d=$ttime[0] AND m=$ttime[1] AND y=$ttime[2] AND pengeluarantrx.idPengeluaran=pengeluaran.id AND pengeluarantrx.deleted='0'" : "WHERE  pengeluarantrx.idPengeluaran=pengeluaran.id AND pengeluarantrx.deleted='0'";
            }else{
                $whereSql = ($qtype != '' && $query != '') ? "where $qtype LIKE '%$query%' AND pengeluarantrx.idPengeluaran=pengeluaran.id AND pengeluarantrx.deleted='0'" : "WHERE  pengeluarantrx.idPengeluaran=pengeluaran.id AND pengeluarantrx.deleted='0'";
            }

            // Setup paging SQL
            $pageStart = ($page-1)*$rp;
            $limitSql = "limit $pageStart, $rp";

            // Create JSON data
            $data = array();
            $data['page'] = $page;
            $data['rows'] = array();
            $select = "pengeluarantrx.id,pengeluaran.namaPengeluaran,pengeluarantrx.jumlah,pengeluarantrx.keterangan,pengeluarantrx.date";
            $sql = "SELECT $select FROM pengeluarantrx,pengeluaran $whereSql $sortSql $limitSql";
            $sqlcount = "SELECT $select FROM pengeluarantrx,pengeluaran $whereSql $sortSql";
//            echo $sql;
            // Get total count of records
            $total = $this->m_pengeluarantrx->get_count_query($sqlcount);
            $data['total'] = $total;

            $results = $this->m_pengeluarantrx->get_query($sql);

            $no=$pageStart+1;
            if($results != false){
                foreach($results as $row){
                    $data['rows'][] = array(
                    'id' => $row->id,
                    'cell' => array($no, ucwords($row->namaPengeluaran),  'Rp. '.number_format($row->jumlah,0,',','.'),date("d-m-Y",$row->date), ucfirst($row->keterangan))
                    );
                    $no++;
                }        
            }

            echo json_encode($data);  
        }   
        
        function pengeluaranForm(){
            $this->sessVerif();
            
            $typeForm=$this->uri->segment(3);
            $id=$this->uri->segment(4);
            $pengeluaranDetail=$this->m_pengeluarantrx->pengeluarantrxGetById($id);
            $pengeluaran=$this->m_pengeluaran->pengeluaranGetAll();
            $data=array(
                'pengeluaran'=>$pengeluaran,
                'pengeluaranDetail'=>$pengeluaranDetail,
                'typeForm'=>$typeForm
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js'),'css'=>array('jquery-ui-1.8.22.custom','style'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('pengeluaran/v_pengeluaranForm.php',$data);
            $this->load->view('template/footer.php');  
        }
        
        function pengeluaranFormSave(){
            $this->load->view('v_loading.php');
                
            if($this->input->post()){
                if($this->input->post('id') == ''){
                    if($this->m_pengeluarantrx->pengeluarantrxAddSave(array_map('strtolower', $this->input->post())) != false){
                        $this->m_log->insert_log('simpan pengeluaran',json_encode((array_merge(["statusAction" => 'sukses'],$this->input->post()))));
                        $this->input->set_cookie('successNotif','Sukses Tambah Data',time()+6000);
                    }else{
                        $this->m_log->insert_log('simpan pengeluaran',json_encode((array_merge(["statusAction" => 'gagal'],$this->input->post()))));
                        $this->input->set_cookie('failedNotif','Tambah Data Gagal !!!',time()+6000);
                    }
                }else{
                    if($this->m_pengeluarantrx->pengeluarantrxEditSave(array_map('strtolower', $this->input->post())) != false){
                        $this->m_log->insert_log('edit pengeluaran',json_encode((array_merge(["statusAction" => 'sukses'],$this->input->post()))));
                        $this->input->set_cookie('successNotif','Sukses Edit Data',time()+6000);
                    }else{
                        $this->m_log->insert_log('edit pengeluaran',json_encode((array_merge(["statusAction" => 'gagal'],$this->input->post()))));
                        $this->input->set_cookie('failedNotif','Edit Data Gagal !!!',time()+6000);
                    }
                }
                redirect(site_url('pengeluaran'));
            }else{
                redirect('login');
            }
        }
        
        function pengeluaranDelete(){
            $this->load->view('v_loading.php');
                
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            if($this->session->userdata('id_admin') != '1' || $this->session->userdata('id_admin') == '5') redirect (site_url());
            
            $data=$this->uri->segment(3);
            
            if($this->m_pengeluarantrx->pengeluarantrxDelete($data) != false){
                $this->m_log->insert_log('delete pengeluaran',json_encode((array_merge(["statusAction" => 'sukses'],$this->input->post()))));
                $this->input->set_cookie('successNotif','Sukses Hapus Data',time()+6000);
            }else{
                $this->m_log->insert_log('delete pengeluaran',json_encode((array_merge(["statusAction" => 'gagal'],$this->input->post()))));
                $this->input->set_cookie('failedNotif','Hapus Data Gagal !!!',time()+6000);
            }
            redirect(site_url('pengeluaran'));
        }
}
