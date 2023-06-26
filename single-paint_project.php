<?php
get_header();

$gallery = get_post_meta(get_the_ID(), 'paint_cmb_project_gallery', true);

$config_feature = [
	'infinite'       => true,
	'slidesToShow'   => 1,
	'slidesToScroll' => 1,
	'arrows'         => false,
	'fade'           => true,
	'asNavFor'       => '.slider-nav'
];

$config_nav_thumbnail = [
	'infinite'       => true,
	'slidesToShow'   => 5,
	'slidesToScroll' => 1,
	'arrows'         => false,
	'asNavFor'       => '.slider-for',
	'focusOnSelect' => true,
	'responsive'     => [
		[
			'breakpoint' => 767,
			'settings'   => [
				'slidesToShow' => 4,
			]
		],
		[
			'breakpoint' => 575,
			'settings'   => [
				'slidesToShow' => 3,
			]
		],
	],
]

?>

<div class="site-single-project element-spacer-pb element-background-image">
	<div class="container">
        <div class="spacer-pt-breadcrumbs">
			<?php get_template_part( 'components/inc', 'breadcrumbs' ); ?>
        </div>

		<?php while ( have_posts() ) : the_post(); ?>
            <h1 class="title text-center">
                <?php the_title() ?>
            </h1>

            <div class="entry-content">
                <div class="post-image">
                    <div class="post-image__feature custom-slick-carousel slider-for" data-config-slick='<?php echo wp_json_encode( $config_feature ); ?>'>
                        <div class="item">
                            <?php the_post_thumbnail('full'); ?>
                        </div>

                        <?php foreach ( $gallery as $key => $item ) : ?>
                            <div class="item">
                                <?php echo wp_get_attachment_image($key, 'full') ?>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="post-image__gallery custom-slick-carousel slider-nav" data-config-slick='<?php echo wp_json_encode( $config_nav_thumbnail ); ?>'>
                        <div class="item">
                            <?php the_post_thumbnail('thumbnail'); ?>
                        </div>

                        <?php foreach ( $gallery as $key => $item ) : ?>
                            <div class="item">
                                <?php echo wp_get_attachment_image($key) ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="post-content">
                    <?php the_content(); ?>
                </div>
            </div>
		<?php
        endwhile;
        wp_reset_postdata();

        get_template_part('template-parts/project/inc', 'related-project');
        ?>
	</div>
</div>
<?php
get_footer();