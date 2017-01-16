<button type="button" onclick="location.href = '<?php echo site_url('setting/productForm/0') ?>';">Tambah Produk</button>
<table style="padding-top:15px;">
    <tr>
        <td valign="top">
            <table class="table1" border="1">
                <tr>
                    <td>No</td>
                    <td>Produsen</td>
                    <td>Merek</td>
                    <td>Nama</td>
                    <td>Berat</td>
                    <td>Stock</td>
                    <td>Harga Beli</td>
                    <td>Harga Jual</td>
                    <td>Skema</td>
                    <td>Aksi</td>
                </tr>
                <?php
                if ($product != '') {
                    $no = 1;
                    foreach ($product as $hasil) {
                        echo '
                                    <tr>
                                        <td>' . $no . '</td>
                                        <td>' . ucwords($hasil->produsen) . '</td>
                                        <td>' . ucwords($hasil->merek) . '</td>
                                        <td>' . ucwords($hasil->nama) . '</td>
                                        <td>' . $hasil->berat . '</td>
                                        <td>' . $hasil->stock . '</td>
                                        <td>Rp. ' . number_format($hasil->hargaBeli,0,',','.') . '</td>
                                        <td>Rp. ' . number_format($hasil->hargaJual,0,',','.') . '</td>
                                        <td>' . ucwords($hasil->scheme) . '</td>
                                        <td>
                                            <a href="' . site_url("setting/productForm/1/$hasil->id") . '" ><img src="public/images/admin/edit.png"/></a>&nbsp;
                                            <a href="#" class="productDeleteButton" aid="' . $hasil->id . '"><img src="public/images/admin/close.png"/></a>
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