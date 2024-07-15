<?php

use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Clinic_Elementor_Testimonial_Slider extends Widget_Base {
    public function get_categories(): array {
        return array( 'my-theme' );
    }

    public function get_name(): string {
        return 'paint-testimonial-slider';
    }

    public function get_title(): string {
        return esc_html__( 'Testimonial Slider', 'paint' );
    }

    public function get_icon(): string {
        return 'eicon-user-circle-o';
    }

    protected function register_controls(): void {

        // Content testimonial
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'paint' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'list_image',
            [
                'label' => esc_html__( 'Choose Image', 'paint' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'list_title', [
                'label' => esc_html__( 'Tên', 'paint' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Anh L.T.D' , 'paint' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_info', [
                'label' => esc_html__( 'Thông tin', 'paint' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( '36 tuổi - Thanh Khê, Đà Nẵng' , 'paint' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_description',
            [
                'label' => esc_html__( 'Description', 'paint' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__( 'GEMs are robotics algorithm for modules that built & optimized for NVIDIA AGX Data should underlie every business decision. Data should underlie every business Yet too often some very down the certain routes.', 'paint' ),
                'placeholder' => esc_html__( 'Type your description here', 'paint' ),
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => esc_html__( 'List', 'paint' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => esc_html__( 'Title #1', 'paint' ),
                    ],
                    [
                        'list_title' => esc_html__( 'Title #2', 'paint' ),
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );

        $this->end_controls_section();

        // style name
        $this->start_controls_section(
            'name_style',
            [
                'label' => esc_html__( 'Tên', 'paint' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label'     =>  esc_html__( 'Color', 'paint' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-testimonial-slider .item .name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'label' => esc_html__( 'Typography', 'paint' ),
                'selector' => '{{WRAPPER}} .element-testimonial-slider .item .name',
            ]
        );

        $this->end_controls_section();

        // style info
        $this->start_controls_section(
            'info_style',
            [
                'label' => esc_html__( 'Thông tin', 'paint' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'info_color',
            [
                'label'     =>  esc_html__( 'Color', 'paint' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-testimonial-slider .item .info' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_typography',
                'label' => esc_html__( 'Typography', 'paint' ),
                'selector' => '{{WRAPPER}} .element-testimonial-slider .item .info',
            ]
        );

        $this->end_controls_section();

        // style description
        $this->start_controls_section(
            'style_description',
            [
                'label' => esc_html__( 'Description', 'paint' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     =>  esc_html__( 'Color', 'paint' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-testimonial-slider .item .desc' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'label' => esc_html__( 'Typography', 'paint' ),
                'selector' => '{{WRAPPER}} .element-testimonial-slider .item .desc',
            ]
        );

        $this->end_controls_section();

    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();

        $owl_options = [
            'dots' => true,

            'responsive' => [
                '0' => [
                    'items' => 1,
                    'margin' => 12,
                ],
                '576' => [
                    'items' => 2,
                    'margin' => 22,
                ],
                '992' => [
                    'items' => 3,
                    'margin' => 22,
                ]
            ]
        ];
        ?>

        <div class="element-testimonial-slider">
            <div class="element-testimonial-slider__warp owl-carousel owl-theme custom-equal-height-owl" data-owl-options='<?php echo wp_json_encode( $owl_options ); ?>'>
                <?php
                foreach ( $settings['list'] as $item ) :
                    $imageId = $item['list_image']['id'];
                    ?>

                    <div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                        <div class="top-box">
                            <div class="thumbnail">
                                <?php
                                if ( $imageId ) :
                                    echo wp_get_attachment_image( $item['list_image']['id'], 'full' );
                                else:
                                    ?>
                                    <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/user-avatar.png' ) ) ?>" alt="<?php echo esc_attr( $item['list_title'] ); ?>" />
                                <?php endif; ?>
                            </div>

                            <div class="profile">
                                <h4 class="name">
                                    <?php echo esc_html( $item['list_title'] ); ?>
                                </h4>

                                <p class="info">
                                    <?php echo wp_kses_post( $item['list_info'] ) ?>
                                </p>
                            </div>
                        </div>

                        <div class="desc text-justify">
                            <?php echo wp_kses_post( $item['list_description'] ) ?>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>

        <?php
    }
}