(function ($) {
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
    });
})(jQuery);