'use strict';

// Cache
var body = jQuery('body');
var mainSlider = jQuery('#main-slider');
var imageCarousel = jQuery('.img-carousel');
var partnersCarousel = jQuery('#partners');
var testimonialsCarousel = jQuery('#testimonials');
var topProductsCarousel = jQuery('#top-products-carousel');
var featuredProductsCarousel = jQuery('#featured-products-carousel');
var sidebarProductsCarousel = jQuery('#sidebar-products-carousel');
var hotDealsCarousel = jQuery('#hot-deals-carousel');
var owlCarouselSelector = jQuery('.owl-carousel');
var isotopeContainer = jQuery('.isotope');
var isotopeFiltrable = jQuery('#filtrable a');
var toTop = jQuery('#to-top');
var hover = jQuery('.thumbnail');
var navigation = jQuery('.navigation');
var superfishMenu = jQuery('ul.sf-menu');
var priceSliderRange = jQuery('#slider-range');

// Slide in/out with fade animation function
jQuery.fn.slideFadeToggle  = function(speed, easing, callback) {
    return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);
};
//
jQuery.fn.slideFadeIn  = function(speed, easing, callback) {
    return this.animate({opacity: 'show', height: 'show'}, speed, easing, callback);
};
jQuery.fn.slideFadeOut  = function(speed, easing, callback) {
    return this.animate({opacity: 'hide', height: 'hide'}, speed, easing, callback);
};

jQuery(document).ready(function () {
    // Prevent empty links
    // ---------------------------------------------------------------------------------------
    jQuery('a[href="#"]').click(function (event) {
        event.preventDefault();
    });
    // Sticky header/menu
    // ---------------------------------------------------------------------------------------
    if (jQuery().sticky) {
        jQuery('.header.fixed').sticky({topSpacing:0});
        //jQuery('.header.fixed').on('sticky-start', function() { console.log("Started"); });
        //jQuery('.header.fixed').on('sticky-end', function() { console.log("Ended"); });
    }
    // SuperFish menu
    // ---------------------------------------------------------------------------------------
    if (jQuery().superfish) {
        superfishMenu.superfish();
    }
    jQuery('ul.sf-menu a').click(function () {
        body.scrollspy('refresh');
    });
    // Fixed menu toggle
    jQuery('.menu-toggle').on('click', function () {
        if (navigation.hasClass('opened')) {
            navigation.removeClass('opened').addClass('closed');
        } else {
            navigation.removeClass('closed').addClass('opened');
        }
    });
    jQuery('.menu-toggle-close').on('click', function () {
        if (navigation.hasClass('opened')) {
            navigation.removeClass('opened').addClass('closed');
        } else {
            navigation.removeClass('closed').addClass('opened');
        }
    });
    // Smooth scrolling
    // ----------------------------------------------------------------------------------------
    jQuery('.sf-menu a, .scroll-to').click(function () {

        jQuery('.sf-menu a').removeClass('active');
        jQuery(this).addClass('active');
        jQuery('html, body').animate({
            scrollTop: jQuery(jQuery(this).attr('href')).offset().top
        }, {
            duration: 1200,
            easing: 'easeInOutExpo'
        });
        return false;
    });
    // BootstrapSelect
    // ---------------------------------------------------------------------------------------
    if (jQuery().selectpicker) {
        jQuery('.selectpicker').selectpicker();
    }
    // prettyPhoto
    // ---------------------------------------------------------------------------------------
    if (jQuery().prettyPhoto) {
        jQuery("a[data-gal^='prettyPhoto']").prettyPhoto({
            theme: 'dark_square'
        });
    }
    // Scroll totop button
    // ---------------------------------------------------------------------------------------
    jQuery(window).scroll(function () {
        if (jQuery(this).scrollTop() > 1) {
            toTop.css({bottom: '15px'});
        } else {
            toTop.css({bottom: '-100px'});
        }
    });
    toTop.click(function () {
        jQuery('html, body').animate({scrollTop: '0px'}, 800);
        return false;
    });
    // Add hover class for correct view on mobile devices
    // ---------------------------------------------------------------------------------------
    hover.hover(
        function () {
            jQuery(this).addClass('hover');
        },
        function () {
            jQuery(this).removeClass('hover');
        }
    );
    // Sliders
    // ---------------------------------------------------------------------------------------
    if (jQuery().owlCarousel) {
        var owl = jQuery('.owl-carousel');
        owl.on('changed.owl.carousel', function(e) {
            // update prettyPhoto
            if (jQuery().prettyPhoto) {
                jQuery("a[data-gal^='prettyPhoto']").prettyPhoto({
                    theme: 'dark_square'
                });
            }
        });
        // Main slider
        if (mainSlider.length) {
            mainSlider.owlCarousel({
                //items: 1,
                rtl:true,
                autoplay: false,
                autoplayHoverPause: true,
                loop: true,
                margin: 0,
                dots: true,
                nav: true,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsiveRefreshRate: 100,
                responsive: {
                    0: {items: 1},
                    479: {items: 1},
                    768: {items: 1},
                    991: {items: 1},
                    1024: {items: 1}
                }
            });
        }
        // Top products carousel
        if (topProductsCarousel.length) {
            topProductsCarousel.owlCarousel({
                 rtl:true,
                autoplay: false,
                loop: true,
                margin: 30,
                dots: false,
                nav: true,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {items: 1},
                    479: {items: 2},
                    768: {items: 3},
                    991: {items: 4},
                    1024: {items: 5},
                    1280: {items: 6}
                }
            });
        }
        // Featured products carousel
        if (featuredProductsCarousel.length) {
            featuredProductsCarousel.owlCarousel({
                 rtl:true,
                autoplay: false,
                loop: true,
                margin: 30,
                dots: false,
                nav: true,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {items: 1},
                    479: {items: 1},
                    768: {items: 2},
                    991: {items: 3},
                    1024: {items: 4}
                }
            });
        }
        // Sidebar products carousel
        if (sidebarProductsCarousel.length) {
            sidebarProductsCarousel.owlCarousel({
                 rtl:true,
                autoplay: false,
                loop: true,
                margin: 30,
                dots: true,
                nav: false,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {items: 1},
                    479: {items: 1},
                    768: {items: 1},
                    991: {items: 1},
                    1024: {items: 1}
                }
            });
        }
        // Partners carousel
        if (partnersCarousel.length) {
            partnersCarousel.owlCarousel({
                 rtl:true,
                autoplay: false,
                loop: true,
                margin: 30,
                dots: false,
                nav: true,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {items: 1},
                    479: {items: 2},
                    768: {items: 3},
                    991: {items: 4},
                    1024: {items: 5},
                    1280: {items: 6}
                }
            });
        }
        // Testimonials carousel
        if (testimonialsCarousel.length) {
            testimonialsCarousel.owlCarousel({
                 rtl:true,
                autoplay: true,

                loop: true,
                margin: 0,
                dots: true,
                nav: false,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {items: 1},
                    479: {items: 1},
                    768: {items: 1},
                    991: {items: 1},
                    1024: {items: 1},
                    1280: {items: 1}
                }
            });
        }
        // Images carousel
        if (imageCarousel.length) {
            imageCarousel.owlCarousel({
                rtl:true,
                autoplay: false,
                loop: true,
                margin: 0,
                dots: true,
                nav: true,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsiveRefreshRate: 100,
                responsive: {
                    0: {items: 1},
                    479: {items: 1},
                    768: {items: 1},
                    991: {items: 1},
                    1024: {items: 1}
                }
            });
        }
    }
    // countdown
    // ---------------------------------------------------------------------------------------
    if (jQuery().countdown) {
        var austDay = new Date();
        austDay = new Date(austDay.getFullYear() + 1, 1 - 1, 26);
        jQuery('#dealCountdown1').countdown({until: austDay});
        jQuery('#dealCountdown2').countdown({until: austDay});
        jQuery('#dealCountdown3').countdown({until: austDay});
    }
    // Google map
    // ---------------------------------------------------------------------------------------
    if (typeof google === 'object' && typeof google.maps === 'object') {
        if (jQuery('#map-canvas').length) {
            var map;
            var marker;
            var image = 'assets/img/icon-google-map.png'; // marker icon
            google.maps.event.addDomListener(window, 'load', function () {
                var mapOptions = {
                    scrollwheel: false,
                    zoom: 12,
                    center: new google.maps.LatLng(40.9807648, 28.9866516) // map coordinates
                };

                map = new google.maps.Map(document.getElementById('map-canvas'),
                    mapOptions);
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(41.0096559,28.9755535), // marker coordinates
                    map: map,
                    icon: image,
                    title: 'Hello World!'
                });
            });
        }
    }
    // Price range / need jquery ui
    // ---------------------------------------------------------------------------------------
    if (jQuery.ui) {
        if (jQuery(priceSliderRange).length) {
            jQuery(priceSliderRange).slider({
                range: true,
                min: 0,
                max: 500,
                values: [75, 300],
                slide: function (event, ui) {
                    jQuery("#amount").val("jQuery" + ui.values[0] + " - jQuery" + ui.values[1]);
                }
            });
            jQuery("#amount").val(
                "jQuery" + jQuery("#slider-range").slider("values", 0) +
                " - jQuery" + jQuery("#slider-range").slider("values", 1)
            );
        }
    }
    // Shop categories widget slide in/out
    // ---------------------------------------------------------------------------------------
    jQuery('.shop-categories .arrow').click(
        function () {

            jQuery(this).parent().parent().find('ul.children').removeClass('active');
            jQuery(this).parent().parent().find('.fa-angle-up').addClass('fa-angle-down').removeClass('fa-angle-up');
            if (jQuery(this).parent().find('ul.children').is(":visible")) {
                //jQuery(this).find('.fa-angle-up').addClass('fa-angle-down').removeClass('fa-angle-up');
                //jQuery(this).parent().find('ul.children').removeClass('active');
            }
            else {
                jQuery(this).find('.fa-angle-down').addClass('fa-angle-up').removeClass('fa-angle-down');
                jQuery(this).parent().find('ul.children').addClass('active');
            }
            jQuery(this).parent().parent().find('ul.children').each(function () {
                if (!jQuery(this).hasClass('active')) {
                    jQuery(this).slideFadeOut();
                }
                else {
                    jQuery(this).slideFadeIn();
                }
            });
        }
    );
    jQuery('.shop-categories ul.children').each(function () {
        if (!jQuery(this).hasClass('active')) {
            jQuery(this).hide();
        }
    });
});

jQuery(window).load(function () {
    // Preloader
    jQuery('#status').fadeOut();
    jQuery('#preloader').delay(200).fadeOut(200);
    // Isotope
    if (jQuery().isotope) {
        isotopeContainer.isotope({ // initialize isotope
            itemSelector: '.isotope-item' // options...
            //,transitionDuration: 0 // disable transition
        });
        isotopeFiltrable.click(function () { // filter items when filter link is clicked
            var selector = jQuery(this).attr('data-filter');
            isotopeFiltrable.parent().removeClass('current');
            jQuery(this).parent().addClass('current');
            isotopeContainer.isotope({filter: selector});
            return false;
        });
        isotopeContainer.isotope('reLayout'); // layout/reLayout
    }
    // Scroll to hash
    if (location.hash != '') {
        var hash = '#' + window.location.hash.substr(1);
        if (hash.length) {
            body.delay(0).animate({
                scrollTop: jQuery(hash).offset().top
            }, {
                duration: 1200,
                easing: "easeInOutExpo"
            });
        }
    }
    // OwlSliders
    if (jQuery().owlCarousel) {
        // Hot deal carousel
        // must initialized after counters
        if (hotDealsCarousel.length) {
            hotDealsCarousel.owlCarousel({
                autoplay: false,
                loop: true,
                margin: 30,
                dots: true,
                nav: false,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {items: 1},
                    479: {items: 1},
                    768: {items: 1},
                    991: {items: 1},
                    1024: {items: 1}
                }
            });
        }
    }
    // Refresh owl carousels/sliders
    owlCarouselSelector.trigger('refresh');
    owlCarouselSelector.trigger('refresh.owl.carousel');
});

jQuery(window).resize(function () {
    // Refresh owl carousels/sliders
    owlCarouselSelector.trigger('refresh');
    owlCarouselSelector.trigger('refresh.owl.carousel');
    // Refresh isotope
    if (jQuery().isotope) {
        isotopeContainer.isotope('reLayout'); // layout/relayout on window resize
    }
    if (jQuery().sticky) {
        jQuery('.header.fixed').sticky('update');
    }
});

jQuery(window).scroll(function () {
    // Refresh owl carousels/sliders
    owlCarouselSelector.trigger('refresh');
    owlCarouselSelector.trigger('refresh.owl.carousel');
    if (jQuery().sticky) {
        jQuery('.header.fixed').sticky('update');
    }
});
