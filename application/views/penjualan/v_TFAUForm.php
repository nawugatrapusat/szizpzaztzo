
</head>
<body>
    <h2><?php echo $typeForm == 0 ? 'Tukar Faktur' : 'Ambil Uang'; ?></h2>
    <form style="padding-left:13px; padding-top: 10px;" onsubmit="return validateForm()" name="penjualanForm" action="<?php echo site_url('penjualan/TFAUFormSave') ?>" method="POST">
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
                        </tr><tr><td><br/></td></tr>
                        <tr style="padding-top: 15px;padding-bottom: 15px;">
                            <td style="border-top: 1px dotted grey;" colspan="3"><b>Kirim Barang</b></td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td><?php echo date("d-m-Y H:i:s", $penjualanById->date) ?></td>
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
                        <?php
                        if($typeForm != 0){
                        ?>
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
                            <td valign="top">Tipe Pembayaran</td>
                            <td>:</td>
                            <td>

                                <span style="color:red;">*</span><select id="tipePembayaran" name="tipePembayaran">
                                    <option value="">Pilih Tipe Pembayaran</option>
                                    <?php
                                    $a = $penjualanById->tipePembayaran == 'tunai' ? "selected='selected'" : '';
                                    $b = $penjualanById->tipePembayaran == 'giro' ? "selected='selected'" : '';
                                    $c = $penjualanById->tipePembayaran == 'giro' ? "" : 'display:none';
                                    ?>
                                    <option <?php echo $a; ?> value="tunai">Tunai</option>
                                    <option <?php echo $b; ?> value="giro">Giro</option>
                                </select>
                                <span id="giro" style="<?php echo $c; ?>">
                                    <select id="idBank" name="idBank">
                                    <option value="">Pilih Bank</option>
                                    <?php
                                    if ($bank != '') {
                                        foreach ($bank as $hasil1) {
                                            $a = $penjualanById->idBank == $hasil1->id && !empty($addEdit) ? "selected='selected'" : '';
                                            echo '<option ' . $a . ' value="' . $hasil1->id . '">' . ucwords($hasil1->namaBank) . ' </option>';
                                        }
                                    }
                                    ?>
                                </select>
                                ,&nbsp;No Giro : <input type="text" id="giroInput" name="noGiro" value="<?php echo $penjualanById->noGiro == '' ? '' : $penjualanById->noGiro ?>"/></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td>

                                <span style="color:red;">*</span><select id="status" name="status">
                                    <option value="">Pilih Status</option>
                                    <?php
                                    $d = $penjualanById->status == 'ambil uang' ? "selected='selected'" : '';
                                    $e = $penjualanById->status == 'manual close' ? "selected='selected'" : '';
                                    $f = $penjualanById->status == 'manual close' ? "" : 'display:none';
                                    ?>
                                    <option <?php echo $d; ?> value="ambil uang">Ambil Uang</option>
                                    <option <?php echo $e; ?> value="manual close">Manual Close</option>
                                </select>&nbsp;<span id="nominal" style="<?php echo $f; ?>">,&nbsp;Nominal : Rp. <span style="color:red;">*</span><input type="text" id="nominalInput" name="nominal" value="<?php echo $penjualanById->nominal == '' ? '' : $penjualanById->nominal ?>"/> <span class="cetakHargaNominal"> </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Biaya Lain</td>
                            <td>:</td>
                            <td>Rp. <input type="text" id='biayaLain' name="biayaLain" value="<?php echo $penjualanById == '' ? '' : $penjualanById->biayaLain ?>"/> <span class="cetakHargaBiayaLain"> </td>
                        </tr>
                        <?php
                        }else{
                        ?>
                        <tr>
                            <td>Tanggal Kembali</td>
                            <td>:</td>
                            <td><input type="text" name="tanggalKembali" id="date" size="10" value="<?php echo $addEdit == '' ? '' : $addEdit->tanggalKembali ?>"/></td>
                        </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td>Pembawa</td>
                            <td>:</td>
                            <td>
                                <span style="color:red;">*</span><select id="idEmployeePic" name="idEmployeePic">
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
                    <td align='right'><?php echo 'Rp. ' . number_format($totalHarga, 0, ',', '.')?></td>
                    </tr>
            </table>
                <table>
                <tr>
                    <td  style="padding-top:30px;padding-bottom:15px;" colspan="3">
                        <input id='typeForm' type="hidden" name="typeForm" value="<?php echo $typeForm == 0 ? 'tukarFaktur' : 'ambilUang'; ?>"/>
                        <input type="hidden" name="addEdit" value="<?php echo $addEdit == false ? 'add' : 'edit'; ?>"/>
                        <input type="hidden" name="idPenjualan" value="<?php echo $penjualanById == '' ? '' : $penjualanById->id ?>"/>
                        <input type="hidden" name="idTFAU" value="<?php echo $addEdit == '' ? '' : $addEdit->id ?>"/>
                        <input type="hidden" name="totalBayar" value="<?php echo $totalHarga ?>"/>
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
        function validateForm() {
            if ($('#idEmployeePic').val() == "") { alert("Pembawa Masih Kosong !!!"); return false; }
            if($('#idEmployeePic').val() != 'tukarFaktur'){
                if ($('#tipePembayaran').val() == "") { 
                    alert("Tipe Pembayaran Masih Kosong !!!"); return false; 
                }else if($('#tipePembayaran').val() == "giro"){
                    if ($('#idBank').val() == "") { alert("Bank Masih Kosong !!!"); return false; }
                    if ($('#giroInput').val() == "") { alert("No Giro Masih Kosong !!!"); return false; }
                }
                if ($('#status').val() == "") {
                    alert("Status Masih Kosong !!!"); 
                    return false; 
                }else if($('#status').val() == "manual close"){
                    if ($('#nominalInput').val() == "") { alert("Nominal Masih Kosong !!!"); return false; }
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
            $("#status").change(function () {
                var status = $(this);
                if(status.val() == 'manual close'){
                    $('#nominal').show();
                }else{
                    $('#nominal').hide();
                    $('#nominalInput').val('');
                }
            });
            $("#tipePembayaran").change(function () {
                var tipePembayaran = $(this);
                if(tipePembayaran.val() == 'giro'){
                    $('#giro').show();
                }else{
                    $('#giro').hide();
                    $('#giroInput').val('');
                    $('#idBank')[0].selectedIndex=0;
                }
            });
            $('#nominalInput').bind('change', function(){
                var tis=$(this);
                if(tis.val() == ''){
                    tis.parent().find('.cetakHargaNominal').html('');
                }else{
                    $.ajax({
                    type: "POST",
                    dataType : "json",
                    url: "<?php echo site_url('penjualan/numberFormat'); ?>",
                    data: 'val='+tis.val()
                  }).done(function( data ) {
                        tis.parent().find('.cetakHargaNominal').html(data.val);
                  });
                }
            });
            $('#biayaLain').bind('change', function(){
                var tis=$(this);
                if(tis.val() == ''){
                    tis.parent().find('.cetakHargaBiayaLain').html('');
                }else{
                    $.ajax({
                    type: "POST",
                    dataType : "json",
                    url: "<?php echo site_url('penjualan/numberFormat'); ?>",
                    data: 'val='+tis.val()
                  }).done(function( data ) {
                        tis.parent().find('.cetakHargaBiayaLain').html(data.val);
                  });
                }
            });
        });
    </script>

