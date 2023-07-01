<?php get_header(); ?>

    <div class="site-discover-warp site-single-discover element-spacer-pb">
        <div class="container">
            <div class="spacer-pt-breadcrumbs">
                <?php get_template_part('components/inc', 'breadcrumbs'); ?>
            </div>

            <?php
            get_template_part('template-parts/discover/inc', 'search-form');

            get_template_part('template-parts/discover/inc', 'detail');
            ?>
        </div>

        <?php get_template_part('template-parts/discover/inc', 'related-post'); ?>
    </div>

<?php
get_footer();