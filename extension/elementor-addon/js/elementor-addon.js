(function ($) {
    // Hàm kiểm tra nếu phần tử trong khung nhìn
    const isElementInViewport = (element) => {
        const rect = element.getBoundingClientRect(); // Lấy vị trí phần tử
        const windowHeight = window.innerHeight; // Chiều cao cửa sổ

        // Kiểm tra nếu phần tử trong khung nhìn
        return rect.top >= 0 && rect.bottom <= windowHeight;
    }

    // animate
    const animateValue = (element, start, end, duration) => {
        let startTime = null;
        const animation = (currentTime) => {
            if (!startTime) startTime = currentTime;
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);

            element.textContent = Math.floor(start + progress * (end - start));

            if (elapsed < duration) {
                requestAnimationFrame(animation);
            }
        }

        requestAnimationFrame(animation);
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
            navText: ['<i class="icon-angle-left" aria-hidden="true"></i>','<i class="icon-angle-right" aria-hidden="true"></i>'],
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

    // element doctor slider
    const elementDoctorSlider = ($scope, $) => {
        const slider = $scope.find('.element-doctor-slider__warp')

        if ( slider.length ) {
            slider.each(function () {
                const thisSlider = $(this)
                const options = {
                    dots: false,
                    nav: true,
                    autoHeight:true,
                    responsive:{
                        0: {
                            items: 1,
                            stagePadding: 0,
                            margin: 0
                        },
                        768: {
                            items: 2,
                            stagePadding: 12,
                            margin: 12
                        },
                        992: {
                            items: 3,
                            stagePadding: 20,
                            margin: 30
                        }
                    }
                }

                thisSlider.owlCarousel(owlCarouselElementorOptions(options))
            })
        }
    }

    // element package slider
    const elementPackageSlider = ($scope, $) => {
        const slider = $scope.find('.element-package-slider__warp')
        const options = slider.data('owl-options')

        if (slider.length) {
            slider.each(function () {
                const thisSlider = $(this)

                thisSlider.owlCarousel(owlCarouselElementorOptions(options))
            })
        }
    }

    // element circular progress
    const elementCircularProgress = ($scope, $) => {
        const circularProgress = $scope.find('.element-circular-progress')
        
        if ( circularProgress.length ) {
            // Sử dụng Intersection Observer để chạy hiệu ứng khi cuộn đến
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const element = entry.target
                        const targetValue = parseInt(element.getAttribute("data-percent"), 10)
                        const elementToAppendTo = element.querySelector('.item__circle .percent')

                        // 2 giây
                        animateValue(elementToAppendTo, 0, targetValue, 2000)

                        // Dừng quan sát sau khi chạy
                        observer.unobserve(entry.target)
                    }
                })
            }, {
                rootMargin: "100px 0px 0px 0px", // Thêm offset 100px ở trên để kích hoạt sớm hơn
                threshold: 1 // Phần trăm bao nhiêu của phần tử cần xuất hiện để kích hoạt sự kiện
            })

            circularProgress.each(function () {
                const thisCircularProgress = $(this)
                const thisCircularItem = thisCircularProgress.find('.item')

                thisCircularItem.each((index, element) => {
                    if (element instanceof Element) {
                        observer.observe(element);
                    } else {
                        const percent = parseInt(element.getAttribute("data-percent"))
                        const elementToAppendTo = element.querySelector('.item__circle .percent')

                        animateValue(elementToAppendTo, 0, percent, 2000)
                    }
                })
            })
        }
    }

    $(window).on('elementor/frontend/init', function () {
        /* Element slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-slider.default', elementSlider);

        /* Element testimonial slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-testimonial-slider.default', elementTestimonialSlider);

        /* Element doctor slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-doctor-slider.default', elementDoctorSlider);

        /* Element doctor slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-package-slider.default', elementPackageSlider);

        /* Element circular progress */
        elementorFrontend.hooks.addAction('frontend/element_ready/clinic-circular-progress.default', elementCircularProgress);
    });
})(jQuery);