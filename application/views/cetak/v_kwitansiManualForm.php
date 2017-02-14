</head>
<body>
    <h2>Cetak Kwitansi</h2>
    <form style="padding-left:13px; padding-top: 10px;" onsubmit="return validateForm()"  name="kwitansiForm" action="<?php echo site_url('cetak/kwitansiManual/'.$id.'/'.$fakturNama) ?>" method="POST">
        <table style="border: 1px solid black;">
            <tr>
                <td>No</td>
                <td>:</td>
                <td> <span style="color:red;">*</span> <input id='no' type="text" name="no" size="10"/></td>
            </tr>
            <tr>
                <td>Telah terima dari</td>
                <td>:</td>
                <td> <span style="color:red;">*</span> <input id='telahTerimaDari' type="text" name="telahTerimaDari" size="30"/></td>
            </tr>
            <tr>
                <td>Terbilang</td>
                <td>:</td>
                <td> <span style="color:red;">*</span> <input id='uangSejumlah' type="text" name="uangSejumlah" size="150"/></td>
            </tr>
            <tr>
                <td>Untuk pembayaran</td>
                <td>:</td>
                <td> <span style="color:red;">*</span> <input id='untukPembayaran' type="text" name="untukPembayaran" size="50"/></td>
            </tr>
            <tr>
                <td>Sejumlah</td>
                <td>:</td>
                <td><span style="color:red;">*</span> <input type="text" name="sejumlah" class='onlyNumb' id="sejumlah" size="10"/></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td><span style="color:red;">*</span> <input type="text" name="tanggal" id="date" size="10"/></td>
            </tr>
            <tr>
                <td  style="padding-top:30px;padding-bottom:15px;" colspan="3">
                    <input type="submit" value="Submit"/>&nbsp;
                </td>
            </tr> 
        </table>
    </form>
    <script>
        function validateForm() {
            if ($('#no').val() == "") { alert("No Masih Kosong !!!"); return false; }
            if ($('#telahTerimaDari').val() == "") { alert("Telah Terima dari Masih Kosong !!!"); return false; }
            if ($('#uangSejumlah').val() == "") { alert("Terbilang Masih Kosong !!!"); return false; }
            if ($('#untukPembayaran').val() == "") { alert("Untuk Pembayaran Masih Kosong !!!"); return false; }
            if ($('#sejumlah').val() == "") { alert("Sejumlah Masih Kosong !!!"); return false; }
            if ($('#date').val() == "") { alert("Tanggal Masih Kosong !!!"); return false; }
            window.scrollTo(0, 0);
            $('#loadingAnim').show();
            document.body.scroll = "no";
            document.body.style.overflow = 'hidden';
            document.height = window.innerHeight;
        }
        $(document).ready(function () {
            $("#date").datepicker({ dateFormat: 'dd-mm-yy' });
        });
    </script>
