(function ($) {

  /* Start Carousel slider */
  let ElementCarouselSlider = function ($scope, $) {

    let element_slides = $scope.find('.custom-owl-carousel');

    $(document).general_owlCarousel_custom(element_slides);

  };

  $(window).on('elementor/frontend/init', function () {

    /* Element slider */
    elementorFrontend.hooks.addAction('frontend/element_ready/paint-slides.default', ElementCarouselSlider);

    /* Element post carousel */
    elementorFrontend.hooks.addAction('frontend/element_ready/paint-post-carousel.default', ElementCarouselSlider);

    /* Element testimonial slider */
    elementorFrontend.hooks.addAction('frontend/element_ready/paint-testimonial-slider.default', ElementCarouselSlider);

    /* Element carousel images */
    elementorFrontend.hooks.addAction('frontend/element_ready/paint-carousel-images.default', ElementCarouselSlider);

  });

})(jQuery);