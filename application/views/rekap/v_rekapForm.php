<?php
$a='d'.$exDate[0];
?>
</head>
<body class="bodyclass" style="display: none;">
    <h2>Edit rekap <?php echo ucwords($namaEmp)?> tanggal <?php echo $tanggal; ?></h2>
    <form style="padding-left:13px; padding-top: 10px;" onsubmit="return validateForm()"  name="rekapForm" action="<?php echo site_url('rekap/rekapFormSave/'.$tab) ?>" method="POST">
        <table style="border: 1px solid black;">
            <tr>
                <td>Nominal</td>
                <td>:</td>
                <td><input type="text" name="isi" id="nominal" value="<?php echo $dateDetail->$a ?>" />
            </tr>
            <tr>
                <td  style="padding-top:30px;padding-bottom:15px;" colspan="3">
                    <input type="hidden" name="id" value="<?php echo $dateDetail->id?>"/>
                    <input type="hidden" name="idEmp" value="<?php echo $dateDetail->idEmployee?>"/>
                    <input type="hidden" name="day" value="<?php echo $a?>"/>
                    <input type="hidden" name="tab" value="<?php echo $tab?>"/>
                    <input type="submit" value="Submit"/>&nbsp;
                    <button type="button" onclick="<?php $this->input->set_cookie('tab',$tab,time()+6000);
                        if($tab == 3){
                            $this->input->set_cookie('kustBulan',$exDate[1],time()+6000);
                            $this->input->set_cookie('kustTahun',$exDate[2],time()+6000);
                            $this->input->set_cookie('kustEmployee',$idEmp,time()+6000);
                        }
                    ?>;location.href='<?php echo site_url('rekap')?>';">Cancel</button>
                </td>
            </tr> 
        </table>
    </form>
    <script>
        function validateForm() {
            if ($('#nominal').val() != ''){
                if(isNaN($('#nominal').val()) == true){
                    alert("Nominal Harus Angka !!!");
                    return false;
                }else if($('#nominal').val() % 1 != 0){
                    alert("Nominal Tidak Boleh Desimal !!!");
                    return false;
                }
            }
                    
            window.scrollTo(0, 0);
            $('#loadingAnim').show();
            document.body.scroll = "no";
            document.body.style.overflow = 'hidden';
            document.height = window.innerHeight;
        }
        $(document).ready(function () {

        });
    </script>