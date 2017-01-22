</head>
<body>
    <h2><?php echo $typeForm == 0 ? 'Tambah Pengeluaran' : 'Edit Pengeluaran '; ?></h2>
    <form style="padding-left:13px; padding-top: 10px;" onsubmit="return validateForm()"  name="pengeluaranForm" action="<?php echo site_url('setting/pengeluaranFormSave/4') ?>" method="POST">
        <table style="border: 1px solid black;">
            <tr>
                <td>Nama Pengeluaran</td>
                <td>:</td>
                <td> <span style="color:red;">*</span> <input id='namaPengeluaran' type="text" name="namaPengeluaran" value="<?php echo $pengeluaran == '' ? '' : ucwords($pengeluaran->namaPengeluaran)?>"/></td>
            </tr>
            <tr>
                <td  style="padding-top:30px;padding-bottom:15px;" colspan="3">
                    <input type="hidden" name="id" value="<?php echo $pengeluaran == '' ? '' : $pengeluaran->id?>"/>
                    <input type="submit" value="Submit"/>&nbsp;
                    <button type="button" onclick="<?php $this->input->set_cookie('tab',4,time()+6000);?>;location.href='<?php echo site_url('setting')?>';">Cancel</button>
                </td>
            </tr> 
        </table>
    </form>
    <script>
        function validateForm() {
            if ($('#namaPengeluaran').val() == "") { alert("Nama Pengeluaran Masih Kosong !!!"); return false; }
            window.scrollTo(0, 0);
            $('#loadingAnim').show();
            document.body.scroll = "no";
            document.body.style.overflow = 'hidden';
            document.height = window.innerHeight;
        }
        $(document).ready(function () {

        });
    </script>
