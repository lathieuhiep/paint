/**
 * Product detail
 */
(function ($) {
  "use strict";

  $(document).ready(function () {
    // handle tabs shown
    $('.tabs-warp .nav-link').on('shown.bs.tab', function (event) {
      const eventTarget = $(event.target);
      const hasIdGallery = eventTarget.attr('id');

      if (hasIdGallery === 'gallery-tab') {
        const hasCallMasonry = eventTarget.hasClass('success-masonry');

        if (!hasCallMasonry) {
          // Masonry
          const productGallery = $('.product-gallery-grid');

          if (productGallery.length) {
            // int masonry
            const $grid = productGallery.masonry({
              percentPosition: true,
              horizontalOrder: true,
              columnWidth: '.grid-sizer-normal',
              itemSelector: '.item'
            });

            // layout Masonry after each image loads
            $grid.imagesLoaded().progress(function () {
              $grid.masonry('layout');
            });
          }

          eventTarget.addClass('success-masonry');
        }
      }
    })

    // handle pattern
    $('.item-pattern').on('click', function () {
      const thisPattern = $(this);
      const postId = thisPattern.data('id');
      const stt = thisPattern.data('stt');
      const hasActive = thisPattern.hasClass('active');

      const spinnerBox = $('.spinner-box');
      const listColor = $('.list-color');

      if (!hasActive) {
        thisPattern.closest('.pattern__posts').find('.item-pattern').removeClass('active');
        thisPattern.addClass('active');

        $.ajax({
          url: productDetailAjax.url,
          type: 'POST',
          data: ({
            action: 'paint_get_color_code',
            postId: postId
          }),
          beforeSend: function () {
            listColor.empty();
            spinnerBox.removeClass('d-none');
          },
          success: function (result) {
            thisPattern.closest('.pattern').find('.pattern__style .stt').text(stt);
            listColor.append(result);
            spinnerBox.addClass('d-none');
          },
        })
      }

    })
  });

})(jQuery);