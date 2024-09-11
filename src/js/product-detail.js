/**
 * Product detail
 */
(function ($) {
    "use strict";

    const body = $('body')

    $(document).ready(function () {
        const groupColorGrid = $('.group-color__grid')
        const itemsPerLoadProductColor = groupColorGrid.data('items-per')
        let isLoadingProductColorScroll = false
        let currentOffsetProductColor = itemsPerLoadProductColor

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

            const delegateImage = sliderProductGalleries.find('.slick-slide').not('.slick-cloned').find('a')
            sliderProductGalleries.magnificPopup({
                delegate: delegateImage,
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
            let isLoading = false
            const thisPattern = $(this);
            const postId = thisPattern.data('id');
            const stt = thisPattern.data('stt');
            const hasActive = thisPattern.hasClass('active');

            const spinnerBox = $('.spinner-box');
            const listColor = $('.group-color');

            if (!hasActive && !isLoading) {
                isLoading = true
                thisPattern.closest('.pattern__posts').find('.item-pattern').removeClass('active');
                thisPattern.addClass('active');

                const targetProductColor = $('.color-code-load')

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
                    complete: function () {
                        isLoading = false
                        targetProductColor.addClass('more-data')
                        currentOffsetProductColor = itemsPerLoadProductColor
                    }
                })
            }
        })

        // load ajax product color
        $(window).on('scroll', function () {
            const tabColorCodeActive = $('#color-code').hasClass('active')

            if ( tabColorCodeActive ) {
                const targetProductColor = $('.color-code-load')
                const targetProductColorHasData = targetProductColor.hasClass('more-data')

                if ( targetProductColorHasData && targetProductColor.offset().top + 110 < $(window).scrollTop() + $(window).height() && !isLoadingProductColorScroll ) {
                    const colorCodeId = $(document).find('.group-color__grid').attr('data-color-code-id')

                    isLoadingProductColorScroll = true

                    $.ajax({
                        url: productDetailAjax.url,
                        type: 'POST',
                        data: ({
                            action: 'paint_get_product_color_ajax',
                            colorCodeId: colorCodeId,
                            offset: currentOffsetProductColor,
                            itemsPerLoad: itemsPerLoadProductColor
                        }),
                        beforeSend: function () {
                            targetProductColor.find('.box-load').fadeIn()
                        },
                        success: function (response) {
                            try {
                                const jsonResponse = JSON.parse(response);

                                if ( jsonResponse.html ) {
                                    const newItems = $(jsonResponse.html)

                                    // Đếm số lượng phần tử
                                    newItems.each(function(index) {
                                        // Thêm lớp và độ trễ cho từng phần tử
                                        $(this).addClass('slide-up').css({
                                            'animation-delay': (index * 0.2) + 's',
                                            'opacity': 0
                                        }).one('animationend', function() {
                                            $(this).removeClass('slide-up')
                                            $(this).css('opacity', 1)
                                        });
                                    })

                                    $(document).find('.group-color__grid').append(newItems);

                                    currentOffsetProductColor += itemsPerLoadProductColor
                                } else {
                                    targetProductColor.removeClass('more-data')
                                }
                            } catch (e) {
                                console.error('Invalid JSON response:', e);
                            }
                        },
                        complete: function () {
                            isLoadingProductColorScroll = false
                            targetProductColor.find('.box-load').fadeOut()
                        }
                    })
                }
            }
        })

        // handle click color product
        let timeoutId = null
        body.on('click', '.product-color .item', function () {
            let isLoading = false;
            const thisItem = $(this);

            // Xác định giá trị
            const hasClassActive = thisItem.hasClass('active');

            if (!hasClassActive && !isLoading) {
                isLoading = true;

                // Vô hiệu hóa click trên các item khác
                $('.product-color .item').addClass('disable-click');

                // Tính toán vị trí chèn
                const items = thisItem.parent().children().not('.box-full-color');
                const index = items.index(thisItem);
                const itemWidth = thisItem.outerWidth(true);
                const containerWidth = thisItem.parent().width();
                const itemsPerRow = Math.floor(containerWidth / itemWidth);
                const rowIndex = Math.floor(index / itemsPerRow);
                const row = items.slice(rowIndex * itemsPerRow, (rowIndex + 1) * itemsPerRow);

                const groupColorGrid = thisItem.closest('.group-color__grid');
                const idColorCode = groupColorGrid.data('color-code-id');
                const boxFullColor = groupColorGrid.find('.box-full-color');
                const spinnerBox = thisItem.find('.spinner-load-color');

                groupColorGrid.find('.item').removeClass('active');

                $.ajax({
                    url: productDetailAjax.url,
                    type: 'POST',
                    data: {
                        action: 'paint_get_color_code_standard',
                        idColorCode: idColorCode,
                        key: index
                    },
                    beforeSend: function () {
                        thisItem.append('<div class="spinner-load-color">' +
                            '<div class="spinner-border text-warning" role="status">' +
                            '<span class="visually-hidden">Loading...</span>' +
                            '</div>' +
                            '</div>');

                        spinnerBox.removeClass('d-none');

                        if (boxFullColor.length) {
                            boxFullColor.slideUp(500, function () {
                                $(this).remove();
                            });
                        }
                    },
                    success: function (result) {
                        row.last().after(result);
                    },
                    complete: function () {
                        // Bỏ lớp disable-click để kích hoạt lại click
                        $('.product-color .item').removeClass('disable-click');

                        thisItem.addClass('active');
                        thisItem.find('.spinner-load-color').remove();

                        // Hủy bỏ timeout cũ nếu có
                        if (timeoutId) {
                            clearTimeout(timeoutId);
                        }

                        // Đặt timeout để trì hoãn việc hiển thị box-full-color
                        timeoutId = setTimeout(function () {
                            groupColorGrid.find('.box-full-color').slideDown(500, function () {
                                $('html, body').animate({
                                    scrollTop: groupColorGrid.find('.box-full-color').offset().top - $('.site-header').outerHeight() - 50
                                }, 500);
                            });
                        }, 500);

                        isLoading = false;
                        applyZoomEffect();
                    }
                });
            }
        });


        body.on('click', '.close-full-color', function () {
            const boxFullColorItem = $(this).closest('.box-full-color')

            boxFullColorItem.slideUp(500, function() {
                $(this).remove()
                $('.group-color__grid').find('.item').removeClass('active')
            })
        })

        // hover image
        const imageContainers = $('.image-container')

        imageContainers.each(function() {
            const container = $(this);
            const img = container.find('img');
            const overlay = container.find('.zoom-overlay');
            const zoomSrc = overlay.data('zoom-src');

            // Cập nhật URL ảnh gốc cho lớp phủ zoom
            overlay.css('background-image', `url(${zoomSrc})`);

            container.on('mousemove', function(e) {
                const rect = img[0].getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                // Tính toán vị trí và kích thước của ảnh zoom
                const scale = 2;
                const backgroundX = -(x * scale - overlay.width() / 2);
                const backgroundY = -(y * scale - overlay.height() / 2);

                overlay.css('background-position', `${backgroundX}px ${backgroundY}px`);
            });

            container.on('mouseenter', function() {
                img.css('opacity', '0');
                overlay.css('opacity', '1');
            });

            container.on('mouseleave', function() {
                img.css('opacity', '1');
                overlay.css('opacity', '0');
                overlay.css('background-position', 'center');
            });
        });

        // related product
        const relatedProductGrid = $('.related-product__grid')
        if ( relatedProductGrid.length ) {
            relatedProductGrid.slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                dots: false,
                arrows: false,
                centerMode: false,
                focusOnSelect: true,
                prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            arrows: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            arrows: true,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: true,
                        }
                    }
                ]
            })
        }

        // show / hide chose category
        $('.btn-dropdown-menu-tabs').on('click', function() {
            $('#pills-tab').slideToggle()
        })

        // Lấy vị trí của phần tử tab-content
        const tabContentOffset = $('.tab-content').offset().top;

        $(window).on('scroll', function() {
            const scrollPosition = $(window).scrollTop();


            if (scrollPosition >= (tabContentOffset + 250)) {
                $('.btn-tab-canvas').fadeIn();
            } else {
                $('.btn-tab-canvas').fadeOut();
            }
        });

        $('.btn-canvas-nav-tab').on('click', function() {
            const targetId = $(this).data('id')

            $('html, body').animate({
                scrollTop: $('.tabs-warp').offset().top
            }, 500, function() {
                const targetTab = $('#' + targetId);
                targetTab.tab('show');

                // Đóng offcanvas nếu nó đang mở
                const offcanvasElement = document.getElementById('offcanvasTabs');
                const offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasElement);
                
                if (offcanvasInstance) {
                    offcanvasInstance.hide();
                }
            })
        });
    })

    // function hover zoom image
    function applyZoomEffect() {
        $('.image-container').each(function() {
            const container = $(this);
            const img = container.find('img');
            const overlay = container.find('.zoom-overlay');
            const zoomSrc = overlay.data('zoom-src');

            // Cập nhật URL ảnh gốc cho lớp phủ zoom
            overlay.css('background-image', `url(${zoomSrc})`);

            // Loại bỏ các sự kiện cũ trước khi gắn lại sự kiện mới
            container.off('mousemove.zoom mouseenter.zoom mouseleave.zoom');

            container.on('mousemove.zoom', function(e) {
                const rect = img[0].getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                // Tính toán vị trí và kích thước của ảnh zoom
                const scale = 2;
                const backgroundX = -(x * scale - overlay.width() / 2);
                const backgroundY = -(y * scale - overlay.height() / 2);

                overlay.css('background-position', `${backgroundX}px ${backgroundY}px`);
            });

            container.on('mouseenter.zoom', function() {
                img.css('opacity', '0');
                overlay.css('opacity', '1');
            });

            container.on('mouseleave.zoom', function() {
                img.css('opacity', '1');
                overlay.css('opacity', '0');
                overlay.css('background-position', 'center');
            });
        });
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
