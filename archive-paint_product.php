<?php get_header(); ?>

  <div class="site-container site-product-cat">
    <div class="container">
      <?php
      get_template_part('components/inc', 'heading-underline', array(
        'title' => esc_html__('Tất cả sản phẩm', 'paint')
      ));

      get_template_part('template-parts/product/inc', 'tax-product');
      ?>
    </div>
  </div>

<?php
get_footer();