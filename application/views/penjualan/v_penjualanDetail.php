
</head>
<body>
    <h2>Detail Penjualan</h2>
        <table style="border: 1px solid black;">
            <tr>
                <td style="padding-bottom: 15px;">
                    <table>
                        <tr>
                            <td>No Faktur</td>
                            <td>:</td>
                            <td><?php echo $penjualanById->noFaktur ?></td>
                        </tr>
                        <tr>
                            <td>No PO</td>
                            <td>:</td>
                            <td><?php echo $penjualanById == '' ? '' : ucwords($penjualanById->noPo) ?></td>
                        </tr>
                        <tr>
                            <td>Client</td>
                            <td>:</td>
                            <td>
                                    <?php
                                    if ($client != '') {
                                        foreach ($client as $hasil1) {
                                             echo $penjualanById->idClient == $hasil1->id && !empty($penjualanById) ? ucwords($hasil1->nama) : '';
                                        }
                                    }
                                    ?>
                            </td>
                        </tr>
                        <tr><td><br/></td></tr>
                        <tr style="padding-top: 15px;padding-bottom: 15px;">
                            <td style="border-top: 1px dotted grey;" colspan="3"><b>Kirim Barang</b></td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td><?php echo date("d-m-Y H:i:s",$penjualanById->date) ?></td>
                        </tr>
                        <tr>
                            <td>Pembawa</td>
                            <td>:</td>
                            <td>
                                    <?php 
                                    echo $penjualanById->idEmployeePic == '0' && !empty($penjualanById) ? "Bawa Sendiri" : '';
                                    ?>
                                    <?php
                                    if ($employee != '') {
                                        foreach ($employee as $hasil1) {
                                            echo $penjualanById->idEmployeePic == $hasil1->id && !empty($penjualanById) ? ucwords($hasil1->nama) : '';
                                        }
                                    }
                                    ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td><?php echo $penjualanById == '' ? '' : ucfirst($penjualanById->keterangan) ?></td>
                        </tr>
                        <tr><td><br/></td></tr>
                        <tr style="padding-top: 15px;padding-bottom: 15px;">
                            <td style="border-top: 1px dotted grey;" colspan="3"><b>Tukar Faktur</b></td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td><?php echo empty($TF) ? '' : date("d-m-Y H:i:s",$TF->date) ?></td>
                        </tr>
                        <tr>
                            <td>Pembawa</td>
                            <td>:</td>
                            <td>
                                    <?php 
                                    if(!empty($TF)) echo $TF->idEmployeePic == '0' ? "Bawa Sendiri" : '';
                                    ?>
                                    <?php
                                    if ($employee != '') {
                                        foreach ($employee as $hasil1) {
                                            if(!empty($TF)) echo $TF->idEmployeePic == $hasil1->id ? ucwords($hasil1->nama) : '';
                                        }
                                    }
                                    ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td><?php if(!empty($TF))echo ucfirst($TF->keterangan) ?></td>
                        </tr>
                        <tr><td><br/></td></tr>
                        <tr style="padding-top: 15px;padding-bottom: 15px;">
                            <td style="border-top: 1px dotted grey;" colspan="3"><b>Ambil Uang</b></td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td><?php if(!empty($AU))echo date("d-m-Y H:i:s",$AU->date) ?></td>
                        </tr>
                        <tr>
                            <td>Pembawa</td>
                            <td>:</td>
                            <td>
                                    <?php 
                                    if(!empty($AU)) echo $AU->idEmployeePic == '0' && !empty($AU) ? "Bawa Sendiri" : '';
                                    ?>
                                    <?php
                                    if ($employee != '') {
                                        foreach ($employee as $hasil1) {
                                            if(!empty($AU)) echo $AU->idEmployeePic == $hasil1->id ? ucwords($hasil1->nama) : '';
                                        }
                                    }
                                    ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td><?php if(!empty($AU)) echo ucfirst($AU->keterangan) ?></td>
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
                    <td align="center">Total</td>
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
                                echo $paramIdProduct[$f] == $hasil1->id ? ucwords($hasil1->nama).' - '.ucwords($hasil1->merek) : '';
                            }
                        }
                        ?>
                        </td>
                        <td align='right'>
                            <?php echo 'Rp. ' . number_format($paramHargaJual[$f], 0, ',', '.'); ?>
                        </td>
                        <td>
                            <?php echo $paramjumlah[$f] ?>
                        </td>
                        <td align='right'>Rp. 
                            <?php echo number_format($paramjumlah[$f]*$paramHargaJual[$f], 0, ',', '.'); ?>
                        </td>
                        </tr>
                    <?php 
                        $totalHarga=$totalHarga+($paramjumlah[$f]*$paramHargaJual[$f]);
                        $totalJumlah=$totalJumlah+$paramjumlah[$f];
                
                            }
                }
                ?>
                        <tr>
                            <td colspan="3" align="right">Total Bayar&nbsp;</td>
                    <td ><?php echo $totalJumlah?></td>
                    <td  align='right'><?php echo 'Rp. ' . number_format($totalHarga, 0, ',', '.')?></td>
                    </tr>
            </table>
                <table>
                <tr>
                    <td  style="padding-top:30px;padding-bottom:15px;" colspan="3">
                        <button type="button" onclick="location.href = '<?php echo site_url('penjualan') ?>';">Cancel</button>
                    </td>
                </tr> 
            </table>
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
