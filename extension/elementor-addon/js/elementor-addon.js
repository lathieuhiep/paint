(function ($) {
    // Hàm kiểm tra nếu phần tử trong khung nhìn
    const isElementInViewport = (element) => {
        const rect = element.getBoundingClientRect(); // Lấy vị trí phần tử
        const windowHeight = window.innerHeight; // Chiều cao cửa sổ

        // Kiểm tra nếu phần tử trong khung nhìn
        return rect.top >= 0 && rect.bottom <= windowHeight;
    }

    // setting owlCarousel
    const owlCarouselElementorOptions = (options) => {
        let defaults = {
            loop: true,
            smartSpeed: 800,
            autoplaySpeed: 800,
            navSpeed: 800,
            dotsSpeed: 800,
            dragEndSpeed: 800,
            navText: ['<i class="fa-solid fa-angle-left"></i>','<i class="fa-solid fa-angle-right"></i>'],
        }

        // extend options
        return $.extend(defaults, options)
    }

    // element slider
    const elementSlider = ($scope, $) => {
        const slider = $scope.find('.element-slider__warp')

        if (slider.length) {
            slider.each(function () {
                const thisSlider = $(this)
                const options = slider.data('owl-options')

                thisSlider.owlCarousel(owlCarouselElementorOptions(options))
            })
        }
    }

    // element slider carousel
    const elementSliderCarousel = ($scope, $) => {
        const slider = $scope.find('.element-slider-carousel__warp')

        if (slider.length) {
            slider.each(function () {
                const thisSlider = $(this)
                const options = slider.data('owl-options')

                thisSlider.owlCarousel(owlCarouselElementorOptions(options))
            })
        }
    }

    // element post carousel
    const elementPostCarousel = ($scope, $) => {
        const slider = $scope.find('.element-post-carousel__warp')

        if (slider.length) {
            slider.each(function () {
                const thisSlider = $(this)
                const options = slider.data('owl-options')

                thisSlider.owlCarousel(owlCarouselElementorOptions(options))
            })
        }
    }

    // element testimonial slider
    const elementTestimonialSlider = ($scope, $) => {
        const slider = $scope.find('.element-testimonial-slider__warp')

        if (slider.length) {
            slider.each(function () {
                const thisSlider = $(this)
                const options = slider.data('owl-options')

                thisSlider.owlCarousel(owlCarouselElementorOptions(options))
            })
        }
    }

    // element about slider
    const elementAboutSlider = ($scope, $) => {
        const slider = $scope.find('.element-about-slider__warp')

        if (slider.length) {
            slider.each(function () {
                const thisSlider = $(this)
                const options = slider.data('owl-options')

                thisSlider.owlCarousel(owlCarouselElementorOptions(options))
            })
        }
    }

    // element tool carousel
    const elementToolSlider = ($scope, $) => {
        const slider = $scope.find('.element-tool-carousel__warp')

        if (slider.length) {
            slider.each(function () {
                const thisSlider = $(this)
                const options = slider.data('owl-options')

                thisSlider.owlCarousel(owlCarouselElementorOptions(options))
            })
        }
    }

    // element project carousel
    const elementProjectSlider = ($scope, $) => {
        const slider = $scope.find('.element-project-carousel__warp')

        if (slider.length) {
            slider.each(function () {
                const thisSlider = $(this)
                const options = slider.data('owl-options')

                thisSlider.owlCarousel(owlCarouselElementorOptions(options))
            })
        }
    }

    // element procedure carousel
    const elementProcedureCarousel = ($scope, $) => {
        const syncedSecondary = true
        const sliderMain = $scope.find('.procedure-slider-main')
        const sliderNumber = $scope.find('.procedure-slider-number')

        if (sliderMain.length) {
            // slider main
            const sliderMainOptions = {
                items: 1,
                autoHeight: true
            }

            sliderMain.each(function () {
                const thisSlider = $(this)
                const parent = thisSlider.closest('.element-procedure-carousel')
                const sync2 = parent.find('.procedure-slider-number')

                thisSlider.owlCarousel(owlCarouselElementorOptions(sliderMainOptions)).on('changed.owl.carousel', function (el) {
                    //if you set loop to false, you have to restore this next line
                    //var current = el.item.index;

                    //if you disable loop you have to comment this block
                    const count = el.item.count - 1;
                    let current = Math.round(el.item.index - (el.item.count / 2) - .5);

                    if (current < 0) {
                        current = count;
                    }
                    if (current > count) {
                        current = 0;
                    }

                    //end block

                    sync2.find(".owl-item").removeClass("current").eq(current).addClass("current")
                    const onscreen = sync2.find('.owl-item.active').length - 1;
                    const start = sync2.find('.owl-item.active').first().index();
                    const end = sync2.find('.owl-item.active').last().index();

                    if (current > end) {
                        sync2.data('owl.carousel').to(current, 100, true);
                    }
                    if (current < start) {
                        sync2.data('owl.carousel').to(current - onscreen, 100, true);
                    }
                })
            })

            // slider number
            const sliderNumberOptions = {
                items: 2,
                autoHeight: true
            }

            sliderNumber.each(function () {
                const thisSlider = $(this)
                const parent = thisSlider.closest('.element-procedure-carousel')
                const sync1 = parent.find('.procedure-slider-main')

                thisSlider.on('initialized.owl.carousel', function() {
                    thisSlider.find(".owl-item").eq(0).addClass("current")
                }).owlCarousel( owlCarouselElementorOptions(sliderNumberOptions) ).on('changed.owl.carousel', function (el) {
                    if (syncedSecondary) {
                        const number = el.item.index;
                        sync1.data('owl.carousel').to(number, 800, true)
                    }
                })
            })
        }
    }

    // element count up
    const elementCountUp = ($scope, $) => {
        let start = 0
        const numberBox = $scope.find('.element-count-up .number-box')

        if ( numberBox.length ) {
            $(window).on('scroll', function() {
                numberBox.each(function () {
                    const thisNumberBox = $(this)

                    if ( isElementInViewport( thisNumberBox[0] ) ) {
                        const countBox = thisNumberBox.find('.count-box')
                        const countTo = countBox.data('number')

                        $({countNum: countBox.text()}).animate(
                            {
                                countNum: countTo
                            },
                            {
                                duration: 850,
                                easing: "swing",
                                step: function () {
                                    countBox.text(
                                        Math.ceil(this.countNum)
                                    );
                                },
                                complete: function () {
                                    countBox.text(
                                        Math.ceil(this.countNum)
                                    );
                                }
                            }
                        )
                    }
                })
            })
        }
    }

    $(window).on('elementor/frontend/init', function () {
        /* Element slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/paint-slider.default', elementSlider);

        // element slider carousel
        elementorFrontend.hooks.addAction('frontend/element_ready/paint-slider-carousel.default', elementSliderCarousel);

        // element post carousel
        elementorFrontend.hooks.addAction('frontend/element_ready/paint-post-carousel.default', elementPostCarousel);

        /* Element testimonial slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/paint-testimonial-slider.default', elementTestimonialSlider);

        // element about slider
        elementorFrontend.hooks.addAction('frontend/element_ready/paint-about-slider.default', elementAboutSlider);

        // element tool carousel
        elementorFrontend.hooks.addAction('frontend/element_ready/paint-tool-carousel.default', elementToolSlider);

        // element project carousel
        elementorFrontend.hooks.addAction('frontend/element_ready/paint-project-carousel.default', elementProjectSlider);

        // element procedure carousel
        elementorFrontend.hooks.addAction('frontend/element_ready/paint-procedure-carousel.default', elementProcedureCarousel);

        // element count up
        elementorFrontend.hooks.addAction('frontend/element_ready/paint-count-up.default', elementCountUp);
    });
})(jQuery);