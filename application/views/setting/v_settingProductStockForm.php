</head>
<body class="bodyclass" style="display: none;">
    <h2>Stock Produk</h2>
    <form style="padding-left:13px; padding-top: 10px;" onsubmit="return validateForm()" name="productForm" action="<?php echo site_url('setting/productStockFormSave') ?>" method="POST">
        <table style="border: 1px solid black;">
            <tr>
                <td colspan="5" >Tipe Stock : 
                    <select id="tipeStock" name="tipeStock">
                        <option value="">Tipe Stock</option>
                        <option value="tambah">Tambah</option>
                        <option value="update">Update</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="table1" border="1">
                        <tr>
                            <td>No</td>
                            <td>Nama Produk</td>
                            <td align="center">Stock</td>
                            <td align="center">Min Stock</td>
                            <td align="center">Data</td>
                        </tr>
                        <?php
                            $no=1;
                            foreach($product as $detail){
                                $st=$detail->stock < $detail->minStock ? 'style="background-color:#ffcccc"' : '';
                                echo '
                                        <tr>
                                            <td '.$st.'>'.$no.'</td>
                                            <td '.$st.'>' . ucwords($detail->nama).' - '.ucwords($detail->berat) . ' gr </td>
                                            <td align="center">'.$detail->stock.'</td>
                                            <td><input type="text" size="5" name="minStock'.$detail->id.'" value="'.$detail->minStock.'"/></td>
                                            <td><input type="text" size="5" name="jumlah'.$detail->id.'"/></td>
                                        </tr>
                                    ';
                                $no++;
                            }
                        ?>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table>
                        <tr>
                            <td  style="padding-top:30px;padding-bottom:15px;" colspan="2">
                                <input type="submit" value="Submit"/>&nbsp;
                                <button type="button" onclick="<?php $this->input->set_cookie('tab',1,time()+6000);?>;location.href='<?php echo site_url('setting')?>';">Cancel</button>
                            </td>
                        </tr> 
                    </table>
                </td>
            </tr>
        </table>
    </form>
    <script>
        function validateForm() {
            if ($('#tipeStock').val() == "") { alert("Tipe Stock Masih Kosong !!!"); return false; }
            window.scrollTo(0, 0);
            $('#loadingAnim').show();
            document.body.scroll = "no";
            document.body.style.overflow = 'hidden';
            document.height = window.innerHeight;
        }
    $(document).ready(function () {
        
        });
    </script>
