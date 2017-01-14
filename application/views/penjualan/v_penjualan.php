
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
    
    <h2>Penjualan</h2>
    <div class="flexme"></div>
<script>
$(document).ready(function(){     
    $(".flexme").flexigrid({
    url: '<?php echo site_url('penjualan/penjualanTable');?>',
    dataType: 'json',
    colModel : [
            {display: 'No Faktur', name : 'noFaktur', width : 90, sortable : true, align: 'left'},
            {display: 'No PO', name : 'noPo', width : 90, sortable : true, align: 'left'},
            {display: 'Nama Client', name : 'nama', width : 300, sortable : true, align: 'left'},
            {display: 'Tanggal', name : 'date', width : 120, sortable : true, align: 'left'},
            {display: 'Status', name : 'status', width : 120, sortable : true, align: 'left'},
            ],
    buttons : [
            {name: 'Tambah', bclass: 'add' ,align:'right', onpress:tambah},
            {separator: true},
            {name: 'Edit', bclass: 'edit' ,align:'right', onpress:edit},
            {separator: true},
            {name: 'Hapus', bclass: 'delete' ,align:'right', onpress:hapus},
            {separator: true},{separator: true},{separator: true},{separator: true},{separator: true},{separator: true},
            {name: 'Tukar Faktur', bclass: 'edit' ,align:'right', onpress:tukarFaktur},
            {separator: true},
            {name: 'Ambil Uang', bclass: 'edit' ,align:'right', onpress:ambilUang},
            {separator: true},{separator: true},{separator: true},{separator: true},{separator: true},{separator: true},
            {name: 'Cetak', bclass: 'print' ,align:'right', onpress:print},
            {separator: true},
            {name: 'Detail', bclass: 'view' ,align:'right', onpress:view},
            ],
    searchitems : [
            {display: 'Nama', name : 'client.nama', isdefault: true},
            {display: 'Tanggal', name : 'd', isdefault: true},
            {display: 'Bulan', name : 'm', isdefault: true},
            {display: 'Tahun', name : 'y', isdefault: true}
            ],
    singleSelect:true,
    sortname: "date",
    sortorder: "desc",
    usepager: true,
    //title: 'Kartu Praktikum Hilang',
    useRp: true,
    rp: 50,
    showTableToggleBtn: true,
    width: 800,
    height: 200
});      
function tambah(com,grid){
    location.href = '<?php echo site_url('penjualan/penjualanForm/0') ?>';
}
function edit(com,grid){
        $('.trSelected',grid).each(function(){
            var id=$(this).attr('id'); 
            id = id.substring(id.lastIndexOf('row')+3);
            location.href = '<?php echo site_url('penjualan/penjualanForm/1/') ?>'+id;
        });
}
function hapus(com,grid){
        $('.trSelected',grid).each(function(){
            var id=$(this).attr('id'); 
            id = id.substring(id.lastIndexOf('row')+3);
            if (confirm("Apakah Anda Yakin Ingin Menghapus ?")) {
                $('.delete').hide();
                location.href = '<?php echo site_url('penjualan/penjualanDelete/') ?>'+id;
            }
        });
}
function tukarFaktur(com,grid){
        $('.trSelected',grid).each(function(){
            var id=$(this).attr('id'); 
            id = id.substring(id.lastIndexOf('row')+3);
            location.href = '<?php echo site_url('penjualan/TFAUForm/0/') ?>'+id;
        });
}
function ambilUang(com,grid){
        $('.trSelected',grid).each(function(){
            var id=$(this).attr('id'); 
            id = id.substring(id.lastIndexOf('row')+3);
            location.href = '<?php echo site_url('penjualan/TFAUForm/1/') ?>'+id;
        });
}
function print(com,grid){
        $('.trSelected',grid).each(function(){
            var id=$(this).attr('id'); 
            id = id.substring(id.lastIndexOf('row')+3);
            location.href = '<?php echo site_url('penjualan/penjualanPrint/') ?>'+id;
        });
}
function view(com,grid){
        $('.trSelected',grid).each(function(){
            var id=$(this).attr('id'); 
            id = id.substring(id.lastIndexOf('row')+3);
            location.href = '<?php echo site_url('penjualan/penjualanDetail/') ?>'+id;
        });
}
});
</script>
    