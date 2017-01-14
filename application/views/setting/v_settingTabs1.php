<button type="button" onclick="location.href = '<?php echo site_url('setting/clientForm/0') ?>';">Tambah Client</button>
<table style="padding-top:15px;">
    <tr>
        <td valign="top">
            <table class="table1" border="1">
                <tr>
                    <td>No</td>
                    <td>Nama Client</td>
                    <td>Alamat Client</td>
                    <td>No Telp</td>
                    <td>Aksi</td>
                </tr>
                <?php
                if ($client != '') {
                    $no = 1;
                    foreach ($client as $hasil) {
                        echo '
                                    <tr>
                                        <td>' . $no . '</td>
                                        <td>' . ucwords($hasil->nama) . '</td>
                                        <td>' . ucwords($hasil->alamat) . '</td>
                                        <td>' . $hasil->noTelp . '</td>
                                        <td>
                                            <a href="' . site_url("setting/clientForm/1/$hasil->id") . '" ><img src="public/images/admin/edit.png"/></a>&nbsp;
                                            <a href="#" class="clientDeleteButton" aid="' . $hasil->id . '"><img src="public/images/admin/close.png"/></a>
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