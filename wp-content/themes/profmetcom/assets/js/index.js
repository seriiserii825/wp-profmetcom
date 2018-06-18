jQuery(document).ready(function($) {
    /*
    https://www.jqueryscript.net/animation/Smooth-Mouse-Wheel-Scrolling-Plugin-With-jQuery-easeScroll.html
    ===========================*/
    if ($(window).width() < 1200) {
        $("html").easeScroll({
            frameRate: 60,
            animationTime: 1000,
            stepSize: 90,
            pulseAlgorithm: 1,
            pulseScale: 8,
            pulseNormalize: 1,
            accelerationDelta: 20,
            accelerationMax: 1,
            keyboardSupport: true,
            arrowScroll: 50,
            touchpadSupport: true,
            fixedBackground: true
        });
    }

    ymaps.ready(init);
    var smallMap;

    function init(){
        smallMap = new ymaps.Map("small-map", {
            center: [55.76, 37.64],
            zoom: 7
        });
    }

    if ($(window).width() > 1200) {
        $('#fullPage').fullpage({
            responsiveWidth: 1200,
            scrollingSpeed: 500,
        });
    }
    /* scroll to top
        ====================================================*/
    $('#js-btn-up').on('click', function(){
        $('html, body').animate({
            scrollTop: 40
        }, 600);
    });

    var documentHeight = $(document).height();

    $(document).on('scroll', function(){
        if ($(this).scrollTop() < documentHeight / 3) {
            $('#js-btn-up').addClass('disabled');
        } else {
            $('#js-btn-up').removeClass('disabled');
        }

        if ($(this).scrollTop() > documentHeight / 4) {
            $('.menu-bottom.index-page').addClass('show');
        } else {
            $('.menu-bottom.index-page').removeClass('show');
        }
    });

});