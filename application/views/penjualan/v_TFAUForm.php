
</head>
<body>
    <h2><?php echo $typeForm == 0 ? 'Tukar Faktur' : 'Ambil Uang'; ?></h2>
    <form style="padding-left:13px; padding-top: 10px;" name="penjualanForm" action="<?php echo site_url('penjualan/TFAUFormSave') ?>" method="POST">
        <table style="border: 1px solid black;">
            <tr>
                <td style="padding-bottom: 15px;">
                    <table>
                        <tr>
                            <td>No Faktur</td>
                            <td>:</td>
                            <td><?php echo $penjualanById->noFaktur; ?></td>
                        </tr>
                        <tr>
                            <td>No PO</td>
                            <td>:</td>
                            <td><?php echo ucwords($penjualanById->noPo); ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td><?php echo date("d-m-Y H:i:s", $penjualanById->date) ?></td>
                        </tr>
                        <tr>
                            <td>Client</td>
                            <td>:</td>
                            <td>
                                <?php
                                if ($client != '') {
                                    foreach ($client as $hasil1) {
                                        echo $penjualanById->idClient == $hasil1->id ? ucwords($hasil1->nama) : '';
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Pembawa</td>
                            <td>:</td>
                            <td>
                                <select id="idEmployeePic" name="idEmployeePic">
                                    <option value="">Pilih Pembawa</option>
                                    <?php
                                    $a = $addEdit->idEmployeePic == '0' ? "selected='selected'" : '';
                                    ?>
                                    <option <?php echo $a; ?> value="0">Bawa Sendiri</option>;
                                    <?php
                                    if ($employee != '') {
                                        foreach ($employee as $hasil1) {
                                            $a = $addEdit->idEmployeePic == $hasil1->id && !empty($addEdit) ? "selected='selected'" : '';
                                            echo '<option ' . $a . ' value="' . $hasil1->id . '">' . ucwords($hasil1->nama) . ' </option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td><input type="text" name="keterangan" value="<?php echo $addEdit == '' ? '' : ucfirst($addEdit->keterangan) ?>" size="80"/></td>
                        </tr>
                        <?php
                        if($typeForm != 0){
                        ?>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td>

                                <select id="status" name="status">
                                    <option value="">Pilih Status</option>
                                    <?php
                                    $a = $penjualanById->status == 'ambil uang' ? "selected='selected'" : '';
                                    $b = $penjualanById->status == 'manual close' ? "selected='selected'" : '';
                                    $c = $penjualanById->status == 'manual close' ? "" : 'display:none';
                                    ?>
                                    <option <?php echo $a; ?> value="ambil uang">Ambil Uang</option>
                                    <option <?php echo $b; ?> value="manual close">Manual Close</option>
                                </select>&nbsp;<span id="nominal" style="<?php echo $c; ?>">,&nbsp;Nominal : Rp.<input type="text" id="nominalInput" name="nominal" value="<?php echo $penjualanById->nominal == '' ? '' : $penjualanById->nominal ?>"/></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Biaya Lain</td>
                            <td>:</td>
                            <td>Rp.<input type="text" name="biayaLain" value="<?php echo $penjualanById == '' ? '' : $penjualanById->biayaLain ?>"/></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                </td>
            <tr/>
            <tr>
                <td> <!style="padding-top: 15px;border-top: 1px dotted grey"--!>
                    <!--<p style="font-size: 14px;">*) Di isi apabila harga produk yang di jual ke client ini berbeda dengan harga produk yang sudah di set di halaman "Daftar Produk"</p>-->
            <table>
                <tr>
                    <td align="center">No</td>
                    <td align="center">Produk</td>
                    <td align="center">Harga Jual</td>
                    <td align="center">Jumlah</td>
                </tr>
                <?php
                $totalHarga=0;
                $totalJumlah=0;
                for ($f = 1; $f <= 15; $f++) {
                    $paramId[$f] = '';
                    $paramIdProduct[$f] = '';
                    $paramHargaBeli[$f] = '';
                    $paramHargaJual[$f] = '';
                    $paramjumlah[$f] = '';
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
                        $c1++;
                    }
                }
                for ($f = 1; $f <= 15; $f++) {
                    if ($paramHargaJual[$f] != '' && $paramjumlah[$f] != '') {
                        echo '
                                        <tr>
                                            <td align="center">' . $f . '</td>
                                            <td>'
                        ?>
                        <?php
                        if ($product != '') {
                            foreach ($product as $hasil1) {
                                echo $paramIdProduct[$f] == $hasil1->id ? ucwords($hasil1->nama) : '';
                            }
                        }
                        ?>
                        </td>
                        <td>
                            <?php echo 'Rp. ' . number_format($paramHargaJual[$f], 0, ',', '.'); ?>
                        </td>
                        <td>
                            <?php echo $paramjumlah[$f] ?>
                        </td>
                        </tr>
                    <?php 
                        $totalHarga=$totalHarga+$paramHargaJual[$f];
                        $totalJumlah=$totalJumlah+$paramjumlah[$f];
                
                            }
                }
                ?>
                        <tr>
                    <td></td>
                    <td >Total</td>
                    <td ><?php echo 'Rp. ' . number_format($totalHarga, 0, ',', '.')?></td>
                    <td ><?php echo $totalJumlah?></td>
                    </tr>
                <tr>
                    <td  style="padding-top:30px;padding-bottom:15px;" colspan="3">
                        <input type="hidden" name="typeForm" value="<?php echo $typeForm == 0 ? 'tukarFaktur' : 'ambilUang'; ?>"/>
                        <input type="hidden" name="addEdit" value="<?php echo $addEdit == false ? 'add' : 'edit'; ?>"/>
                        <input type="hidden" name="idPenjualan" value="<?php echo $penjualanById == '' ? '' : $penjualanById->id ?>"/>
                        <input type="hidden" name="idTFAU" value="<?php echo $addEdit == '' ? '' : $addEdit->id ?>"/>
                        <input type="submit" value="Submit"/>&nbsp;
                        <button type="button" onclick="location.href = '<?php echo site_url('penjualan') ?>';">Cancel</button>
                    </td>
                </tr> 
            </table>
            </td>
            </tr>
        </table>
    </form>
    <script>
        $(document).ready(function () {
            $(".idProduct").change(function () {
                var product = $(this), client;
                if ($("#idClient").val() != '') {
                    if (product.val() != '') {
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "<?php echo site_url('penjualan/cekHarga'); ?>",
                            data: 'idProduct=' + product.val() + '&idClient=' + $("#idClient").val()
                        }).done(function (data) {
                            product.parent().parent().find('.cetakHargaJual').val(data.cetakHargaJual);
                            product.parent().parent().find('.hargaJual').val(data.hargaJual);
                            product.parent().parent().find('.hargaBeli').val(data.hargaBeli);
                        });
                    } else {
                        product.parent().parent().find('.cetakHargaJual').val('');
                        product.parent().parent().find('.hargaJual').val('');
                        product.parent().parent().find('.hargaBeli').val('');
                    }
                } else {
                    alert('Client harap di pilih dahulu');
                    product[0].selectedIndex = 0;
                }

            });
            $("#status").change(function () {
                var status = $(this);
                if(status.val() == 'manual close'){
                    $('#nominal').show();
                }else{
                    $('#nominal').hide();
                    $('#nominalInput').val('');
                }
            });
        });
    </script>
