/**
 * Created by design on 12/28/2015.
 */
$(document).ready(function() {
    $('.slidewrap2').carousel({
        slider: '.slider',
        slide: '.slide',
        slideHed: '.slidehed',
        nextSlide : '.next',
        prevSlide : '.prev',
        addPagination: false,
        addNav : false
    });
});
$(window).load(function(){
    $("a[class^='prettyPhoto']").prettyPhoto({social_tools: '' });
    // cache container
    var $container = $('#isotope-container');
    // initialize isotope
    $container.isotope({
        animationOptions: {
            duration: 750,
            easing: 'linear',
            queue: false
        },
        layoutMode : 'fitRows'
    });
    // filter items when filter link is clicked
    $('#filters a').click(function(){
        $("#filters a.active").removeClass('active');
        $(this).addClass('active');
        var selector = $(this).attr('data-filter');
        $container.isotope({ filter: selector });
        return false;
    });
});