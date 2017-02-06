
<html>
    <head>
        <title>Surat Jalan</title>
        <style>
            @page {
                size: auto;   /* auto is the initial value */
                margin: 0;  /* this affects the margin in the printer settings */
            }
            #tabel
            {
                font-size:12px;
                border-collapse:collapse;
            }
            #tabel  td
            {
                padding-left:5px;
                border: 1px solid black;
            }
        </style>
    </head>
    <body style='font-family:tahoma; font-size:8pt;padding-top:20px;'>
    <center>
        <table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border = '0'>
            <tr>
                <td>
                    <img src="<?php echo site_url('public/images/admin/logo.png')?>" width="80;"/>
                </td>
                <td width='60%' align='left' style='padding-right:80px; vertical-align:top'>
                    <span style='font-size:12pt'><b>Sari Puspita Herba</b></span></br>
                    Pamulang Permai I Blok N 2 C </br>
                    Tangerang 15417</br>
                    Tlp &nbsp;&nbsp;&nbsp; : 0851-0048-5662</br>
                    Fax &nbsp;&nbsp;&nbsp; : 021-74710908</br>
                    HP &nbsp;&nbsp;&nbsp;&nbsp; : 0813-8777-5505</br>
                    Email : sbpsbpsbp@gmail.com
                </td>
                <td style='vertical-align:top' width='40%' align='left'>
                    <b><span style='font-size:12pt'>Surat Jalan</span></b></br>
                    No : <?php echo $penjualanById->noFaktur ?></br>
                    Tanggal : <?php echo date("d-m-Y", $penjualanById->date) ?><br/>
                    Kepada YTH <?php echo ucwords($detailClient->nama) ?></br>
                    <?php echo ucwords($detailClient->alamat) ?>
                </td>
            </tr>
        </table><br/>
        <table cellspacing='0' style='width:550px; font-size:8pt; font-family:calibri;  border-collapse: collapse;' border='1'>
                <tr>
                    <td align="left" width='20px;' colspan="3" style="padding: 10px 5px 10px 5px;">
                        Kami kirimkan barang-barang tersebut dibawah ini dengan kendaraan R4 / R2 No
                    </td>
                </tr>
                <tr>
                    <td align="center" width='20px;'>No</td>
                    <td align="center">Produk</td>
                    <td align="center" width='40'>Jumlah</td>
                </tr>
                <?php
                $totalHarga=0;
                $totalJumlah=0;
                for ($f = 1; $f <= 50; $f++) {
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
                for ($f = 1; $f <= 50; $f++) {
                    if ($paramHargaJual[$f] != '' && $paramjumlah[$f] != '') {
                        echo '
                                        <tr>
                                            <td align="center">' . $f . '</td>
                                            <td  style="padding-left: 5px;">'
                        ?>
                        <?php
                        if ($product != '') {
                            foreach ($product as $hasil1) {
                                echo $paramIdProduct[$f] == $hasil1->id ? ucwords($hasil1->nama).' - '.ucwords($hasil1->berat).' gr' : '';
                            }
                        }
                        ?>
                        </td>
                        <td align="center">
                            <?php echo $paramjumlah[$f] ?>
                        </td>
                        </tr>
                    <?php 
                        $totalHarga=$totalHarga+($paramjumlah[$f]*$paramHargaJual[$f]);
                        $totalJumlah=$totalJumlah+$paramjumlah[$f];
                
                            }
                }
                ?>
                        <tr>
                            <td colspan="2" align="right">Total&nbsp;&nbsp;&nbsp;</td>
                    <td align='center'><?php echo $totalJumlah?></td>
                    </tr>
                <tr>
        </table><br/>
        <table style='width:650; font-size:7pt;' cellspacing='2'>
            <tr>
                <td align='center'>Diterima Oleh,</br></br></br></br></br></br>(...........................)</td>
                <td align='center'>Hormat Kami,</br></br></br></br></br></br>(...........................)</td>
            </tr>
        </table>
    </center>
</body>
</html>