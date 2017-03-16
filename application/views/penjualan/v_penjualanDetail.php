
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
                            <td><?php echo date("d-M-Y",strtotime($penjualanById->d.'-'.$penjualanById->m.'-'.$penjualanById->y)) ?></td>
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
                            <td><?php echo empty($TF) ? '' : date("d-M-Y",strtotime($TF->d.'-'.$TF->m.'-'.$TF->y)) ?></td>
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
                            <td>Tanggal Kembali</td>
                            <td>:</td>
                            <td><?php echo empty($TF) ? '' : $TF->tanggalKembali ?></td>
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
                            <td><?php if(!empty($AU))echo date("d-M-Y",strtotime($AU->d.'-'.$AU->m.'-'.$AU->y)) ?></td>
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
                            <td>Tipe Pembayaran</td>
                            <td>:</td>
                            <td><?php if(!empty($penjualanById)) echo ucwords($penjualanById->tipePembayaran) ?></td>
                        </tr>
                        <?php
                        if(!empty($penjualanById) && $penjualanById->tipePembayaran == 'giro'){
                            foreach($bank as $hasil1){
                                if($hasil1->id == $penjualanById->idBank) $namaBank=$hasil1->namaBank;
                            }
                        ?>
                        <tr>
                            <td>Bank</td>
                            <td>:</td>
                            <td><?php echo ucwords($namaBank).', No Giro : '.$penjualanById->noGiro ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td>Nominal Faktur</td>
                            <td>:</td>
                            <td><?php if(!empty($penjualanById) && !empty($penjualanById->nominalFaktur)) echo 'Rp. ' . number_format($penjualanById->nominalFaktur, 0, ',', '.') ?></td>
                        </tr>
                        <tr>
                            <td>Diskon</td>
                            <td>:</td>
                            <td><?php 
                                $pa='';
                                if($penjualanById->diskon == 'nominal'){
                                    $ca=$penjualanById->jumlahDiskon;
                                    $ct='Rp. ' . number_format($penjualanById->nominalFaktur-$penjualanById->jumlahDiskon, 0, ',', '.');
                                }else if($penjualanById->diskon == 'persen'){
                                    $pa=''.$penjualanById->jumlahDiskon.' %';
                                    $ca=$penjualanById->jumlahDiskon*$penjualanById->nominalFaktur/100;
                                    $ct='Rp. ' . number_format($penjualanById->nominalFaktur-($penjualanById->jumlahDiskon*$penjualanById->nominalFaktur/100), 0, ',', '.');
                                }else if ($penjualanById->diskon == 'tidak'){
                                    $ca='0';
                                    $ct='Rp. ' . number_format($penjualanById->nominalFaktur, 0, ',', '.');
                                }
                            if(!empty($penjualanById) && !empty($penjualanById->diskon)) echo ucwords($penjualanById->diskon).' / '.$pa.' / '.'Rp. ' . number_format($ca, 0, ',', '.')
                            ?></td>
                        </tr>
                        <tr>
                            <td>Nominal Faktur</td>
                            <td>:</td>
                            <td><?php 
                                if($penjualanById->diskon == 'nominal'){
                                    $ct='Rp. ' . number_format($penjualanById->nominalFaktur-$penjualanById->jumlahDiskon, 0, ',', '.');
                                }else if($penjualanById->diskon == 'persen'){
                                    $ct='Rp. ' . number_format($penjualanById->nominalFaktur-($penjualanById->jumlahDiskon*$penjualanById->nominalFaktur/100), 0, ',', '.');
                                }else if ($penjualanById->diskon == 'tidak'){
                                    $ct='Rp. ' . number_format($penjualanById->nominalFaktur, 0, ',', '.');
                                }
                                if(!empty($penjualanById) && !empty($penjualanById->nominalFaktur)) echo $ct; 
                            ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td><?php if(!empty($penjualanById)) {echo ucwords($penjualanById->status);} if($penjualanById->status == 'manual close') {echo ', Rp. ' . number_format($penjualanById->nominal, 0, ',', '.');} ?></td>
                        </tr>
                        <tr>
                            <td>Biaya Lain</td>
                            <td>:</td>
                            <td><?php if(!empty($penjualanById) && !empty($penjualanById->biayaLain)) echo 'Rp. ' . number_format($penjualanById->biayaLain, 0, ',', '.') ?></td>
                        </tr>
                        <tr>
                            <td>Hasil</td>
                            <td>:</td>
                            <td><?php if(!empty($penjualanById) && !empty($penjualanById->totalBayar)) echo 'Rp. ' . number_format($penjualanById->totalBayar, 0, ',', '.') ?></td>
                        </tr>
                        <tr>
                            <td>Cashback</td>
                            <td>:</td>
                            <td><?php echo 'Rp. ' . number_format($cashback, 0, ',', '.') ?></td>
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
                    <td align="center" style='background-color: #c4fad1;'>Total</td>
                    <td align="center">Harga Karyawan</td>
                    <td align="center" style='background-color: #c4fad1;'>Cashback</td>
                    <td align="center" style='background-color: #c4fad1;'>Pendapatan</td>
                </tr>
                <?php
                $totalHarga=0;
                $totalJumlah=0;
                $totcashback=0;
                $totperhitungan=0;
                for ($f = 1; $f <= 50; $f++) {
                    $paramId[$f] = '';
                    $paramIdProduct[$f] = '';
                    $paramHargaBeli[$f] = '';
                    $paramHargaJual[$f] = '';
                    $paramHargaJualDiskon[$f] = '';
                    $paramjumlah[$f] = '';
                    $paramcashback[$f]='0';
                    $paramhargaemp[$f]='0';
                    $paramperhitungan[$f]='0';
                }
                if ($penjualanDetail != '') {
                    $c1 = 1;
                    foreach ($penjualanDetail as $hasil2) {
                        $paramId[$c1] = $hasil2->id;
                        $paramIdProduct[$c1] = $hasil2->idProduct;
                        $paramHargaBeli[$c1] = $hasil2->hargaBeli;
                        $paramHargaJual[$c1] = $hasil2->hargaJual;
                        $paramHargaJualDiskon[$c1] = $hasil2->hargaJualDiskon;
                        $paramHargaBeli[$c1] = $hasil2->hargaBeli;
                        $paramjumlah[$c1] = $hasil2->jumlah;
                        if($hasil2->scheme == 'cashback'){
                            $paramhargaemp[$c1]=$hasil2->hargaEmployee;
                            $paramcashback[$c1]=((($hasil2->hargaJual-$hasil2->hargaEmployee)/2)*$hasil2->jumlah);
                            $paramcashback[$c1]=$hasil2->perhitungan == 'default' ? $paramcashback[$c1] : 0;
                            $totcashback=$totcashback+$paramcashback[$c1];
                        }
                        if($hasil2->perhitungan == 'selisih'){
                            $paramperhitungan[$c1]=($hasil2->hargaJual-$hasil2->hargaEmployee)*$hasil2->jumlah;
                            $totperhitungan=$totperhitungan+$paramperhitungan[$c1];
                        }
                        $c1++;
                    }
                }
                for ($f = 1; $f <= 50; $f++) {
                    if ($paramHargaJualDiskon[$f] != '' && $paramjumlah[$f] != '') {
                        echo '
                                        <tr>
                                            <td align="center">' . $f . '</td>
                                            <td>'
                        ?>
                        <?php
                        if ($product != '') {
                            foreach ($product as $hasil1) {
                                echo $paramIdProduct[$f] == $hasil1->id ? ucwords($hasil1->nama).' - '.ucwords($hasil1->berat).' gr' : '';
                            }
                        }
                        ?>
                        </td>
                        <td align='right'>
                            <?php echo 'Rp. ' . number_format($paramHargaJualDiskon[$f], 0, ',', '.'); ?>
                        </td>
                        <td align='center'>
                            <?php echo $paramjumlah[$f] ?>
                        </td>
                        <td align='right'>Rp. 
                            <?php echo number_format($paramjumlah[$f]*$paramHargaJualDiskon[$f], 0, ',', '.'); ?>
                        </td>
                        <td align='right'>Rp. 
                            <?php echo number_format($paramhargaemp[$f], 0, ',', '.'); ?>
                        </td>
                        <td align='right'>Rp. 
                            <?php echo number_format($paramcashback[$f], 0, ',', '.'); ?>
                        </td>
                        <td align='right'>Rp. 
                            <?php echo number_format($paramperhitungan[$f], 0, ',', '.'); ?>
                        </td>
                        </tr>
                    <?php 
                        $totalHarga=$totalHarga+($paramjumlah[$f]*$paramHargaJualDiskon[$f]);
                        $totalJumlah=$totalJumlah+$paramjumlah[$f];
                
                            }
                }
                ?>
                    <tr>
                        <td colspan="3" align="right">Total&nbsp;</td>
                        <td  align='center'><?php echo $totalJumlah?></td>
                        <td align='right' style='background-color: #c4fad1;'><?php echo 'Rp. ' . number_format($totalHarga, 0, ',', '.')?></td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td colspan="4" align="right">Diskon<?php echo $pa ?>&nbsp;</td>
                        <td align='right'><?php echo 'Rp. ' . number_format($ca, 0, ',', '.') ?></td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td colspan="4" align="right">Total Bayar&nbsp;</td>
                        <td align='right' style='background-color: #c4fad1;'><?php echo $penjualanById->diskon == 'persen' ? 'Rp. ' . number_format($totalHarga-($totalHarga*$penjualanById->jumlahDiskon/100), 0, ',', '.') : 'Rp. ' . number_format($totalHarga-$penjualanById->jumlahDiskon, 0, ',', '.') ?></td>
                        <td align='right'>Total</td>
                        <td align='right' style='background-color: #c4fad1;'><?php echo 'Rp. ' . number_format($totcashback, 0, ',', '.')?></td>
                        <td align='right' style='background-color: #c4fad1;'><?php echo 'Rp. ' . number_format($totperhitungan, 0, ',', '.')?></td>
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
