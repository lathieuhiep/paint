<?php
// config slider
$data_config_slider = [
  'infinite' => true,
  'slidesToShow' => 8,
  'slidesToScroll' => 8,
  'arrows' => true,
  'autoplay' => false,
  'dots' => true,
  'responsive' => [
    [
      'breakpoint' => 1023,
      'settings' => [
        'slidesToShow' => 3,
        'slidesToScroll' => 3,
      ]
    ],
    [
      'breakpoint' => 767,
      'settings' => [
        'slidesToShow' => 2,
        'slidesToScroll' => 2,
      ]
    ],
    [
      'breakpoint' => 575,
      'settings' => [
        'slidesToShow' => 1,
        'slidesToScroll' => 1,
      ]
    ],
  ],
];

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
      <div class="custom-slick-carousel" data-config-slick='<?php echo wp_json_encode($data_config_slider); ?>'>
        <?php
        while ($query->have_posts()) :
          $query->the_post();
        ?>
          <div class="item-post">
            <figure class="thumbnail-image">
              <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('large'); ?>
              </a>
            </figure>

            <h2 class="title-item view-detail">
              <a href="<?php the_permalink(); ?>">
                <?php the_title() ?>
              </a>
            </h2>

            <?php if (has_term('', 'paint_discover_cat')) : ?>
              <div class="meta">
                <?php the_terms(get_the_ID(), 'paint_discover_cat', '', ', '); ?>
              </div>
            <?php endif; ?>
          </div>
        <?php
          endwhile;
        wp_reset_postdata();
        ?>
      </div>
    </div>
  <?php
  endif;
endif;