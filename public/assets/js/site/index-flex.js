/**
 * Created by design on 12/28/2015.
 */
$(window).load(function(){
    $(".flex.hide").fadeIn(1000);
    $('.flexslider').flexslider({
        animation: "slide"
    });
    $("a[class^='prettyPhoto']").prettyPhoto({social_tools: '' });
});
$(document).ready(function() {
    $('.slidewrap, .slidewrap2').carousel({
        slider: '.slider',
        slide: '.slide',
        slideHed: '.slidehed',
        nextSlide : '.next',
        prevSlide : '.prev',
        addPagination: false,
        addNav : false
    });
    $('.slide.testimonials').contentSlide();
});