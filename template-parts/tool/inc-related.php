<?php
$data_settings_slide = [
  'infinite' => true,
  'slidesToShow' => 4,
  'slidesToScroll' => 1,
  'arrows' => true,
  'autoplay' => false,
  'responsive' => [
    [
      'breakpoint' => 575,
      'settings' => [
        'slidesToShow' => 1,
      ]
    ],
    [
      'breakpoint' => 767,
      'settings' => [
        'slidesToShow' => 2,
      ]
    ],
    [
      'breakpoint' => 1199,
      'settings' => [
        'slidesToShow' => 3,
      ]
    ],
  ],
];

$term_ids = wp_get_post_terms(get_the_ID(), 'paint_tool_cat', array('fields' => 'ids'));

if (!empty($term_ids)) :
  $args = array(
    'post_type' => 'paint_tool',
    'posts_per_page' => 10,
    'post__not_in' => array(get_the_ID()),
    'ignore_sticky_posts' => 1,
    'tax_query' => array(
      array(
        'taxonomy' => 'paint_tool_cat',
        'field' => 'term_id',
        'terms' => $term_ids
      ),
    )
  );

  $query = new WP_Query($args);

  if ($query->have_posts()) :
    ?>
    <div class="tool-related">
      <h2 class="heading text-center">
        <?php esc_html_e('Sản phẩm liên quan', 'paint'); ?>
      </h2>

      <div class="element-tool-slider">
        <div class="tool-list-grid custom-slick-carousel"
             data-config-slick='<?php echo wp_json_encode($data_settings_slide); ?>'>
          <?php
          while ($query->have_posts()):
            $query->the_post();

            $url_product = get_post_meta(get_the_ID(), 'paint_cmb_tool_specifications_url', true);
            $price = get_post_meta(get_the_ID(), 'paint_cmb_tool_specifications_price', true);
            ?>

            <div class="item">
              <div class="item__thumbnail">
                <a class="icon-image" href="<?php echo esc_url($url_product); ?>" target="_blank">
                  <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/icon-shopee.png')); ?>"
                       alt="shopee">
                </a>

                <?php the_post_thumbnail('large'); ?>
              </div>

              <div class="item__info">
                <div class="left-box">
                  <h2 class="title">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title() ?>">
                      <?php the_title(); ?>
                    </a>
                  </h2>

                  <div class="meta">
                    <?php the_terms(get_the_ID(), 'paint_tool_tag', '', ', '); ?>
                  </div>
                </div>

                <div class="right-box">
                  <span class="price"><?php echo esc_html(number_format($price, 0, '', '.')); ?></span>
                  <span class="currency">đ</span>
                </div>
              </div>
            </div>

          <?php endwhile;
          wp_reset_postdata(); ?>
        </div>
      </div>
    </div>
  <?php
  endif;
endif;