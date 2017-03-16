</head>
<body class="bodyclass" style="display: none;">
    <h2><?php echo $typeForm == 0 ? 'Tambah Produk' : 'Edit Produk '; ?></h2>
    <form style="padding-left:13px; padding-top: 10px;" onsubmit="return validateForm()" name="productForm" action="<?php echo site_url('setting/productFormSave/1') ?>" method="POST">
        <table style="border: 1px solid black;">
            <tr>
                <td>Merek</td>
                <td>:</td>
                <td> <span style="color:red;">*</span> <input id="merek" type="text" name="merek" value="<?php echo $product == '' ? '' : ucwords($product->merek) ?>" size="50"/></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td> <span style="color:red;">*</span> <input id="nama" type="text" name="nama" value="<?php echo $product == '' ? '' : ucwords($product->nama)?>" size="100"/></td>
            </tr>
            <tr>
                <td>Berat</td>
                <td>:</td>
                <td> <span style="color:red;">*</span> <input class='onlyNumb' id="berat" type="text" name="berat" value="<?php echo $product == '' ? '' : $product->berat?>"/> Gram</td>
            </tr>
<!--            <tr>
                <td>Stock</td>
                <td>:</td>
                <td> <span style="color:red;">*</span> <input id="stock" type="text" name="stock" value="<?php echo $product == '' ? '' : $product->stock?>"/></td>
            </tr>-->
            <tr>
                <td>Harga Beli</td>
                <td>:</td>
                <td> <span style="color:red;">*</span> Rp.<input class='onlyNumb' id="hargaBeli" type="text" name="hargaBeli" value="<?php echo $product == '' ? '' : $product->hargaBeli?>"/> <span class="cetakHargaBeli"> </td>
            </tr>
            <tr>
                <td>Skema</td>
                <td>:</td>
                <td> <span style="color:red;">*</span> 
                    <select id="scheme" name="scheme">
                        <option value="">Skema</option>
                        <?php 
                        $a=$product->scheme == "cashback" ? "selected='selected'" : '';
                        $b=$product->scheme == "kinerja" ? "selected='selected'" : '';
                        $c=$product->scheme == 'cashback' ? "" : 'display:none';
                        ?>
                        <option <?php echo $a; ?> value="cashback">Cashback</option>;
                        <option <?php echo $b; ?> value="kinerja">Kinerja</option>;
                    </select>&nbsp;<span id="hargaEmployee" style="<?php echo $c; ?>">,&nbsp;Harga Karyawan : Rp. <span style="color:red;">*</span> <input type="text" class='onlyNumb' id="hargaEmployeeInput" name="hargaEmployee" value="<?php echo $product == '' ? '' : $product->hargaEmployee ?>"/></span> <span class="cetakHargaEmployee"> 
                </td>
            </tr>
            <tr>
                <td>Harga Jual</td>
                <td>:</td>
                <td> <span style="color:red;">*</span> Rp.<input class='onlyNumb' id="hargaJual" type="text" name="hargaJual" value="<?php echo $product == '' ? '' : $product->hargaJual?>"/> <span class="cetakHargaJual"> </td>
            </tr>
            <tr>
                <td>Harga Jual Diskon</td>
                <td>:</td>
                <td> <span style="color:red;">*</span> Rp.<input class='onlyNumb' id="hargaJualDiskon" type="text" name="hargaJualDiskon" value="<?php echo $product == '' ? '' : $product->hargaJualDiskon?>"/> <span class="cetakHargaJualDiskon"> </td>
            </tr>
            <tr>
                <td  style="padding-top:30px;padding-bottom:15px;" colspan="3">
                    <input type="hidden" name="id" value="<?php echo $product == '' ? '' : $product->id?>"/>
                    <input type="submit" value="Submit"/>&nbsp;
                    <button type="button" onclick="<?php $this->input->set_cookie('tab',1,time()+6000);?>;location.href='<?php echo site_url('setting')?>';">Cancel</button>
                </td>
            </tr> 
        </table>
    </form>
    <script>
        function validateForm() {
            if ($('#merek').val() == "") { alert("Merek Masih Kosong !!!"); return false; }
            if ($('#nama').val() == "") { alert("Nama Masih Kosong !!!"); return false; }
            if ($('#berat').val() == "") { alert("Berat Masih Kosong !!!"); return false; }
//            if ($('#stock').val() == "") { alert("Stock Masih Kosong !!!"); return false; }
            if ($('#hargaBeli').val() == "") { alert("Harga beli Masih Kosong !!!"); return false; }
                if ($('#hargaBeli').val() != ''){
                    if(isNaN($('#hargaBeli').val()) == true){
                        alert("Harga Beli Harus Angka !!!");
                        return false;
                    }else if($('#hargaBeli').val() % 1 != 0){
                        alert("Harga Beli Tidak Boleh Desimal !!!");
                        return false;
                    }
                }
            if ($('#scheme').val() == "") { 
                alert("Skema Masih Kosong !!!"); return false; 
            }else if($('#scheme').val() == 'cashback'){
                if($('#hargaEmployeeInput').val() == ''){ alert("Harga Karyawan Masih Kosong !!!"); return false; }
                    if ($('#hargaEmployeeInput').val() != ''){
                        if(isNaN($('#hargaEmployeeInput').val()) == true){
                            alert("Harga Karyawan Harus Angka !!!");
                            return false;
                        }else if($('#hargaEmployeeInput').val() % 1 != 0){
                            alert("Harga Karyawan Tidak Boleh Desimal !!!");
                            return false;
                        }
                    }
            }
            if ($('#hargaJual').val() == "") { alert("Harga jual Masih Kosong !!!"); return false; }
                if ($('#hargaJual').val() != ''){
                    if(isNaN($('#hargaJual').val()) == true){
                        alert("Harga Jual Harus Angka !!!");
                        return false;
                    }else if($('#hargaJual').val() % 1 != 0){
                        alert("Harga Jual Tidak Boleh Desimal !!!");
                        return false;
                    }
                }
            if ($('#hargaJualDiskon').val() == "") { alert("Harga jual Diskon Masih Kosong !!!"); return false; }
                if ($('#hargaJualDiskon').val() != ''){
                    if(isNaN($('#hargaJualDiskon').val()) == true){
                        alert("Harga Jual Diskon Harus Angka !!!");
                        return false;
                    }else if($('#hargaJualDiskon').val() % 1 != 0){
                        alert("Harga Jual Diskon Tidak Boleh Desimal !!!");
                        return false;
                    }
                }
            if(parseInt($('#hargaBeli').val()) > parseInt($('#hargaJual').val()) || parseInt($('#hargaBeli').val()) > parseInt($('#hargaJualDiskon').val())) 
                { alert("Harga Tidak Sesuai (Lebih Kecil / Lebih Besar Dari Harga Beli / Harga Jual / Harga Jual Diskon)"); return false; }
            if($('#scheme').val() == 'cashback' && parseInt($('#hargaEmployeeInput').val()) > parseInt($('#hargaJual').val()) || parseInt($('#hargaEmployeeInput').val()) > parseInt($('#hargaJualDiskon').val())) 
                { alert("Harga Tidak Sesuai (Lebih Kecil / Lebih Besar Dari Harga Karyawan / Harga Jual / Harga Jual Diskon)"); return false; }
            window.scrollTo(0, 0);
            $('#loadingAnim').show();
            document.body.scroll = "no";
            document.body.style.overflow = 'hidden';
            document.height = window.innerHeight;
        }
    $(document).ready(function () {
            $('#hargaBeli').bind('change', function(){
                var tis=$(this);
                if(tis.val() == ''){
                    tis.parent().find('.cetakHargaBeli').html('');
                }else{
                    $.ajax({
                    type: "POST",
                    dataType : "json",
                    url: "<?php echo site_url('penjualan/numberFormat'); ?>",
                    data: 'val='+tis.val()
                  }).done(function( data ) {
                        tis.parent().find('.cetakHargaBeli').html(data.val);
                  });
                }
            });
            $('#hargaJual').bind('change', function(){
                var tis=$(this);
                if(tis.val() == ''){
                    tis.parent().find('.cetakHargaJual').html('');
                    tis.parent().parent().parent().find('.cetakHargaJualDiskon').html('');
                    tis.parent().parent().parent().find('#hargaJualDiskon').val('');
                }else{
                    tis.parent().parent().parent().find('#hargaJualDiskon').val(tis.val());
                    $.ajax({
                    type: "POST",
                    dataType : "json",
                    url: "<?php echo site_url('penjualan/numberFormat'); ?>",
                    data: 'val='+tis.val()
                  }).done(function( data ) {
                        tis.parent().find('.cetakHargaJual').html(data.val);
                        tis.parent().parent().parent().find('.cetakHargaJualDiskon').html(data.val);
                  });
                }
            });
            $('#hargaJualDiskon').bind('change', function(){
                var tis=$(this);
                if(tis.val() == ''){
                    tis.parent().find('.cetakHargaJualDiskon').html('');
                }else{
                    $.ajax({
                    type: "POST",
                    dataType : "json",
                    url: "<?php echo site_url('penjualan/numberFormat'); ?>",
                    data: 'val='+tis.val()
                  }).done(function( data ) {
                        tis.parent().find('.cetakHargaJualDiskon').html(data.val);
                  });
                }
            });
            $('#hargaEmployeeInput').bind('change', function(){
                var tis=$(this);
                if(tis.val() == ''){
                    $('.cetakHargaEmployee').html('');
                }else{
                    $.ajax({
                    type: "POST",
                    dataType : "json",
                    url: "<?php echo site_url('penjualan/numberFormat'); ?>",
                    data: 'val='+tis.val()
                  }).done(function( data ) {
                        $('.cetakHargaEmployee').html(data.val);
                  });
                }
            });
            $("#scheme").change(function () {
                var scheme = $(this);
                if(scheme.val() == 'cashback'){
                    $('#hargaEmployee').show();
                }else{
                    $('#hargaEmployee').hide();
                    $('#hargaEmployeeInput').val('');
                    $('.cetakHargaEmployee').html('');
                }
            });
        });
    </script>
