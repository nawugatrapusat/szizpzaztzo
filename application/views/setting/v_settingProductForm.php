</head>
<body>
    <h2><?php echo $typeForm == 0 ? 'Tambah Produk' : 'Edit Produk '; ?></h2>
    <form style="padding-left:13px; padding-top: 10px;" name="productForm" action="<?php echo site_url('setting/productFormSave/1') ?>" method="POST">
        <table style="border: 1px solid black;">
            <tr>
                <td>Produsen</td>
                <td>:</td>
                <td><input type="text" name="produsen" value="<?php echo $product == '' ? '' : ucwords($product->produsen) ?>"/></td>
            </tr>
            <tr>
                <td>Merek</td>
                <td>:</td>
                <td><input type="text" name="merek" value="<?php echo $product == '' ? '' : ucwords($product->merek) ?>" size="50"/></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><input type="text" name="nama" value="<?php echo $product == '' ? '' : ucwords($product->nama)?>" size="100"/></td>
            </tr>
            <tr>
                <td>Berat</td>
                <td>:</td>
                <td><input type="text" name="berat" value="<?php echo $product == '' ? '' : $product->berat?>"/> Gram</td>
            </tr>
            <tr>
                <td>Stock</td>
                <td>:</td>
                <td><input type="text" name="stock" value="<?php echo $product == '' ? '' : $product->stock?>"/></td>
            </tr>
            <tr>
                <td>Harga Beli</td>
                <td>:</td>
                <td>Rp.<input type="text" name="hargaBeli" value="<?php echo $product == '' ? '' : $product->hargaBeli?>"/></td>
            </tr>
            <tr>
                <td>Harga Jual</td>
                <td>:</td>
                <td>Rp.<input type="text" name="hargaJual" value="<?php echo $product == '' ? '' : $product->hargaJual?>"/></td>
            </tr>
            <tr>
                <td>Skema</td>
                <td>:</td>
                <td>
                    <select id="scheme" name="scheme">
                        <option value="">Skema</option>
                        <?php 
                        $a=$product->scheme == "cashback" ? "selected='selected'" : '';
                        $b=$product->scheme == "kinerja" ? "selected='selected'" : '';
                        $c=$product->scheme == 'cashback' ? "" : 'display:none';
                        ?>
                        <option <?php echo $a; ?> value="cashback">Cashback</option>;
                        <option <?php echo $b; ?> value="kinerja">Kinerja</option>;
                    </select>&nbsp;<span id="hargaEmployee" style="<?php echo $c; ?>">,&nbsp;Harga Karyawan : Rp.<input type="text" id="hargaEmployeeInput" name="hargaEmployee" value="<?php echo $product == '' ? '' : $product->hargaEmployee ?>"/></span>
                </td>
            </tr>
            <tr>
                <td  style="padding-top:30px;padding-bottom:15px;" colspan="3">
                    <input type="hidden" name="id" value="<?php echo $product == '' ? '' : $product->id?>"/>
                    <input type="submit" value="Submit"/>&nbsp;
                    <button type="button" onclick="<?php $this->input->set_cookie('tab',1,time()+6000);?>;location.href='<?php echo site_url('setting')?>';">Cancel</button>
                </td>
            </tr> 
        </table>
    </form>
    <script>
        $(document).ready(function () {
            $("#scheme").change(function () {
                var scheme = $(this);
                if(scheme.val() == 'cashback'){
                    $('#hargaEmployee').show();
                }else{
                    $('#hargaEmployee').hide();
                    $('#hargaEmployeeInput').val('');
                }
            });
        });
    </script>
