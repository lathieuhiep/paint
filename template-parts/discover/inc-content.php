<div class="site-discover-warp site-discover-cat element-spacer-pb">
  <div class="container">
    <div class="spacer-pt-breadcrumbs">
      <?php get_template_part('components/inc', 'breadcrumbs'); ?>
    </div>

    <?php get_template_part('template-parts/discover/inc', 'search-form'); ?>
  </div>

  <div class="content-warp">
    <?php if (have_posts()) : ?>
      <div class="grid-discover">
        <?php
        while (have_posts()) :
          the_post();

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