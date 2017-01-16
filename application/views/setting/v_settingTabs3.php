<button type="button" onclick="location.href = '<?php echo site_url('setting/empForm/0') ?>';">Tambah Karyawan</button>
<table style="padding-top:15px;">
    <tr>
        <td valign="top">
            <table class="table1" border="1">
                <tr>
                    <td>No</td>
                    <td>NIK</td>
                    <td>Nama</td>
                    <td>Alamat</td>
                    <td>No HP</td>
                    <td>Aksi</td>
                </tr>
                <?php
                if ($emp != '') {
                    $no = 1;
                    foreach ($emp as $hasil) {
                        echo '
                                    <tr>
                                        <td>' . $no . '</td>
                                        <td>' . $hasil->nik . '</td>
                                        <td>' . ucwords($hasil->nama) . '</td>
                                        <td>' . ucwords($hasil->alamat) . '</td>
                                        <td>' . $hasil->noHp . '</td>
                                        <td>
                                            <a href="' . site_url("setting/empForm/1/$hasil->id") . '" ><img src="public/images/admin/edit.png"/></a>&nbsp;
                                            <a href="#" class="empDeleteButton" aid="' . $hasil->id . '"><img src="public/images/admin/close.png"/></a>
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