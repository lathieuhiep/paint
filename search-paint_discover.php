<?php
get_header();

$search_query = get_search_query();
$s = $_GET['s'];
$cat = $_GET['cat'];

$tax_query = array();
if ( !empty( $cat ) ) {
	$tax_query = array(
		array(
			'taxonomy' => 'paint_discover_cat',
			'field'    => 'slug',
			'terms'    => $cat
		),
	);
}

$args = array(
	'post_type' => 'paint_discover',
	'ignore_sticky_posts' => 1,
	's' => $s,
	'posts_per_page' => posts_per_page_discover,
	'tax_query' => $tax_query,
);

$query = new WP_Query( $args );
?>

<div class="site-result-discover site-discover-warp element-spacer-pb">
	<div class="container">
        <div class="spacer-pt-breadcrumbs">
			<?php get_template_part( 'components/inc', 'breadcrumbs' ); ?>
        </div>

		<?php
        get_template_part( 'template-parts/discover/inc', 'search-form' );

        if ( $search_query ) :
		?>
            <header class="heading">
                <h1 class="page-title">
                    <?php _e( 'Tìm kiếm cho', 'paint' ); ?>: "<?php echo esc_html( $search_query ); ?>"
                </h1>
            </header>
        <?php endif; ?>
	</div>

	<div class="result-discover-warp content-warp">
		<?php if ( $query->have_posts() ) : ?>
            <div class="grid-discover">
				<?php
				while ($query->have_posts()) :
					$query->the_post();

					get_template_part('template-parts/discover/inc', 'render-item');

				endwhile;
				wp_reset_postdata();
				?>
            </div>

            <div class="spinner-warp text-center d-none">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        <?php endif; ?>
	</div>
</div>

<?php
get_footer();