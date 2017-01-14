<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penjualan extends CI_Controller {
    
	function __construct()
	{
		parent::__construct();
                date_default_timezone_set('Asia/Jakarta');
                $this->load->model('m_produk', '', TRUE);
                $this->load->model('m_log', '', TRUE);
	}
        
        public function detail_penjualan()
	{
            $page = 1; // The current page
            $sortname = 'date'; // Sort column
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
            $whereSql = ($qtype != '' && $query != '') ? "where $qtype LIKE '%$query%' AND orderan.id=penjualan.id_order AND produk.id=penjualan.id_produk AND penjualan.deleted='no' AND produk.deleted='no'" : "WHERE orderan.id=penjualan.id_order AND produk.id=penjualan.id_produk AND penjualan.deleted='no' AND produk.deleted='no'";

            // Setup paging SQL
            $pageStart = ($page-1)*$rp;
            $limitSql = "limit $pageStart, $rp";

            // Create JSON data
            $data = array();
            $data['page'] = $page;
            $data['rows'] = array();
            $select = "produk.nama,penjualan.harga_jual,produk.bentuk,penjualan.date,penjualan.jumlah,penjualan.status,penjualan.discount,penjualan.id,orderan.keterangan,penjualan.d,penjualan.m,penjualan.y,penjualan.status_date";
            $sql = "SELECT $select FROM penjualan,produk,orderan $whereSql $sortSql $limitSql";
            $sqlcount = "SELECT $select FROM penjualan,produk,orderan $whereSql $sortSql";

            // Get total count of records
            $total = $this->m_produk->get_count_query($sqlcount);
            $data['total'] = $total;

            $results = $this->m_produk->get_query($sql);

            if($results != false){
                foreach($results as $row){
                    $data['rows'][] = array(
                    'id' => $row->id,
                    'cell' => array(ucwords($row->nama).' ('.$row->bentuk.')','Rp. '.$this->format_rupiah($row->harga_jual),$row->jumlah,$row->d."-".$row->m."-".$row->y,ucwords($row->status_date),ucwords($row->status),str_replace("<br/>",",&nbsp;&nbsp;",$row->keterangan))
                    );
                }        
            }

            echo json_encode($data);  
        }   
        
        function format_rupiah($angka){
            $rupiah=number_format($angka,0,',','.');
            return $rupiah;
        }
}
