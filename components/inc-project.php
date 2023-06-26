<?php
$opt_heading = paint_get_option( 'template_home_opt_project_heading', '' );
$opt_limit = paint_get_option( 'template_home_opt_project_limit', 10 );
$opt_order_by = paint_get_option( 'template_home_opt_project_order_by', 'id' );
$opt_order = paint_get_option( 'template_home_opt_project_order', 'DESC' );

// Query
$args = array(
	'post_type'             =>  'paint_project',
	'posts_per_page'        =>  $opt_limit,
	'orderby'               =>  $opt_order_by,
	'order'                 =>  $opt_order,
	'ignore_sticky_posts'   =>  1,
);

$query = new WP_Query( $args );
?>

<div class="element-project">
	<?php if ( ! empty( $opt_heading ) ) : ?>
        <h2 class="heading mb-5 text-<?php echo esc_attr( $opt_heading['align'] ); ?>">
			<?php echo esc_html( $opt_heading['title'] ); ?>
        </h2>
	<?php
	endif;

	if ( $query->have_posts() ) :
    ?>

        <div class="project-content project-grid">
            <div class="row row-cols-2 row-cols-md-3">
				<?php while ( $query->have_posts() ): $query->the_post(); ?>
                    <div class="col item">
                        <div class="thumbnail">
                            <a class="link-image" href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('large'); ?>
                            </a>

                            <h2 class="title">
                                <a href="<?php the_permalink(); ?>">
									<?php the_title() ?>
                                </a>
                            </h2>
                        </div>
                    </div>
				<?php endwhile; ?>
            </div>
        </div>

    <?php
		wp_reset_postdata();
	endif;
	?>
</div>