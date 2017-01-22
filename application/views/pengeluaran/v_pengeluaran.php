<?php
$tab = get_cookie('tab');
$successNotif = get_cookie('successNotif');
$failedNotif = get_cookie('failedNotif');
delete_cookie('tab');
delete_cookie('successNotif');
delete_cookie('failedNotif');

if (empty($tab))$tab = 0;
if (empty($successNotif)) $successNotifShow = 'display: none;'; else $successNotifShow = '';
if (empty($failedNotif)) $failedNotifShow = 'display: none;'; else $failedNotifShow = '';
?>
</head>
<body>
    <?php $this->load->view('template/menu') ?>
    
    <div class="notification-area" style="<?php echo $successNotifShow; ?>"><?php echo $successNotif; ?></div>
    <div class="warning-area" style="<?php echo $failedNotifShow; ?>"><?php echo $failedNotif; ?></div>
    <h2>Pengeluaran</h2>
 <div class="flexme"></div>
<script>
$(document).ready(function(){     
    $(".flexme").flexigrid({
    url: '<?php echo site_url('pengeluaran/pengeluaranTable');?>',
    dataType: 'json',
    colModel : [
            {display: 'No', name : '', width : 20, sortable : true, align: 'left'},
            {display: 'Pengeluaran', name : 'namaPengeluaran', width : 250, sortable : true, align: 'left'},
            {display: 'Jumlah', name : 'jumlah', width : 100, sortable : true, align: 'left'},
            {display: 'Tanggal', name : 'date', width : 100, sortable : true, align: 'left'},
            {display: 'Keterangan', name : 'keterangan', width : 700, sortable : true, align: 'left'},
            ],
    buttons : [
            {name: 'Tambah', bclass: 'add' ,align:'right', onpress:tambah},
            {separator: true},
            {name: 'Edit', bclass: 'edit' ,align:'right', onpress:edit},
            {separator: true},
            {name: 'Hapus', bclass: 'delete' ,align:'right', onpress:hapus},
            ],
    searchitems : [
            {display: 'Pengeluaran', name : 'namaPengeluaran', isdefault: true},
            {display: 'Tanggal dd-mm-yyyy', name : 'time', isdefault: true},
            {display: 'Keterangan', name : 'keterangan', isdefault: true}
            ],
    singleSelect:true,
    sortname: "date",
    sortorder: "desc",
    usepager: true,
    //title: 'Kartu Praktikum Hilang',
    useRp: true,
    rp: 50,
    showTableToggleBtn: true,
    width: 1280,
    height: 380
});      
function tambah(com,grid){
    location.href = '<?php echo site_url('pengeluaran/pengeluaranForm/0') ?>';
}
function edit(com,grid){
        $('.trSelected',grid).each(function(){
            var id=$(this).attr('id'); 
            id = id.substring(id.lastIndexOf('row')+3);
            location.href = '<?php echo site_url("pengeluaran/pengeluaranForm/1/") ?>'+id;
        });
}
function hapus(com,grid){
        $('.trSelected',grid).each(function(){
            var id=$(this).attr('id'); 
            id = id.substring(id.lastIndexOf('row')+3);
            if (confirm("Apakah Anda Yakin Ingin Menghapus ?")) {
                window.scrollTo(0, 0);
                $('#loadingAnim').show();
                document.body.scroll = "no";
                document.body.style.overflow = 'hidden';
                document.height = window.innerHeight;
                $('.delete').hide();
                location.href = '<?php echo site_url("pengeluaran/pengeluaranDelete/") ?>' + id;
            }
        });
}
});
</script>