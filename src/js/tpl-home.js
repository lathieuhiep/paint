(function ($) {
    "use strict";

    gsap.registerPlugin(SplitText, ScrollTrigger);

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
                        991:  { perPage: 4, gap: '6rem' },
                        767:  { perPage: 3, gap: '4rem' },
                        575:  { perPage: 2, gap: '2rem' },
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

    // Stacked Cards — pin section + các card trượt từ dưới lên đè nhau
    const initStack = () => {

        if (!window.matchMedia("(min-width:1200px)").matches) return;

        const stack = document.getElementById('productStack');
        const warp  = document.getElementById('cardWarp');

        if (!stack || !warp) return;

        const cards = gsap.utils.toArray('#cardWarp .card-box');
        const total = cards.length;

        if (!total) return;

        let cardH;

        const updateLayout = () => {
            cardH = cards[0].offsetHeight;
            warp.style.height = cardH + 'px';
        };

        updateLayout();

        ScrollTrigger.getAll().forEach(st => {
            if (st.trigger === stack) st.kill();
        });

        cards.forEach((card, i) => {
            card.style.zIndex = i + 1;
        });

        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: stack,
                start: "top top",
                end: () => "+=" + (total - 1) * window.innerHeight,
                pin: true,
                scrub: true,
                anticipatePin: 1,
                invalidateOnRefresh: true,
                refreshPriority: 1,
                onRefreshInit: updateLayout
            }
        });

        const reveal = 20;

        cards.forEach((card, i) => {

            if (i === 0) return;

            const prev = cards[i - 1];

            tl.fromTo(card,
                { y: () => cardH + (i * 32) },
                { y: i * reveal, ease: "none" }
            )

                .to(prev, {
                    scale: 1,
                    opacity: 1,
                    ease: "none"
                }, "<");

        });

    };

    // Khởi tạo GSAP Services Reveal
    const initServicesReveal = () => {
        const items = gsap.utils.toArray(".element-services__list .item");
        if (items.length === 0) return;

        items.forEach((item) => {
            const icon  = item.querySelector(".item__icon");
            const title = item.querySelector(".item__title");

            if (icon && title) {
                const tl = gsap.timeline({
                    scrollTrigger: {
                        trigger: item,
                        start: "top 40%",
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
                    stagger: 0.1
                });
            }
        });
    };

    // Khởi tạo Swiper Project với hiệu ứng Coverflow
    const elementProject = () => {
        const el = document.querySelector('.element-project__swiper');
        if (!el) return;

        new Swiper(el, {
            effect: "coverflow",
            loop: true,
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 1.2,
            coverflowEffect: {
                rotate: 0,
                stretch: 100,
                depth: 100,
                modifier: 2,
                slideShadows: true,
                scale: 0.95,
            },
        });
    };

    // volunteer slider
    const elementVolunteer = () => {
        const el = document.querySelector('.swiper-volunteer');
        if (!el) return;

        new Swiper(el, {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            loop: true,
            coverflowEffect: {
                rotate: 35,
                stretch: -1,
                depth: 0,
                modifier: 1,
                slideShadows: false,
            },
        });
    }

    //
    const initTyping = () => {
        const el = document.querySelector('.typing');
        if (!el) return;

        const split = SplitText.create(el, {
            type: 'chars',
            charsClass: 'char',
            tag: 'span'
        });

        gsap.set(split.chars, { opacity: 0 });

        gsap.to(split.chars, {
            opacity: 1,
            duration: 0.01,
            stagger: 0.06,
            ease: 'back.out(2)',
            scrollTrigger: {
                trigger: el,       // khi el vào viewport
                start: 'top 80%',  // bắt đầu khi top của el đạt 80% chiều cao màn hình
                once: true,        // chỉ chạy 1 lần
            }
        });
    }

    // Xử lý sự kiện click cho nút submit cf7
    $('.element-contact__form .wpcf7-form .action-box__btn p').on('click', function (e) {
        if ($(e.target).is('.wpcf7-submit')) return;

        const btn = $(this).find('.wpcf7-submit');

        if (btn.length) {
            btn[0].click(); // dùng native click
        }

    });

    // Quản lý luồng thực thi khi trang load
    $(window).on('load', function () {
        elementPartner();
        elementGroupGallery();
        initServicesReveal();
        elementProject();
        elementVolunteer();
        initTyping();

        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                initStack();
                ScrollTrigger.refresh();
            });

        });
    });

})(jQuery);