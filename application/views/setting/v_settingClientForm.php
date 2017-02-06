</head>
<body>
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
                            <td align="center">Harga Jual</td>
                        </tr>
                        <?php
                        for ($f = 1; $f <= 30; $f++) {
                                $param1[$f] = '';
                                $param2[$f] = '';
                                $param3[$f] = '';
                        }
                        if ($clientPrice != '') {
                            $c1 = 1;
                            foreach ($clientPrice as $hasil2) {
                                $param1[$c1] = $hasil2->id;
                                $param2[$c1] = $hasil2->idProduct;
                                $param3[$c1] = $hasil2->hargaJual;
                                $c1++;
                            }
                        }
                        for ($f = 1; $f <= 30; $f++) {
                            echo '
                                <tr>
                                    <td align="center">' . $f . '</td>
                                    <td>'
                            ?>
                            <select class="cekVal1<?php echo $f?>" name="clientPriceProduct<?php echo $f; ?>">
                                <option value="">Pilih Produk</option>
                                <?php
                                if ($product != '') {
                                    foreach ($product as $hasil1) {
                                        $a = $param2[$f] == $hasil1->id ? "selected='selected'" : '';
                                        echo '<option ' . $a . ' value="' . $hasil1->id . '">' . ucwords($hasil1->nama).' - '.ucwords($hasil1->berat) . ' gr </option>';
                                    }
                                }
                                ?>
                            </select>
                    </td>
                    <td>
                        Rp. <input type="text" class="hargaJual cekVal2<?php echo $f?>" name="hargaJual<?php echo $f; ?>" value="<?php echo $param3[$f] == '' ? '' : $param3[$f] ?>" /> <span class="cetakHarga"> </span>
                        <input type="hidden" name="idClientPrice<?php echo $f; ?>" value="<?php echo $param1[$f] == '' ? '' : $param1[$f] ?>"/>
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
            for(a=1;a<=5;a++){
                if(($('.cekVal1'+a).val() == '' && $('.cekVal2'+a).val() != '') || ($('.cekVal1'+a).val() != '' && $('.cekVal2'+a).val() == '')){
                    alert("Produk / Harga Jual Ada Yang Masih Kosong !!!");
                    return false;
                }
            }
            window.scrollTo(0, 0);
            $('#loadingAnim').show();
            document.body.scroll = "no";
            document.body.style.overflow = 'hidden';
            document.height = window.innerHeight;
        }
    $(document).ready(function () {
        $('.hargaJual').bind('change', function(){
            var tis=$(this);
            if(tis.val() == ''){
                tis.parent().find('.cetakHarga').html('');
            }else{
                $.ajax({
                type: "POST",
                dataType : "json",
                url: "<?php echo site_url('penjualan/numberFormat'); ?>",
                data: 'val='+tis.val()
              }).done(function( data ) {
                    tis.parent().find('.cetakHarga').html(data.val);
              });
            }
        });
    });
</script>
