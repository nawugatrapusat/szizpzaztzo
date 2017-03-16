<div class="flexme1"></div>
<script>
$(document).ready(function(){     
    $(".flexme1").flexigrid({
    url: '<?php echo site_url('setting/productTable');?>',
    dataType: 'json',
    colModel : [
            {display: 'No', name : '', width : 20, sortable : true, align: 'left'},
            {display: 'Merek', name : 'merek', width : 220, sortable : true, align: 'left'},
            {display: 'Nama', name : 'nama', width : 220, sortable : true, align: 'left'},
            {display: 'Berat', name : 'berat', width : 50, sortable : true, align: 'left'},
            {display: 'Harga Beli', name : 'hargaBeli', width : 100, sortable : true, align: 'left'},
            {display: 'Harga Karyawan', name : 'hargaEmployee', width : 120, sortable : true, align: 'left'},
            {display: 'Harga Jual', name : 'hargaJual', width : 100, sortable : true, align: 'left'},
            {display: 'Harga Jual Diskon', name : 'hargaJualDiskon', width : 130, sortable : true, align: 'left'},
            {display: 'Skema', name : 'scheme', width : 60, sortable : true, align: 'left'},
            ],
    buttons : [
            {name: 'Tambah', bclass: 'add' ,align:'right', onpress:tambah},
            {separator: true},
            {name: 'Edit', bclass: 'edit' ,align:'right', onpress:edit},
            {separator: true},
            {name: 'Hapus', bclass: 'delete' ,align:'right', onpress:hapus},
            {separator: true},
            {separator: true},
            {separator: true},
            {separator: true},
            {separator: true},
            {name: 'Stock', bclass: 'edit' ,align:'right', onpress:stock},
            ],
    searchitems : [
            {display: 'Nama', name : 'nama', isdefault: true},
            {display: 'Skema', name : 'scheme', isdefault: true}
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
    location.href = '<?php echo site_url('setting/productForm/0') ?>';
}
function edit(com,grid){
        $('.trSelected',grid).each(function(){
            var id=$(this).attr('id'); 
            id = id.substring(id.lastIndexOf('row')+3);
            location.href = '<?php echo site_url("setting/productForm/1/") ?>'+id;
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
                    url: "<?php echo site_url('setting/cekDeleteProduct'); ?>",
                    data: 'idProduct='+id
                  }).done(function( data ) {
                        if(data.stdelete == true){
                            if(data.c == 0){
                            window.scrollTo(0, 0);
                            $('#loadingAnim').show();
                            document.body.scroll = "no";
                            document.body.style.overflow = 'hidden';
                            document.height = window.innerHeight;
                            $('.delete').hide();
                            location.href = '<?php echo site_url("setting/productDelete/1/") ?>' + id;
                            }else{
                                alert(data.val);
                            }
                        }else{
                            alert("Ada kesalahan dalam delete data, silahkan hubungi administrator website !!!");
                        }
                  });
            }
        });
}
function stock(com,grid){
        location.href = '<?php echo site_url("setting/productStockForm") ?>';
}
});
</script>