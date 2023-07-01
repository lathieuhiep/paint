<?php
$term = get_queried_object();
?>
<div class="site-discover-warp site-discover-cat element-spacer-pb">
  <div class="container">
    <h1 class="title">
      <?php echo esc_html( $term->label ); ?>
    </h1>

    <?php get_template_part('template-parts/discover/inc', 'search-form'); ?>

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
</div>