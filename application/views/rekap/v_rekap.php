<style>
    .tableClass td{
        width: 175px;
        height: 70;
        text-align: left;
        vertical-align: top;
        /*cursor:pointer;*/
    }
    .dateLink1,.dateLink2,.dateLink3,.dateLinkx {
        padding-right: 25px;
        padding-bottom: 20px;
    }
    
</style>
<?php
$tab = get_cookie('tab');
$successNotif = get_cookie('successNotif');
$failedNotif = get_cookie('failedNotif');
delete_cookie('tab');
delete_cookie('successNotif');
delete_cookie('failedNotif');

if (empty($tab))$tab = 0;
if($kustEmployee != '') $tab=3;
if (empty($successNotif)) $successNotifShow = 'display: none;'; else $successNotifShow = '';
if (empty($failedNotif)) $failedNotifShow = 'display: none;'; else $failedNotifShow = '';
?>
<script>
    $(function () {
        $("#tabs").tabs({selected: <?php echo $tab ?>});
    });
</script>
</head>
<body class="bodyclass" style="display: none;">
<?php $this->load->view('template/menu')?>
    <div class="notification-area" style="<?php echo $successNotifShow; ?>"><?php echo $successNotif; ?></div>
    <div class="warning-area" style="<?php echo $failedNotifShow; ?>"><?php echo $failedNotif; ?></div>
    <h2>Rekap</h2>

    <div id="tabs">
        <ul>
            <?php
            $a=1;
            foreach ($emp as $hasil) {
                echo '<li><a href="#tabs'.$a.'">'.ucwords($hasil->nama).'</a></li>';
                $a++;
            }
            echo '<li><a href="#tabs'.$a.'">Kustomisasi</a></li>';
            ?>
        </ul>
        <div id="tabs1">
<table border='1' class="table1 tableClass">
    <tr>
        <td style="text-align:center;height: 20px;">Senin</td>
        <td style="text-align:center;height: 20px;">Selasa</td>
        <td style="text-align:center;height: 20px;">Rabu</td>
        <td style="text-align:center;height: 20px;">Kamis</td>
        <td style="text-align:center;height: 20px;">Jum'at</td>
        <td style="text-align:center;height: 20px;background-color:#ffa5a5 ;">Sabtu</td>
        <td style="text-align:center;height: 20px;background-color:#ffa5a5 ;">Minggu</td>
    </tr>
    <?php
//    $dayAgenda
//    $daysAgenda
//    for($a=0;$a<35$a++;){
        $flag=1;
        $dayFlag=1;
        $count=0;
        echo "<tr>";
        if($agenda1->d1 != '') $cet="Rp ".number_format($agenda1->d1, 0, ',', '.'); else $cet='';
        if($dayAgenda == 'Monday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLink1">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda == 'Tuesday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLink1">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda == 'Wednesday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLink1">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda == 'Thursday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLink1">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda == 'Friday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLink1">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda == 'Saturday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLink1">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda == 'Sunday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLink1">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        $count=$count+($agenda1->d1 == '' ? 0 : $agenda1->d1);
        for($a=2;$a<$daysAgenda+1;$a++){
            $v='d'.$a;
            if($agenda1->$v != '') $cet="Rp ".number_format($agenda1->$v, 0, ',', '.'); else $cet='';
            echo '<td class="agenda" isi="'.$a.'-'.$date.'"><a href="#" class="dateLink1">'.$a.'</a><br/><br/>'.$cet.'</td>';
            $dayFlag2++;
            if($dayFlag2 % 7 == 0) echo "</tr><tr>";
            $count=$count+($agenda1->$v == '' ? 0 : $agenda1->$v);
        }
        while($dayFlag2<35){
            echo "<td></td>";
            $dayFlag2++;
        }
        echo "</tr>";
//    }
    ?>
</table>
            <br/>
            <table style="width: 1270px;">
                <tr>
                    <td align="right">
                        Total = <?php echo "Rp ".number_format($count, 0, ',', '.');?>
                    </td>
                </tr>
            </table>
        </div>
        
        <div id="tabs2">
<table border='1' class="table1 tableClass">
    <tr>
        <td style="text-align:center;height: 20px;">Senin</td>
        <td style="text-align:center;height: 20px;">Selasa</td>
        <td style="text-align:center;height: 20px;">Rabu</td>
        <td style="text-align:center;height: 20px;">Kamis</td>
        <td style="text-align:center;height: 20px;">Jum'at</td>
        <td style="text-align:center;height: 20px;background-color:#ffa5a5 ;">Sabtu</td>
        <td style="text-align:center;height: 20px;background-color:#ffa5a5 ;">Minggu</td>
    </tr>
    <?php
//    $dayAgenda
//    $daysAgenda
//    for($a=0;$a<35$a++;){
        $flag=1;
        $dayFlag=1;
        $count=0;
        echo "<tr>";
        if($agenda2->d1 != '') $cet="Rp ".number_format($agenda2->d1, 0, ',', '.'); else $cet='';
        if($dayAgenda == 'Monday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLink2">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda == 'Tuesday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLink2">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda == 'Wednesday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLink2">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda == 'Thursday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLink2">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda == 'Friday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLink2">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda == 'Saturday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLink2">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda == 'Sunday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLink2">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        $count=$count+($agenda2->d1 == '' ? 0 : $agenda2->d1);
        for($a=2;$a<$daysAgenda+1;$a++){
            $v='d'.$a;
            if($agenda2->$v != '') $cet="Rp ".number_format($agenda2->$v, 0, ',', '.'); else $cet='';
            echo '<td class="agenda" isi="'.$a.'-'.$date.'"><a href="#" class="dateLink2">'.$a.'</a><br/><br/>'.$cet.'</td>';
            $dayFlag2++;
            if($dayFlag2 % 7 == 0) echo "</tr><tr>";
            $count=$count+($agenda2->$v == '' ? 0 : $agenda2->$v);
        }
        while($dayFlag2<35){
            echo "<td></td>";
            $dayFlag2++;
        }
        echo "</tr>";
//    }
    ?>
</table>

            <br/>
            <table style="width: 1270px;">
                <tr>
                    <td align="right">
                        Total = <?php echo "Rp ".number_format($count, 0, ',', '.');?>
                    </td>
                </tr>
            </table>
        </div>
        

        <div id="tabs3">
<table border='1' class="table1 tableClass">
    <tr>
        <td style="text-align:center;height: 20px;">Senin</td>
        <td style="text-align:center;height: 20px;">Selasa</td>
        <td style="text-align:center;height: 20px;">Rabu</td>
        <td style="text-align:center;height: 20px;">Kamis</td>
        <td style="text-align:center;height: 20px;">Jum'at</td>
        <td style="text-align:center;height: 20px;background-color:#ffa5a5 ;">Sabtu</td>
        <td style="text-align:center;height: 20px;background-color:#ffa5a5 ;">Minggu</td>
    </tr>
    <?php
//    $dayAgenda
//    $daysAgenda
//    for($a=0;$a<35$a++;){
        $flag=1;
        $dayFlag=1;
        $count=0;
        echo "<tr>";
        if($agenda3->d1 != '') $cet="Rp ".number_format($agenda3->d1, 0, ',', '.'); else $cet='';
        if($dayAgenda == 'Monday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLink3">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda == 'Tuesday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLink3">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda == 'Wednesday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLink3">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda == 'Thursday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLink3">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda == 'Friday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLink3">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda == 'Saturday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLink3">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda == 'Sunday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLink3">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        $count=$count+($agenda3->d1 == '' ? 0 : $agenda3->d1);
        for($a=2;$a<$daysAgenda+1;$a++){
            $v='d'.$a;
            if($agenda3->$v != '') $cet="Rp ".number_format($agenda3->$v, 0, ',', '.'); else $cet='';
            echo '<td class="agenda" isi="'.$a.'-'.$date.'"><a href="#" class="dateLink3">'.$a.'</a><br/><br/>'.$cet.'</td>';
            $dayFlag2++;
            if($dayFlag2 % 7 == 0) echo "</tr><tr>";
            $count=$count+($agenda3->$v == '' ? 0 : $agenda3->$v);
        }
        while($dayFlag2<35){
            echo "<td></td>";
            $dayFlag2++;
        }
        echo "</tr>";
//    }
    ?>
</table>

            <br/>
            <table style="width: 1270px;">
                <tr>
                    <td align="right">
                        Total = <?php echo "Rp ".number_format($count, 0, ',', '.');?>
                    </td>
                </tr>
            </table>
        </div>
        

        <div id="tabs4">
<form onsubmit="return validateForm()" name="kustomisasiForm" action="<?php echo site_url('rekap/index') ?>" method="POST">
            <table>
                <tr>
                    <td>
                        <select id="kustBulan" name="kustBulan">
                            <option value="">Pilih Bulan</option>
                            <option value="1" <?php echo $kustBulan == '1' ? "selected='selected'" : '';?>>Januari</option>
                            <option value="2" <?php echo $kustBulan == '2' ? "selected='selected'" : '';?>>Februari</option>
                            <option value="3" <?php echo $kustBulan == '3' ? "selected='selected'" : '';?>>Maret</option>
                            <option value="4" <?php echo $kustBulan == '4' ? "selected='selected'" : '';?>>April</option>
                            <option value="5" <?php echo $kustBulan == '5' ? "selected='selected'" : '';?>>Mei</option>
                            <option value="6" <?php echo $kustBulan == '6' ? "selected='selected'" : '';?>>Juni</option>
                            <option value="7" <?php echo $kustBulan == '7' ? "selected='selected'" : '';?>>Juli</option>
                            <option value="8" <?php echo $kustBulan == '8' ? "selected='selected'" : '';?>>Agustus</option>
                            <option value="9" <?php echo $kustBulan == '9' ? "selected='selected'" : '';?>>September</option>
                            <option value="10" <?php echo $kustBulan == '10' ? "selected='selected'" : '';?>>Oktober</option>
                            <option value="11" <?php echo $kustBulan == '11' ? "selected='selected'" : '';?>>November</option>
                            <option value="12" <?php echo $kustBulan == '12' ? "selected='selected'" : '';?>>Desember</option>
                        </select>
                        <select id="kustTahun" name="kustTahun">
                            <option value="">Pilih Tahun</option>
                            <option value="2017" <?php echo $kustTahun == '2017' ? "selected='selected'" : '';?>>2017</option>
                            <option value="2018" <?php echo $kustTahun == '2018' ? "selected='selected'" : '';?>>2018</option>
                            <option value="2019" <?php echo $kustTahun == '2019' ? "selected='selected'" : '';?>>2019</option>
                            <option value="2020" <?php echo $kustTahun == '2020' ? "selected='selected'" : '';?>>2020</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select id="kustEmployee" name="kustEmployee">
                            <option value="">Pilih Karyawan</option>
                        <?php
                            foreach ($emp as $hasil) {
                                $a=$kustEmployee == $hasil->id ? "selected='selected'" : '';
                                echo '<option value="'.$hasil->id.'" '.$a.'>'. ucwords($hasil->nama).'</option>';
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="Submit" /></td>
                </tr>
            </table>
</form>
        <?php 
          if($agendaKust != '' && $agendaKust != false){  
        ?>
            <table border='1' class="table1 tableClass">
                <tr>
                    <td style="text-align:center;height: 20px;">Senin</td>
                    <td style="text-align:center;height: 20px;">Selasa</td>
                    <td style="text-align:center;height: 20px;">Rabu</td>
                    <td style="text-align:center;height: 20px;">Kamis</td>
                    <td style="text-align:center;height: 20px;">Jum'at</td>
                    <td style="text-align:center;height: 20px;background-color:#ffa5a5 ;">Sabtu</td>
                    <td style="text-align:center;height: 20px;background-color:#ffa5a5 ;">Minggu</td>
                </tr>
                <?php
            //    $dayAgenda
            //    $daysAgenda
            //    for($a=0;$a<35$a++;){
                    $flag=1;
                    $dayFlag=1;
                    $count=0;
                    echo "<tr>";
                    if($agendaKust->d1 != '') $cet="Rp ".number_format($agendaKust->d1, 0, ',', '.'); else $cet='';
                    if($dayAgenda == 'Monday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLinkx">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
                    if($dayAgenda == 'Tuesday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLinkx">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
                    if($dayAgenda == 'Wednesday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLinkx">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
                    if($dayAgenda == 'Thursday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLinkx">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
                    if($dayAgenda == 'Friday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLinkx">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
                    if($dayAgenda == 'Saturday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLinkx">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
                    if($dayAgenda == 'Sunday'){ echo '<td class="agenda" isi="1-'.$date.'"><a href="#" class="dateLinkx">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
                    $count=$count+($agendaKust->d1 == '' ? 0 : $agendaKust->d1);
                    for($a=2;$a<$daysAgenda+1;$a++){
                        $v='d'.$a;
                        if($agendaKust->$v != '') $cet="Rp ".number_format($agendaKust->$v, 0, ',', '.'); else $cet='';
                        echo '<td class="agenda" isi="'.$a.'-'.$date.'"><a href="#" class="dateLinkx">'.$a.'</a><br/><br/>'.$cet.'</td>';
                        $dayFlag2++;
                        if($dayFlag2 % 7 == 0) echo "</tr><tr>";
                        $count=$count+($agendaKust->$v == '' ? 0 : $agendaKust->$v);
                    }
                    while($dayFlag2<35){
                        echo "<td></td>";
                        $dayFlag2++;
                    }
                    echo "</tr>";
            //    }
                ?>
            </table>

                        <br/>
                        <table style="width: 1270px;">
                            <tr>
                                <td align="right">
                                    Total = <?php echo "Rp ".number_format($count, 0, ',', '.');?>
                                </td>
                            </tr>
                        </table>
                <?php
                    }
                ?>
        </div>
    </div>
<script> 
    function validateForm() {
        if ($('#kustBulan').val() == "") { alert("Bulan Masih Kosong !!!"); return false; }
        if ($('#kustTahun').val() == "") { alert("Tahun Masih Kosong !!!"); return false; }
        if ($('#kustEmployee').val() == "") { alert("Karyawan Masih Kosong !!!"); return false; }
        window.scrollTo(0, 0);
        $('#loadingAnim').show();
        document.body.scroll = "no";
        document.body.style.overflow = 'hidden';
        document.height = window.innerHeight;
    }
$(document).ready(function(){    
    
    $(".dateLink1").click(function () {
        location.href = '<?php echo site_url("rekap/rekapForm/0/".$agenda1->idEmployee)."/" ?>' + $(this).parent().attr('isi');
    }); 
    $(".dateLink2").click(function () {
        location.href = '<?php echo site_url("rekap/rekapForm/1/".$agenda2->idEmployee)."/" ?>' + $(this).parent().attr('isi');
    });
    $(".dateLink3").click(function () {
        location.href = '<?php echo site_url("rekap/rekapForm/2/".$agenda3->idEmployee)."/" ?>' + $(this).parent().attr('isi');
    });
    $(".dateLinkx").click(function () {
        location.href = '<?php echo site_url("rekap/rekapForm/3/".$kustEmployee)."/" ?>' + $(this).parent().attr('isi'); 
    });
});
</script>
    