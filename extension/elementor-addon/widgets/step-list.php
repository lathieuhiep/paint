<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Clinic_Elementor_Step_List extends Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @access public
     * @return string Widget name.
     */
    public function get_name(): string
    {
        return 'paint-step-list';
    }

    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @access public
     * @return string Widget title.
     */
    public function get_title(): string
    {
        return esc_html__('Quy trình', 'paint');
    }

    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @access public
     * @return string Widget icon.
     */
    public function get_icon(): string {
        return 'eicon-text';
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
        return ['step', 'list'];
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @access public
     * @return array Widget categories.
     */
    public function get_categories(): array
    {
        return ['my-theme'];
    }

    /**
     * Register oEmbed widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @access protected
     */
    protected function register_controls(): void
    {
        // list content
        $this->start_controls_section(
            'list_section',
            [
                'label' => esc_html__( 'Danh sách', 'paint' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'list_title', [
                'label' => esc_html__( 'Tiêu đề', 'paint' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Tiêu đề' , 'paint' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_content', [
                'label' => esc_html__( 'Nội dung', 'paint' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Nội dung' , 'paint' ),
                'show_label' => false,
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
                        'list_title' => __( 'Tiêu đề #1', 'paint' ),
                    ],
                    [
                        'list_title' => __( 'Tiêu đề #2', 'paint' ),
                    ],
                    [
                        'list_title' => __( 'Tiêu đề #3', 'paint' ),
                    ],
                    [
                        'list_title' => __( 'Tiêu đề #4', 'paint' ),
                    ],
                    [
                        'list_title' => __( 'Tiêu đề #5', 'paint' ),
                    ],
                    [
                        'list_title' => __( 'Tiêu đề #6', 'paint' ),
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );

        $this->end_controls_section();

        // style title
        $this->start_controls_section(
            'style_title_section',
            [
                'label' => esc_html__( 'Tiêu đề', 'paint' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color_odd',
            [
                'label' => esc_html__( 'Màu chữ mục lẻ', 'paint' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-step-list .group-box.odd .item .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_color_even',
            [
                'label' => esc_html__( 'Màu chữ mục chẵn', 'paint' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-step-list .group-box.even .item .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'list_title_typography',
                'selector' => '{{WRAPPER}} .element-step-list .group-box .item .title',
            ]
        );

        $this->end_controls_section();

        // style content
        $this->start_controls_section(
            'style_content_section',
            [
                'label' => esc_html__( 'Nội dung', 'paint' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color_odd',
            [
                'label' => esc_html__( 'Màu chữ mục lẻ', 'paint' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-step-list .group-box.odd .item__box .content' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'content_color_even',
            [
                'label' => esc_html__( 'Màu chữ mục chẵn', 'paint' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-step-list .group-box.even .item__box .content' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .element-step-list .group-box .item__box .content',
            ]
        );

        $this->end_controls_section();

        // style number
        $this->start_controls_section(
            'style_number_section',
            [
                'label' => esc_html__( 'Số', 'paint' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'number_color_odd',
            [
                'label' => esc_html__( 'Màu chữ mục lẻ', 'paint' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-step-list .group-box.odd .item .number' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'number_color_even',
            [
                'label' => esc_html__( 'Màu chữ mục chẵn', 'paint' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-step-list .group-box.even .item .number' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'number_typography',
                'selector' => '{{WRAPPER}} .element-step-list .group-box .item .number',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @access protected
     */
    protected function render(): void
    {
        $settings = $this->get_settings_for_display();
    ?>
        <div class="element-step-list">
            <?php
            if ( !empty( $settings['list'] ) ) :
                $oddData = [];
                $evenData = [];

                for ($i = 0; $i < count( $settings['list'] ); $i++) {
                    $j = $i + 1;

                    if ($i % 2 == 0) {
                        $oddData[$j] = $settings['list'][$i];
                    } else {
                        $evenData[$j] = $settings['list'][$i];
                    }
                }

                $this->itemList($oddData, 'odd');
                $this->itemList($evenData, 'even');
             endif;
             ?>
        </div>
    <?php
    }

    protected function itemList($data, $class): void
    {
        if ( empty( $data ) ):
            return;
        endif;

    ?>
        <div class="group-box <?php echo esc_attr($class); ?>">
            <?php foreach ( $data as $key => $item ) : ?>
                <div class="item repeater-item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                    <div class="item__box">
                        <h4 class="title">
                            <?php echo esc_html( $item['list_title'] ); ?>
                        </h4>

                        <div class="content text-justify">
                            <?php echo wpautop( $item['list_content'] ); ?>
                        </div>

                        <div class="number">
                            <?php echo esc_html( addZeroBeforeNumber($key) ); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php
    }
}