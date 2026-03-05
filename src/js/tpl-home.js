(function ($) {
    "use strict";

    // Đăng ký plugin (đặt ở đây để chắc chắn plugin đã sẵn sàng)
    gsap.registerPlugin(ScrollTrigger);

    // Khởi tạo Splide Partners
    const elementPartner = () => {
        const splidePartner = $('.element-partner__splide');
        if (splidePartner.length) {
            splidePartner.each(function () {
                const splide = new Splide(this, {
                    type: 'loop',
                    drag: false,
                    focus: 'center',
                    perPage: 6,
                    gap: '10rem',
                    arrows: false,
                    pagination: false,
                    autoWidth: true,
                    autoScroll: { speed: 1, pauseOnHover: false, pauseOnFocus: false },
                    breakpoints: {
                        1199: { perPage: 5, gap: '8rem' },
                        991: { perPage: 4, gap: '6rem' },
                        767: { perPage: 3, gap: '4rem' },
                        575: { perPage: 2, gap: '2rem' },
                    }
                });
                splide.mount(window.splide.Extensions);
            });
        }
    };

    // Khởi tạo Gallery
    const elementGroupGallery = () => {
        const splideGroupGallery = $('.element-group-gallery__splide');
        if (splideGroupGallery.length) {
            splideGroupGallery.each(function () {
                const direction = $(this).data('direction');
                const splide = new Splide(this, {
                    type: 'loop',
                    drag: false,
                    focus: 'center',
                    fixedWidth: '529px',
                    height: '397px',
                    gap: '12px',
                    arrows: false,
                    pagination: false,
                    direction: direction,
                    autoScroll: { speed: 1, pauseOnHover: false, pauseOnFocus: false },
                });
                splide.mount(window.splide.Extensions);
            });
        }
    };

    // Hiệu ứng mới cho Stacked Panels
    const initStack = () => {
        gsap.utils.toArray('.element-product__stack .card-warp .card-box').forEach((el, i) => {
            gsap.to(el, {
                opacity: 1,
                y: 0,
                duration: 0.65,
                ease: 'power2.out',
                delay: i * 0.2,
                scrollTrigger: {
                    trigger: el,
                    start: 'top 40%',
                    toggleActions: 'play none none reverse',
                }
            });
        });
    }

    // Khởi tạo GSAP Services Reveal
    const initServicesReveal = () => {
        const items = gsap.utils.toArray(".element-services__list .item");
        if (items.length === 0) return;

        items.forEach((item) => {
            const icon = item.querySelector(".item__icon");
            const title = item.querySelector(".item__title");

            if (icon && title) {
                const tl = gsap.timeline({
                    scrollTrigger: {
                        trigger: item,
                        start: "top 60%",
                        end: "bottom 100px",
                        toggleActions: "play none none reverse",
                        invalidateOnRefresh: true,
                    }
                });

                tl.to([icon, title], {
                    clipPath: "inset(0% 0 0 0)",
                    opacity: 1,
                    duration: 1,
                    ease: "power2.out",
                    stagger: 0.1 // Icon chạy xong 0.1s sau Title chạy luôn, code cực gọn
                });
            }
        });
    };

    // Quản lý luồng thực thi khi trang load
    $(window).on('load', function () {
        // Chạy Splide trước
        elementPartner();
        elementGroupGallery();

        // Chạy GSAP sau cùng
        initStack();
        initServicesReveal();

        // Đồng bộ hóa lại toàn bộ tọa độ sau khi các Slider đã ổn định
        setTimeout(() => {
            ScrollTrigger.sort();
            ScrollTrigger.refresh();
        }, 500);
    });

})(jQuery);