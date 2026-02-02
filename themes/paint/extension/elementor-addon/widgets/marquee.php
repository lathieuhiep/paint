<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

defined('ABSPATH') || exit;

class Paint_Elementor_Marquee extends Widget_Base {

    public function get_name(): string {
        return 'es-marquee';
    }

    public function get_title(): string {
        return esc_html__('ES Marquee', 'extend-site');
    }

    public function get_icon(): string {
        return 'eicon-slider-album';
    }

    public function get_categories(): array {
        return ['es-addons'];
    }

    public function get_keywords(): array {
        return ['marquee', 'logo', 'gallery', 'splide'];
    }

    /* =======================
     * REGISTER CONTROLS
     * ======================= */
    protected function register_controls(): void {

        /* ---------- CONTENT ---------- */
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'extend-site'),
            ]
        );

        $this->add_control(
            'mode',
            [
                'label' => esc_html__('Mode', 'extend-site'),
                'type' => Controls_Manager::SELECT,
                'default' => 'logo',
                'options' => [
                    'logo'    => esc_html__('Logo', 'extend-site'),
                    'gallery' => esc_html__('Gallery', 'extend-site'),
                ],
            ]
        );

        $this->add_control(
            'direction',
            [
                'label' => esc_html__('Scroll Direction', 'extend-site'),
                'type' => Controls_Manager::SELECT,
                'default' => 'ltr',
                'options' => [
                    'ltr' => esc_html__('Left → Right', 'extend-site'),
                    'rtl' => esc_html__('Right → Left', 'extend-site'),
                ],
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => esc_html__('Scroll Speed', 'extend-site'),
                'type' => Controls_Manager::NUMBER,
                'default' => 1,
                'min' => 0.1,
                'step' => 0.1,
            ]
        );

        $this->end_controls_section();

        /* ---------- STYLE: ITEM ---------- */
        $this->start_controls_section(
            'section_style_item',
            [
                'label' => esc_html__('Item', 'extend-site'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'item_width',
            [
                'label' => esc_html__('Item Width', 'extend-site'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => ['min' => 40, 'max' => 400],
                ],
                'selectors' => [
                    '{{WRAPPER}} .es-marquee .splide__slide' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_height',
            [
                'label' => esc_html__('Item Height', 'extend-site'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => ['min' => 20, 'max' => 300],
                ],
                'selectors' => [
                    '{{WRAPPER}} .es-marquee img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gap',
            [
                'label' => esc_html__('Gap', 'extend-site'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .es-marquee' => '--es-marquee-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'selector' => '{{WRAPPER}} .es-marquee img',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_shadow',
                'selector' => '{{WRAPPER}} .es-marquee img',
            ]
        );

        $this->end_controls_section();
    }

    /* =======================
     * RENDER
     * ======================= */
    protected function render(): void {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="es-marquee splide es-marquee--<?php echo esc_attr($settings['mode']); ?>"
             data-direction="<?php echo esc_attr($settings['direction']); ?>"
             data-speed="<?php echo esc_attr($settings['speed']); ?>">

            <div class="splide__track">
                <ul class="splide__list">
                    <?php
                    // Demo item – bước sau thay bằng repeater / query
                    for ($i = 1; $i <= 6; $i++) :
                        ?>
                        <li class="splide__slide es-marquee__item">
                            <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/no-image.png' ) ) ?>" alt="">
                        </li>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
        <?php
    }
}