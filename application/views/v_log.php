
</head>
<body>
<?php $this->load->view('template/menu')?>

    
    
    <div class="notification-area"></div>
    <div class="warning-area"></div>
    <h2>Detail Penjualan</h2>
    <div class="flexme"></div><br/>
    <h2>Log Sistem</h2>
    <div class="flexme1"></div>
    <h2>Log Sistem</h2>
    <div class="flexme2"></div>
<script>
$(document).ready(function(){
     $('.notification-area').hide();
     $('.warning-area').hide();
     
    $(".flexme").flexigrid({
    url: '<?php echo site_url('api/penjualan/detail_penjualan');?>',
    dataType: 'json',
    colModel : [
            {display: 'Nama', name : 'nama', width : 230, sortable : true, align: 'left'},
            {display: 'Harga', name : 'harga', width : 70, sortable : true, align: 'left'},
            {display: 'Jml', name : 'jumlah', width : 25, sortable : true, align: 'left'},
            {display: 'Tanggal', name : 'date', width : 60, sortable : true, align: 'left'},
            {display: 'Sttts Tgl', name : 'status_tanggal', width : 60, sortable : true, align: 'left'},
            {display: 'Stts', name : 'status', width : 40, sortable : true, align: 'left'},
            {display: 'Keterangan', name : 'keterangan', width : 410, sortable : true, align: 'left'},
            ],
//    buttons : [
//            {name: 'Delete', bclass: 'delete' ,align:'right', onpress:hapus},
//            {name: 'Detail', bclass: 'detail' ,align:'right', onpress:detail},
//            {separator: true}
//            ],
    searchitems : [
            {display: 'Nama', name : 'nama', isdefault: true},
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
    width: 1000,
    height: 700
});      

    $(".flexme1").flexigrid({
    url: '<?php echo site_url('api/log/log_penjualan');?>',
    dataType: 'json',
    colModel : [
            {display: 'Nama', name : 'nama', width : 270, sortable : true, align: 'left'},
            {display: 'Harga', name : 'harga', width : 90, sortable : true, align: 'left'},
            {display: 'Diskon', name : 'diskon', width : 90, sortable : true, align: 'left'},
            {display: 'Jumlah', name : 'jumlah', width : 50, sortable : true, align: 'left'},
            {display: 'Tanggal', name : 'date', width : 120, sortable : true, align: 'left'},
            {display: 'Status', name : 'status', width : 60, sortable : true, align: 'left'},
            ],
//    buttons : [
//            {name: 'Delete', bclass: 'delete' ,align:'right', onpress:hapus},
//            {name: 'Detail', bclass: 'detail' ,align:'right', onpress:detail},
//            {separator: true}
//            ],
    searchitems : [
            {display: 'Nama', name : 'nama', isdefault: true},
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
    height: 700
});      

    $(".flexme2").flexigrid({
    url: '<?php echo site_url('api/log/log_sistem');?>',
    dataType: 'json',
    colModel : [
            {display: 'Tanggal', name : 'tanggal', width : 120, sortable : true, align: 'left'},
            {display: 'Kategori', name : 'kategori', width : 70, sortable : true, align: 'left'},
            {display: 'Aktifitas', name : 'aktifitas', width : 550, sortable : true, align: 'left'},
            ],
//    buttons : [
//            {name: 'Delete', bclass: 'delete' ,align:'right', onpress:hapus},
//            {name: 'Detail', bclass: 'detail' ,align:'right', onpress:detail},
//            {separator: true}
//            ],
    searchitems : [
            {display: 'Kategori', name : 'category', isdefault: true},
            {display: 'Aktifitas', name : 'activity', isdefault: true},
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
    height: 700
});      
});
</script>
    