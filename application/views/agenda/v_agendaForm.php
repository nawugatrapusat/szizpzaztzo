<?php
$a='d'.$exDate[0];
?>
</head>
<body class="bodyclass" style="display: none;">
    <h2>Edit Agenda tanggal <?php echo $tanggal; ?></h2>
    <form style="padding-left:13px; padding-top: 10px;" onsubmit="return validateForm()"  name="agendaForm" action="<?php echo site_url('agenda/agendaFormSave/'.$tab) ?>" method="POST">
        <table style="border: 1px solid black;">
            <tr>
                <td>Agenda</td>
                <td>:</td>
                <td><textarea  rows="15" cols="60" name="isi"><?php echo str_replace("<br/>", "\n", $dateDetail->$a)?></textarea>
            </tr>
            <tr>
                <td  style="padding-top:30px;padding-bottom:15px;" colspan="3">
                    <input type="hidden" name="id" value="<?php echo $dateDetail->id?>"/>
                    <input type="hidden" name="day" value="<?php echo $a?>"/>
                    <input type="submit" value="Submit"/>&nbsp;
                    <button type="button" onclick="location.href='<?php $this->input->set_cookie('tab',$tab,time()+6000);echo site_url('agenda')?>';">Cancel</button>
                </td>
            </tr> 
        </table>
    </form>
    <script>
        function validateForm() {
            window.scrollTo(0, 0);
            $('#loadingAnim').show();
            document.body.scroll = "no";
            document.body.style.overflow = 'hidden';
            document.height = window.innerHeight;
        }
        $(document).ready(function () {

        });
    </script>