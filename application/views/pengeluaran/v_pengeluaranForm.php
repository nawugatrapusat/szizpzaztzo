</head>
<body>
    <h2><?php echo $typeForm == 0 ? 'Tambah Pengeluaran' : 'Edit Pengeluaran '; ?></h2>
    <form style="padding-left:13px; padding-top: 10px;" onsubmit="return validateForm()"  name="pengeluaranForm" action="<?php echo site_url('pengeluaran/pengeluaranFormSave') ?>" method="POST">
        <table style="border: 1px solid black;">
            <tr>
                <td>Nama Pengeluaran</td>
                <td>:</td>
                <td>
                    <span style="color:red;">*</span><select id="idPengeluaran" name="idPengeluaran">
                        <option value="">Pilih Pengeluaran</option>
                        <?php
                        if ($pengeluaran != '') {
                            foreach ($pengeluaran as $hasil1) {
                                $a = $pengeluaranDetail->idPengeluaran == $hasil1->id && !empty($pengeluaranDetail) ? "selected='selected'" : '';
                                echo '<option ' . $a . ' value="' . $hasil1->id . '">' . ucwords($hasil1->namaPengeluaran) . ' </option>';
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Jumlah</td>
                <td>:</td>
                <td>Rp. <span style="color:red;">*</span><input type="text" class='onlyNumb' id="jumlah" name="jumlah" value="<?php echo $pengeluaranDetail == '' ? '' : $pengeluaranDetail->jumlah?>"/> <span class="cetakHarga"> </span></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td><input type="text" id="keterangan" name="keterangan" size='80' value="<?php echo $pengeluaranDetail == '' ? '' : $pengeluaranDetail->keterangan?>"/></td>
            </tr>
            <tr>
                <td  style="padding-top:30px;padding-bottom:15px;" colspan="3">
                    <input type="hidden" name="id" value="<?php echo $pengeluaranDetail == '' ? '' : $pengeluaranDetail->id?>"/>
                    <input type="submit" value="Submit"/>&nbsp;
                    <button type="button" onclick="location.href='<?php echo site_url('pengeluaran')?>';">Cancel</button>
                </td>
            </tr> 
        </table>
    </form>
    <script>
        function validateForm() {
            if ($('#idPengeluaran').val() == "") { alert("Pengeluaran Masih Kosong !!!"); return false; }
            if ($('#jumlah').val() == "") { alert("Jumlah Masih Kosong !!!"); return false; }
            window.scrollTo(0, 0);
            $('#loadingAnim').show();
            document.body.scroll = "no";
            document.body.style.overflow = 'hidden';
            document.height = window.innerHeight;
        }
        $(document).ready(function () {
            $('#jumlah').bind('change', function(){
                var tis=$(this);
                if(tis.val() == ''){
                    tis.parent().find('.cetakHarga').html('');
                }else{
                    $.ajax({
                    type: "POST",
                    dataType : "json",
                    url: "<?php echo site_url('penjualan/numberFormat'); ?>",
                    data: 'val='+tis.val()
                  }).done(function( data ) {
                        tis.parent().find('.cetakHarga').html(data.val);
                  });
                }
            });
        });
    </script>
