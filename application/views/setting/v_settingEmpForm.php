</head>
<body class="bodyclass" style="display: none;">
    <h2><?php echo $typeForm == 0 ? 'Tambah Karyawan' : 'Edit Karyawan '; ?></h2>
    <form style="padding-left:13px; padding-top: 10px;" onsubmit="return validateForm()"  name="empForm" action="<?php echo site_url('setting/empFormSave/2') ?>" method="POST">
        <table style="border: 1px solid black;">
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td><input type="text" name="nik" value="<?php echo $emp == '' ? '' : $emp->nik?>" size="100"/></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td> <span style="color:red;">*</span> <input id='nama' type="text" name="nama" value="<?php echo $emp == '' ? '' : ucwords($emp->nama)?>" size="100"/></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><input type="text" name="alamat" value="<?php echo $emp == '' ? '' : ucwords($emp->alamat)?>" size="100"/></td>
            </tr>
            <tr>
                <td>No HP</td>
                <td>:</td>
                <td><input type="text" class='onlyNumb' name="noHp" value="<?php echo $emp == '' ? '' : $emp->noHp?>" size="100"/></td>
            </tr>
            <tr>
                <td  style="padding-top:30px;padding-bottom:15px;" colspan="3">
                    <input type="hidden" name="id" value="<?php echo $emp == '' ? '' : $emp->id?>"/>
                    <input type="submit" value="Submit"/>&nbsp;
                    <button type="button" onclick="<?php $this->input->set_cookie('tab',2,time()+6000);?>;location.href='<?php echo site_url('setting')?>';">Cancel</button>
                </td>
            </tr> 
        </table>
    </form>
    <script>
        function validateForm() {
            if ($('#nama').val() == "") { alert("Nama Masih Kosong !!!"); return false; }
            window.scrollTo(0, 0);
            $('#loadingAnim').show();
            document.body.scroll = "no";
            document.body.style.overflow = 'hidden';
            document.height = window.innerHeight;
        }
        $(document).ready(function () {
        });
    </script>
