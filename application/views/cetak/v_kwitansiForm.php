</head>
<body>
    <h2>Cetak Kwitansi</h2>
    <form style="padding-left:13px; padding-top: 10px;" onsubmit="return validateForm()"  name="kwitansiForm" action="<?php echo site_url('cetak/kwitansi/'.$id.'/'.$fakturNama) ?>" method="POST">
        <table style="border: 1px solid black;">
            <tr>
                <td>Terbilang</td>
                <td>:</td>
                <td> <span style="color:red;">*</span> <input id='uangSejumlah' type="text" name="uangSejumlah" size="150"/></td>
            </tr>
            <tr>
                <td>Untuk pembayaran</td>
                <td>:</td>
                <td>Faktur tanggal <?php echo date("d-M-Y",strtotime($penjualanById->d.'-'.$penjualanById->m.'-'.$penjualanById->y));?> sebesar <?php 
                    if($penjualanById->diskon == 'nominal'){
                        echo 'Rp. ' . number_format($penjualanById->nominalFaktur-$penjualanById->jumlahDiskon, 0, ',', '.');
                    }else if($penjualanById->diskon == 'persen'){
                        echo 'Rp. ' . number_format($penjualanById->nominalFaktur-($penjualanById->jumlahDiskon*$penjualanById->nominalFaktur/100), 0, ',', '.');
                    }else if ($penjualanById->diskon == 'tidak'){
                        echo 'Rp. ' . number_format($penjualanById->nominalFaktur, 0, ',', '.');
                    }
                        ?>,- </td>
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
            if ($('#uangSejumlah').val() == "") { alert("Uang Sejumlah Masih Kosong !!!"); return false; }
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
