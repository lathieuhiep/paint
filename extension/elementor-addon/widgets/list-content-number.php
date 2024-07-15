<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Clinic_Elementor_List_Content_Number extends Widget_Base
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
        return 'paint-list-content-number';
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
        return esc_html__('List content number', 'paint');
    }

    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @access public
     * @return string Widget icon.
     */
    public function get_icon(): string
    {
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
        return ['image', 'text', 'list'];
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
                'label' => esc_html__('Danh sách', 'paint'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'list_title',
            [
                'label' => esc_html__('Tiêu đề', 'paint'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Tiêu đề', 'paint'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_content',
            [
                'label' => esc_html__('Nội dung', 'paint'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__('Default description', 'paint'),
            ]
        );

        $repeater->add_control(
            'list_heading_stt_style',
            [
                'label' => esc_html__('Style STT', 'paint'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'list_number_color', [
                'label' => esc_html__( 'Màu chữ', 'paint' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-list-content-number__warp {{CURRENT_ITEM}} .item__top .number' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'list_number_border_color', [
                'label' => esc_html__( 'Màu border', 'paint' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-list-content-number__warp {{CURRENT_ITEM}} .item__top .number' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'list_heading_title_style',
            [
                'label' => esc_html__('Style title', 'paint'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'list_background_title',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .element-list-content-number__warp {{CURRENT_ITEM}} .item__top .title span',
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => esc_html__('List', 'paint'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => __('Tiêu đề #1', 'paint'),
                    ],
                    [
                        'list_title' => __('Tiêu đề #2', 'paint'),
                    ],
                    [
                        'list_title' => __('Tiêu đề #3', 'paint'),
                    ],
                    [
                        'list_title' => __('Tiêu đề #4', 'paint'),
                    ],
                    [
                        'list_title' => __('Tiêu đề #5', 'paint'),
                    ],
                    [
                        'list_title' => __('Tiêu đề #6', 'paint'),
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );

        $this->end_controls_section();

        // number style
        $this->start_controls_section(
            'number_style_section',
            [
                'label' => esc_html__( 'Số thứ tự', 'paint' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'number_color',
            [
                'label'     =>  esc_html__( 'Color', 'paint' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-list-content-number__warp .item__top .number' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'number_typography',
                'label' => esc_html__( 'Typography', 'paint' ),
                'selector' => '{{WRAPPER}} .element-list-content-number__warp .item__top .number',
            ]
        );

        $this->end_controls_section();

        // title style
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => esc_html__( 'Tiêu đề', 'paint' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     =>  esc_html__( 'Color', 'paint' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-list-content-number__warp .item__top .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Typography', 'paint' ),
                'selector' => '{{WRAPPER}} .element-list-content-number__warp .item__top .title',
            ]
        );

        $this->end_controls_section();

        // content style
        $this->start_controls_section(
            'content_style_section',
            [
                'label' => esc_html__( 'Nội dung', 'paint' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     =>  esc_html__( 'Color', 'paint' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-list-content-number__warp .item__content' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => esc_html__( 'Typography', 'paint' ),
                'selector' => '{{WRAPPER}} .element-list-content-number__warp .item__content',
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
        <div class="element-list-content-number">
            <?php if ($settings['list']) : ?>
                <div class="element-list-content-number__warp">
                    <?php foreach ($settings['list'] as $key => $item) : ?>
                        <div class="item repeater-item elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                            <div class="item__top">
                                <span class="number"><?php echo esc_html(addZeroBeforeNumber($key + 1)); ?></span>

                                <h4 class="title">
                                    <span><?php echo esc_html($item['list_title']); ?></span>
                                </h4>
                            </div>

                            <div class="item__content">
                                <?php echo wpautop($item['list_content']) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }
}