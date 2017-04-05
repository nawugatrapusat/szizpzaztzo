<style>
    .tabel_tampil td{
        padding-top:7px;
        padding-right:100px;
    }
</style>
</head>
<body class="bodyclass" style="display: none;">
<?php $this->load->view('template/menu')?>
    <h2>Beranda</h2>

<?php
            if($this->session->userdata('id_admin') == '1') {
//                echo '<table>';
                foreach($product as $detail){
                    if($detail->hargaBeli > $detail->hargaJual || $detail->hargaBeli > $detail->hargaJualDiskon){
                        echo '<div style="background-color:#ffcccc;margin-bottom:1px;">'
                        . ''.ucwords($detail->nama).'|| harga beli : '.$detail->hargaBeli.' || harga jual : '.$detail->hargaJual.' || harga karyawan : '.$detail->hargaEmployee.' || '
                                . 'harga jual diskon :'.$detail->hargaJualDiskon.'</div>';
//                        echo '<tr style="background-color:#ffcccc">
//                                    <td>'.$detail->nama.'</td>
//                                    <td> || harga beli : '.$detail->hargaBeli.' || </td>
//                                    <td>harga jual : '.$detail->hargaJual.' || </td>
//                                    <td>harga karyawan : '.$detail->hargaEmployee.' || </td>
//                                    <td>harga jual diskon :'.$detail->hargaJualDiskon.'</td>
//                                </tr>';
                    }else if($detail->hargaEmployee != '' && ($detail->hargaBeli > $detail->hargaEmployee)){
                        echo '<div style="background-color:#ffcccc;margin-bottom:1px;">'
                        . ''.ucwords($detail->nama).'|| harga beli : '.$detail->hargaBeli.' || harga jual : '.$detail->hargaJual.' || harga karyawan : '.$detail->hargaEmployee.' || '
                                . 'harga jual diskon :'.$detail->hargaJualDiskon.'</div>';
//                        echo '<tr style="background-color:#ffcccc">
//                                    <td>'.$detail->nama.'</td>
//                                    <td> || harga beli : '.$detail->hargaBeli.' || </td>
//                                    <td>harga jual : '.$detail->hargaJual.' || </td>
//                                    <td>harga karyawan : '.$detail->hargaEmployee.' || </td>
//                                    <td>harga jual diskon :'.$detail->hargaJualDiskon.'</td>
//                                </tr>';
                    }
                    if($detail->stock < $detail->minStock){
                        echo '<div style="background-color:#ffcccc;;margin-bottom:1px;">
                            Barang '.ucwords($detail->nama).', Stock Sudah Minimum / Stock Habis  </div>';
                    } 
                }
//                echo '</table>';
            }
echo "<br/><br/>";
echo '<span style="font-weight:bold;">Dashboard Penjualan Faktur AU</span><br/>';
?>
    <table border="1" style="border-collapse: collapse;">
        <tr>
            <td>
                <table border="0" style="border-collapse: collapse;">
                    <tr>
                        <td colspan="3" align="center" style="border-bottom: 1px solid black;">Bulan <?php echo $bulanNow?></td>
                    </tr>
                    <tr>
                        <td>Total Faktur</td>
                        <td>:</td>
                        <td><?php echo $tFaktur?></td>
                    </tr>
                    <tr>
                        <td>Total Barang</td>
                        <td>:</td>
                        <td><?php echo $tBarang?></td>
                    </tr>
                    <tr>
                        <td>Total Nominal</td>
                        <td>:</td>
                        <td><?php echo $tNominal?></td>
                    </tr>
                    <tr>
                        <td>Total Keuntunagan</td>
                        <td>:</td>
                        <td><?php echo $tUntung?></td>
                    </tr>
                </table>
            </td>
            <td>
                <table border="0" style="border-collapse: collapse;">
                    <tr>
                        <td colspan="3" align="center" style="border-bottom: 1px solid black;">Bulan <?php echo $bulanYesterday?></td>
                    </tr>
                    <tr>
                        <td>Total Faktur</td>
                        <td>:</td>
                        <td><?php echo $tFakturYesterday?></td>
                    </tr>
                    <tr>
                        <td>Total Barang</td>
                        <td>:</td>
                        <td><?php echo $tBarangYesterday?></td>
                    </tr>
                    <tr>
                        <td>Total Nominal</td>
                        <td>:</td>
                        <td><?php echo $tNominalYesterday?></td>
                    </tr>
                    <tr>
                        <td>Total Keuntunagan</td>
                        <td>:</td>
                        <td><?php echo $tUntungYesterday?></td>
                    </tr>
                </table>
            </td>
            <td>
                <table border="0" style="border-collapse: collapse;">
                    <tr>
                        <td colspan="3" align="center" style="border-bottom: 1px solid black;">Bulan <?php echo $bulanYesterday2?></td>
                    </tr>
                    <tr>
                        <td>Total Faktur</td>
                        <td>:</td>
                        <td><?php echo $tFakturYesterday2?></td>
                    </tr>
                    <tr>
                        <td>Total Barang</td>
                        <td>:</td>
                        <td><?php echo $tBarangYesterday2?></td>
                    </tr>
                    <tr>
                        <td>Total Nominal</td>
                        <td>:</td>
                        <td><?php echo $tNominalYesterday2?></td>
                    </tr>
                    <tr>
                        <td>Total Keuntunagan</td>
                        <td>:</td>
                        <td><?php echo $tUntungYesterday2?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>    
<?php
echo '<br/><span style="font-weight:bold;">Informasi TF</span><br/><br/>';
    foreach($client as $detail){
        if($detail->keteranganTF != ''){
            echo "TF ".ucwords($detail->nama)." - ".ucfirst($detail->keteranganTF)."<br/>";
        }
    }
?>
    <br/>
    <?php
//echo "<br/>";
//echo '<span style="font-weight:bold;">Pending Faktur</span><br/><br/>';
    ?>
    <!--<div class="flexme"></div>-->
<script>
$(document).ready(function(){     
    $(".flexme").flexigrid({
    url: '<?php echo site_url('beranda/penjualanTable');?>',
    dataType: 'json',
    colModel : [
            {display: 'No', name : '', width : 20, sortable : true, align: 'left'},
            {display: 'No Faktur', name : 'noFaktur', width : 90, sortable : true, align: 'left'},
            {display: 'No PO', name : 'noPo', width : 90, sortable : true, align: 'left'},
            {display: 'Nama Client', name : 'nama', width : 290, sortable : true, align: 'left'},
            {display: 'Pembawa', name : 'idEmployeePic', width : 100, sortable : true, align: 'left'},
            {display: 'Tanggal', name : 'date', width : 110, sortable : true, align: 'left'},
            {display: 'Tgl Kembali', name : 'tanggalKembali', width : 90, sortable : true, align: 'left'},
            {display: 'Nominal Faktur', name : 'nominalFaktur', width : 120, sortable : true, align: 'left'},
            {display: 'Hasil', name : 'totalBayar', width : 120, sortable : true, align: 'left'},
            {display: 'Status', name : 'status', width : 120, sortable : true, align: 'left'},
            ],
    buttons : [
//            {name: 'Tambah', bclass: 'add' ,align:'right', onpress:tambah},
//            {separator: true},
//            {name: 'Edit', bclass: 'edit' ,align:'right', onpress:edit},
//            {separator: true},
//            {name: 'Hapus', bclass: 'delete' ,align:'right', onpress:hapus},
//            {separator: true},{separator: true},{separator: true},{separator: true},{separator: true},{separator: true},
//            {name: 'Tukar Faktur', bclass: 'edit' ,align:'right', onpress:tukarFaktur},
//            {separator: true},
//            {name: 'Ambil Uang', bclass: 'edit' ,align:'right', onpress:ambilUang},
//            {separator: true},{separator: true},{separator: true},{separator: true},{separator: true},{separator: true},
//            {name: 'Cetak', bclass: 'print' ,align:'right', onpress:print},
//            {separator: true},
            {name: 'Detail', bclass: 'view' ,align:'right', onpress:view},
            ],
    searchitems : [
            {display: 'No Faktur', name : 'penjualan.noFaktur', isdefault: true},
            {display: 'No PO', name : 'penjualan.noPo', isdefault: true},
            {display: 'Nama Client', name : 'client.nama', isdefault: true},
            {display: 'Nama Pembawa Kirim Barang', name : 'penjualan.idEmployeePic', isdefault: true},
            {display: 'Tanggal dd-mm-yyyy', name : 'time', isdefault: true},
            {display: 'Status', name : 'penjualan.status', isdefault: true},
            ],
    singleSelect:true,
    sortname: "noFaktur",
    sortorder: "desc",
    usepager: true,
//    title: 'Pending Faktur',
    useRp: true,
    rp: 50,
    showTableToggleBtn: true,
    width: 1280,
    height: 380
});   
function view(com,grid){
        $('.trSelected',grid).each(function(){
            var id=$(this).attr('id'); 
            id = id.substring(id.lastIndexOf('row')+3);
            location.href = '<?php echo site_url('penjualan/penjualanDetail/') ?>'+id;
        });
}
});
$(window).load(function(){ 
    $('.flexme > tbody  > tr').each(function() {
        $(this).find('td').each(function(){
            var tis=$(this);
            if(tis.attr('abbr') == 'status' && tis.text() == 'Tukar Faktur'){
                tis.parent().css('background-color','#FAEFC4');
            }
        });
    });
});
</script>
    