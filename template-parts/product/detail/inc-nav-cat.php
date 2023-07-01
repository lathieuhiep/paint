<?php
$config_slider = [
  'infinite' => true,
  'slidesToShow' => 3,
  'slidesToScroll' => 1,
  'arrows' => true,
  'responsive' => [
    [
      'breakpoint' => 1199,
      'settings' => [
        'arrows' => false,
        'autoplay' => true,
      ]
    ],
    [
      'breakpoint' => 991,
      'settings' => [
        'slidesToShow' => 2,
        'arrows' => false,
        'autoplay' => true,
      ]
    ],
    [
      'breakpoint' => 575,
      'settings' => [
        'slidesToShow' => 1,
        'arrows' => false,
        'autoplay' => true,
      ]
    ]
  ],
];

// get all terms product cat
$terms = get_terms(array(
  'taxonomy' => 'paint_product_cat',
  'hide_empty' => false,
));

if (!empty($terms)) :
  $productTerms = get_the_terms(get_the_ID(), 'paint_product_cat');

  $slugTerm = '';
  if ($productTerms) {
    $slugTerm = $productTerms[0]->slug;
  }
  ?>
  <div class="nav-cat">
    <div class="nav-cat__box">
      <div class="custom-slick-carousel" data-config-slick='<?php echo wp_json_encode($config_slider); ?>'>
        <?php foreach ($terms as $term): ?>
          <div class="item">
            <a class="item__link<?php echo esc_attr(!empty($slugTerm) && $slugTerm == $term->slug ? ' active' : ''); ?>"
               href="<?php echo esc_url(get_term_link($term->slug, 'paint_product_cat')); ?>">
              <?php echo esc_html($term->name); ?>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

<?php endif; ?>