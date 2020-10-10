/**
  * isMobile
  * responsiveMenu
  * headerFixed
  * ajaxContactForm
  * alertBox
  * blog_slider
  * detectViewport
  * flatIconboxCarousel
  * blogCarousel
  * flatClient
  * googleMap
  * productSlide
  * onepage_nav
  * flatClient
  * responsiveVideo
  * swClick
  * activePattern
  * goTop
  * toggleExtramenu
  * retinaLogos
  * parallax
  * popupGallery
  * removePreloader
*/

;(function($) {

   'use strict'

    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };

	var responsiveMenu = function() {
        var menuType = 'desktop';

        $(window).on('load resize', function() {
            var currMenuType = 'desktop';

            if ( matchMedia( 'only screen and (max-width: 991px)' ).matches ) {
                currMenuType = 'mobile';
            }

            if ( currMenuType !== menuType ) {
                menuType = currMenuType;

                if ( currMenuType === 'mobile' ) {
                    var $mobileMenu = $('#mainnav').attr('id', 'mainnav-mobi').hide();
                    var hasChildMenu = $('#mainnav-mobi').find('li:has(ul)');

                    $('#header').after($mobileMenu);
                    hasChildMenu.children('ul').hide();
                    hasChildMenu.children('a').after('<span class="btn-submenu"></span>');
                    $('.btn-menu').removeClass('active');
                } else {
                    var $desktopMenu = $('#mainnav-mobi').attr('id', 'mainnav').removeAttr('style');

                    $desktopMenu.find('.submenu').removeAttr('style');
                    $('#header').find('.nav-wrap').append($desktopMenu);
                    $('.btn-submenu').remove();
                }
            }
        });

        $('.btn-menu').on('click', function() {         
            $('#mainnav-mobi').slideToggle(300);
            $(this).toggleClass('active');
        });

        $(document).on('click', '#mainnav-mobi li .btn-submenu', function(e) {
            $(this).toggleClass('active').next('ul').slideToggle(300);
            e.stopImmediatePropagation()
        });
    }

    var counter = function() {
        var before = '<div class="square"><div class="numb">',
            text = '</div><div class="text">';
            if ($().countdown) {
                $(".countdown").countdown('2017/10/8', function(event) {
                  $(this).html(event.strftime(before + '%D' + text + 'DAYS</div></div>' + before + '%H' + text + 'HOURS</div></div>' + before + '%M' + text + 'MINITUES</div></div>' + before + '%S' + text + 'SECONDS</div>'));
                });
            }
    };    


    var headerFixed = function() {
        if ( $('body').hasClass('header_sticky') ) {
            var nav = $('.header');

            if ( nav.size() != 0 ) {
                var offsetTop = $('.header').offset().top,
                    headerHeight = $('.header').height(),
                    injectSpace = $('<div />', { height: headerHeight }).insertAfter(nav);   
                    injectSpace.hide();                 

                $(window).on('load scroll', function(){
                    if ( $(window).scrollTop() > offsetTop + 120 ) {
                        $('.header').addClass('downscrolled');
                        injectSpace.show();
                    } else {
                        $('.header').removeClass('header-small downscrolled');
                        injectSpace.hide();
                    }

                    if ( $(window).scrollTop() > 500 ) {
                        $('.header').addClass('header-small upscrolled');
                    } else {
                        $('.header').removeClass('upscrolled');
                    }
                })
            }
        }     
    };

    var ajaxContactForm = function() {  
        $('#reservation-form').each(function(e) {
            e.preventDefault;
            $(this).validate({
                submitHandler: function( form ) {
                    var $form = $(form),
                        str = $form.serialize(),
                        loading = $('<div />', { 'class': 'loading' });

                    $.ajax({
                        type: "POST",
                        url:  $form.attr('action'),
                        data: str,
                        beforeSend: function () {
                            $form.find('.form-submit').append(loading);
                        },
                        success: function( msg ) {
                            var result, cls;                            
                            if ( msg == 'Success' ) {                                
                                result = 'Message Sent Successfully To Email Administrator. ( You can change the email management a very easy way to get the message of customers in the user manual )';
                                cls = 'msg-success';
                            } else {
                                result = 'Error sending email.';
                                cls = 'msg-error';
                            }

                            $form.prepend(
                                $('<div />', {
                                    'class': 'flat-alert ' + cls,
                                    'text' : result
                                }).append(
                                    $('<a class="close" href="#"><i class="fa fa-close"></i></a>')
                                )
                            );

                            $form.find(':input').not('.submit').val('');
                        },
                        complete: function (xhr, status, error_thrown) {
                            $form.find('.loading').remove();
                        }
                    });
                }
            });
        }); // each contactform
    };   

    var alertBox = function() {
        $(document).on('click', '.close', function(e) {
            $(this).closest('.flat-alert').remove();
            e.preventDefault();
        })     
    }  
   
    var blog_slider = function() { 
        if ( $().flexslider ) {            
            $('.flat-blog-slider').each(function() {
                var $this = $(this)
                $this.find('.flexslider').flexslider({
                    animation      :  "slide",
                    direction      :  "horizontal", // vertical
                    pauseOnHover   :  true,
                    useCSS         :  false,
                    easing         :  "swing",
                    animationSpeed :  500,
                    slideshowSpeed :  5000,
                    controlNav     :  false,
                    directionNav   :  true,
                    slideshow      :  true,
                    prevText       :  '<i class="fa fa-angle-left"></i>',
                    nextText       :  '<i class="fa fa-angle-right"></i>',
                    smoothHeight   :  true
                }); // flexslider
            }); // blog-sider
        }
    }; 

    var detectViewport = function() {
        $('[data-waypoint-active="yes"]').waypoint(function() {
            $(this).trigger('on-appear');
        }, { offset: '90%', triggerOnce: true });

        $(window).on('load', function() {
            setTimeout(function() {
                $.waypoints('refresh');
            }, 100);
        });
    };   

    var flatIconboxCarousel = function() {
        $('.flat-iconbox-carosuel-wrap').each(function(){            
            if ( $().owlCarousel ) {
                $(this).find('.flat-iconbox-carosuel').owlCarousel({
                    loop: true,
                    margin: 30,
                    nav: true,
                    dots: false, 
                    auto: true,
                    responsive:{
                        0:{
                            items: 1
                        },
                        480:{
                            items: 2
                        },
                        767:{
                            items: 2
                        },
                        991:{
                            items: 3
                        }, 
                        1200:{
                            items: 3
                        }               
                    }
                });
            }            
        });
    };

    var blogCarousel = function() {
        $('.blog-carosuel-wrap').each(function(){            
            if ( $().owlCarousel ) {
                $(this).find('.blog-carosuel').owlCarousel({
                    loop: true,
                    margin: 30,
                    nav: false,
                    dots: true, 
                    auto:true,
                    responsive:{
                        0:{
                            items: 1
                        },
                        480:{
                            items: 2
                        },
                        767:{
                            items: 2
                        },
                        991:{
                            items: 3
                        }, 
                        1200:{
                            items: 3
                        }               
                    }
                });
            }            
        });
    };     

    var flatClient = function() {
        $('.flat-row').each(function() {            
            if ( $().owlCarousel ) {
                $(this).find('.flat-client').owlCarousel({
                    loop: true,
                    margin: $('.flat-client').data('margin'),
                    nav: $('.flat-client').data('nav'),
                    dots: $('.flat-client').data('dots'),                     
                    autoplay: $('.flat-client').data('auto'),                    
                    responsive:{
                        0:{
                            items: 1
                        },
                        480:{
                            items: 2
                        },
                        767:{
                            items: 3
                        },
                        991:{
                            items: 3
                        },
                        1200: {
                            items: $('.flat-client').data('item')
                        }
                    }
                });
            }
        });
    };

   


    var portfolioIsotope = function() { 
        if ( $().isotope ) {           
            var $container = $('.projects-portfolio');
            $container.imagesLoaded(function(){
                $container.isotope({
                    itemSelector: '.projects-portfolio-wrap',
                    transitionDuration: '1s'
                });
            });

            $('.portfolio-filter li').on('click',function() {                           
                var selector = $(this).find("a").attr('data-filter');
                $('.portfolio-filter li').removeClass('active');
                $(this).addClass('active');
                $container.isotope({ filter: selector });
                return false;
            });            
        };
    };
  
    var googleMap = function() {
        if ( $().gmap3 ) {
            $("#flat-map").gmap3({
                map:{
                    options:{
                        mapTypeControl:false,
                        zoomControl:false,
                        zoom: 11,
                        mapTypeId: 'arch_style',
                        mapTypeControlOptions: {
                            mapTypeIds: ['arch_style', google.maps.MapTypeId.SATELLITE, google.maps.MapTypeId.HYBRID]
                        },
                        scrollwheel: false
                    }
                },
                getlatlng:{
                    address:  "PO Box 97845 Baker st. 567, Los Angeles, California, United States",
                    callback: function(results) {
                        if ( !results ) return;
                        $(this).gmap3('get').setCenter(new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng()));
                        $(this).gmap3({
                            marker:{
                                latLng:results[0].geometry.location,
                                options:{
                                    visible:false,
                                    icon: 'http://themesflat.com/html/arch/images/icon/marker.png'
                                }
                            }
                        });
                    }
                },
                styledmaptype:{
                    id: "arch_style",
                    options:{
                        name: "Arch Map"
                    }, 
                    styles: [
                            {
                                "featureType": "all",
                                "elementType": "labels.text.fill",
                                "stylers": [
                                    {
                                        "saturation": 36
                                    },
                                    {
                                        "color": "#000000"
                                    },
                                    {
                                        "lightness": 40
                                    }
                                ]
                            },
                            {
                                "featureType": "all",
                                "elementType": "labels.text.stroke",
                                "stylers": [
                                    {
                                        "visibility": "on"
                                    },
                                    {
                                        "color": "#000000"
                                    },
                                    {
                                        "lightness": 16
                                    }
                                ]
                            },
                            {
                                "featureType": "all",
                                "elementType": "labels.icon",
                                "stylers": [
                                    {
                                        "visibility": "off"
                                    }
                                ]
                            },
                            {
                                "featureType": "administrative",
                                "elementType": "geometry.fill",
                                "stylers": [
                                    {
                                        "color": "#000000"
                                    },
                                    {
                                        "lightness": 20
                                    }
                                ]
                            },
                            {
                                "featureType": "administrative",
                                "elementType": "geometry.stroke",
                                "stylers": [
                                    {
                                        "color": "#000000"
                                    },
                                    {
                                        "lightness": 17
                                    },
                                    {
                                        "weight": 1.2
                                    }
                                ]
                            },
                            {
                                "featureType": "landscape",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#000000"
                                    },
                                    {
                                        "lightness": 20
                                    }
                                ]
                            },
                            {
                                "featureType": "poi",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#000000"
                                    },
                                    {
                                        "lightness": 21
                                    }
                                ]
                            },
                            {
                                "featureType": "road.highway",
                                "elementType": "geometry.fill",
                                "stylers": [
                                    {
                                        "color": "#000000"
                                    },
                                    {
                                        "lightness": 17
                                    }
                                ]
                            },
                            {
                                "featureType": "road.highway",
                                "elementType": "geometry.stroke",
                                "stylers": [
                                    {
                                        "color": "#000000"
                                    },
                                    {
                                        "lightness": 29
                                    },
                                    {
                                        "weight": 0.2
                                    }
                                ]
                            },
                            {
                                "featureType": "road.arterial",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#000000"
                                    },
                                    {
                                        "lightness": 18
                                    }
                                ]
                            },
                            {
                                "featureType": "road.local",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#000000"
                                    },
                                    {
                                        "lightness": 16
                                    }
                                ]
                            },
                            {
                                "featureType": "transit",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#000000"
                                    },
                                    {
                                        "lightness": 19
                                    }
                                ]
                            },
                            {
                                "featureType": "water",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#000000"
                                    },
                                    {
                                        "lightness": 17
                                    }
                                ]
                            }
                        ]
                },
            });
        }
    }; 

    var productSlide = function() {
        $('.flat-product-single-slider').each(function(){
            $(this).children('#flat-product-carousel').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                itemWidth: 100,
                itemMargin: 10,
                asNavFor: $(this).children('#flat-product-flexslider'),
                prevText: '<i class="fa fa-angle-left"></i>',
                nextText: '<i class="fa fa-angle-right"></i>'
            });
            $(this).children('#flat-product-flexslider').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,                
                sync: $(this).children('#flat-product-carousel'),
                prevText: '<i class="fa fa-angle-left"></i>',
                nextText: '<i class="fa fa-angle-right"></i>'
            });
        });
    };  

    var flatServicesCarousel = function() {
        $('.flat-carousel').each(function(){
            if ( $().owlCarousel ) {
                $(this).find('.owl-carousel-services').owlCarousel({
                    loop: true,
                    //margin: 30,
                    auto: true,
                    dots: false,
                    nav: true,
                    responsive:{
                        0:{
                            items: 1
                        },
                        480:{
                            items: 1
                        },
                        767:{
                            items: 1
                        },
                        991:{
                            items: 1
                        }, 
                        1200:{
                            items: 1
                        }               
                    }
                });
            }
        });
    };


    var onepage_nav = function () {
        $('.mainnav > ul > li > a').on('click',function() {           
            var anchor = $(this).attr('href').split('#')[1];
            var largeScreen = matchMedia('only screen and (min-width: 992px)').matches;
            var headerHeight = 0;
            headerHeight = $('.header').height();
            if ( anchor ) {
                if ( $('#'+anchor).length > 0 ) {
                   if ( $('.upscrolled').length > 0 && largeScreen ) {
                        headerHeight = headerHeight;
                   } else {
                        headerHeight = 0;
                   }                   
                   var target = $('#'+anchor).offset().top - headerHeight;
                   $('html,body').animate({scrollTop: target}, 1000, 'easeInOutExpo');
                }
            }
            return false;
        })

        $('.mainnav ul > li > a').on( 'click', function() {
            $( this ).addClass('active').parent().siblings().children().removeClass('active');
        });
    }  

    var tabs = function() {
        $('.flat-tabs').each(function() {

            $(this).children('.content-tab').children().hide();
            $(this).children('.content-tab').children().first().show();

            $(this).find('.menu-tab').children('li').on('click', function(e) {
                var liActive = $(this).index(),
                    contentActive = $(this).siblings().removeClass('active').parents('.flat-tabs').children('.content-tab').children().eq(liActive);

                contentActive.addClass('active').fadeIn('slow');
                contentActive.siblings().removeClass('active');
                $(this).addClass('active').parents('.flat-tabs').children('.content-tab').children().eq(liActive).siblings().hide();
                e.preventDefault();
            });
        });
    };

    var flatClient = function() {
        $('.flat-row').each(function() {            
            if ( $().owlCarousel ) {
                var $flat_client = $(this).find('.flat-client');
               $flat_client.owlCarousel({
                    loop: true,
                    margin: $flat_client.data('margin'),
                    nav: $flat_client.data('nav'),
                    dots: $flat_client.data('dots'),                     
                    autoplay: $flat_client.data('auto'),                    
                    responsive:{
                        0:{
                            items: 1
                        },
                        480:{
                            items: 2
                        },
                        767:{
                            items: 3
                        },
                        991:{
                            items: 3
                        },
                        1200: {
                            items: $('.flat-client').data('item')
                        }
                    }
                });
            }
        });
    }; 

    var flatAccordion = function() {
        var args = {duration: 600};
        $('.flat-toggle .toggle-title.active').siblings('.toggle-content').show();

        $('.flat-toggle.enable .toggle-title').on('click', function() {
            $(this).closest('.flat-toggle').find('.toggle-content').slideToggle(args);
            $(this).toggleClass('active');
        }); // toggle 

        $('.flat-accordion .toggle-title').on('click', function () {
            if( !$(this).is('.active') ) {
                $(this).closest('.flat-accordion').find('.toggle-title.active').toggleClass('active').next().slideToggle(args);
                $(this).toggleClass('active');
                $(this).next().slideToggle(args);
            } else {
                $(this).toggleClass('active');
                $(this).next().slideToggle(args);
            }     
        }); // accordion
    }; 

    var responsiveVideo= function() {
        if ( $().fitVids ) {
            $('.container').fitVids();
        }
    };

    var swClick = function () {
        function activeLayout () {
            $(".switcher-container" ).on( "click", "a.sw-light", function() {
                $(this).toggleClass( "active" );
                $('body').addClass('home-boxed');  
                $('body').css({'background': '#f6f6f6' });                
                $('.sw-pattern.pattern').css ({ "top": "100%", "opacity": 1, "z-index": "10"});
            }).on( "click", "a.sw-dark", function() {
                $('.sw-pattern.pattern').css ({ "top": "98%", "opacity": 0, "z-index": "-1"});
                $(this).removeClass('active').addClass('active');
                $('body').removeClass('home-boxed');
                $('body').css({'background': '#fff' });
                return false;
            })       
        }        

        function activePattern () {
            $('.sw-pattern').on('click', function () {
                $('.sw-pattern.pattern a').removeClass('current');
                $(this).addClass('current');
                $('body').css({'background': 'url("' + $(this).data('image') + '")', 'background-size' : '30px 30px', 'background-repeat': 'repeat' });
                return false
            })
        }

        activeLayout(); 
        activePattern();
    } 
    
    var goTop = function() {
        $(window).scroll(function() {
            if ( $(this).scrollTop() > 800 ) {
                $('.go-top-v1').addClass('show');
            } else {
                $('.go-top-v1').removeClass('show');
            }
        }); 

        $('.go-top-v1').on('click', function() {            
            $("html, body").animate({ scrollTop: 0 }, 1000 , 'easeInOutExpo');
            return false;
        });
    };

    var toggleExtramenu = function() {
        $('.menu.menu-extra li a').on('click', function() {
            $('body').toggleClass('off-canvas-active');
        });
        $('#site-off-canvas .close').on('click', function() {
            $('body').removeClass('off-canvas-active');
        });
    }

    var retinaLogos = function() {
      var retina = window.devicePixelRatio > 1 ? true : false;

        if(retina) {
            $('.header .logo').find('img').attr({src:'./images/logo@2x.png',width:'210',height:'88'});   
        }
    };    
    
    var parallax = function() {
        if ( $().parallax && isMobile.any() == null ) {
            $('.parallax1').parallax("50%", 0.2);
            $('.parallax4').parallax("50%", 0.4);  
            $('.parallax3').parallax("50%", 0.5);            
        }
    };

    var popupGallery = function () {
        $(".popup-gallery").magnificPopup({
            type: "image",
            tLoading: "Loading image #%curr%...",
            removalDelay: 600,
            mainClass: "my-mfp-slide-bottom",
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [ 0, 1 ]
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
            }
        });
    }

    var date_time = function() {
        if ($().datetimepicker) {
            $(".date_picker input").datetimepicker({
                  timepicker:false,
                  format: 'd/m/Y'
            })
            $(".time_picker input").datetimepicker({
                  datepicker:false,
                  format: 'H:i'
            })
        }
    }

    var videoPopup =  function() {
        $(".fancybox").on("click", function(){
            $.fancybox({
              href: this.href,
              type: $(this).data("type")
            }); // fancybox
            return false   
        }); // on
    }

    var removePreloader = function() {        
        $('.loading-overlay').fadeOut('slow',function () {
            $(this).remove();
        });
    };

   	// Dom Ready
	$(function() { 
        if ( matchMedia( 'only screen and (min-width: 991px)' ).matches ) {
            headerFixed();
        }  
        counter();
        responsiveMenu();        
        googleMap(); 
        flatClient();
        goTop();  
        date_time();
        videoPopup();
        removePreloader();
        productSlide();
        tabs();
        ajaxContactForm();
        portfolioIsotope();
        flatServicesCarousel();
        flatAccordion();
   	});

})(jQuery);