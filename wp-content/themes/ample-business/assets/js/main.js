jQuery(window).load(function() {

    var allFXs = ['scroll', 'crossfade', 'cover', 'uncover'];
    function setRandomFX(jQueryelem) {
        var newFX = Math.floor(Math.random() * allFXs.length);
        jQueryelem.trigger('configuration', {
            auto: {
                fx: allFXs[ newFX ]
            }
        });
    }


//Primary Nav in both scene 

    var windowWidth = jQuery(window).width();
    var nav = ".main-nav";
    //    for sub menu arrow

    //    for sub menu arrow
    jQuery('.main-nav >li:has("ul")>a').each(function() {
        jQuery(this).addClass('below');
    });
    jQuery('ul:not(.main-nav)>li:has("ul")>a').each(function() {
        jQuery(this).addClass('side');
    });
    if (windowWidth > 991) {

        jQuery('#showbutton').off('click');
        jQuery('.im-hiding').css('display', 'block');
        jQuery(nav).off('mouseenter', 'li');
        jQuery(nav).off('mouseleave', 'li');
        jQuery(nav).off('click', 'li');
        jQuery(nav).off('click', 'a');
        jQuery(nav).on('mouseenter', 'li', function() {
            jQuery(this).children('ul').stop().hide();
            jQuery(this).children('ul').slideDown(400);
        });
        jQuery(nav).on('mouseleave', 'li', function() {
            jQuery(this).children('ul').stop().slideUp(350);
        });
    } else {

        jQuery('#showbutton').off('click');
        jQuery('.im-hiding').css('display', 'none');
        jQuery(nav).off('mouseenter', 'li');
        jQuery(nav).off('mouseleave', 'li');
        jQuery(nav).off('click', 'li');
        jQuery(nav).off('click', 'a');
        jQuery(nav).on('click', 'a', function(e) {
            jQuery(this).next('ul').attr('style=""');
            jQuery(this).next('ul').slideToggle();
            if (jQuery(this).next('ul').length !== 0) {
                e.preventDefault();
            }
        });
        // for hide menu
        jQuery('#showbutton').on('click', function() {

            jQuery('.im-hiding').slideToggle();
        });
    }
    

    
    jQuery(window).resize(function() {
        windowWidth = jQuery(window).width();
        jQuery(nav + ' ul').each(function() {
            jQuery(this).attr('style', '" "');
        });
        if (windowWidth > 991) {
            jQuery('#showbutton').off('click');
            jQuery('.im-hiding').css('display', 'block');
            jQuery(nav).off('mouseenter', 'li');
            jQuery(nav).off('mouseleave', 'li');
            jQuery(nav).off('click', 'li');
            jQuery(nav).off('click', 'a');
            jQuery(nav).on('mouseenter', 'li', function() {
                jQuery(this).children('ul').stop().hide();
                jQuery(this).children('ul').slideDown(400);
            });
            jQuery(nav).on('mouseleave', 'li', function() {
                jQuery(this).children('ul').stop().slideUp(350);
            });
        } else {
            jQuery('#showbutton').off('click');
            jQuery('.im-hiding').css('display', 'none');
            jQuery(nav).off('mouseenter', 'li');
            jQuery(nav).off('mouseleave', 'li');
            jQuery(nav).off('click', 'li');
            jQuery(nav).off('click', 'a');
            jQuery(nav).on('click', 'a', function(e) {
                jQuery(this).next('ul').attr('style=""');
                jQuery(this).next('ul').slideToggle();
                if (jQuery(this).next('ul').length !== 0) {
                    e.preventDefault();
                }
            });
            // for hide menu
            jQuery('#showbutton').on('click', function() {

                jQuery('.im-hiding').slideToggle();
            });
        }
    });



    /* owl carousl jQuery */

    jQuery("#owl-demo1").owlCarousel({

        slideSpeed : 500,
        autoPlay:true,
        paginationSpeed : 1000,
        singleItem:true,
        navigation : true,
        navigationText: [
            "<i class='fa fa-chevron-left'></i>",
            "<i class='fa fa-chevron-right'></i>"
        ],
        pagination : false



    });
    jQuery("#owl-demo2").owlCarousel({

        slideSpeed : 300,
        autoPlay:true,
        paginationSpeed : 400,
        singleItem:true,
        navigation : false,
        pagination : true


    });

    jQuery("#owl-demo3").owlCarousel({
        autoPlay: true,
        slideSpeed: 300,
        itemsCustom: [
            [0, 1],
            [450, 1],
            [600, 2],
            [700, 2],
            [991, 3],
            [1200, 5],
            [1400, 5],
            [1600, 5]
        ],
        navigation: false,
        pagination: false
    });


    /*news ticker*/
    jQuery('.ticker').show().ticker();


    /* Hide owl carousl up to full load */
    jQuery(document).ready(function() {
        jQuery('#owl-demo1').show();
    });
    jQuery(document).ready(function() {
        jQuery('#owl-demo').show();
    });

    // inatate wow jQuery
    new WOW().init();

    // scroll jQuery
    jQuery( "#parallex-team" ).click(function() {
        jQuery('html, body').animate({
            scrollTop: jQuery("#ample-business-theme-ourteam").offset().top
        }, 2000);
    });

    // scroll jQuery
    jQuery( "#parallex-counter" ).click(function() {
        jQuery('html, body').animate({
            scrollTop: jQuery("#ample-business-theme-counter").offset().top
        }, 2000);
    });

    /* nav bar fixed */
    jQuery(window).scroll(function () {



        if (jQuery(window).scrollTop() > 30) {
            jQuery('.main-header').addClass('navbar-fixed-top');
        }

        if (jQuery(window).scrollTop() < 31) {
            jQuery('.main-header').removeClass('navbar-fixed-top');
        }
    });

    /* scroll to top */
    jQuery(window).scroll(function () {
        if (jQuery(this).scrollTop() > 400) {
            jQuery('.scrollup').fadeIn();
        } else {
            jQuery('.scrollup').fadeOut();
        }
    });

    jQuery('.scrollup').click(function () {
        jQuery("html, body").animate({
            scrollTop: 0
        }, 1500);
        return false;
    });


});


/*-- Inisate isotop mixup ---*/
(function (jQuery) {


    jQuery(window).load(function(){


        //Portfolio container
        var jQuerycontainer = jQuery('.portfolioContainer');
        jQuerycontainer.isotope({
            filter: '*',
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false
            }
        });

        jQuery('.portfolioFilter a').on('click', function(){
            jQuery('.portfolioFilter a').removeClass('current');
            jQuery(this).addClass('current');

            var selector = jQuery(this).attr('data-filter');
            jQuerycontainer.isotope({
                filter: selector,
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false
                }
            });
            return false;
        });

        jQuery(function () {
            jQuery('.search-btn').live('click', function () {
                jQuery('.header-search .top-search').slideToggle('slow');
            });
        });

        //sticky sidebar
        var at_body = jQuery("body");
        var at_window = jQuery(window);

        if(at_body.hasClass('at-sticky-sidebar')){
            if(at_body.hasClass('right-sidebar')){
                jQuery('#secondary, #primary').theiaStickySidebar();
            }
            else{
                jQuery('#secondary, #primary').theiaStickySidebar();
            }
        }

        

    });
    


}(jQuery)); 

