<?php
$term_ids = wp_get_post_terms(get_the_ID(), 'paint_project_cat', array('fields' => 'ids'));
if (!empty($term_ids)) :
  $limit = 3;

  $arg = array(
    'post_type' => 'paint_project',
    'post__not_in' => array(get_the_ID()),
    'posts_per_page' => $limit,
    'orderby' => 'id',
    'order' => 'DESC',
    'ignore_sticky_posts' => 1,
    'tax_query' => array(
      array(
        'taxonomy' => 'paint_project_cat',
        'field' => 'term_id',
        'terms' => $term_ids
      ),
    )
  );

  $query = new WP_Query($arg);

  if ($query->have_posts()) :
?>

  <div class="site-single-project-related">
    <h3 class="title text-center">
      <?php esc_html_e('DỰ ÁN KHÁC', 'paint'); ?>
    </h3>

    <div class="project-content project-grid">
      <?php
      while ($query->have_posts()): $query->the_post();
        get_template_part('template-parts/project/inc', 'item');
      endwhile;
     ?>
    </div>
  </div>

<?php
  endif;
endif;
