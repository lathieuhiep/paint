/**
 * Product detail
 */
(function ($) {
    "use strict";

    const body = $('body')

    $(document).ready(function () {
        // galleries
        const sliderProductGalleries = $('.slider-product-galleries')
        const sliderProductGalleryNav = $('.slider-product-gallery-nav')

        if (sliderProductGalleries.length) {
            sliderProductGalleries.slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                asNavFor: '.slider-product-gallery-nav'
            })

            sliderProductGalleries.magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery:{
                    enabled:true
                }
            })
        }

        if (sliderProductGalleryNav.length) {
            sliderProductGalleryNav.slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                arrows: false,
                asNavFor: '.slider-product-galleries',
                dots: false,
                centerMode: false,
                focusOnSelect: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                        }
                    }
                ]
            })
        }

        // handle tabs shown
        const idProduct = parseInt($('.site-single-product').data('product-id'));

        $('.tabs-warp .nav-link').on('shown.bs.tab', function (event) {
            const thisItem = $(this)
            const eventTarget = $(event.target)
            const getIdTab = eventTarget.attr('id')
            const hasSuccessLoading = thisItem.hasClass('success-loading')

            if (!hasSuccessLoading) {
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
                        if (result) {
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
            const itemThumbnail = thisItem.find('.item__thumbnail')

            const groupColorGrid = thisItem.closest('.group-color__grid')
            const idColorCode = groupColorGrid.data('color-code-id')
            const key = itemThumbnail.data('key')

            const productColor = thisItem.closest('.product-color')
            const hasItemClone = productColor.find('.item-full')
            const listColor = thisItem.closest('.list-color')
            const cloneItem = thisItem.clone().addClass('item-full')

            console.log(idColorCode)
            console.log(key)

            if (!hasClassActive) {
                const spinnerBox = thisItem.find('.spinner-load-color')
                const row = thisItem.closest('.list-color')

                $.ajax({
                    url: productDetailAjax.url,
                    type: 'POST',
                    data: ({
                        action: 'paint_get_color_code_standard',
                        idColorCode: idColorCode,
                        key: key
                    }),
                    beforeSend: function () {
                        spinnerBox.removeClass('d-none')
                        groupColorGrid.find('.box-full-color').remove()
                    },
                    success: function (result) {
                        if ( $(window).width() > 575 ) {
                            row.after(result)
                        }

                        spinnerBox.addClass('d-none');
                    },
                })

                // if (hasItemClone.length) {
                //     $('.product-color').find('.item-full').slideUp()
                //
                //     timeShowColorProduct = setTimeout(function () {
                //
                //         $('.product-color').find('.box-full-color').remove()
                //         showItemFullColor(listColor, cloneItem, urlImage, thisItem)
                //
                //     }, 500)
                // } else {
                //     showItemFullColor(listColor, cloneItem, urlImage, thisItem)
                // }
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

        // related product
        const relatedProductGrid = $('.related-product__grid')
        if ( relatedProductGrid.length ) {
            relatedProductGrid.slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                dots: false,
                centerMode: false,
                focusOnSelect: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            })
        }
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

document.addEventListener('DOMContentLoaded', (event) => {
    const contentElement = document.getElementById('content-product-detail')

    const simpleBarInstance = new SimpleBar(contentElement, {
        autoHide: false,
        forceVisible: "y"
    })

    // active scroll
    contentElement.classList.add('simplebar-active')

    // Resize
    const resizeObserver = new ResizeObserver(() => {
        simpleBarInstance.recalculate()
    });

    resizeObserver.observe(contentElement);
});