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
        const space = document.querySelector(".stack-space");
        const wrapper = document.querySelector(".stack-wrapper");
        const panels = gsap.utils.toArray(".panel-item");

        // 1. Đo chiều cao tấm thẻ cao nhất
        const panelHeights = panels.map(p => p.offsetHeight);
        const maxPanelH = Math.max(...panelHeights);

        // 2. Thiết lập thông số
        const stackGap = 150;    // Khoảng cách xếp chồng giữa các tấm
        const startOffset = 100; // Tấm đầu tiên cách top của wrapper 100px
        const endOffset = 100; // Khoảng cách trống dưới cùng của khối space
        const scrollSpeed = 800; // Quãng đường cuộn cho mỗi tấm (giảm số này nếu muốn cuộn nhanh hơn)

        // Chiều cao hiển thị thực tế của Wrapper (đủ chứa các tấm khi đã xếp chồng)
        const visibleWrapperHeight = maxPanelH + startOffset + endOffset + ((panels.length - 1) * stackGap);

        // Gán chiều cao thực cho wrapper để bọc khít nội dung
        gsap.set(wrapper, { height: visibleWrapperHeight });

        // 3. Tính toán quãng đường cuộn (Scroll distance)
        // Quãng đường này chỉ cần đủ để (n-1) tấm còn lại trượt lên
        const scrollDistance = (panels.length - 1) * scrollSpeed;

        // Chiều cao tổng của Space = Chiều cao Wrapper + Quãng đường cuộn
        const totalSpaceHeight = visibleWrapperHeight + scrollDistance;

        // Gán chiều cao cho Space để tạo thanh cuộn vừa khít
        gsap.set(space, { height: totalSpaceHeight });

        // 4. Tạo hiệu ứng
        const mainTl = gsap.timeline({
            scrollTrigger: {
                trigger: wrapper,
                start: "top top",
                end: () => `+=${scrollDistance}`,
                scrub: 2,
                pin: true,
                pinSpacing: false,
                anticipatePin: 1,
                invalidateOnRefresh: true
            }
        });

        panels.forEach((panel, i) => {
            const finalY = startOffset + (i * stackGap);

            if (i === 0) {
                mainTl.set(panel, {
                    y: startOffset,
                    immediateRender: true
                }, 0);
            } else {
                const travelDistance = 100;

                mainTl.fromTo(panel,
                    { y: finalY + travelDistance,
                        opacity: 0
                    },
                    {
                        y: finalY,
                        opacity: 1,
                        duration: 1,
                        ease: "power2.out"
                    },
                    i * 1.1 // Nhịp độ xuất hiện (stagger)
                );
            }
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
                        start: "top 30%",
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