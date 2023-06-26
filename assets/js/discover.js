/**
 * Product detail
 */
(function ($) {
    "use strict";

    $( document ).ready( function () {
        // Masonry
        const discoverGallery = $('.grid-discover');

        if ( discoverGallery.length ) {
            // int masonry
            const $grid = discoverGallery.masonry({
                percentPosition: true,
                horizontalOrder: true,
                columnWidth: '.grid-discover__item',
                itemSelector: '.grid-discover__item'
            });

            // layout Masonry after each image loads
            $grid.imagesLoaded().progress( function() {
                $grid.masonry('layout');
            });
        }

        // handle history back
        $('.history-back-discover').on('click', function (event) {
            event.preventDefault();
            history.back(1);
        })
    });

    // create paged discover
    let paged = 2;
    $(window).scroll(function(){
        if ( $(window).scrollTop() + $(window).height()  >= $(document).height() ) {
            const contentWarpGrid = $('.content-warp');
            const hasScrollLoading = contentWarpGrid.hasClass('scroll-loading');

            if ( !hasScrollLoading ) {
                contentWarpGrid.addClass('scroll-loading');

                scrollLoadDiscover(contentWarpGrid);
            }

        }
    });

    // function ajax pagination discover
    const scrollLoadDiscover = (contentWarpGrid) => {
        const formSearchDiscover = $('.search-form-discover');
        const keyWord = formSearchDiscover.find('.search-field').val();
        const limit = formSearchDiscover.data('limit');
        const cat = formSearchDiscover.find('.btn-check:checked').val();

        $.ajax({
            url: discoverAjax.url,
            type: 'POST',
            data: ({
                action: 'paint_pagination_discover',
                keyWord: keyWord,
                limit: limit,
                cat: cat,
                paged: paged
            }),
            beforeSend: function () {
                $('.spinner-warp').removeClass('d-none');
            },
            success: function (result) {
                if ( result ) {
                    const content = $(result);

                    $('.grid-discover').append(content).masonry( 'appended', content, true );
                    $('.content-warp').removeClass('scroll-loading');

                    paged++;
                }
            },
            complete: function () {
                $('.spinner-warp').addClass('d-none');
            }
        })
    }

})( jQuery );