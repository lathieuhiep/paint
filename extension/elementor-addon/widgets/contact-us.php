<?php

use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Clinic_Elementor_Contact_Us extends Widget_Base
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
        return 'paint-contact-us';
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
        return esc_html__('Contact Us', 'paint');
    }

    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @access public
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-mail';
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
        return ['contact'];
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
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'paint'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'list_title', [
                'label' => esc_html__('Tiêu đề', 'paint'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Tiêu đề', 'paint'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_image',
            [
                'label' => esc_html__('Chọn ảnh', 'paint'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'list_content', [
                'label' => esc_html__('Nội dung', 'paint'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__('List Content', 'paint'),
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'font_size_content', [
                'label' => esc_html__('Font Size Content (px)', 'paint'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'step' => 1,
                'default' => 16,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .item__content' => 'font-size: {{VALUE}}px'
                ],
            ]
        );

        $this->add_control(
            'contact_list',
            [
                'label' => esc_html__('Contact List', 'paint'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => esc_html__('Title #1', 'paint'),
                        'list_content' => esc_html__('Item content. Click the edit button to change this text.', 'paint'),
                    ],
                    [
                        'list_title' => esc_html__('Title #2', 'paint'),
                        'list_content' => esc_html__('Item content. Click the edit button to change this text.', 'paint'),
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
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
        <div class="element-contact-us">
            <?php if ($settings['contact_list']) : ?>

                <div class="element-contact-us__list">
                    <?php foreach ($settings['contact_list'] as $item): ?>
                        <div class="item elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                            <div class="item__image">
                                <?php echo wp_get_attachment_image($item['list_image']['id'], 'medium'); ?>
                            </div>

                            <div class="item__body">
                                <h3 class="title">
                                    <?php echo esc_html( $item['list_title'] ); ?>
                                </h3>

                                <div class="desc">
                                    <?php echo wpautop( $item['list_content'] ); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php endif; ?>
        </div>
    <?php
    }
}