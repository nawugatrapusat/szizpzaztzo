<button type="button" onclick="location.href = '<?php echo site_url('setting/pengeluaranForm/0') ?>';">Tambah Pengeluaran</button>
<table style="padding-top:15px;">
    <tr>
        <td valign="top">
            <table class="table1" border="1">
                <tr>
                    <td>No</td>
                    <td>Nama Pengeluaran</td>
                    <td>Aksi</td>
                </tr>
                <?php
                if ($pengeluaran != '') {
                    $no = 1;
                    foreach ($pengeluaran as $hasil) {
                        echo '
                                    <tr>
                                        <td>' . $no . '</td>
                                        <td>' . ucwords($hasil->namaPengeluaran) . '</td>
                                        <td>
                                            <a href="' . site_url("setting/pengeluaranForm/1/$hasil->id") . '" ><img src="public/images/admin/edit.png"/></a>&nbsp;
                                            <a href="#" class="pengeluaranDeleteButton" aid="' . $hasil->id . '"><img src="public/images/admin/close.png"/></a>
                                        </td>
                                    </tr>
                                    ';
                        $no++;
                    }
                }
                ?>
            </table>
        </td>
        <td valign="top" style="border-left: 1px solid grey;padding-left: 10px;">
            <table>
                <div id="div_order"></div>
            </table>
        </td>
    </tr>
</table>