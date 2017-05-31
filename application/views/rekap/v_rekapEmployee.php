<style>
    .tableClass td{
        width: 175px;
        height: 70;
        text-align: left;
        vertical-align: top;
        /*cursor:pointer;*/
    }
    .dateLink1 {
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
            foreach ($emp as $hasil) {
                if($this->session->userdata('id_admin') == $hasil->idAdmin){
                    echo '<li><a href="#tabs1">Bulan '.$bulanNow.'</a></li>';
                }
            }
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
        if($agendax->d1 != '') $cet="Rp ".number_format($agendax->d1, 0, ',', '.'); else $cet='';
        if($dayAgenda == 'Monday') { echo '<td class="agenda" content="'.$cet.'" isi="1-'.$date.'"><a href="#" class="dateLink1">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda == 'Tuesday') { echo '<td class="agenda" content="'.$cet.'" isi="1-'.$date.'"><a href="#" class="dateLink1">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda == 'Wednesday') { echo '<td class="agenda" content="'.$cet.'" isi="1-'.$date.'"><a href="#" class="dateLink1">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda == 'Thursday') { echo '<td class="agenda" content="'.$cet.'" isi="1-'.$date.'"><a href="#" class="dateLink1">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda == 'Friday') { echo '<td class="agenda" content="'.$cet.'" isi="1-'.$date.'"><a href="#" class="dateLink1">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda == 'Saturday') { echo '<td class="agenda" content="'.$cet.'" isi="1-'.$date.'"><a href="#" class="dateLink1">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda == 'Sunday') { echo '<td class="agenda" content="'.$cet.'" isi="1-'.$date.'"><a href="#" class="dateLink1">1</a><br/><br/>'.$cet.'</td>';$flag++;$dayFlag2=$dayFlag; } if($flag == 1) echo "<td></td>";$dayFlag++;
        $count=$count+($agendax->d1 == '' ? 0 : $agendax->d1);
        for($a=2;$a<$daysAgenda+1;$a++){
            $v='d'.$a;
            if($agendax->$v != '') $cet="Rp ".number_format($agendax->$v, 0, ',', '.'); else $cet='';
            echo '<td class="agenda" content="'.$cet.'" isi="'.$a.'-'.$date.'"><a href="#" class="dateLink1">'.$a.'</a><br/><br/>'.$cet.'</td>';
            $dayFlag2++;
            if($dayFlag2 % 7 == 0) echo "</tr><tr>";
            $count=$count+($agendax->$v == '' ? 0 : $agendax->$v);
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
    </div>
<script>
$(document).ready(function(){     
    $(".dateLink1").click(function () {
        if($(this).parent().attr('content') == '') location.href = '<?php echo site_url("rekap/rekapForm/0/".$agendax->idEmployee)."/" ?>' + $(this).parent().attr('isi');
    }); 
});
</script>
    