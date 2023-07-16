<?php get_header(); ?>

  <div class="site-container site-product-cat">
      <div class="container">
          <?php
          $taxonomy = get_queried_object();

          get_template_part('components/inc', 'heading-underline', array(
            'title' => $taxonomy->name
          ));

          get_template_part('template-parts/product/inc', 'tax-product');
          ?>
      </div>
  </div>

<?php
get_footer();