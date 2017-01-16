</head>
<body>
    <h2><?php echo $typeForm == 0 ? 'Tambah Client' : 'Edit Client '; ?></h2>
    <form style="padding-left:13px; padding-top: 10px;" name="clientForm" action="<?php echo site_url('setting/clientFormSave/0') ?>" method="POST">
        <table style="border: 1px solid black;">
            <tr>
                <td style="padding-bottom: 15px;">
                    <table>
                        <tr>
                            <td>Nama Client</td>
                            <td>:</td>
                            <td><input type="text" name="nama" value="<?php echo $client == '' ? '' : ucwords($client->nama) ?>" size="50"/></td>
                        </tr>
                        <tr>
                            <td>Alamat Client</td>
                            <td>:</td>
                            <td><input type="text" name="alamat" value="<?php echo $client == '' ? '' : ucwords($client->alamat) ?>" size="100"/></td>
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
                    <p style="font-size: 14px;">*) Di isi apabila harga produk yang di jual ke client ini berbeda dengan harga produk yang sudah di set di halaman "Daftar Produk"</p>
                    <table>
                        <tr>
                            <td align="center">No</td>
                            <td align="center">Produk</td>
                            <td align="center">Harga Jual</td>
                        </tr>
                        <?php
                        for ($f = 1; $f <= 5; $f++) {
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
                        for ($f = 1; $f <= 5; $f++) {
                            echo '
                                <tr>
                                    <td align="center">' . $f . '</td>
                                    <td>'
                            ?>
                            <select name="clientPriceProduct<?php echo $f; ?>">
                                <option value="">Pilih Produk</option>
                                <?php
                                if ($product != '') {
                                    foreach ($product as $hasil1) {
                                        $a = $param2[$f] == $hasil1->id ? "selected='selected'" : '';
                                        echo '<option ' . $a . ' value="' . $hasil1->id . '">' . ucwords($hasil1->nama) . ' </option>';
                                    }
                                }
                                ?>
                            </select>
                    </td>
                    <td>
                        <input type="text" name="hargaJual<?php echo $f; ?>" value="<?php echo $param3[$f] == '' ? '' : $param3[$f] ?>" />
                        <input type="hidden" name="idClientPrice<?php echo $f; ?>" value="<?php echo $param1[$f] == '' ? '' : $param1[$f] ?>"/>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td  style="padding-top:30px;padding-bottom:15px;" colspan="3">
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
    $(document).ready(function () {

    });
</script>
