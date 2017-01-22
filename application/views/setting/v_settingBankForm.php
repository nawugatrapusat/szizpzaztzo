</head>
<body>
    <h2><?php echo $typeForm == 0 ? 'Tambah Bank' : 'Edit Bank '; ?></h2>
    <form style="padding-left:13px; padding-top: 10px;" onsubmit="return validateForm()"  name="bankForm" action="<?php echo site_url('setting/bankFormSave/3') ?>" method="POST">
        <table style="border: 1px solid black;">
            <tr>
                <td>Nama Bank</td>
                <td>:</td>
                <td> <span style="color:red;">*</span> <input id='namaBank' type="text" name="namaBank" value="<?php echo $bank == '' ? '' : ucwords($bank->namaBank)?>"/></td>
            </tr>
            <tr>
                <td  style="padding-top:30px;padding-bottom:15px;" colspan="3">
                    <input type="hidden" name="id" value="<?php echo $bank == '' ? '' : $bank->id?>"/>
                    <input type="submit" value="Submit"/>&nbsp;
                    <button type="button" onclick="<?php $this->input->set_cookie('tab',3,time()+6000);?>;location.href='<?php echo site_url('setting')?>';">Cancel</button>
                </td>
            </tr> 
        </table>
    </form>
    <script>
        function validateForm() {
            if ($('#namaBank').val() == "") { alert("Nama Bank Masih Kosong !!!"); return false; }
            window.scrollTo(0, 0);
            $('#loadingAnim').show();
            document.body.scroll = "no";
            document.body.style.overflow = 'hidden';
            document.height = window.innerHeight;
        }
        $(document).ready(function () {

        });
    </script>
