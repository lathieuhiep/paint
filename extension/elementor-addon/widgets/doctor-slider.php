<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Paint_Elementor_Doctor_Slider extends Widget_Base {

	public function get_categories(): array {
		return array( 'my-theme' );
	}

	public function get_name(): string {
		return 'paint-doctor-slider';
	}

	public function get_title(): string {
		return esc_html__( 'Doctor Slider', 'paint' );
	}

	public function get_icon(): string {
		return 'eicon-slider-push';
	}

	protected function register_controls(): void {
		// Content section
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Query', 'paint' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'limit',
			[
				'label'     =>  esc_html__( 'Number of Posts', 'paint' ),
				'type'      =>  Controls_Manager::NUMBER,
				'default'   =>  12,
				'min'       =>  1,
				'max'       =>  100,
				'step'      =>  1,
			]
		);

		$this->add_control(
			'order_by',
			[
				'label'     =>  esc_html__( 'Order By', 'paint' ),
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
				'label'     =>  esc_html__( 'Order', 'paint' ),
				'type'      =>  Controls_Manager::SELECT,
				'default'   =>  'DESC',
				'options'   =>  [
					'ASC'   =>  esc_html__( 'Ascending', 'paint' ),
					'DESC'  =>  esc_html__( 'Descending', 'paint' ),
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();

        $medical_appointment_form = paint_get_opt_medical_appointment();

		$limit_post     =   $settings['limit'];
		$order_by_post  =   $settings['order_by'];
		$order_post     =   $settings['order'];

		// Query
		$args = array(
			'post_type'           => 'paint_doctor',
			'posts_per_page'      => $limit_post,
			'orderby'             => $order_by_post,
			'order'               => $order_post,
			'ignore_sticky_posts' => 1,
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) :
        ?>
            <div class="element-doctor-slider">
                <div class="element-doctor-slider__warp owl-carousel custom-equal-height-owl">
					<?php
					while ( $query->have_posts() ) :
						$query->the_post();

						$specialist = get_post_meta(get_the_ID(), 'paint_cmb_doctor_specialist', true);
                    ?>

                        <div class="item">
                            <div class="item__thumbnail">
								<?php the_post_thumbnail('large'); ?>
                            </div>

                            <div class="item__body">
                                <h3 class="title text-uppercase text-center">
									<?php the_title(); ?>
                                </h3>

                                <div class="meta text-center">
                                    <p class="specialist m-0">
                                        <?php echo esc_html( $specialist ); ?>
                                    </p>
                                </div>

                                <?php if ( !empty( get_the_content() ) ) : ?>
                                    <div class="content">
                                        <?php the_content(); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="action-box">
                                    <?php if ( $medical_appointment_form ) : ?>
                                        <a class="action-box__booking text-uppercase d-inline-block" href="#" data-bs-toggle="modal" data-bs-target="#modal-appointment-form">
                                            <?php esc_html_e('Đăng ký khám', "paint"); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

					<?php
					endwhile;
					wp_reset_postdata();
					?>
                </div>
            </div>
		<?php
		endif;
	}
}