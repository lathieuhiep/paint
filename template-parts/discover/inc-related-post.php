<?php
$term_ids = wp_get_post_terms(get_the_ID(), 'paint_discover_cat', array('fields' => 'ids'));

if (!empty($term_ids)) :
  $args = array(
    'post_type' => 'paint_discover',
    'posts_per_page' => posts_per_page_discover,
    'post__not_in' => array(get_the_ID()),
    'ignore_sticky_posts' => 1,
    'tax_query' => array(
      array(
        'taxonomy' => 'paint_discover_cat',
        'field' => 'term_id',
        'terms' => $term_ids
      ),
    )
  );

  $query = new WP_Query($args);

  if ($query->have_posts()):
    ?>
    <div class="site-discover-related content-warp">
      <div class="grid-discover">
        <?php
        while ($query->have_posts()) :
          $query->the_post();

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
    </div>
  <?php
  endif;
endif;