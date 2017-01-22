<!--<script type="text/javascript" src="<?php echo site_url('public/js/admin/tinymce/tiny_mce.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('public/js/admin/tinymce/tiny_init.js') ?>"></script>-->
<?php
$tab = get_cookie('tab');
$successNotif = get_cookie('successNotif');
$failedNotif = get_cookie('failedNotif');
delete_cookie('tab');
delete_cookie('successNotif');
delete_cookie('failedNotif');

if (empty($tab))$tab = 0;
if (empty($successNotif)) $successNotifShow = 'display: none;'; else $successNotifShow = '';
if (empty($failedNotif)) $failedNotifShow = 'display: none;'; else $failedNotifShow = '';
?>
<script>
    $(function () {
        $("#tabs").tabs({selected: <?php echo $tab ?>});
    });
</script>
</head>
<body>
    <?php $this->load->view('template/menu') ?>
    
    <div class="notification-area" style="<?php echo $successNotifShow; ?>"><?php echo $successNotif; ?></div>
    <div class="warning-area" style="<?php echo $failedNotifShow; ?>"><?php echo $failedNotif; ?></div>
    <h2>Setting Toko</h2>
    <div id="tabs">
        <ul>
            <li><a href="#tabs1">Daftar Client</a></li>
            <li><a href="#tabs2">Daftar Produk</a></li>
            <li><a href="#tabs3">Daftar Karyawan</a></li>
            <li><a href="#tabs4">Daftar Bank</a></li>
            <li><a href="#tabs5">Daftar Pengeluaran</a></li>
        </ul>
        <div id="tabs1">
            <?php $this->load->view('setting/v_settingTabs1') ?>
        </div>
        <div id="tabs2">
            <?php $this->load->view('setting/v_settingTabs2') ?>
        </div>
        <div id="tabs3">
            <?php $this->load->view('setting/v_settingTabs3') ?>
        </div>
        <div id="tabs4">
            <?php $this->load->view('setting/v_settingTabs4') ?>
        </div>
        <div id="tabs5">
            <?php $this->load->view('setting/v_settingTabs5') ?>
        </div>
    </div>

    <script>
        $(document).ready(function () {
//            $('.clientDeleteButton').click(function () {
//                if (confirm("Apakah Anda Yakin Ingin Menghapus ?")) {
//                    location.href = '<?php echo site_url("setting/clientDelete/0/") ?>' + $(this).attr('aid');
//                    $(this).hide();
//                }
//            });
//            $('.productDeleteButton').click(function () {
//                if (confirm("Apakah Anda Yakin Ingin Menghapus ?")) {
//                    location.href = '<?php echo site_url("setting/productDelete/1/") ?>' + $(this).attr('aid');
//                    $(this).hide();
//                }
//            });
            $('.empDeleteButton').click(function () {
                if (confirm("Apakah Anda Yakin Ingin Menghapus ?")) {
                    window.scrollTo(0, 0);
                    $('#loadingAnim').show();
                    document.body.scroll = "no";
                    document.body.style.overflow = 'hidden';
                    document.height = window.innerHeight;
                    location.href = '<?php echo site_url("setting/empDelete/2/") ?>' + $(this).attr('aid');
                    $(this).hide();
                }
            });
            $('.bankDeleteButton').click(function () {
                if (confirm("Apakah Anda Yakin Ingin Menghapus ?")) {
                    window.scrollTo(0, 0);
                    $('#loadingAnim').show();
                    document.body.scroll = "no";
                    document.body.style.overflow = 'hidden';
                    document.height = window.innerHeight;
                    location.href = '<?php echo site_url("setting/bankDelete/3/") ?>' + $(this).attr('aid');
                    $(this).hide();
                }
            });
            $('.pengeluaranDeleteButton').click(function () {
                if (confirm("Apakah Anda Yakin Ingin Menghapus ?")) {
                    window.scrollTo(0, 0);
                    $('#loadingAnim').show();
                    document.body.scroll = "no";
                    document.body.style.overflow = 'hidden';
                    document.height = window.innerHeight;
                    location.href = '<?php echo site_url("setting/pengeluaranDelete/4/") ?>' + $(this).attr('aid');
                    $(this).hide();
                }
            });

        });
    </script>
