</head>
<body class="bodyclass" style="display: none;">
    <h2><?php echo $typeForm == 0 ? 'Tambah Client' : 'Edit Client '; ?></h2>
    <form style="padding-left:13px; padding-top: 10px;" onsubmit="return validateForm()" name="myForm" action="<?php echo site_url('setting/clientFormSave/0') ?>" method="POST">
        <table style="border: 1px solid black;">
            <tr>
                <td style="padding-bottom: 15px;">
                    <table>
                        <tr>
                            <td>Nama Client <span style="color:red;">*</span></td>
                            <td>:</td>
                            <td><input id='nama' type="text" name="nama" value="<?php echo $client == '' ? '' : ucwords($client->nama) ?>" size="50"/></td>
                        </tr>
                        <tr>
                            <td>Nama PT</td>
                            <td>:</td>
                            <td><input id='namaPT' type="text" name="namaPT" value="<?php echo $client == '' ? '' : ucwords($client->namaPT) ?>" size="50"/></td>
                        </tr>
                        <tr>
                            <td>Alamat Client <span style="color:red;">*</span></td>
                            <td>:</td>
                            <td><input id='alamat' type="text" name="alamat" value="<?php echo $client == '' ? '' : ucwords($client->alamat) ?>" size="100"/></td>
                        </tr>
                        <tr>
                            <td>No Telp</td>
                            <td>:</td>
                            <td><input type="text" name="noTelp" value="<?php echo $client == '' ? '' : $client->noTelp ?>"/></td>
                        </tr>
                        <tr>
                            <td>No Hp</td>
                            <td>:</td>
                            <td><input type="text" name="noHp" value="<?php echo $client == '' ? '' : $client->noHp ?>"/></td>
                        </tr>
                        <tr>
                            <td>PIC Pembelian</td>
                            <td>:</td>
                            <td><input type="text" name="picPembelian" value="<?php echo $client == '' ? '' : ucwords($client->picPembelian) ?>"/></td>
                        </tr>
                        <tr>
                            <td>PIC Tagihan</td>
                            <td>:</td>
                            <td><input type="text" name="picTagihan" value="<?php echo $client == '' ? '' : ucwords($client->picTagihan) ?>"/></td>
                        </tr>
                        <tr>
                            <td>Keterangan TF</td>
                            <td>:</td>
                            <td><input id='keteranganTF' type="text" name="keteranganTF" value="<?php echo $client == '' ? '' : ucwords($client->keteranganTF) ?>" size="100"/></td>
                        </tr>
                    </table>
                </td>
            <tr/>
            <tr>
                <td style="padding-top: 15px;border-top: 1px dotted grey">
                    <p style="font-size: 14px;"><span style="color:red;">*)</span> Di isi apabila harga produk yang di jual ke client ini berbeda dengan harga produk yang sudah di set di halaman "Daftar Produk"</p>
                    <table class="table1" border="1">
                        <tr>
                            <td align="center">No</td>
                            <td align="center">Produk</td>
                            <td align="center">Harga Karyawan</td>
                            <td align="center">Harga Jual</td>
                            <td align="center">Harga Jual Diskon</td>
                            <td align="center">Perhitungan</td>
                        </tr>
                        <?php
                        for ($f = 1; $f <= 30; $f++) {
                                $param1[$f] = '';
                                $param2[$f] = '';
                                $param3[$f] = '';
                                $param4[$f] = '';
                                $param5[$f] = '';
                                $param6[$f] = '';
                                $param7[$f] = '';
                        }
                        if ($clientPrice != '') {
                            $c1 = 1;
                            foreach ($clientPrice as $hasil2) {
                                $param1[$c1] = $hasil2->id;
                                $param2[$c1] = $hasil2->idProduct;
                                $param3[$c1] = $hasil2->hargaJual;
                                $param4[$c1] = $hasil2->hargaEmployee;
                                $param6[$c1] = $hasil2->hargaJualDiskon;
                                $param7[$c1] = $hasil2->perhitungan;
                                $c1++;
                            }
                        }
                        for ($f = 1; $f <= 30; $f++) {
                            echo '
                                <tr>
                                    <td align="center">' . $f . '</td>
                                    <td>'
                            ?>
                            <select class="produk cekVal1<?php echo $f?>" name="clientPriceProduct<?php echo $f; ?>">
                                <option value="">Pilih Produk</option>
                                <?php
                                if ($product != '') {
                                    foreach ($product as $hasil1) {
                                        if($param2[$f] == $hasil1->id) $param5[$f]=$hasil1->scheme;
                                        $a = $param2[$f] == $hasil1->id ? "selected='selected'" : '';
                                        echo '<option ' . $a . ' value="' . $hasil1->id . '" scheme="'.$hasil1->scheme.'">' . ucwords($hasil1->nama).' - '.ucwords($hasil1->berat) . ' gr </option>';
                                    }
                                }
                                ?>
                            </select>
                    </td>
                    <td>
                        Rp. <input size='10' type="text" <?php echo $param5[$f] == 'cashback' || $param7[$f] == 'selisih' ? '':'disabled="disabled"'?> class="onlyNumb hargaEmployee cekVal3<?php echo $f?>" name="hargaEmployee<?php echo $f; ?>" value="<?php echo $param4[$f] == '' ? '' : $param4[$f] ?>" /> <span class="cetakHargaEmployee"> </span>
                    </td>
                    <td>
                        Rp. <input size='10' type="text" class="onlyNumb hargaJual cekVal2<?php echo $f?>" name="hargaJual<?php echo $f; ?>" value="<?php echo $param3[$f] == '' ? '' : $param3[$f] ?>" /> <span class="cetakHarga"> </span>
                        <input type="hidden" name="idClientPrice<?php echo $f; ?>" value="<?php echo $param1[$f] == '' ? '' : $param1[$f] ?>"/>
                    </td>
                    <td>
                        Rp. <input size='10' type="text" class="onlyNumb hargaJualDiskon cekVal4<?php echo $f?>" name="hargaJualDiskon<?php echo $f; ?>" value="<?php echo $param6[$f] == '' ? '' : $param6[$f] ?>" /> <span class="cetakHargaDiskon"> </span>                    
                    </td>
                    <td>
                        <select class="perhitungan cekVal5<?php echo $f?>" name="perhitungan<?php echo $f; ?>">
                            <?php
                                $a = $param7[$f] == 'default' ? "selected='selected'" : '';
                                $b = $param7[$f] == 'selisih' ? "selected='selected'" : '';
                                echo '<option ' . $a . ' value="default">Default</option>';
                                echo '<option ' . $b . ' value="selisih">Selisih</option>';
                            ?>
                        </select>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <table>
            <tr>
                <td  style="padding-top:15px;padding-bottom:15px;" colspan="3">
                    <input type="hidden" name="id" value="<?php echo $client == '' ? '' : $client->id ?>"/>
                    <input type="submit" value="Submit"/>&nbsp;
                    <button type="button" onclick="location.href = '<?php echo site_url('setting') ?>';">Cancel</button>
                </td>
            </tr> 
        </table>
    </td>
</tr>
</table>
</form>
<script>
        function validateForm() {
            var a;
            if ($('#nama').val() == "") {
                alert("Nama Masih Kosong !!!");
                return false;
            }
            if ($('#alamat').val() == "") {
                alert("Alamat Masih Kosong !!!");
                return false;
            }
            for(a=1;a<=30;a++){
                if(($('.cekVal1'+a).val() == '' && $('.cekVal2'+a).val() != '') || ($('.cekVal1'+a).val() != '' && $('.cekVal2'+a).val() == '')){
                    alert("Produk / Harga Jual Ada Yang Masih Kosong !!!");
                    return false;
                }else if($('.cekVal3'+a).val() == '' && $('.cekVal3'+a).attr('disabled') != 'disabled'){
                    alert("Harga Karyawan Ada Yang Masih Kosong !!!");
                    return false;   
                }else if(($('.cekVal1'+a).val() == '' && $('.cekVal4'+a).val() != '') || ($('.cekVal1'+a).val() != '' && $('.cekVal4'+a).val() == '')){
                    alert("Harga Jual Diskon Ada Yang Masih Kosong !!!");
                    return false;   
                }
                if($('.cekVal1'+a).val() != '' && $('.cekVal2'+a).val() != ''){
                    for (b = 1; b <= 30; b++) {
                        if(a != b){
                            if($('.cekVal1' + a).val() == $('.cekVal1' + b).val() ){
                                alert($('.cekVal1' + b+ ' option:selected').text()+", Sudah Pernah Dipilih !!!");
                                return false;
                            }
                        }
                    }
                }
                if($('.cekVal1'+a).val() != '' && $('.cekVal2'+a).val() != ''){
                    if(isNaN($('.cekVal2'+a).val()) == true){
                        alert("Harga Jual Ada Yang Tidak Menggunakan Angka !!!");
                        return false;
                    }else if($('.cekVal2'+a).val() % 1 != 0){
                        alert("Harga Jual Ada Yang Desimal !!!");
                        return false;
                    }
                }if($('.cekVal1'+a).val() != '' && $('.cekVal3'+a).val() != ''){
                    if(isNaN($('.cekVal3'+a).val()) == true){
                        alert("Harga Karyawan Ada Yang Tidak Menggunakan Angka !!!");
                        return false;
                    }else if($('.cekVal3'+a).val() % 1 != 0){
                        alert("Harga Karyawan Ada Yang Desimal !!!");
                        return false;
                    }
                }if($('.cekVal1'+a).val() != '' && $('.cekVal4'+a).val() != ''){
                    if(isNaN($('.cekVal4'+a).val()) == true){
                        alert("Harga Jual Diskon Ada Yang Tidak Menggunakan Angka !!!");
                        return false;
                    }else if($('.cekVal4'+a).val() % 1 != 0){
                        alert("Harga Jual Diskon Ada Yang Desimal !!!");
                        return false;
                    }
                }
            }
            window.scrollTo(0, 0);
            $('#loadingAnim').show();
            document.body.scroll = "no";
            document.body.style.overflow = 'hidden';
            document.height = window.innerHeight;
        }
    $(document).ready(function () {
        $('.produk').bind('change', function(){
            var tis=$(this);
            tis.parent().parent().find('.perhitungan')[0].selectedIndex=0;
            tis.parent().parent().find('.cetakHargaEmployee').html('');
            tis.parent().parent().find('.hargaEmployee').val('');
            if($('option:selected',this).attr('scheme') == 'cashback'){
                tis.parent().parent().find('.hargaEmployee').removeAttr('disabled');
            }else{
                tis.parent().parent().find('.hargaEmployee').attr({'disabled':'disabled'});
            }
                $.ajax({
                type: "POST",
                dataType : "json",
                url: "<?php echo site_url('penjualan/numberFormat'); ?>",
                data: 'val='+tis.val()
              }).done(function( data ) {
                    tis.parent().find('.cetakHarga').html(data.val);
              });
        });
        $('.perhitungan').bind('change', function(){
            var tis=$(this);
            if(tis.val() == 'selisih'){
                tis.parent().parent().find('.hargaEmployee').removeAttr('disabled');
            }else{
                if(tis.parent().parent().find('.produk option:selected').attr('scheme') == 'cashback'){
                    tis.parent().parent().find('.hargaEmployee').removeAttr('disabled');
                }else{
                    tis.parent().parent().find('.hargaEmployee').attr({'disabled':'disabled'});
                    tis.parent().parent().find('.cetakHargaEmployee').html('');
                    tis.parent().parent().find('.hargaEmployee').val('');
                }
            }
        });
        $('.hargaJual').bind('change', function(){
            var tis=$(this);
            if(tis.val() == ''){
                tis.parent().find('.cetakHarga').html('');
                tis.parent().parent().find('.cetakHargaDiskon').html('');
                tis.parent().parent().find('.hargaJualDiskon').val('');
            }else{
                tis.parent().parent().find('.hargaJualDiskon').val(tis.val());
                $.ajax({
                type: "POST",
                dataType : "json",
                url: "<?php echo site_url('penjualan/numberFormat'); ?>",
                data: 'val='+tis.val()
              }).done(function( data ) {
                    tis.parent().find('.cetakHarga').html(data.val);
                    tis.parent().parent().find('.cetakHargaDiskon').html(data.val);
              });
            }
        });
        $('.hargaJualDiskon').bind('change', function(){
            var tis=$(this);
            if(tis.val() == ''){
                tis.parent().find('.cetakHargaDiskon').html('');
            }else{
                $.ajax({
                type: "POST",
                dataType : "json",
                url: "<?php echo site_url('penjualan/numberFormat'); ?>",
                data: 'val='+tis.val()
              }).done(function( data ) {
                    tis.parent().find('.cetakHargaDiskon').html(data.val);
              });
            }
        });
        $('.hargaEmployee').bind('change', function(){
            var tis=$(this);
            if(tis.val() == ''){
                tis.parent().find('.cetakHargaEmployee').html('');
            }else{
                $.ajax({
                type: "POST",
                dataType : "json",
                url: "<?php echo site_url('penjualan/numberFormat'); ?>",
                data: 'val='+tis.val()
              }).done(function( data ) {
                    tis.parent().find('.cetakHargaEmployee').html(data.val);
              });
            }
        });
        $('#nama').bind('change', function(){
            var tis=$(this);
            $('#namaPT').val(tis.val());
        });
    });
</script>
