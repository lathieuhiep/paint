<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Clinic_Elementor_Gallery_Grid_Box extends Widget_Base
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
		return 'paint-gallery-grid-box';
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
		return esc_html__('Gallery Grid Box', 'paint');
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
		return 'eicon-gallery-grid';
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
		return ['image', 'grid', 'gallery', 'box' ];
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
		// layout section
		$this->start_controls_section(
			'layout_section',
			[
				'label' => esc_html__( 'Layout', 'paint' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'column',
			[
				'label' => esc_html__( 'Cột', 'paint' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'step' => 1,
				'default' => 3,
				'selectors' => [
					'{{WRAPPER}} .element-gallery-grid-box__warp' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
				],
			]
		);

		$this->add_responsive_control(
			'grid-column-gap',
			[
				'label' => esc_html__( 'Grid column gap', 'paint' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors' => [
					'{{WRAPPER}} .element-gallery-grid-box__warp' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'grid-row-gap',
			[
				'label' => esc_html__( 'Grid row gap', 'paint' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors' => [
					'{{WRAPPER}} .element-gallery-grid-box__warp' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

        // content section
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Nội dung', 'paint' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'list_title', [
				'label' => esc_html__( 'Tiêu đề', 'paint' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title' , 'paint' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_image', [
				'label' => esc_html__( 'Image', 'paint' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
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

        $repeater->add_control(
            'list_content_background_color', [
                'label' => esc_html__( 'Màu nền', 'paint' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-gallery-grid-box__warp {{CURRENT_ITEM}} .item__body' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'list_title_color', [
                'label' => esc_html__( 'Màu tiêu đề', 'paint' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-gallery-grid-box__warp {{CURRENT_ITEM}} .item__body .title ' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'list_content_color', [
                'label' => esc_html__( 'Màu nội dung', 'paint' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-gallery-grid-box__warp {{CURRENT_ITEM}} .item__body .content ' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Danh sách', 'paint' ),
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

		// list style
		$this->start_controls_section(
			'list_style_section',
			[
				'label' => esc_html__( 'Danh sách', 'paint' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'list_padding',
			[
				'label' => esc_html__( 'Padding', 'paint' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => '',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .element-gallery-grid-box__warp .item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'list_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .element-gallery-grid-box__warp .item',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'list_border',
				'selector' => '{{WRAPPER}} .element-gallery-grid-box__warp .item',
			]
		);

		$this->add_control(
			'list_border_radius',
			[
				'label' => esc_html__( 'Border radius', 'paint' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => '',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .element-gallery-grid-box__warp .item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'list_box_shadow',
                'selector' => '{{WRAPPER}} .element-gallery-grid-box__warp .item',
            ]
        );

		$this->end_controls_section();

		// image style
		$this->start_controls_section(
			'image_style_section',
			[
				'label' => esc_html__( 'Ảnh', 'paint' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
            'image_margin',
            [
                'label' => esc_html__( 'Margin', 'paint' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-gallery-grid-box__warp .item__thumbnail' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_padding',
            [
                'label' => esc_html__( 'Padding', 'paint' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-gallery-grid-box__warp .item__thumbnail img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_control(
			'image_align',
			[
				'label'     =>  esc_html__( 'Alignment', 'paint' ),
				'type'      =>  Controls_Manager::CHOOSE,
				'options'   =>  [
					'text-start'  =>  [
						'title' =>  esc_html__( 'Left', 'paint' ),
						'icon'  =>  'eicon-text-align-left',
					],

					'text-center' => [
						'title' =>  esc_html__( 'Center', 'paint' ),
						'icon'  =>  'eicon-text-align-center',
					],

					'text-end' => [
						'title' =>  esc_html__( 'Right', 'paint' ),
						'icon'  =>  'eicon-text-align-right',
					],
				],
				'default' => 'text-center',
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label' => esc_html__( 'Chiều rộng ảnh', 'paint' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .element-gallery-grid-box__warp .item__thumbnail img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label' => esc_html__( 'Chiều cao ảnh', 'paint' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .element-gallery-grid-box__warp .item__thumbnail img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .element-gallery-grid-box__warp .item__thumbnail img',
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => esc_html__( 'Border radius', 'paint' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-gallery-grid-box__warp .item__thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();

        // body content style
        $this->start_controls_section(
            'body_style_section',
            [
                'label' => esc_html__( 'Hộp chứa nội dung', 'paint' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'body_min_height',
            [
                'label' => esc_html__( 'Chiều cao tối thiểu', 'paint' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-gallery-grid-box__warp .item__body' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'body_margin',
            [
                'label' => esc_html__( 'Margin', 'paint' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-gallery-grid-box__warp .item__body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'body_padding',
            [
                'label' => esc_html__( 'Padding', 'paint' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-gallery-grid-box__warp .item__body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'body_background_color',
            [
                'label'     =>  esc_html__( 'Background Color', 'paint' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-gallery-grid-box__warp .item__body' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'body_border',
                'selector' => '{{WRAPPER}} .element-gallery-grid-box__warp .item__body',
            ]
        );

        $this->add_control(
            'body_border_radius',
            [
                'label' => esc_html__( 'Border radius', 'paint' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-gallery-grid-box__warp .item__body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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

        $this->add_responsive_control(
            'title_min_height',
            [
                'label' => esc_html__( 'Chiều cao title', 'paint' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-gallery-grid-box__warp .item__body .title' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__( 'Margin', 'paint' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-gallery-grid-box__warp .item__body .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Padding', 'paint' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => '',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .element-gallery-grid-box__warp .item__body .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_align',
			[
				'label'     =>  esc_html__( 'Alignment', 'paint' ),
				'type'      =>  Controls_Manager::CHOOSE,
				'options'   =>  [
					'text-start'  =>  [
						'title' =>  esc_html__( 'Left', 'paint' ),
						'icon'  =>  'eicon-text-align-left',
					],

					'text-center' => [
						'title' =>  esc_html__( 'Center', 'paint' ),
						'icon'  =>  'eicon-text-align-center',
					],

					'text-end' => [
						'title' =>  esc_html__( 'Right', 'paint' ),
						'icon'  =>  'eicon-text-align-right',
					],

					'text-justify' => [
						'title' =>  esc_html__( 'Justify', 'paint' ),
						'icon'  =>  'eicon-text-align-justify',
					],
				],
				'default' => 'text-center',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     =>  esc_html__( 'Màu chữ', 'paint' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-gallery-grid-box__warp .item__body .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'paint' ),
				'selector' => '{{WRAPPER}} .element-gallery-grid-box__warp .item__body .title',
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'title_border',
                'selector' => '{{WRAPPER}} .element-gallery-grid-box__warp .item__body .title',
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

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'paint' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => '',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .element-gallery-grid-box__warp .item__body .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_align',
			[
				'label'     =>  esc_html__( 'Alignment', 'paint' ),
				'type'      =>  Controls_Manager::CHOOSE,
				'options'   =>  [
					'text-start'  =>  [
						'title' =>  esc_html__( 'Left', 'paint' ),
						'icon'  =>  'eicon-text-align-left',
					],

					'text-center' => [
						'title' =>  esc_html__( 'Center', 'paint' ),
						'icon'  =>  'eicon-text-align-center',
					],

					'text-end' => [
						'title' =>  esc_html__( 'Right', 'paint' ),
						'icon'  =>  'eicon-text-align-right',
					],

					'text-justify' => [
						'title' =>  esc_html__( 'Justify', 'paint' ),
						'icon'  =>  'eicon-text-align-justify',
					],
				],
				'default' => 'text-center',
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     =>  esc_html__( 'Color', 'paint' ),
				'type'      =>  Controls_Manager::COLOR,
				'selectors' =>  [
					'{{WRAPPER}} .element-gallery-grid-box__warp .item__body .content' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => esc_html__( 'Typography', 'paint' ),
				'selector' => '{{WRAPPER}} .element-gallery-grid-box__warp .item__body .content',
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
        <div class="element-gallery-grid-box">
            <div class="element-gallery-grid-box__warp">
				<?php foreach ( $settings['list'] as $item ) : ?>
                    <div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
						<?php if ( !empty( $item['list_image']['id'] ) ) : ?>
                            <div class="item__thumbnail <?php echo esc_attr( $settings['image_align'] ); ?>">
								<?php echo wp_get_attachment_image( $item['list_image']['id'], 'large' ); ?>
                            </div>
						<?php endif; ?>

                        <div class="item__body">
                            <?php if ( $item['list_title'] ) : ?>
                                <h3 class="title <?php echo esc_attr( $settings['title_align'] ); ?>">
                                    <?php echo esc_html( $item['list_title'] ); ?>
                                </h3>
                            <?php endif; ?>

                            <?php if ( $item['list_content'] ) : ?>
                                <div class="content <?php echo esc_attr( $settings['content_align'] ); ?>">
                                    <?php echo wpautop( $item['list_content'] ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
				<?php endforeach; ?>
            </div>
        </div>
		<?php
	}
}