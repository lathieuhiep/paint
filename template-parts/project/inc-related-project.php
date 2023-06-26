<?php
$limit = 3;

$arg = array(
	'post_type'           => 'paint_project',
	'post__not_in'        => array( get_the_ID() ),
	'posts_per_page'      => $limit,
	'orderby'             => 'id',
	'order'               => 'DESC',
	'ignore_sticky_posts' => 1
);

$query = new WP_Query( $arg );

if ($query->have_posts()) :
?>

    <div class="site-single-project-related">
        <h3 class="title text-center">
            <?php esc_html_e('DỰ ÁN KHÁC', 'paint'); ?>
        </h3>

        <div class="project-content project-grid">
            <div class="row row-cols-1 row-cols-sm-3">
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
    </div>

<?php
endif;
