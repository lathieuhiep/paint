/**
 * Custom js v1.0.0
 * Copyright 2017-2020
 * Licensed under  ()
 */

( function( $ ) {
    "use strict";

    $( document ).ready( function () {

        /* Start back top */
        $('#back-top').on( 'click', function (e) {
            e.preventDefault();
            $('html').scrollTop(0);
        } );
        /* End back top */

        /* btn mobile Start*/
        let subMenuToggle  =   $('.sub-menu-toggle');

        if ( subMenuToggle.length ) {

            subMenuToggle.each(function () {
                $(this).on( 'click', function () {
                    const widthScreen = $(window).width();

                    if ( widthScreen < 992 ) {
                        $(this).toggleClass('active');
                        $(this).closest( '.menu-item-has-children' ).siblings().find( subMenuToggle ).removeClass( 'active' );
                        $(this).parent().children( '.sub-menu' ).slideToggle();
                        $(this).parents( '.menu-item-has-children' ).siblings().find( '.sub-menu' ).slideUp();
                    }

                } )
            })

        }
        /* btn mobile End */

        /* Start Gallery Single */
        $( document ).general_owlCarousel_custom( '.site-post-slides' );
        /* End Gallery Single */

        /* Start custom owl carousel */
        generalSlickCarousel('.custom-slick-carousel');
        /* End Gallery Single */

    });

    // loading
    $( window ).on( "load", function() {
        setTimeout(function() {
            $( '#site-loadding' ).remove();
        }, 300);
    });

    // scroll event
    let timer_clear;
    let start = 0;
    const elementCountUp = $('.element-count-up');

    $( window ).scroll( function() {
        // handle show back to top
        if ( timer_clear ) clearTimeout(timer_clear);
        timer_clear = setTimeout( function() {

            /* Start scroll back top */
            let $scrollTop = $(this).scrollTop();

            if ( $scrollTop > 200 ) {
                $('#back-top').addClass('active_top');
            }else {
                $('#back-top').removeClass('active_top');
            }
            /* End scroll back top */

        }, 100 );

        // handle count up
        if ( elementCountUp.length ) {
            const oTop = $('.element-count-up .content-warp').offset().top - window.innerHeight;

            if (start === 0 && $(window).scrollTop() > oTop) {
                $('.number-counter').each(function () {
                    const $this = $(this);
                    const countTo = $this.attr("data-number");

                    $({ countNum: $this.text() }).animate(
                        {
                            countNum: countTo
                        },
                        {
                            duration: 850,
                            easing: "swing",
                            step: function () {
                                $this.text(
                                    Math.ceil(this.countNum)
                                );
                            },
                            complete: function () {
                                $this.text(
                                    Math.ceil(this.countNum)
                                );
                            }
                        }
                    );
                });

                start = 1;
            }
        }
    });

    // function slick carousel
    const generalSlickCarousel = (classSelector) => {
        const sliderCarousel = $(classSelector);

        if ( sliderCarousel.length ) {
            sliderCarousel.each(function () {
                const slider = $(this);

                if ( !slider.hasClass('slick-carousel-init') ) {
                    const defaults = {
                        lazyLoad: 'ondemand',
                        speed: 800,
                        autoplaySpeed: 2000,
                        prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
                        nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>'
                    };

                    const config = $.extend( defaults, slider.data( 'config-slick') );

                    slider.slick( config ).addClass( 'slick-carousel-init' );
                }
            })
        }
    }

    // function call owlCarousel
    $.fn.general_owlCarousel_custom = function ( class_item ) {

        let class_item_owlCarousel   =   $( class_item );

        if ( class_item_owlCarousel.length ) {

            class_item_owlCarousel.each( function () {

                let slider = $(this);

                if ( !slider.hasClass('owl-carousel-init') ) {

                    let defaults = {
                        autoplaySpeed: 800,
                        navSpeed: 800,
                        dotsSpeed: 800,
                        autoHeight: false,
                        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
                    };

                    let config = $.extend( defaults, slider.data( 'settings-owl') );

                    slider.owlCarousel( config ).addClass( 'owl-carousel-init' );

                }

            } )

        }

    }

} )( jQuery );