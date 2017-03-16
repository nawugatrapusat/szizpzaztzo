<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="description" content="" />
<meta name="keywords" content="" />
<title>SIPATO</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="<?php echo site_url('public/js/admin/jquery-1.7.2.min.js')?>"></script>
<?php 
if(isset($js)){ 
    foreach ($js as $val) {
    echo '<script type="text/javascript" src="'.base_url().'public/js/admin/'.$val.'.js"></script>';
    }
}if(isset($css)){ 
    foreach ($css as $val) {
    echo '<link rel="stylesheet" type="text/css" href="'.base_url().'public/css/admin/'.$val.'.css"/>';
    }
}
?>
<style>
/*#layeredImg {
   position: absolute;
   top: 50%;
   left: 50%;
   width: 300px;
   height: 300px;
   margin-top: -150px;  Half the height 
   margin-left: -150px;  Half the width 
    z-index: 9999;
    display: none;
}*/
/*body:before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(130,138,140,0.5);
    z-index: 1111;
}*/

</style>
<!--<img id='layeredImg' src="public/images/admin/loading-anim.gif"/>-->
<img id="loadingAnim" src="<?php echo site_url('public/images/admin/loading-anim.gif')?>" style="    margin: auto;
    width: 35%;
    border: 3px solid green;
    margin-left: 32%;margin-top: 7%;margin-bottom: 250px;"/>


