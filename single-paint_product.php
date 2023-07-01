<?php
get_header();

$banner = get_post_meta(get_the_ID(), 'paint_cmb_product_banner_id', true);
?>

  <div class="site-single-product">
    <?php if ($banner) : ?>
      <div class="banner-box">
        <?php echo wp_get_attachment_image($banner, 'full'); ?>
      </div>
    <?php endif; ?>

    <div class="header-warp">
      <div class="container">
        <?php
        get_template_part('components/inc', 'breadcrumbs');

        get_template_part('template-parts/product/detail/inc', 'nav-cat');

        get_template_part('template-parts/product/detail/inc', 'nav-related');
        ?>
      </div>
    </div>

    <div class="entry-content">
      <div class="container">
        <?php
        while (have_posts()) :
          the_post();

          get_template_part('template-parts/product/detail/inc', 'tabs');

        endwhile;
        ?>
      </div>
    </div>

    <?php get_template_part('template-parts/product/detail/inc', 'suggestion-tool'); ?>
  </div>

<?php
get_footer();