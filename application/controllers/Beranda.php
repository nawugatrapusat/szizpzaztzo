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
            if($this->session->userdata('id_admin') != '1') redirect (site_url());
//            update hargaJualDiskon----------------------------------------------------------------------------------------------------------------------
//            $clientPrice=$this->m_client->clientPriceGetAll();
//            foreach($clientPrice as $detail){
//                $data=new stdClass();
//                $data->hargaJualDiskon=$detail->hargaJual;
//                $this->m_client->clientPriceUpdate($detail->id,$data);
//            }
//            $product=$this->m_product->productGetAll();
//            foreach($product as $detail){
//                $data=new stdClass();
//                $data->hargaJualDiskon=$detail->hargaJual;
//                $this->m_product->productUpdate($detail->id,$data);
//            }
//            $PenjualanDetail=$this->m_penjualan->penjualanDetailGetAll();
//            foreach($PenjualanDetail as $detail){
//                $data=new stdClass();
//                $data->hargaJualDiskon=$detail->hargaJual;
//                $this->m_penjualan->penjualanDetailUpdate($detail->id,$data);
//            }            
//            update scheme penjualan detail----------------------------------------------------------------------------------------------------------------------
            /*$PenjualanDetail=$this->m_penjualan->penjualanDetailGetAll();
            foreach($PenjualanDetail as $detail){
                if($detail->idProduct != ''){
                    $dp=$this->m_product->productGetById($detail->idProduct);
                    $data=new stdClass();
                    $data->scheme=$dp->scheme;
                    $this->m_penjualan->penjualanDetailUpdate($detail->id,$data);
                }
            } */   
//            update namaPT----------------------------------------------------------------------------------------------------------------------
            /*$clientPrice=$this->m_client->clientGetAll();
            foreach($clientPrice as $detail){
                $data=new stdClass();
                $data->namaPT=$detail->nama;
                $this->m_client->clientUpdate($detail->id,$data);
            }*/
//            cek hagrga beli < harga jual----------------------------------------------------------------------------------------------------------------------            
            
            
            
            $all_produk='';
            $product=$this->m_product->productGetAll();
            $client=$this->m_client->clientGetAll();
            
            $penjualan=$this->m_penjualan->penjualanGetAll();
            $mDate=date("m");
            $yDate=date("Y");
            $tFaktur=0;
            $tFakturYesterday=0;
            $tFakturYesterday2=0;
            $tBarang=0;
            $tBarangYesterday=0;
            $tBarangYesterday2=0;
            $tNominal=0;
            $tNominalYesterday=0;
            $tNominalYesterday2=0;
            $tUntung=0;
            $tUntungYesterday=0;
            $tUntungYesterday2=0;
            if(date("m") == 1){
                $mDateYesterday=12;
                $mDateYesterday2=11;
                $yDateYesterday=date("Y")-1;
                $yDateYesterday2=date("Y")-1;
            }else if(date("m") == 2){
                $mDateYesterday=1;
                $mDateYesterday2=12;
                $yDateYesterday=date("Y");
                $yDateYesterday2=date("Y")-1;
            }else{
                $mDateYesterday=date("m")-1;
                $mDateYesterday2=date("m")-2;
                $yDateYesterday=date("Y");
                $yDateYesterday2=date("Y");
            }
            foreach($penjualan as $detail){
                if($detail->m == $mDate && $detail->y == $yDate && $detail->status=='ambil uang'){
                    $penjualanDetail=$this->m_penjualan->penjualanGetDetail($detail->id);
                    $tFaktur=$tFaktur+1;
                    foreach($penjualanDetail as $hasil){
                        $tBarang=$tBarang+$hasil->jumlah;
                        $tNominal=$tNominal+($hasil->hargaJual*$hasil->jumlah);
                        $tUntung=$tUntung+($hasil->jumlah*($hasil->hargaJual - $hasil->hargaBeli));
                    }
                }
                if($detail->m == $mDateYesterday && $detail->y == $yDateYesterday && $detail->status=='ambil uang'){
                    $penjualanDetail=$this->m_penjualan->penjualanGetDetail($detail->id);
                    $tFakturYesterday=$tFakturYesterday+1;
                    foreach($penjualanDetail as $hasil){
                        $tBarangYesterday=$tBarangYesterday+$hasil->jumlah;
                        $tNominalYesterday=$tNominalYesterday+($hasil->hargaJual*$hasil->jumlah);
                        $tUntungYesterday=$tUntungYesterday+($hasil->jumlah*($hasil->hargaJual - $hasil->hargaBeli));
                    }
                }
                if($detail->m == $mDateYesterday2 && $detail->y == $yDateYesterday2 && $detail->status=='ambil uang'){
                    $penjualanDetail=$this->m_penjualan->penjualanGetDetail($detail->id);
                    $tFakturYesterday2=$tFakturYesterday2+1;
                    foreach($penjualanDetail as $hasil){
                        $tBarangYesterday2=$tBarangYesterday2+$hasil->jumlah;
                        $tNominalYesterday2=$tNominalYesterday2+($hasil->hargaJual*$hasil->jumlah);
                        $tUntungYesterday2=$tUntungYesterday2+($hasil->jumlah*($hasil->hargaJual - $hasil->hargaBeli));
                    }
                }
            }
            
            $data=array(
                'all_produk'=>$all_produk,
                'client'=>$client,
                'product'=>$product,
                'tFaktur'=>$tFaktur,
                'tFakturYesterday'=>$tFakturYesterday,
                'tFakturYesterday2'=>$tFakturYesterday2,
                'bulanNow'=>$this->namaBulan($mDate).'-'.$yDate,
                'bulanYesterday'=>$this->namaBulan($mDateYesterday).'-'.$yDateYesterday,
                'bulanYesterday2'=>$this->namaBulan($mDateYesterday2).'-'.$yDateYesterday2,
                'tBarang'=>number_format($tBarang,0,',','.'),
                'tNominal'=>'Rp. '.number_format($tNominal,0,',','.'),
                'tUntung'=>'Rp. '.number_format($tUntung,0,',','.'),
                'tBarangYesterday'=>number_format($tBarangYesterday,0,',','.'),
                'tNominalYesterday'=>'Rp. '.number_format($tNominalYesterday,0,',','.'),
                'tUntungYesterday'=>'Rp. '.number_format($tUntungYesterday,0,',','.'),
                'tBarangYesterday2'=>number_format($tBarangYesterday2,0,',','.'),
                'tNominalYesterday2'=>'Rp. '.number_format($tNominalYesterday2,0,',','.'),
                'tUntungYesterday2'=>'Rp. '.number_format($tUntungYesterday2,0,',','.')
            );
            
            $header = array('js'=>array('jquery-ui-1.8.22.custom.min','js','flexigrid.pack','cookie'),'css'=>array('jquery-ui-1.8.22.custom','style','flexigrid.pack'));
            
            $this->load->view('template/header.php',$header);    
            $this->load->view('v_beranda.php',$data);
            $this->load->view('template/footer.php');  
	}	
        
        function penjualanTable()
	{
            if($this->session->userdata('id_admin') == '') redirect (site_url());
            if($this->session->userdata('id_admin') != '1') redirect (site_url());
            
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
            if($qtype == 'time' && $query != ''){
                $ttime=explode('-', $query);
                $whereSql = ($qtype != '' && $query != '') ? "where d=$ttime[0] AND m=$ttime[1] AND y=$ttime[2] AND client.id=penjualan.idClient AND STATUS <> 'ambil uang' AND STATUS <> 'manual close' AND penjualan.deleted='0'" : "WHERE  client.id=penjualan.idClient AND STATUS <> 'ambil uang' AND STATUS <> 'manual close' AND penjualan.deleted='0'";
            }else{
                $whereSql = ($qtype != '' && $query != '') ? "where $qtype LIKE '%$query%' AND client.id=penjualan.idClient AND STATUS <> 'ambil uang' AND STATUS <> 'manual close' AND penjualan.deleted='0'" : "WHERE  client.id=penjualan.idClient AND STATUS <> 'ambil uang' AND STATUS <> 'manual close' AND penjualan.deleted='0'";
            }

            // Setup paging SQL
            $pageStart = ($page-1)*$rp;
            $limitSql = "limit $pageStart, $rp";

            // Create JSON data
            $data = array();
            $data['page'] = $page;
            $data['rows'] = array();
            $select = "client.nama,penjualan.noFaktur,penjualan.noPo,penjualan.d,penjualan.m,penjualan.y,penjualan.status,penjualan.id,penjualan.totalBayar,penjualan.idEmployeePic,penjualan.nominalFaktur";
            $sql = "SELECT $select FROM penjualan,client $whereSql $sortSql $limitSql";
            $sqlcount = "SELECT $select FROM penjualan,client $whereSql $sortSql";
//            echo $sql;
            // Get total count of records
            $total = $this->m_penjualan->get_count_query($sqlcount);
            $data['total'] = $total;

            $results = $this->m_penjualan->get_query($sql);

            $no=$pageStart+1;
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
                    $fakturData=$this->m_penjualan->tukarFakturGetByIdPenjualan($row->id);
                    if($fakturData != false) $tglKembali=date("d-M-Y",strtotime($fakturData->tanggalKembali)); else $tglKembali='';
                    $data['rows'][] = array(
                    'id' => $row->id,
                    'cell' => array($no,$row->noFaktur,  strtoupper($row->noPo),  ucwords($row->nama), ucwords($employeePic),date("d-M-Y",strtotime($row->d.'-'.$row->m.'-'.$row->y)),$tglKembali,'Rp. ' . number_format($row->nominalFaktur, 0, ',', '.'),$totByr,ucwords($row->status))
                    );
                    $no++;
                }        
            }

            echo json_encode($data);  
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
