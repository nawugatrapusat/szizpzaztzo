<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

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
                $this->load->model('m_penjualan', '', TRUE);
                $this->load->model('m_client', '', TRUE);
                $this->load->model('m_product', '', TRUE);
                $this->load->model('m_employee', '', TRUE);
                $this->load->model('m_bank', '', TRUE);
	}
    
	public function index()
	{
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            
            $all_produk='';
            
            $data=array(
                'all_produk'=>$all_produk
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js','flexigrid.pack','cookie'),'css'=>array('jquery-ui-1.8.22.custom','style','flexigrid.pack'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('v_beranda.php',$data);
            $this->load->view('template/footer.php');  
	}	
        
        function penjualanTable()
	{
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
            if($qtype == 'penjualan.idEmployeePic'){
                if(strtolower($query) == 'bawa sendiri' || strtolower($query) == 'sendiri'){
                    $query='0';
                }
            }
            $whereSql = ($qtype != '' && $query != '') ? "where $qtype LIKE '%$query%' AND client.id=penjualan.idClient AND tukarfaktur.idPenjualan=penjualan.id AND STATUS <> 'ambil uang' AND STATUS <> 'manual close' AND penjualan.deleted='0'" : "WHERE  client.id=penjualan.idClient AND tukarfaktur.idPenjualan=penjualan.id AND STATUS <> 'ambil uang' AND STATUS <> 'manual close' AND penjualan.deleted='0'";

            // Setup paging SQL
            $pageStart = ($page-1)*$rp;
            $limitSql = "limit $pageStart, $rp";

            // Create JSON data
            $data = array();
            $data['page'] = $page;
            $data['rows'] = array();
            $select = "client.nama,penjualan.noFaktur,penjualan.noPo,penjualan.date,penjualan.status,penjualan.id,penjualan.totalBayar,penjualan.idEmployeePic,penjualan.nominalFaktur,tukarfaktur.tanggalKembali";
            $sql = "SELECT $select FROM penjualan,client,tukarfaktur $whereSql $sortSql $limitSql";
            $sqlcount = "SELECT $select FROM penjualan,client,tukarfaktur $whereSql $sortSql";
//            echo $sql;
            // Get total count of records
            $total = $this->m_penjualan->get_count_query($sqlcount);
            $data['total'] = $total;

            $results = $this->m_penjualan->get_query($sql);

            $no=1;
            if($results != false){
                foreach($results as $row){
                    if($row->idEmployeePic == '0'){
                        $employeePic='Bawa Sendiri';
                    }else{
                        $a=$this->m_employee->empGetById($row->idEmployeePic);
                        $employeePic=$a->nama;
                    }
                    if($row->totalBayar != ''){
                        $totByr='Rp. ' . number_format($row->totalBayar, 0, ',', '.');
                    }else{
                        $totByr='';
                    }
                    $data['rows'][] = array(
                    'id' => $row->id,
                    'cell' => array($no,$row->noFaktur,  strtoupper($row->noPo),  ucwords($row->nama), ucwords($employeePic),date("d-m-Y H:i:s",$row->date),$row->tanggalKembali,'Rp. ' . number_format($row->nominalFaktur, 0, ',', '.'),$totByr,ucwords($row->status))
                    );
                    $no++;
                }        
            }

            echo json_encode($data);  
        }   
        
}
