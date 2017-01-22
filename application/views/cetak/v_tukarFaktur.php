   
<html>
    <head>
        <title>Tukar Faktur</title>
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
            .warning-area{margin:0px 0px 10px 0px;padding:10px 10px 10px 45px;border:1px solid #ff6666; color:#BF0000;background:#ffcccc url('<?php echo site_url()?>/public/images/admin/warn_back.jpg') 10px center no-repeat}
            .warning-area:hover{cursor:pointer}
        </style>
    </head>
    <?php

    if ($datas['inject'] == 0) {
        $failedNotifShow = 'display: none;';
        $bodyShow='';
    }else{
        $failedNotifShow = '';
        $bodyShow='display: none;';
    }
    ?>

    <div class="warning-area" style="<?php echo $failedNotifShow; ?>"><?php echo $datas['failedNotif']; ?></div>
    
    <body style='font-family:tahoma; font-size:8pt;padding-top:20px;'>
    <center style='<?php echo $bodyShow; ?>'>
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
                    <b><span style='font-size:12pt'>Tukar Faktur</span></b></br>
                    Kepada YTH <?php echo ucwords($detailClient->nama) ?></br>
                    <?php echo ucwords($detailClient->alamat) ?><br/>
                    Telah diterima dari : Sari Puspita Herba<br/>
                    Faktur sebanyak : <?php echo $datas['jumlah']?> lembar
                </td>
            </tr>
        </table><br/>
        <table cellspacing='0' style='width:550px; font-size:8pt; font-family:calibri;  border-collapse: collapse;' border='1'>
            <tr>
                    <td align="center" width='20px;'>No</td>
                    <td align="center" width='176px;'>Tanggal</td>
                    <td align="center" width='176px;'>No Faktur</td>
                    <td align="center" width='176px'>Jumlah</td>
                </tr>
                <?php
                $b=1;
                $totalHarga=0;
                    if($datas != ''){
                        for($a=3;$a<3+$datas['jumlah'];$a++){
                            echo '
                                    <tr>
                                        <td style="padding-left: 5px;">'.$b.'</td>
                                        <td style="padding-left: 5px;">'.$datas[$a]['tanggal'].'</td>
                                        <td style="padding-left: 5px;">'.$datas[$a]['noFaktur'].'</td>
                                        <td style="padding-left: 5px;">Rp. '.number_format($datas[$a]['totalBayar'], 0, ',', '.').'</td>
                                    </tr>
                                ';
                            $b++;
                            $totalHarga=$totalHarga+$datas[$a]['totalBayar'];
                        }
                    }
                ?>
                        <tr>
                            <td colspan="3" align="right">Total Bayar&nbsp;&nbsp;&nbsp;</td>
                    <td  style='padding-left: 5px;'><?php echo 'Rp. ' . number_format($totalHarga, 0, ',', '.')?></td>
                    </tr>
        </table><br/>
        <table style='width:500px; font-size:7pt;' cellspacing='2'>
            <tr>
                <td align='center' valign='top'>Kembali Tanggal : ................................</td>
                <td align='center'>Cap / Tanda Tangan,</br></br></br></br></br></br>(...........................)</td>
            </tr>
        </table>
    </center>
</body>
</html>