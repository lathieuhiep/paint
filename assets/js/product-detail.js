/**
 * Product detail
 */
(function ($) {
  "use strict";

  const body = $('body')

  $(document).ready(function () {
    // handle tabs shown
    const idProduct = parseInt( $('.site-single-product').data('product-id') );

    $('.tabs-warp .nav-link').on('shown.bs.tab', function (event) {
      const thisItem = $(this)
      const eventTarget = $(event.target)
      const getIdTab = eventTarget.attr('id')
      const hasSuccessLoading = thisItem.hasClass('success-loading')

      if ( !hasSuccessLoading ) {
        $.ajax({
          url: productDetailAjax.url,
          type: 'POST',
          data: ({
            action: 'paint_get_tab_product_detail',
            idTab: getIdTab,
            idProduct: idProduct
          }),
          beforeSend: function () {
            $('.spinner-warp').removeClass('d-none');
          },
          success: function (result) {
            if ( result ) {
              $(`.${getIdTab}`).append(result)

              // call masonry
              if (getIdTab === 'gallery-tab') {
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

              // add class success
              thisItem.addClass('success-loading')
            }
          },
          complete: function () {
            $('.spinner-warp').addClass('d-none');
          }
        })
      }
    })

    // handle pattern
    $('.item-pattern').on('click', function () {
      const thisPattern = $(this);
      const postId = thisPattern.data('id');
      const stt = thisPattern.data('stt');
      const hasActive = thisPattern.hasClass('active');

      const spinnerBox = $('.spinner-box');
      const listColor = $('.group-color');

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

    // handle click color product
    let timeShowColorProduct

    body.on('click', '.product-color .item', function () {
      window.clearTimeout(timeShowColorProduct)

      const thisItem = $(this)
      const hasClassActive = thisItem.hasClass('active')
      const urlImage = thisItem.find('.item__thumbnail').data('image-feature')
      const productColor = thisItem.closest('.product-color')
      const hasItemClone =  productColor.find('.item-full')
      const listColor = thisItem.closest('.list-color')
      const cloneItem = thisItem.clone().addClass('item-full')

      if ( !hasClassActive ) {
        if (hasItemClone.length) {
          $('.product-color').find('.item-full').slideUp()

          timeShowColorProduct = setTimeout(function () {

            $('.product-color').find('.box-full-color').remove()
            showItemFullColor(listColor, cloneItem, urlImage, thisItem)

          }, 500)
        } else {
          showItemFullColor(listColor, cloneItem, urlImage, thisItem)
        }
      }
    })

    body.on('click', '.close-full-color', function () {
      window.clearTimeout(timeShowColorProduct)

      const boxFullColorItem = $(this).closest('.box-full-color')

      boxFullColorItem.slideUp()

      timeShowColorProduct = setTimeout(function () {

        boxFullColorItem.remove()
        $('.product-color').find('.list-color .item').removeClass('active')

      }, 500)
    })
  })

  function showItemFullColor(element, cloneItem, urlImage, thisItem) {
    thisItem.closest('.product-color').find('.item').removeClass('active')

    // append item full color
    element.append('<div class="box-full-color"></div>')

    const findBoxFullColor = body.find('.list-color .box-full-color')
    findBoxFullColor.append(cloneItem)

    findBoxFullColor.find('.item-full img').attr('src', urlImage)
    findBoxFullColor.find('.item-full').removeClass('item')
    findBoxFullColor.find('.info').append('<button class="close-full-color"><i class="fa-solid fa-xmark"></i></button>')
    findBoxFullColor.slideDown()

    thisItem.addClass('active')
  }
})(jQuery);