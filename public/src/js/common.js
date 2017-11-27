(function ( $ ) {
    $.fn.flex=function(){
        return $(this).css({'display':'flex'});
    }
}( jQuery ));

$(window).bind('load',function () {
    $('#animasiya').fadeOut();
});

$('#header').find('>img').click(function () {
    window.location='/';
});

$('#hamburger-nav').click(function (event) {
    $('nav').find('>ul:nth-of-type(1)').stop().slideToggle();
});

if($(window).width()<=768){
    $('#axtaris-form').slideUp();
}

$('#axtaris').click(function () {
    $('#axtaris-form').stop().slideToggle();
});


$('.alert').find('.close').click(function () {
   $(this).parent('.alert').slideUp().fadeOut();
});