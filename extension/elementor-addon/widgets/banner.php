<?php

use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Paint_Elementor_Banner extends Widget_Base {
    public function get_categories(): array {
        return array( 'my-theme' );
    }

    public function get_name(): string {
        return 'paint-banner';
    }

    public function get_title(): string {
        return esc_html__( 'Banner', 'paint' );
    }

    public function get_icon(): string {
        return 'eicon-image';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the oEmbed widget belongs to.
     *
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords(): array
    {
        return ['banner', 'image' ];
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

        $this->add_control(
            'more_options',
            [
                'label' => esc_html__( 'Sử dụng ảnh ở mục banner trong theme options', 'paint' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void {
        $banner = paint_get_option('opt_general_banner');
    ?>

        <div class="element-banner">
            <?php if ( !empty( $banner ) ) : ?>
                <?php echo wp_get_attachment_image( $banner['id'], 'full' ); ?>
            <?php endif; ?>
        </div>

    <?php
    }
}