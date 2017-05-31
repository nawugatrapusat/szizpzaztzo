<h2><span style="font-weight: bold;color: red;">S</span>istem <span style="font-weight: bold;color: red;">I</span>nformasi <span style="font-weight: bold;color: red;">P</span>enju<span style="font-weight: bold;color: red;">A</span>lan <span style="font-weight: bold;color: red;">TO</span>ko Sari Puspita Herba</h2>
    <table id="menu">
        <tr>
            <?php
                if($this->session->userdata('id_admin') == '1'){
            ?>
                <td><a href="<?php echo site_url('beranda');?>">Beranda</a></td>
                <td><a href="<?php echo site_url('penjualan');?>">Penjualan</a></td>
                <td><a href="<?php echo site_url('agenda');?>">Agenda</a></td>
                <td><a href="<?php echo site_url('rekap');?>">Rekap</a></td>
                <td><a href="<?php echo site_url('pengeluaran');?>">Pengeluaran</a></td>
                <td><a href="<?php echo site_url('setting');?>">Setting</a></td>
                <td><a href="<?php echo site_url('log');?>">Log</a></td>
                <td><a href="<?php echo site_url();?>">Log Out</a></td>
            <?php
                }else if($this->session->userdata('id_admin') == '5'){
            ?>
                <td><a href="<?php echo site_url('beranda');?>">Beranda</a></td>
                <td><a href="<?php echo site_url('agenda');?>">Agenda</a></td>
                <td><a href="<?php echo site_url('rekap');?>">Rekap</a></td>
                <td><a href="<?php echo site_url();?>">Log Out</a></td>
            <?php
                }else{
            ?>
                <td><a href="<?php echo site_url('penjualan');?>">Penjualan</a></td>
                <td><a href="<?php echo site_url('agenda');?>">Agenda</a></td>
                <td><a href="<?php echo site_url('rekap');?>">Rekap</a></td>
                <td><a href="<?php echo site_url();?>">Log Out</a></td>
            <?php
                }
            ?>
        </tr>
    </table>
<?php
function format_rupiah($angka){
  $rupiah=number_format($angka,0,',','.');
  return $rupiah;
}
?>
