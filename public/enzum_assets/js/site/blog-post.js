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
    $(window).load(function(){
        $("a[class^='prettyPhoto']").prettyPhoto({social_tools: '' });
    });
});