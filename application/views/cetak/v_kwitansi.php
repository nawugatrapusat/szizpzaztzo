
<html>
    <head>
        <title>Kwitansi Penjualan</title>
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
                <td width='100%' align='left' style='padding-right:80px; vertical-align:top'>
                    <span style='font-size:12pt'><b>Sari Puspita Herba</b></span><br/> Pamulang Permai I Blok N 2 C Tangerang 15417</br>
                    Tlp &nbsp;&nbsp;&nbsp; : 0851-0048-5662</br>
                    Fax &nbsp;&nbsp;&nbsp; : 021-74710908</br>
                    HP &nbsp;&nbsp;&nbsp;&nbsp; : 0813-8777-5505</br>
                    Email : sbpsbpsbp@gmail.com
                </td>
            </tr>
        </table><br/>
        <table cellspacing='0' style='width:550px; font-size:8pt; font-family:calibri;  border-collapse: collapse;border: 1px solid black;'>
                <tr>
                    <td style="padding-top: 10;padding-bottom: 10;" align="center" colspan="3" ><b style="font-size: 14">KWITANSI</b></td>
                </tr>
                <tr>
                    <td style="padding-left: 10;" align="left" width="90">No</td>
                    <td align="left">:</td>
                    <td align="left"><u><?php echo $penjualanById->noFaktur?></u></td>
                </tr>
                <tr>
                    <td style="padding-left: 10;" align="left">Telah terima dari</td>
                    <td align="left">:</td>
                    <td align="left"><u><?php echo ucwords($detailClient->nama)?></u></td>
                </tr>
                <tr>
                    <td style="padding-left: 10;" align="left">Terbilang</td>
                    <td align="left">:</td>
                    <td align="left"><u><?php echo ucwords($this->input->post('uangSejumlah'))?></u></td>
                </tr>
                <tr>
                    <td style="padding-left: 10;" align="left" valign="top">Untuk Pembayaran</td>
                    <td align="left" valign="top">:</td>
                    <td align="left"><u>Faktur tanggal <?php echo date("d-M-Y",strtotime($penjualanById->d.'-'.$penjualanById->m.'-'.$penjualanById->y));?> sebesar Rp. <?php 
                    if($penjualanById->diskon == 'nominal'){
                        $nom= 'Rp. ' . number_format($penjualanById->nominalFaktur-$penjualanById->jumlahDiskon, 0, ',', '.');
                    }else if($penjualanById->diskon == 'persen'){
                        $nom= 'Rp. ' . number_format($penjualanById->nominalFaktur-($penjualanById->jumlahDiskon*$penjualanById->nominalFaktur/100), 0, ',', '.');
                    }else if ($penjualanById->diskon == 'tidak'){
                        $nom= 'Rp. ' . number_format($penjualanById->nominalFaktur, 0, ',', '.');
                    }
                        echo $nom;    ?>,- </u></td>
                </tr>
                <tr>
                    <td style="padding-left: 10;" align="left">Sejumlah</td>
                    <td align="left">:</td>
                    <td align="left"><u><?php echo $nom;?>,- </u></td>
                </tr>
                <tr>
                    <td align="right" colspan="3" style="padding-right: 60">Jakarta, <?php echo date("d-M-Y",strtotime($penjualanById->d.'-'.$penjualanById->m.'-'.$penjualanById->y))?></td>
                </tr>
                <tr>
                    <td align="right" colspan="3"><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></td>
                </tr>
        </table>
    </center>
</body>
</html>