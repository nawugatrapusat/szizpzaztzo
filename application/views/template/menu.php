<h2><span style="font-weight: bold;color: red;">S</span>istem <span style="font-weight: bold;color: red;">I</span>nformasi <span style="font-weight: bold;color: red;">P</span>enju<span style="font-weight: bold;color: red;">A</span>lan <span style="font-weight: bold;color: red;">TO</span>ko Sari Puspita Herba</h2>
    <table id="menu">
        <tr>
            <td><a href="<?php echo site_url('beranda');?>">Beranda</a></td>
            <td><a href="<?php echo site_url('penjualan');?>">Penjualan</a></td>
            <td><a href="<?php echo site_url('kinerja');?>">Kinerja</a></td>
            <td><a href="<?php echo site_url('setting');?>">Setting</a></td>
            
            <td><a href="<?php echo site_url('pemasukan');?>">Pemasukan</a></td>
            <td><a href="<?php echo site_url('perhitungan');?>">Perhitungan</a></td>
            <td><a href="<?php echo site_url('order');?>">Order</a></td>
            <td><a href="<?php echo site_url('log');?>">Log</a></td>
	    <td><a href="<?php echo site_url();?>">Log Out</a></td>
        </tr>
    </table>
<?php
function format_rupiah($angka){
  $rupiah=number_format($angka,0,',','.');
  return $rupiah;
}
?>