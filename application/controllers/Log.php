<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

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
	}
    
	public function index()
	{
            if($this->session->userdata('id_admin') == '') redirect (site_url());
                        
            
//            $data=array(
//                'all_produk'=>$all_produk
//            );
            
            $header = array('css'=>array('flexigrid.pack','jquery-ui-1.8.22.custom','style'),'js'=>array('jquery-ui-1.8.22.custom.min','flexigrid.pack','cookie','js'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('v_log.php');
            $this->load->view('template/footer.php');  
	}	
    
	public function logDetail()
	{
            if($this->session->userdata('id_admin') == '') redirect (site_url());
                        
            $id=$this->uri->segment(3);
            $detail=$this->m_log->logGetById($id) == false ? '' : $this->m_log->logGetById($id);
            
            $data=array(
                'detail'=>$detail
            );
            
            $header = array('css'=>array('jquery-ui-1.8.22.custom','style'),'js'=>array('jquery-ui-1.8.22.custom.min','js'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('v_logDetail.php',$data);
            $this->load->view('template/footer.php');  
	}	
        
        function logTable()
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
            if($qtype == 'time' && $query != ''){
                $ttime=explode('-', $query);
                $whereSql = ($qtype != '' && $query != '') ? "where d=$ttime[0] AND m=$ttime[1] AND y=$ttime[2]" : "";
            }else{
                $whereSql = ($qtype != '' && $query != '') ? "where $qtype LIKE '%$query%'" : "";
            }

            // Setup paging SQL
            $pageStart = ($page-1)*$rp;
            $limitSql = "limit $pageStart, $rp";

            // Create JSON data
            $data = array();
            $data['page'] = $page;
            $data['rows'] = array();
            $select = "*";
            $sql = "SELECT $select FROM log $whereSql $sortSql $limitSql";
            $sqlcount = "SELECT $select FROM log $whereSql $sortSql";
//            echo $sql;
            // Get total count of records
            $total = $this->m_log->get_count_query($sqlcount);
            $data['total'] = $total;

            $results = $this->m_log->get_query($sql);

            $no=$pageStart+1;
            if($results != false){
                foreach($results as $row){
                    $data['rows'][] = array(
                    'id' => $row->id,
                    'cell' => array($no,$row->id_admin,  ucwords($row->category), date("d-m-Y H:i:s",$row->date),$row->activity)
                    );
                    $no++;
                }        
            }

            echo json_encode($data);  
        }   
        
}
