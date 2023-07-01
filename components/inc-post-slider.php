<?php
$opt_heading = paint_get_option('template_home_opt_post_heading', '');
$opt_cat = paint_get_option('template_home_opt_post_cat', '');
$opt_limit = paint_get_option('template_home_opt_post_limit', 10);
$opt_order_by = paint_get_option('template_home_opt_post_order_by', 'id');
$opt_order = paint_get_option('template_home_opt_post_order', 'ASC');

// config slider
$data_config_slider = [
  'infinite' => true,
  'slidesToShow' => 4,
  'slidesToScroll' => 4,
  'arrows' => false,
  'autoplay' => true,
  'dots' => false,
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

// Query
$args = array(
  'post_type' => 'post',
  'posts_per_page' => $opt_limit,
  'orderby' => $opt_order_by,
  'order' => $opt_order,
  'cat' => $opt_cat,
  'ignore_sticky_posts' => 1,
);

$query = new WP_Query($args);
?>

<div class="element-post-slider">
  <?php if (!empty($opt_heading)) : ?>
    <h2 class="heading text-<?php echo esc_attr($opt_heading['align']); ?>">
      <?php echo esc_html($opt_heading['title']); ?>
    </h2>
  <?php
  endif;

  if ($query->have_posts()) :
    ?>

    <div class="custom-slick-carousel" data-config-slick='<?php echo wp_json_encode($data_config_slider); ?>'>
      <?php while ($query->have_posts()): $query->the_post(); ?>
        <div class="post">
          <figure class="post__thumbnail">
            <a href="<?php the_permalink(); ?>">
              <?php the_post_thumbnail('large'); ?>
            </a>
          </figure>

          <h2 class="post__title">
            <a href="<?php the_permalink(); ?>" title="<?php the_title() ?>">
              <?php the_title(); ?>
            </a>
          </h2>

          <p class="post__desc">
            <?php
            if (has_excerpt()) :
              echo esc_html(get_the_excerpt());
            else:
              echo esc_html(wp_trim_words(get_the_content(), 10, '...'));
            endif;
            ?>
          </p>

          <a href="<?php the_permalink(); ?>" class="read-more" title="<?php the_title() ?>">
            <span><?php esc_html_e('Xem thêm', 'paint'); ?></span>
            <i class="fa-solid fa-right-long"></i>
          </a>
        </div>
      <?php endwhile;
      wp_reset_postdata(); ?>
    </div>

  <?php endif; ?>
</div>
