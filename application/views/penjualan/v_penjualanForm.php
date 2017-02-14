
</head>
<body>
    <h2><?php echo $typeForm == 0 ? 'Tambah Penjualan' : 'Edit Penjualan '; ?></h2>
    <form style="padding-left:13px; padding-top: 10px;" onsubmit="return validateForm()" name="penjualanForm" action="<?php echo site_url('penjualan/penjualanFormSave') ?>" method="POST">
        <table style="border: 1px solid black;">
            <tr>
                <td style="padding-bottom: 15px;">
                    <table>
                        <?php
                        if($typeForm != 0){
                            echo '
                        <tr>
                            <td>No Faktur</td>
                            <td>:</td>
                            <td>'.$penjualanById->noFaktur.'</td>
                        </tr>';
                        }
                        ?>
                        <tr>
                            <td>No PO</td>
                            <td>:</td>
                            <td><input type="text" name="noPo" value="<?php echo $penjualanById == '' ? '' : ucwords($penjualanById->noPo) ?>" size="50"/></td>
                        </tr>
                        <tr>
                            <td>Tanggal Faktur</td>
                            <td>:</td>
                            <td><span style="color:red;">*</span> <input type="text" name="tanggalFaktur" id="date" size="10" value="<?php echo $penjualanById == '' ? '' : $penjualanById->d.'-'.$penjualanById->m.'-'.$penjualanById->y ?>"/></td>
                        </tr>
                        <?php
                        if($typeForm != 0){
//                            echo '
//                        <tr>
//                            <td>Tanggal</td>
//                            <td>:</td>
//                            <td>'.date("d-m-Y H:i:s",$penjualanById->date).'</td>
//                        </tr>';
                        }
                        ?>
                        <tr>
                            <td>Client</td>
                            <td>:</td>
                            <td> <span style="color:red;">*</span> 
                                <select id="idClient" name="idClient">
                                    <option value="">Pilih Client</option>
                                    <?php
                                    if ($client != '') {
                                        foreach ($client as $hasil1) {
                                            $a = $penjualanById->idClient == $hasil1->id && !empty($penjualanById) ? "selected='selected'" : '';
                                            echo '<option ' . $a . ' value="' . $hasil1->id . '">' . ucwords($hasil1->nama) . ' </option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Pembawa</td>
                            <td>:</td>
                            <td> 
                                <?php
                                    if($this->session->userdata('id_admin') == '1'){
                                ?>
                                    <span style="color:red;">*</span> 
                                        <select id="idEmployeePic" name="idEmployeePic">
                                            <option value="">Pilih Pembawa</option>
                                            <?php 
                                            $a=$penjualanById->idEmployeePic == '0' && !empty($penjualanById) ? "selected='selected'" : '';
                                            ?>
                                            <option <?php echo $a; ?> value="0">Bawa Sendiri</option>;
                                            <?php
                                            if ($employee != '') {
                                                foreach ($employee as $hasil1) {
                                                    $a = $penjualanById->idEmployeePic == $hasil1->id && !empty($penjualanById) ? "selected='selected'" : '';
                                                    echo '<option ' . $a . ' value="' . $hasil1->id . '">' . ucwords($hasil1->nama) . ' </option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                <?php
                                    }else{
                                        $empp=$this->m_employee->empGetById($this->session->userdata('id_employee'));
                                        echo ucwords($empp->nama);
                                        echo '<input type="hidden" id="idEmployeePic" name="idEmployeePic" value="'.$this->session->userdata('id_employee').'"/>';
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Diskon</td>
                            <td>:</td>
                            <td>
                                <select id="diskon" name="diskon">
                                    <?php 
                                        $a=$penjualanById->diskon == 'tidak' && !empty($penjualanById) ? "selected='selected'" : '';
                                        $b=$penjualanById->diskon == 'nominal' && !empty($penjualanById) ? "selected='selected'" : '';
                                        $c=$penjualanById->diskon == 'persen' && !empty($penjualanById) ? "selected='selected'" : '';
                                        
                                        $z=$penjualanById->diskon == 'tidak' && !empty($penjualanById) ? 'disabled="disabled"' : '';
                                    ?>
                                    <option <?php echo $a; ?> value="tidak">Tidak</option>
                                    <option <?php echo $b; ?> value="nominal">Nominal</option>
                                    <option <?php echo $c; ?> value="persen">Persen</option>
                                </select>
                                <input type="text" <?php echo $z?>  class='onlyNumb' id="jumlahDiskon" name="jumlahDiskon" value="<?php echo $penjualanById == '' ? '' : ucfirst($penjualanById->jumlahDiskon) ?>" size="10"/> <span class="cetakHargaDiskon"> </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td><input type="text" name="keterangan" value="<?php echo $penjualanById == '' ? '' : ucfirst($penjualanById->keterangan) ?>" size="80"/></td>
                        </tr>
                    </table>
                </td>
            <tr/>
            <tr>
                <td> <!style="padding-top: 15px;border-top: 1px dotted grey"--!>
                    <!--<p style="font-size: 14px;">*) Di isi apabila harga produk yang di jual ke client ini berbeda dengan harga produk yang sudah di set di halaman "Daftar Produk"</p>-->
                    <table class="table1" border="1">
                        <tr>
                            <td align="center">No</td>
                            <td align="center">Produk</td>
                            <td align="center">Harga Jual</td>
                            <td align="center">Jumlah</td>
                        </tr>
                        <?php
                        for ($f = 1; $f <= 50; $f++) {
                            $paramId[$f] = '';
                            $paramIdProduct[$f] = '';
                            $paramHargaBeli[$f] = '';
                            $paramHargaJual[$f] = '';
                            $paramjumlah[$f] = '';
                            $paramHargaEmployee[$f] = '';
                            $paramScheme[$f] = '';
                        }
                        if ($penjualanDetail != '') {
                            $c1 = 1;
                            foreach ($penjualanDetail as $hasil2) {
                                $paramId[$c1] = $hasil2->id;
                                $paramIdProduct[$c1] = $hasil2->idProduct;
                                $paramHargaBeli[$c1] = $hasil2->hargaBeli;
                                $paramHargaJual[$c1] = $hasil2->hargaJual;
                                $paramHargaBeli[$c1] = $hasil2->hargaBeli;
                                $paramjumlah[$c1] = $hasil2->jumlah;
                                $paramHargaEmployee[$c1] = $hasil2->hargaEmployee;
                                $paramScheme[$c1] = $hasil2->scheme;
                                $c1++;
                            }
                        }
                        for ($f = 1; $f <= 50; $f++) {
                            echo '
                                <tr>
                                    <td align="center">' . $f . '</td>
                                    <td>'
                            ?>
                             </span> <select class="idProduct cekVal1<?php echo $f?>" name="idProduct<?php echo $f; ?>">
                                <option value="">Pilih Produk</option>
                                <?php
                                if ($product != '') {
                                    foreach ($product as $hasil1) {
                                        $a = $paramIdProduct[$f] == $hasil1->id ? "selected='selected'" : '';
                                        echo '<option ' . $a . ' value="' . $hasil1->id . '">' . ucwords($hasil1->nama).' - '.ucwords($hasil1->berat) . ' gr </option>';
                                    }
                                }
                                ?>
                            </select>
                    </td>
                    <td>
                        <input class="cetakHargaJual" type="text" value="<?php echo $paramHargaJual[$f] == '' ? '' : 'Rp. '.number_format($paramHargaJual[$f],0,',','.') ?>" disabled/>
                    </td>
                    <td>
                         <input class='onlyNumb cekVal2<?php echo $f?>' type="text" name="jumlah<?php echo $f; ?>" value="<?php echo $paramjumlah[$f] == '' ? '' : $paramjumlah[$f] ?>" size="5"/>
                        <input type="hidden" class="hargaBeli" name="hargaBeli<?php echo $f; ?>" value="<?php echo $paramHargaBeli[$f] == '' ? '' : $paramHargaBeli[$f] ?>"/>
                        <input type="hidden" class="hargaJual" name="hargaJual<?php echo $f; ?>" value="<?php echo $paramHargaJual[$f] == '' ? '' : $paramHargaJual[$f] ?>"/>
                        <input type="hidden" class="hargaEmployee" name="hargaEmployee<?php echo $f; ?>" value="<?php echo $paramHargaEmployee[$f] == '' ? '' : $paramHargaEmployee[$f] ?>"/>
                        <input type="hidden" class="scheme" name="scheme<?php echo $f; ?>" value="<?php echo $paramScheme[$f] == '' ? '' : $paramScheme[$f] ?>"/>
                        <input type="hidden" name="id<?php echo $f; ?>" value="<?php echo $paramId[$f] == '' ? '' : $paramId[$f] ?>"/>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <table>
            <tr>
                <td  style="padding-top:30px;padding-bottom:15px;" colspan="3">
                    <input type="hidden" name="id" value="<?php echo $penjualanById == '' ? '' : $penjualanById->id ?>"/>
                    <input type="submit" value="Submit"/>&nbsp;
                    <button type="button" onclick="location.href = '<?php echo site_url('penjualan') ?>';">Cancel</button>
                </td>
            </tr> 
    </td>
</tr>
</table>
</form>
<script>
        function validateForm() {
            var a;
            if ($('#date').val() == "") { alert("Tanggal Faktur Masih Kosong !!!"); return false; }
            if ($('#idClient').val() == "") { alert("Client Masih Kosong !!!"); return false; }
            if ($('#idEmployeePic').val() == "") { alert("Pembawa Masih Kosong !!!"); return false; }
            if ($('#diskon').val() != "tidak" && $("#jumlahDiskon").val() == '') { alert("Nominal / Persen Diskon Masih Kosong !!!"); return false; }
            for(a=1;a<=50;a++){
                if(($('.cekVal1'+a).val() == '' && $('.cekVal2'+a).val() != '') || ($('.cekVal1'+a).val() != '' && $('.cekVal2'+a).val() == '')){
                    alert("Produk / Jumlah Ada Yang Masih Kosong !!!");
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
        $("#date").datepicker({ dateFormat: 'dd-mm-yy' });
        $(".idProduct").change(function(){
            var product = $(this),client;
            if($("#idClient").val() != ''){
                    product.parent().parent().find('.cetakHargaJual').val('');
                    product.parent().parent().find('.hargaJual').val('');
                    product.parent().parent().find('.hargaBeli').val('');
                    product.parent().parent().find('.hargaEmployee').val('');
                    product.parent().parent().find('.scheme').val('');
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
                            product.parent().parent().find('.hargaEmployee').val(data.hargaEmployee);
                            product.parent().parent().find('.scheme').val(data.scheme);
                      });
                }
//                else{
//                    product.parent().parent().find('.cetakHargaJual').val('');
//                    product.parent().parent().find('.hargaJual').val('');
//                    product.parent().parent().find('.hargaBeli').val('');
//                    product.parent().parent().find('.hargaEmployee').val('');
//                    product.parent().parent().find('.scheme').val('');
//                }
            }else{
                alert('Client harap di pilih dahulu');
                product[0].selectedIndex=0;
            }
    
        });
        $("#diskon").change(function(){
            $("#jumlahDiskon").val('');
            $(".cetakHargaDiskon").html('');
            var tis = $(this);
            if(tis.val() != 'tidak'){
                $('#jumlahDiskon').removeAttr('disabled');
            }else{
                $('#jumlahDiskon').attr('disabled','disabled');
            }
        });
        $("#jumlahDiskon").change(function(){
            var tis = $(this);
            if(tis.val() != '' && $("#diskon").val() == 'nominal'){
                $.ajax({
                type: "POST",
                dataType : "json",
                url: "<?php echo site_url('penjualan/numberFormat'); ?>",
                data: 'val='+tis.val()
              }).done(function( data ) {
                    tis.parent().find('.cetakHargaDiskon').html(data.val);
              });
            }else if(tis.val() != '' && $("#diskon").val() == 'persen'){
                tis.parent().find('.cetakHargaDiskon').html(tis.val()+' %');
            }
        });
    });
</script>
