<style>
    .tabel_tampil td{
        padding-top:7px;
        padding-right:100px;
    }
</style>
</head>
<body>
<?php $this->load->view('template/menu')?>
    <h2>Ringkasan Keuangan</h2>
    <div id="detail"></div>


<script>
function hapus_beli() {
    var r = confirm("Apakah Anda Yakin ?");
    if (r == true) {
            $('#total_beli').html('0');
            $('.beli').each(function(){
                $(this).parent().removeAttr( 'bgcolor' );
                $(this).parent().css('background-color','');
                var tis=$(this);
                $('#span_beli_'+$(this).attr('id')).html('Rp. 0');
                $(this).val('0');
                $.ajax({
                type: "POST",
                dataType : "json",
                url: "<?php echo site_url('api/produk/simpan_beli'); ?>",
                data: 'id='+$(this).attr('id')+'&beli=0'
              }).done(function( data ) {
                    if(data.auth == true){
                        tis.parent().css('background-color','#c4fad1');
                    }else{
                        alert('Terjadi Kesalahan');
                    }
              });
            });
    }
}
function hapus_pending() {
    var r = confirm("Apakah Anda Yakin ?");
    if (r == true) {
            $('.pending').each(function(){
                $(this).parent().removeAttr( 'bgcolor' );
                $(this).parent().css('background-color','');
                var tis=$(this);
                $(this).val('0');
                $.ajax({
                type: "POST",
                dataType : "json",
                url: "<?php echo site_url('api/produk/simpan_pending'); ?>",
                data: 'id='+$(this).attr('id')+'&jum=0'
              }).done(function( data ) {
                    if(data.auth == true){
                        tis.parent().css('background-color','#c4fad1');
                    }else{
                        alert('Terjadi Kesalahan');
                    }
              });
            });
    }
}function hapus_rev() {
    var r = confirm("Apakah Anda Yakin ?");
    if (r == true) {
            $('#rugi_selisih').html('0');
            $('.rev').each(function(){
                $(this).parent().removeAttr( 'bgcolor' );
                $(this).parent().css('background-color','');
                var tis=$(this);
                $(this).val('0');
                $.ajax({
                type: "POST",
                dataType : "json",
                url: "<?php echo site_url('api/produk/simpan_rev'); ?>",
                data: 'id='+$(this).attr('id')+'&jum=0'
              }).done(function( data ) {
                    if(data.auth == true){
                        tis.parent().css('background-color','#c4fad1');
                    }else{
                        alert('Terjadi Kesalahan');
                    }
              });
            });
    }
}
function simpan_beli() {
    var r = confirm("Apakah Anda Yakin ?");
    if (r == true) {
            $('.beli').each(function(){
                $.ajax({
                type: "POST",
                dataType : "json",
                url: "<?php echo site_url('api/produk/pemasukan'); ?>",
                data: 'produk='+$(this).attr('id')+'&jumlah='+$(this).val()+'&keterangan='
              }).done(function( data ) {
                    if(data.auth == true){
                    }else{
                        alert('Terjadi Kesalahan');
                    }
              });
            });

            $('#total_beli').html('0');
            $('.beli').each(function(){
                $(this).parent().removeAttr( 'bgcolor' );
                $(this).parent().css('background-color','');
                var tis=$(this);
                $('#span_beli_'+$(this).attr('id')).html('Rp. 0');
                $(this).val('0');
                $.ajax({
                type: "POST",
                dataType : "json",
                url: "<?php echo site_url('api/produk/simpan_beli'); ?>",
                data: 'id='+$(this).attr('id')+'&beli=0'
              }).done(function( data ) {
                    if(data.auth == true){
                        tis.parent().css('background-color','#c4fad1');
                    }else{
                        alert('Terjadi Kesalahan');
                    }
              });
            });
    }
}
function simpan_rev() {
    var r = confirm("Apakah Anda Yakin ?");
    if (r == true) {
            $('.rev').each(function(){
                var jum=$(this).val(),stock=$(this).attr('stock');
                $.ajax({
                type: "POST",
                dataType : "json",
                url: "<?php echo site_url('api/produk/simpan_rev_produk'); ?>",
                data: 'id='+$(this).attr('id')+'&jum='+jum+'&stock='+stock
              }).done(function( data ) {
                    if(data.auth == true){
                    }else{
                        alert('Terjadi Kesalahan');
                    }
              });
            });

            $('.rev').each(function(){
                $(this).parent().removeAttr( 'bgcolor' );
                $(this).parent().css('background-color','');
                var tis=$(this);
                $(this).val('0');
                $.ajax({
                type: "POST",
                dataType : "json",
                url: "<?php echo site_url('api/produk/simpan_rev'); ?>",
                data: 'id='+$(this).attr('id')+'&jum=0'
              }).done(function( data ) {
                    if(data.auth == true){
                        tis.parent().css('background-color','#c4fad1');
                    }else{
                        alert('Terjadi Kesalahan');
                    }
              });
            });
    }
}
function rollback_stock() {
    var r = confirm("Apakah Anda Yakin ?");
    if (r == true) {

            $('.rev').each(function(){
                $(this).parent().removeAttr( 'bgcolor' );
                $(this).parent().css('background-color','');
                var tis=$(this);
                $(this).val('0');
                $.ajax({
                type: "POST",
                dataType : "json",
                url: "<?php echo site_url('api/produk/rollback_stock'); ?>",
                data: 'id='+$(this).attr('id')
              }).done(function( data ) {
                    if(data.auth == true){
                        tis.parent().css('background-color','#A3E8FF');
                    }else{
                        alert('Terjadi Kesalahan');
                    }
              });
            });
    }
}
$(document).ready(function(){
     $('.notification-area').hide();
     $('.warning-area').hide();
     
      
//        $('.beli').each(function(){
//            
//        });

        $.ajax({
        type: "POST",
        url: "<?php echo site_url('api/produk/ringkasan_penjualan'); ?>",
        data: ''
      }).done(function( data ) {
          $('#detail').html(data);
            var c=0,a,b,harga_dasar;
            $('.beli').each(function(){
                a=parseInt($(this).attr('harga_beli'));
                b=parseInt($(this).val() == '' ? 0 : $(this).val());
                harga_dasar=(a-(a*15/100))*b;
                c=parseInt($('#total_beli').html())+parseInt(harga_dasar);
                $('#span_beli_'+$(this).attr('id')).html("Rp. "+(harga_dasar).formatMoney(0, ',', '.'));
                $('#total_beli').html(c);
            });
            c=parseInt($('#total_beli').html());
            $('#total_beli').html((c).formatMoney(0, ',', '.'));
            
            var c=0,a,b,d,e,harga_rev=0;
            $('.rev').each(function(){
                a=parseInt($(this).attr('harga_beli'));
                b=parseInt($(this).val() == '' ? 0 : $(this).val());
                d=parseInt($(this).attr('stock') == '' ? 0 : $(this).attr('stock'));
                if(b < d && b != 0) e=d-b; else e=0;
                harga_rev=(a-(a*15/100))*e;
                c=parseInt($('#rugi_selisih').html())+parseInt(harga_rev);
                $('#rugi_selisih').html(c);
            });
            c=parseInt($('#rugi_selisih').html());
            $('#rugi_selisih').html((c).formatMoney(0, ',', '.'));
      });
      
        Number.prototype.formatMoney = function(c, d, t){
        var n = this, 
            c = isNaN(c = Math.abs(c)) ? 2 : c, 
            d = d == undefined ? "." : d, 
            t = t == undefined ? "," : t, 
            s = n < 0 ? "-" : "", 
            i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
            j = (j = i.length) > 3 ? j % 3 : 0;
           return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
         };
         
        $('.beli').bind('focus', function(){
            $(this).val('');
        });
        $('.beli').bind('blur', function(){
            if($(this).val() == ''){
            	$(this).val('0');
            }
		var id=$(this).attr('id');
		var beli=$(this).val();
	    setTimeout(function(){ harga_dasar(id,beli); }, 500);
        });
        /*$('.beli').bind('change', function(){
        	var id=$(this).attr('id'),beli=$(this).val()
		harga_dasar(id,beli);
        });*/
        function harga_dasar(id,beli){
            $.ajax({
            type: "POST",
            dataType : "json",
            url: "<?php echo site_url('api/produk/simpan_beli'); ?>",
            data: 'id='+id+'&beli='+beli
          }).done(function( data ) {
                $('#total_beli').html('0');
                if(data.auth == true){
                        var c=0,a,b,harga_dasar;
                        $('.beli').each(function(){
                            a=parseInt($(this).attr('harga_beli'));
                            b=parseInt($(this).val());
                            harga_dasar=(a-(a*15/100))*b;
                            c=parseInt($('#total_beli').html())+parseInt(harga_dasar);
                            $('#total_beli').html(c);
                            $('#span_beli_'+$(this).attr('id')).html("Rp. "+(harga_dasar).formatMoney(0, ',', '.'));
                            if(b != 0) $(this).parent().css('background-color','#FFCD87');
                        });
                        c=parseInt($('#total_beli').html());
                        $('#total_beli').html((c).formatMoney(0, ',', '.'));

                }else{
                    alert('Terjadi Kesalahan');
                }
          });
        }
        

         
        $('.pending').bind('focus', function(){
            $(this).val('');
        });
        $('.pending').bind('blur', function(){
                if($(this).val() == ''){
                    $(this).val('0');
                }
                    var id=$(this).attr('id');
                    var jum=$(this).val();
                setTimeout(function(){ jum_pending(id,jum); }, 500);
        });
        /*$('.beli').bind('change', function(){
        	var id=$(this).attr('id'),beli=$(this).val()
		harga_dasar(id,beli);
        });*/
        function jum_pending(id,jum){
            $.ajax({
            type: "POST",
            dataType : "json",
            url: "<?php echo site_url('api/produk/simpan_pending'); ?>",
            data: 'id='+id+'&jum='+jum
          }).done(function( data ) {
                if(data.auth == true){
                        var a,b,c;
                        $('.pending').each(function(){
                            a=parseInt($(this).val());
                            if(!$.isNumeric(a)) a=0;
                            b=parseInt($(this).attr('stock'));
                            c=b-a;
//                            alert(a);alert(b);alert(c);
                            $(this).parent().parent().find('.stockN').html(c);
                            if(a != 0) $(this).parent().css('background-color','#FFCD87'); else {$(this).parent().removeAttr( 'bgcolor' );$(this).parent().css('background-color','');}
                        });

                }else{
                    alert('Terjadi Kesalahan');
                }
          });
        }
        
        
        

         
        $('.rev').bind('focus', function(){
            $(this).val('');
        });
        $('.rev').bind('blur', function(){
                if($(this).val() == ''){
                    $(this).val('0');
                }
                    var id=$(this).attr('id');
                    var jum=$(this).val();
                setTimeout(function(){ jum_rev(id,jum); }, 500);
        });
        /*$('.beli').bind('change', function(){
        	var id=$(this).attr('id'),beli=$(this).val()
		harga_dasar(id,beli);
        });*/
        function jum_rev(id,jum){
            $.ajax({
            type: "POST",
            dataType : "json",
            url: "<?php echo site_url('api/produk/simpan_rev'); ?>",
            data: 'id='+id+'&jum='+jum
          }).done(function( data ) {
                $('#rugi_selisih').html('0');
                if(data.auth == true){
                        var a,b,c;
                        $('.rev').each(function(){
                            a=parseInt($(this).val());
                            if(!$.isNumeric(a)) a=0;
//                            alert(a);alert(b);alert(c);
                            if(a != 0) $(this).parent().css('background-color','#FFCD87'); else {$(this).parent().removeAttr( 'bgcolor' );$(this).parent().css('background-color','');}
                        });
                        
                        var c=0,a,b,d,e,harga_rev=0;
                        $('.rev').each(function(){
                            a=parseInt($(this).attr('harga_beli'));
                            b=parseInt($(this).val() == '' ? 0 : $(this).val());
                            d=parseInt($(this).attr('stock') == '' ? 0 : $(this).attr('stock'));
                            if(b < d && b != 0) e=d-b; else e=0;
                            harga_rev=(a-(a*15/100))*e;
                            c=parseInt($('#rugi_selisih').html())+parseInt(harga_rev);
                            $('#rugi_selisih').html(c);
                        });
                        c=parseInt($('#rugi_selisih').html());
                        $('#rugi_selisih').html((c).formatMoney(0, ',', '.'));
                }else{
                    alert('Terjadi Kesalahan');
                }
          });
        }
//         $('#hapus_beli').bind('click', function(){
//            $('#total_beli').html('0');
//            $('.beli').each(function(){
//                $('#span_beli_'+$(this).attr('id')).html('Rp. 0');
//                $(this).val('0');
//                $.ajax({
//                type: "POST",
//                dataType : "json",
//                url: "<?php echo site_url('api/produk/simpan_beli'); ?>",
//                data: 'id='+$(this).attr('id')+'&beli=0'
//              }).done(function( data ) {
//                    if(data.auth == true){
//                    }else{
//                        alert('Terjadi Kesalahan');
//                    }
//              });
//            });
//        });
//        
//        $('#simpan_beli').bind('click', function(){
//            $('#total_beli').html('0');
//            $('.beli').each(function(){
//                $('#span_beli_'+$(this).attr('id')).html('Rp. 0');
//                $(this).val('0');
//                $.ajax({
//                type: "POST",
//                dataType : "json",
//                url: "<?php echo site_url('api/produk/simpan_beli'); ?>",
//                data: 'id='+$(this).attr('id')+'&beli=0'
//              }).done(function( data ) {
//                    if(data.auth == true){
//                    }else{
//                        alert('Terjadi Kesalahan');
//                    }
//              });
//            });
//        });
    
    
});
</script>
    