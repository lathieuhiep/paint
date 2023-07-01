<?php get_header(); ?>

    <div class="site-container site-product-cat">
        <div class="container">
            <?php
            get_template_part('components/inc', 'breadcrumbs');

            get_template_part('template-parts/product/inc', 'tax-product');
            ?>
        </div>
    </div>

<?php
get_footer();