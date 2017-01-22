
</head>
<body>
<?php
$successNotif = get_cookie('successNotif');
$failedNotif = get_cookie('failedNotif');
delete_cookie('successNotif');
delete_cookie('failedNotif');

if (empty($successNotif)) $successNotifShow = 'display: none;'; else $successNotifShow = '';
if (empty($failedNotif)) $failedNotifShow = 'display: none;'; else $failedNotifShow = '';
?>
<?php $this->load->view('template/menu')?>
    
    <div class="notification-area" style="<?php echo $successNotifShow; ?>"><?php echo $successNotif; ?></div>
    <div class="warning-area" style="<?php echo $failedNotifShow; ?>"><?php echo $failedNotif; ?></div>
    
    <h3>Cetak </h3>
    <!--<h3>Cetak Faktur</h3>-->
    <button type="button" onclick="window.open('<?php echo site_url('cetak/faktur/'.$id) ?>')">Cetak Faktur</button><br/><br/>
    <!--<h3>Cetak Surat Jalan</h3>-->
    <button type="button" onclick="window.open('<?php echo site_url('cetak/suratJalan/'.$id) ?>')">Cetak Surat Jalan</button><br/><br/>
    <!--<h3>Cetak Kwitansi</h3>-->
    <!--<button type="button" onclick="window.open('<?php echo site_url('cetak/kwitansi/'.$id) ?>')">Cetak Kwitansi</button><br/>-->
    <!--<h3>Cetak Tukar Faktur</h3>-->
    <div class="flexme"></div>
    
<script>
$(document).ready(function(){     
    $(".flexme").flexigrid({
    url: '<?php echo site_url('penjualan/penjualanPrintTable/'.$idClient);?>',
    dataType: 'json',
    colModel : [
            {display: 'No', name : '', width : 20, sortable : true, align: 'left'},
            {display: 'No Faktur', name : 'noFaktur', width : 90, sortable : true, align: 'left'},
            {display: 'No PO', name : 'noPo', width : 90, sortable : true, align: 'left'},
            {display: 'Nama Client', name : 'nama', width : 300, sortable : true, align: 'left'},
            {display: 'Pembawa', name : 'idEmployeePic', width : 140, sortable : true, align: 'left'},
            {display: 'Tanggal', name : 'date', width : 120, sortable : true, align: 'left'},
            {display: 'Nominal', name : 'nominal', width : 120, sortable : true, align: 'left'},
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
            {name: 'Cetak Tukar Faktur', bclass: 'print' ,align:'right', onpress:print},
            {separator: true},
//            {name: 'Detail', bclass: 'view' ,align:'right', onpress:view},
            ],
//    searchitems : [
//            {display: 'Nama', name : 'client.nama', isdefault: true},
//            {display: 'Tanggal', name : 'd', isdefault: true},
//            {display: 'Bulan', name : 'm', isdefault: true},
//            {display: 'Tahun', name : 'y', isdefault: true}
//            ],
    singleSelect:false,
    sortname: "date",
    sortorder: "desc",
    usepager: true,
    //title: 'Kartu Praktikum Hilang',
    useRp: true,
    rp: 50,
    showTableToggleBtn: true,
    width: 1280,
    height: 200
});      
function print(com,grid){
        var a='';
        $('.trSelected',grid).each(function(){
            var id=$(this).attr('id'); 
            id = id.substring(id.lastIndexOf('row')+3);
            a=a+id+'/';
        });
        $('.trSelected',grid).each(function(){
            var id=$(this).attr('id'); 
            id = id.substring(id.lastIndexOf('row')+3);
            window.open('<?php echo site_url('cetak/tukarFaktur/') ?>'+a);
        });
}
});
</script>
    