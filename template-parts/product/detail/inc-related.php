<?php
$term_ids = wp_get_post_terms(get_the_ID(), 'paint_product_cat', array('fields' => 'ids'));

if ($term_ids) :
  // query product
  $query = new WP_Query(array(
    'post_type' => 'paint_product',
    'posts_per_page' => 4,
    'post__not_in' => array(get_the_ID()),
    'ignore_sticky_posts' => 1,
    'tax_query' => array(
      array(
        'taxonomy' => 'paint_product_cat',
        'field' => 'term_id',
        'terms' => $term_ids
      ),
    )
  ));

  if ($query->have_posts()) :
?>
  <div class="related-product">
    <h3 class="related-product__title">
      <?php esc_html_e('Sản phẩm khác', 'paint'); ?>
    </h3>

    <div class="element-products product-grid-cat">
      <?php
      while ($query->have_posts()) :
        $query->the_post();

        get_template_part('template-parts/product/inc', 'tax-product');

      endwhile;
      wp_reset_postdata();
      ?>
    </div>
  </div>
<?php
  endif;
endif;