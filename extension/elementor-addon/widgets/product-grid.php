<?php

use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Paint_Elementor_Product_Grid extends Widget_Base {

    public function get_categories(): array {
        return array( 'my-theme' );
    }

    public function get_name(): string {
        return 'paint-product-grid';
    }

    public function get_title(): string {
        return esc_html__( 'Danh sách sản phẩm', 'paint' );
    }

    public function get_icon(): string {
        return 'eicon-gallery-grid';
    }

    protected function register_controls(): void {

        // content section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Query', 'paint' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'select_cat',
            [
                'label'         =>  esc_html__( 'Chọn danh mục', 'paint' ),
                'type'          =>  Controls_Manager::SELECT2,
                'options'       =>  paint_check_get_cat( 'paint_product_cat' ),
                'multiple'      =>  true,
                'label_block'   =>  true
            ]
        );

        $this->add_control(
            'limit',
            [
                'label'     =>  esc_html__( 'Số lượng bài viết', 'paint' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  8,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label'     =>  esc_html__( 'Sắp xếp theo', 'paint' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'id',
                'options'   =>  [
                    'id'    =>  esc_html__( 'ID', 'paint' ),
                    'title' =>  esc_html__( 'Title', 'paint' ),
                    'date'  =>  esc_html__( 'Date', 'paint' ),
                    'rand'  =>  esc_html__( 'Random', 'paint' ),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label'     =>  esc_html__( 'Sắp xếp', 'paint' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'DESC',
                'options'   =>  [
                    'ASC'   =>  esc_html__( 'Tăng dần', 'paint' ),
                    'DESC'  =>  esc_html__( 'Giảm dần', 'paint' ),
                ],
            ]
        );

        $this->end_controls_section();

        // carousel options
        $this->start_controls_section(
            'options_section',
            [
                'label' => esc_html__( 'Tùy chọn bổ sung', 'paint' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'loop',
            [
                'type'          =>  Controls_Manager::SWITCHER,
                'label'         =>  esc_html__('Lặp lại vô hạn', 'paint'),
                'label_off'     =>  esc_html__('Không', 'paint'),
                'label_on'      =>  esc_html__('Có', 'paint'),
                'return_value'  =>  'yes',
                'default'       =>  'yes',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'         =>  esc_html__('Tự động chạy', 'paint'),
                'type'          =>  Controls_Manager::SWITCHER,
                'label_off'     =>  esc_html__('Không', 'paint'),
                'label_on'      =>  esc_html__('Có', 'paint'),
                'return_value'  =>  'yes',
                'default'       =>  'no',
            ]
        );

        $this->add_control(
            'navigation',
            [
                'label' => esc_html__( 'Thanh điều hướng', 'paint' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'arrows',
                'options' => [
                    'both'  => esc_html__( 'Mũi tên và Dấu chấm', 'paint' ),
                    'arrows'  => esc_html__( 'Mũi tên', 'paint' ),
                    'dots'  => esc_html__( 'Dấu chấm', 'paint' ),
                    'none' => esc_html__( 'Không', 'paint' ),
                ],
            ]
        );

        $this->end_controls_section();

        // responsive
        $this->start_controls_section(
            'responsive_section',
            [
                'label' => esc_html__( 'Responsive', 'paint' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'margin_item',
            [
                'label'     =>  esc_html__( 'Khoảng cách', 'paint' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  24,
                'min'       =>  0,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        // greater 1200px
        $this->add_control(
            'min_width_1200',
            [
                'label'     =>  esc_html__( 'Độ rộng lớn hơn 1200px', 'paint' ),
                'type'      =>  Controls_Manager::HEADING,
                'separator' =>  'before',
            ]
        );

        $this->add_control(
            'item',
            [
                'label'     =>  esc_html__( 'Số lượng hiển thị', 'paint' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  5,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        // greater 992px
        $this->add_control(
            'min_width_992',
            [
                'label'     =>  esc_html__( 'Độ rộng lớn hơn 992px', 'paint' ),
                'type'      =>  Controls_Manager::HEADING,
                'separator' =>  'before',
            ]
        );

        $this->add_control(
            'item_992',
            [
                'label'     =>  esc_html__( 'Số lượng hiển thị', 'paint' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  3,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        // greater 768px
        $this->add_control(
            'min_width_768',
            [
                'label'     =>  esc_html__( 'Độ rộng lớn hơn 768px', 'paint' ),
                'type'      =>  Controls_Manager::HEADING,
                'separator' =>  'before',
            ]
        );

        $this->add_control(
            'margin_item_greater_768',
            [
                'label'     =>  esc_html__( 'Khoảng cách', 'paint' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  24,
                'min'       =>  0,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'item_768',
            [
                'label'     =>  esc_html__( 'Số lượng hiển thị', 'paint' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  2,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        // greater 576px
        $this->add_control(
            'width_greater_576',
            [
                'label'     =>  esc_html__( 'Độ rộng lớn hơn 576px', 'paint' ),
                'type'      =>  Controls_Manager::HEADING,
                'separator' =>  'before',
            ]
        );

        $this->add_control(
            'item_greater_576',
            [
                'label'     =>  esc_html__( 'Số lượng hiển thị', 'paint' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  2,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'margin_item_greater_576',
            [
                'label'     =>  esc_html__( 'Khoảng cách', 'paint' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  12,
                'min'       =>  0,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        // greater 480px
        $this->add_control(
            'width_greater_480',
            [
                'label'     =>  esc_html__( 'Độ rộng lớn hơn 480px', 'paint' ),
                'type'      =>  Controls_Manager::HEADING,
                'separator' =>  'before',
            ]
        );

        $this->add_control(
            'item_greater_480',
            [
                'label'     =>  esc_html__( 'Số lượng hiển thị', 'paint' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  2,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'margin_item_greater_480',
            [
                'label'     =>  esc_html__( 'Khoảng cách', 'paint' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  12,
                'min'       =>  0,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        // less 480px
        $this->add_control(
            'max_width_item_less_480',
            [
                'label'     =>  esc_html__( 'Nhỏ hơn 480px', 'paint' ),
                'type'      =>  Controls_Manager::HEADING,
                'separator' =>  'before',
            ]
        );

        $this->add_control(
            'item_less_480',
            [
                'label'     =>  esc_html__( 'Số lượng hiển thị', 'paint' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  1,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'margin_item_less_480',
            [
                'label'     =>  esc_html__( 'Khoảng cách', 'paint' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  0,
                'min'       =>  0,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->end_controls_section();

        // title section
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => esc_html__( 'Tiêu đề', 'paint' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'title_align',
            [
                'label'     =>  esc_html__( 'Alignment', 'paint' ),
                'type'      =>  Controls_Manager::CHOOSE,
                'options'   =>  [
                    'left'  =>  [
                        'title' =>  esc_html__( 'Left', 'paint' ),
                        'icon'  =>  'eicon-text-align-left',
                    ],

                    'center' => [
                        'title' =>  esc_html__( 'Center', 'paint' ),
                        'icon'  =>  'eicon-text-align-center',
                    ],

                    'right' => [
                        'title' =>  esc_html__( 'Right', 'paint' ),
                        'icon'  =>  'eicon-text-align-right',
                    ],

                    'justify' => [
                        'title' =>  esc_html__( 'Justify', 'paint' ),
                        'icon'  =>  'eicon-text-align-justify',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .element-product-grid .item__title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     =>  esc_html__( 'Màu chữ', 'paint' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-product-grid .item__title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label'     =>  esc_html__( 'Màu chữ di chuột', 'paint' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-product-grid .item:hover .item__title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Typography', 'paint' ),
                'selector' => '{{WRAPPER}} .element-product-grid .item__title',
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void {
        $settings       =   $this->get_settings_for_display();

        // owl options
        $owl_options = [
            'loop' => ('yes' === $settings['loop']),
            'nav' => $settings['navigation'] == 'both' || $settings['navigation'] == 'arrows',
            'dots' => $settings['navigation'] == 'both' || $settings['navigation'] == 'dots',
            'autoplay' => ('yes' === $settings['autoplay']),
            'margin' => $settings['margin_item'],
            'responsive' => [
                '0' => array(
                    'items' => $settings['item_less_480'],
                    'margin' => $settings['margin_item_less_480']
                ),
                '480' => array(
                    'items' => $settings['item_greater_480'],
                    'margin' => $settings['margin_item_greater_480']
                ),
                '576' => array(
                    'items' => $settings['item_greater_576'],
                    'margin' => $settings['margin_item_greater_576']
                ),
                '768' => array(
                    'items' => $settings['item_768'],
                    'margin' => $settings['margin_item_greater_768']
                ),
                '992' => array(
                    'items' => $settings['item_992']
                ),
                '1200' => array(
                    'items' => $settings['item']
                ),
            ],
        ];

        // Query
        $cat_post       =   $settings['select_cat'];
        $limit_post     =   $settings['limit'];
        $order_by_post  =   $settings['order_by'];
        $order_post     =   $settings['order'];

        $tax_query = [];

        if ( $cat_post ) {
            $tax_query[] = array(
                'taxonomy' => 'paint_product_cat',
                'field' => 'term_id',
                'terms' => $cat_post
            );
        }

        $args = array(
            'post_type' => 'paint_product',
            'posts_per_page' => $limit_post,
            'orderby' => $order_by_post,
            'order' => $order_post,
            'ignore_sticky_posts' => 1,
            'tax_query' => $tax_query
        );

        $query = new WP_Query( $args );

        if ( $query->have_posts() ) :
    ?>
        <div class="element-product-grid">
            <div class="element-product-grid__warp custom-owl-carousel owl-carousel owl-theme" data-owl-options='<?php echo wp_json_encode( $owl_options ); ?>'>
                <?php
                while ( $query->have_posts() ):
                    $query->the_post();

                    $image_hover = get_post_meta(get_the_ID(), 'paint_cmb_product_image_feature_hover', true);
                ?>
                <div class="item">
                    <a class="item__link" href="<?php the_permalink(); ?>"></a>

                    <div class="item__image">
                        <?php
                        $attr = array(
                            'class' => 'featured-image w-100'
                        );

                        the_post_thumbnail('large', $attr);
                        ?>

                        <?php if ( $image_hover ) : ?>
                            <div class="secondary-image">
                                <img src="<?php echo esc_url( $image_hover ); ?>" alt="<?php the_title() ?>" width="768">
                            </div>
                        <?php endif; ?>
                    </div>

                    <h3 class="item__title">
                        <?php the_title(); ?>
                    </h3>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    <?php
        endif;
    }
}