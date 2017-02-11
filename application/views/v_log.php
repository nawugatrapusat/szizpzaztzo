
</head>
<body>
<?php $this->load->view('template/menu')?>

    
    
    <h2>Log</h2>
    <div class="flexme"></div><br/>
<script>
$(document).ready(function(){     
    $(".flexme").flexigrid({
    url: '<?php echo site_url('log/logTable');?>',
    dataType: 'json',
    colModel : [
            {display: 'No', name : '', width : 40, sortable : true, align: 'left'},
            {display: 'Id', name : 'id_admin', width : 20, sortable : true, align: 'left'},
            {display: 'Category', name : 'category', width : 110, sortable : true, align: 'left'},
            {display: 'Tanggal', name : 'date', width : 120, sortable : true, align: 'left'},
            {display: 'Activity', name : 'activuty', width : 890, sortable : true, align: 'left'},
            ],
    buttons : [
            {name: 'Detail', bclass: 'detail' ,align:'right', onpress:detail},
            {separator: true}
            ],
    searchitems : [
            {display: 'Category', name : 'category', isdefault: true},
            {display: 'Tanggal dd-mm-yyyy', name : 'time', isdefault: true},
            {display: 'Activity', name : 'activity', isdefault: true},
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
function detail(com,grid){
        $('.trSelected',grid).each(function(){
            var id=$(this).attr('id'); 
            id = id.substring(id.lastIndexOf('row')+3);
            location.href = '<?php echo site_url("log/logDetail/") ?>'+id;
        });
}
});
</script>
    