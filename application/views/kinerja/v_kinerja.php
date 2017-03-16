
</head>
<body class="bodyclass" style="display: none;">
    <?php 
    $this->load->view('template/menu') ;
        function bulan($id){
            if($id=1) return 'Januari';
            if($id=2) return 'Februari';
            if($id=3) return 'Maret';
            if($id=4) return 'April';
            if($id=5) return 'Mei';
            if($id=6) return 'Juni';
            if($id=7) return 'Juli';
            if($id=8) return 'Agustus';
            if($id=9) return 'September';
            if($id=10) return 'Oktober';
            if($id=11) return 'November';
            if($id=12) return 'Desember';
        }    
    ?>

    <h2>Kinerja Karyawan</h2>
    <form style="padding-left:13px; padding-top: 10px;" action="<?php echo site_url('kinerja/employee') ?>" method="POST">
    <table>
        <tr>
            <td>Bulan</td>
            <td>:</td>
            <td>
                <select id="bulan" name="bulan">
                    <option value="">Pilih Bulan</option>
                    <?php
                        for($a=1;$a<=12;$a++){
                            echo '<option value="' . $a . '">'.$a.'</option>';
                        }
                    ?>
                </select>
                <select id="tahun" name="tahun">
                    <option value="">Pilih Tahun</option>
                    <?php
                        for($a=2017;$a<=2021;$a++){
                            echo '<option value="' . $a . '">'.$a.'</option>';
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Karyawan</td>
            <td>:</td>
            <td>
                <select id="employee" name="employee">
                    <option value="">Pilih Karyawan</option>
                    <?php
                    if ($employee != '') {
                        foreach ($employee as $hasil1) {
                            echo '<option value="' . $hasil1->id . '">' . ucwords($hasil1->nama) . ' </option>';
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><input type="submit" value="Submit"/></td>
        </tr>
    </table>
    </form>
    <?php
        if(!empty($employeeDetail)){
//    print_r($employeeDetail);
    ?>
    <h3><?php echo ucwords($employeeDetail->nama).' Bulan '.bulan($bulan);?></h3>
    <table  class="table1" border="1">
        <tr>
            <td>Tgl</td>
            <td>Tunai</td>
            <td>Giro</td>
            <td>Total</td>
        </tr>
    <?php
        for($a=1;$a<=31;$a++){
            echo '
                <tr>
                    <td>'.$a.'</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                ';
        }
        echo '</table>';
        }
    ?>
    <script>
        $(document).ready(function () {
//            $("#employee").change(function(){
//                var emp = $(this);
//                if(emp.val() != ''){
//                    location.href = '<?php echo site_url('kinerja/employee/') ?>'+emp.val();
//                }
//            });
        });
    </script>
