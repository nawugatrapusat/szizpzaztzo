<style>
    .tableClass td{
        width: 175px;
        height: 100px;
        text-align: left;
        vertical-align: top;
        /*cursor:pointer;*/
    }
    
    .dateLink1 {
        padding-right: 25px;
        padding-bottom: 20px;
    }
    
    .dateLink2 {
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
    <h2>Agenda</h2>

    <div id="tabs">
        <ul>
            <li><a href="#tabs1">Bulan <?php echo $bulanNow;?></a></li>
            <li><a href="#tabs2">Bulan <?php echo $bulanNext;?></a></li>
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
//    $dayAgenda1
//    $daysAgenda1
//    for($a=0;$a<35$a++;){
        $flag=1;
        $dayFlag=1;
        echo "<tr>";
        if($dayAgenda1 == 'Monday'){ echo '<td class="agenda" isi="1-'.$date1.'"><a href="#" class="dateLink1">1</a><br/><br/>'.$agenda1->d1.'</td>';$flag++;$dayFlag2=1; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda1 == 'Tuesday'){ echo '<td class="agenda" isi="1-'.$date1.'"><a href="#" class="dateLink1">1</a><br/><br/>'.$agenda1->d1.'</td>';$flag++;$dayFlag2=2; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda1 == 'Wednesday'){ echo '<td class="agenda" isi="1-'.$date1.'"><a href="#" class="dateLink1">1</a><br/><br/>'.$agenda1->d1.'</td>';$flag++;$dayFlag2=3; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda1 == 'Thursday'){ echo '<td class="agenda" isi="1-'.$date1.'"><a href="#" class="dateLink1">1</a><br/><br/>'.$agenda1->d1.'</td>';$flag++;$dayFlag2=4; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda1 == 'Friday'){ echo '<td class="agenda" isi="1-'.$date1.'"><a href="#" class="dateLink1">1</a><br/><br/>'.$agenda1->d1.'</td>';$flag++;$dayFlag2=5; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda1 == 'Saturday'){ echo '<td class="agenda" isi="1-'.$date1.'"><a href="#" class="dateLink1">1</a><br/><br/>'.$agenda1->d1.'</td>';$flag++;$dayFlag2=6; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda1 == 'Sunday'){ echo '<td class="agenda" isi="1-'.$date1.'"><a href="#" class="dateLink1">1</a><br/><br/>'.$agenda1->d1.'</td>';$flag++;$dayFlag2=7; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayFlag2 % 7 == 0) echo "</tr><tr>";
        for($a=2;$a<$daysAgenda1+1;$a++){
            $v='d'.$a;
            echo '<td class="agenda" isi="'.$a.'-'.$date1.'"><a href="#" class="dateLink1">'.$a.'</a><br/><br/>'.$agenda1->$v.'</td>';
            $dayFlag2++;
            if($dayFlag2 % 7 == 0) echo "</tr><tr>";
        }
        while($dayFlag2<35){
            echo "<td></td>";
            $dayFlag2++;
        }
        echo "</tr>";
//    }
    ?>
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
//    $dayAgenda1
//    $daysAgenda1
//    for($a=0;$a<35$a++;){
        $flag=1;
        $dayFlag=1;
        echo "<tr>";
        if($dayAgenda2 == 'Monday'){ echo '<td class="agenda" isi="1-'.$date2.'"><a href="#" class="dateLink2">1</a><br/><br/>'.$agenda2->d1.'</td>';$flag++;$dayFlag2=1; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda2 == 'Tuesday'){ echo '<td class="agenda" isi="1-'.$date2.'"><a href="#" class="dateLink2">1</a><br/><br/>'.$agenda2->d1.'</td>';$flag++;$dayFlag2=2; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda2 == 'Wednesday'){ echo '<td class="agenda" isi="1-'.$date2.'"><a href="#" class="dateLink2">1</a><br/><br/>'.$agenda2->d1.'</td>';$flag++;$dayFlag2=3; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda2 == 'Thursday'){ echo '<td class="agenda" isi="1-'.$date2.'"><a href="#" class="dateLink2">1</a><br/><br/>'.$agenda2->d1.'</td>';$flag++;$dayFlag2=4; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda2 == 'Friday'){ echo '<td class="agenda" isi="1-'.$date2.'"><a href="#" class="dateLink2">1</a><br/><br/>'.$agenda2->d1.'</td>';$flag++;$dayFlag2=5; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda2 == 'Saturday'){ echo '<td class="agenda" isi="1-'.$date2.'"><a href="#" class="dateLink2">1</a><br/><br/>'.$agenda2->d1.'</td>';$flag++;$dayFlag2=6; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayAgenda2 == 'Sunday'){ echo '<td class="agenda" isi="1-'.$date2.'"><a href="#" class="dateLink2">1</a><br/><br/>'.$agenda2->d1.'</td>';$flag++;$dayFlag2=7; } if($flag == 1) echo "<td></td>";$dayFlag++;
        if($dayFlag2 % 7 == 0) echo "</tr><tr>";
        for($a=2;$a<$daysAgenda2+1;$a++){
            $v='d'.$a;
            echo '<td class="agenda" isi="'.$a.'-'.$date2.'"><a href="#" class="dateLink2">'.$a.'</a><br/><br/>'.$agenda2->$v.'</td>';
            $dayFlag2++;
            if($dayFlag2 % 7 == 0) echo "</tr><tr>";
        }
        while($dayFlag2<35){
            echo "<td></td>";
            $dayFlag2++;
        }
        echo "</tr>";
//    }
    ?>
</table>

        </div>
    </div>
<script>
$(document).ready(function(){     
    $(".dateLink1").click(function () {
        location.href = '<?php echo site_url("agenda/agendaForm/0/") ?>' + $(this).parent().attr('isi');
    }); 
    $(".dateLink2").click(function () {
        location.href = '<?php echo site_url("agenda/agendaForm/1/") ?>' + $(this).parent().attr('isi');
    });
});
</script>
    