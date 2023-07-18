<?php get_header(); ?>

  <div class="site-container site-single-product">
    <div class="container">
      <?php
      while (have_posts()) :
        the_post();

        get_template_part('template-parts/product/detail/inc', 'tabs');

      endwhile;

      get_template_part('template-parts/product/detail/inc', 'related');
      ?>
    </div>
  </div>

<?php
get_footer();