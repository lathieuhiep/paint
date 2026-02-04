(function ($) {
    "use strict";

    $(document).ready(function () {
        // elementPartner
        const elementPartner = () => {
            const splidePartner = $('.element-partner__splide');

            if (splidePartner.length) {
                splidePartner.each(function () {
                    // Lấy element DOM thuần từ đối tượng jQuery
                    const el = this;

                    const splide = new Splide(el, {
                        type: 'loop',
                        drag: false,     // Cho phép vuốt nhẹ trên mobile
                        focus: 'center',
                        perPage: 6,          // Mặc định cho Desktop (≥ 1200px - mốc xl)
                        gap: '10rem',     // Khoảng cách mặc định
                        arrows: false,
                        pagination: false,
                        autoWidth : true,
                        autoScroll: {
                            speed: 1,
                            pauseOnHover: false,
                            pauseOnFocus: false,
                        },
                        // Cấu hình Breakpoints (Mobile First ngược - Max-width)
                        breakpoints: {
                            // Dưới 1200px (Lớp lg của Bootstrap)
                            1199: {
                                perPage: 5,
                                gap: '8rem'
                            },
                            // Dưới 992px (Lớp md của Bootstrap)
                            991: {
                                perPage: 4,
                                gap: '6rem'
                            },
                            // Dưới 768px (Lớp sm của Bootstrap)
                            767: {
                                perPage: 3,
                                gap: '4rem'
                            },
                            // Dưới 576px (Lớp xs của Bootstrap)
                            575: {
                                perPage: 2,
                                gap: '2rem'
                            },
                        }
                    });

                    // Mount extension
                    splide.mount(window.splide.Extensions);
                });
            }
        };

        elementPartner();

        // element group gallery
        const elementGroupGallery = () => {
            const splideGroupGallery = $('.element-group-gallery__splide');

            if ( splideGroupGallery.length ) {
                splideGroupGallery.each(function () {
                    // Lấy element DOM thuần từ đối tượng jQuery
                    const el = this;

                    const splide = new Splide(el, {
                        type: 'loop',
                        drag: false,
                        focus: 'center',
                        fixedWidth: '529px',
                        height: '397px',
                        gap: '12px',
                        arrows: false,
                        pagination: false,
                        autoScroll: {
                            speed: 1,
                            pauseOnHover: false,
                            pauseOnFocus: false,
                        },
                    });

                    // Mount extension
                    splide.mount(window.splide.Extensions);
                });
            }
        }

        elementGroupGallery();
    });
})(jQuery);