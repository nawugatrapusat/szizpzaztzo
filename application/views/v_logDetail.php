
</head>
<body>
    <h2>Detail Log</h2>
        <table style="border: 1px solid black;">
            <tr>
                <td>Id</td>
                <td>:</td>
                <td><?php echo $detail->id_admin?></td>
            </tr>
            <tr>
                <td>Category</td>
                <td>:</td>
                <td><?php echo ucwords($detail->category)?></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td><?php echo date("d-m-Y H:i:s",$detail->date)?></td>
            </tr>
            <tr>
                <td valign="top">Activity</td>
                <td>:</td>
                <td><?php echo str_replace(',','<br/>',$detail->activity)?></td>
            </tr>
                <tr>
                    <td  style="padding-top:30px;padding-bottom:15px;" colspan="3">
                        <button type="button" onclick="location.href = '<?php echo site_url('log') ?>';">Cancel</button>
                    </td>
                </tr> 
</table>
<script>
    $(document).ready(function () {
        $(".idProduct").change(function(){
            var product = $(this),client;
            if($("#idClient").val() != ''){
                if(product.val() != ''){
                        $.ajax({
                        type: "POST",
                        dataType : "json",
                        url: "<?php echo site_url('penjualan/cekHarga'); ?>",
                        data: 'idProduct='+product.val()+'&idClient='+$("#idClient").val()
                      }).done(function( data ) {
                            product.parent().parent().find('.cetakHargaJual').val(data.cetakHargaJual);
                            product.parent().parent().find('.hargaJual').val(data.hargaJual);
                            product.parent().parent().find('.hargaBeli').val(data.hargaBeli);
                      });
                }else{
                    product.parent().parent().find('.cetakHargaJual').val('');
                    product.parent().parent().find('.hargaJual').val('');
                    product.parent().parent().find('.hargaBeli').val('');
                }
            }else{
                alert('Client harap di pilih dahulu');
                product[0].selectedIndex=0;
            }
    
        });
    });
</script>
