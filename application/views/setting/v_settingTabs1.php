<div class="flexme"></div>
<script>
$(document).ready(function(){     
    $(".flexme").flexigrid({
    url: '<?php echo site_url('setting/clientTable');?>',
    dataType: 'json',
    colModel : [
            {display: 'No', name : '', width : 20, sortable : true, align: 'left'},
            {display: 'Nama Client', name : 'nama', width : 240, sortable : true, align: 'left'},
            {display: 'Alamat Client', name : 'alamat', width : 240, sortable : true, align: 'left'},
            {display: 'No Telp', name : 'noTelp', width : 80, sortable : true, align: 'left'},
            {display: 'No Hp', name : 'noHp', width : 80, sortable : true, align: 'left'},
            {display: 'PIC Pembelian', name : 'picPembelian', width : 110, sortable : true, align: 'left'},
            {display: 'PIC Tagihan', name : 'picTagihan', width : 100, sortable : true, align: 'left'},
            {display: 'Harga Client', name : 'hargaJual', width : 300, sortable : true, align: 'left'},
            ],
    buttons : [
            {name: 'Tambah', bclass: 'add' ,align:'right', onpress:tambah},
            {separator: true},
            {name: 'Edit', bclass: 'edit' ,align:'right', onpress:edit},
            {separator: true},
            {name: 'Hapus', bclass: 'delete' ,align:'right', onpress:hapus},
            ],
    searchitems : [
            {display: 'Nama Client', name : 'nama', isdefault: true}
            ],
    singleSelect:true,
    sortname: "nama",
    sortorder: "asc",
    usepager: true,
    //title: 'Kartu Praktikum Hilang',
    useRp: true,
    rp: 50,
    showTableToggleBtn: true,
    width: 1280,
    height: 380
});      
function tambah(com,grid){
    location.href = '<?php echo site_url('setting/clientForm/0') ?>';
}
function edit(com,grid){
        $('.trSelected',grid).each(function(){
            var id=$(this).attr('id'); 
            id = id.substring(id.lastIndexOf('row')+3);
            location.href = '<?php echo site_url("setting/clientForm/1/") ?>'+id;
        });
}
function hapus(com,grid){
        $('.trSelected',grid).each(function(){
            var id=$(this).attr('id'); 
            id = id.substring(id.lastIndexOf('row')+3);
            if (confirm("Apakah Anda Yakin Ingin Menghapus ?")) {
                    $.ajax({
                    type: "POST",
                    dataType : "json",
                    url: "<?php echo site_url('setting/cekDeleteClient'); ?>",
                    data: 'idClient='+id
                  }).done(function( data ) {
                            if(data.c == 0){
                                window.scrollTo(0, 0);
                                $('#loadingAnim').show();
                                document.body.scroll = "no";
                                document.body.style.overflow = 'hidden';
                                document.height = window.innerHeight;
                                $('.delete').hide();
                                location.href = '<?php echo site_url("setting/clientDelete/0/") ?>' + id;
                            }else{
                                alert(data.val);
                            }
                  });
            }
        });
}
});
</script>