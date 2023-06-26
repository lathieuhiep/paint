<?php
$config_slider = [
	'infinite'       => true,
	'slidesToShow'   => 3,
	'slidesToScroll' => 1,
	'arrows'         => true,
	'responsive'     => [
		[
			'breakpoint' => 1199,
			'settings'   => [
				'arrows' => false,
				'autoplay' => true,
			]
		],
		[
			'breakpoint' => 991,
			'settings'   => [
				'slidesToShow' => 2,
				'arrows' => false,
				'autoplay' => true,
			]
		],
		[
			'breakpoint' => 575,
			'settings'   => [
				'slidesToShow' => 1,
				'arrows' => false,
				'autoplay' => true,
			]
		]
	],
];

// get cate product by id
$tax_query = array();
$list_cate  = get_the_terms(get_the_ID(), 'paint_product_cat');
$list_cate_ids = array();

foreach ($list_cate as $item) $list_cate_ids[] = $item->term_id;

if ( !empty( $cate_product ) ) {
	$tax_query = array(
		array(
			'taxonomy' => 'paint_product_cat',
			'field'    => 'term_id',
			'terms'    => $list_cate_ids
		),
	);
}

// query product
$query = new WP_Query(array(
	'post_type' => 'paint_product',
	'posts_per_page' => 9,
	'post__not_in' => array(get_the_ID()),
	'ignore_sticky_posts'   =>  1,
	'tax_query' => $tax_query
));
?>
<div class="nav-post">
    <div class="nav-post__box">
        <div class="custom-slick-carousel" data-config-slick='<?php echo wp_json_encode( $config_slider ); ?>'>
            <div class="item">
                <h2 class="post-title active"><?php the_title(); ?></h2>
            </div>

            <?php
            if ( $query->have_posts() ) :
                while ($query->have_posts()) :
                    $query->the_post();
                    ?>

                    <div class="item">
                        <a href="<?php the_permalink(); ?>" class="post-title">
                            <?php the_title(); ?>
                        </a>
                    </div>

                <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</div>