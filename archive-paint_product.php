<?php get_header(); ?>

  <div class="site-container site-product-cat">
    <div class="container">
      <?php
      get_template_part('components/inc', 'heading-underline', array(
        'title' => esc_html__('Tất cả sản phẩm', 'paint')
      ));

      if (have_posts()) :
      ?>
        <div class="element-products product-grid-cat">
          <?php
          while (have_posts()) :
            the_post();

            get_template_part('template-parts/product/inc', 'tax-product');

            endwhile;
          wp_reset_postdata();
          ?>
        </div>
      <?php
        paint_pagination();

        else:
      ?>
          <p class="text-not text-center">
            <?php esc_html_e('Sản phẩm đang được cập nhập', 'paint'); ?>
          </p>
      <?php endif; ?>
    </div>
  </div>

<?php
get_footer();