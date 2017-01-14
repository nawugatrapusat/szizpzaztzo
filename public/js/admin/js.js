$(document).ready(function(){
    $('.notification-area , .warning-area').bind('click',function(){
            $(this).slideUp('slow');
    });

    $('.notification-area2 , .warning-area2').bind('click',function(){
            $(this).slideUp('slow');
    });
});