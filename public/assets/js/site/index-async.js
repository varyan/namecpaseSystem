/**
 * Created by design on 12/28/2015.
 */
$(window).load(function(){
    // Setup Slider
    $(".asyncslider.hide").fadeIn(600);
    $(".asyncslider").asyncSlider({
        keyboardNavigate: true,
        autoswitch: 4000,
        slidesNav: true,
        easing: 'easeInOutExpo',
        minTime: 700,
        maxTime: 1600,
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