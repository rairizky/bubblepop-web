$(document).ready(function() {
   revapi1 = $('.tp-banner').show().revolution({
        dottedOverlay:"none",
        delay:6000,
        startwidth:1170,
        startheight:853,
        hideThumbs:200,

        thumbWidth:100,
        thumbHeight:50,
        thumbAmount:5,

        navigationType:"bullet",
        navigationArrows:"solo",
        navigationStyle:"square",

        touchenabled:"on",
        onHoverStop:"on",

        swipe_velocity: 0.7,
        swipe_min_touches: 1,
        swipe_max_touches: 1,
        drag_block_vertical: false,

        parallax:"mouse",
        parallaxBgFreeze:"on",
        parallaxLevels:[7,4,3,2,5,4,3,2,1,0],

        keyboardNavigation:"off",

        navigationHAlign:"center",
        navigationVAlign:"bottom",
        navigationHOffset:0,
        navigationVOffset:20,

        soloArrowLeftHalign:"left",
        soloArrowLeftValign:"center",
        soloArrowLeftHOffset:20,
        soloArrowLeftVOffset:0,

        soloArrowRightHalign:"right",
        soloArrowRightValign:"center",
        soloArrowRightHOffset:20,
        soloArrowRightVOffset:0,

        shadow:0,
        fullWidth:"on",
        fullScreen:"off",

        spinner:"spinner4",

        stopLoop:"off",
        stopAfterLoops:-1,
        stopAtSlide:-1,

        shuffle:"off",

        autoHeight:"off",                       
        forceFullWidth:"off",                       

        hideThumbsOnMobile:"off",
        hideNavDelayOnMobile:1500,                      
        hideBulletsOnMobile:"off",
        hideArrowsOnMobile:"off",
        hideThumbsUnderResolution:0,

        hideSliderAtLimit:0,
        hideCaptionAtLimit:0,
        hideAllCaptionAtLilmit:0,
        startWithSlide:0,
        fullScreenOffsetContainer: "",

        disableProgressBar: "on"
    });
    revapi1.bind("revolution.slide.onloaded",function (e,data) {
                // $("#slider-counter .current-number").text( add_zero_num(revapi1.revcurrentslide(),2) );
                // $("#slider-counter .total-numbers").text( add_zero_num(revapi1.revmaxslide(),2) );
            });
                    
    revapi1.bind("revolution.slide.onchange",function (e,data) {
                // $("#slider-counter .current-number").text( add_zero_num(revapi1.revcurrentslide(),2) );  
                // $("#slider-counter .total-numbers").text( add_zero_num(revapi1.revmaxslide(),2) );  
                $data_id = 'a[data-id='   + revapi1.revcurrentslide()  +']';
                $("#slider-counter a").removeClass("active");
                $("#slider-counter " + $data_id).addClass("active");
            });
    $("#slider-counter a").on('click', function(e){
        e.preventDefault();
        revapi1.revshowslide($(this).data('id'));
    })

});