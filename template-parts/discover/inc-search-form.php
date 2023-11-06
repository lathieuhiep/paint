<?php
// config slider
$data_config_slider = [
  'infinite' => false,
  'slidesToShow' => 5,
  'slidesToScroll' => 1,
  'arrows' => true,
  'autoplay' => false,
  'variableWidth' => true,
  'responsive' => [
    [
      'breakpoint' => 1199,
      'settings' => [
        'slidesToShow' => 3
      ]
    ],
    [
      'breakpoint' => 767,
      'settings' => [
        'slidesToShow' => 2
      ]
    ],
    [
      'breakpoint' => 479,
      'settings' => [
        'slidesToShow' => 1
      ]
    ],
  ],
];

$paint_unique_id = esc_attr(uniqid('search-form-'));

$terms = get_terms(array(
  'taxonomy' => 'paint_discover_cat',
  'hide_empty' => false,
));

$cat = !empty($_GET['cat']) ? (int) $_GET['cat'] : '';

if (is_singular('paint_discover')) {
  $get_terms_post = wp_get_post_terms(get_the_ID(), 'paint_discover_cat', array('fields' => 'slugs'));

  if ($get_terms_post) {
    $cat = $get_terms_post[0];
  }
}
?>

<form role="search" method="get"
      class="search-form <?php echo esc_attr( !is_singular('paint_discover') ? 'search-form-discover' : 'search-form-single-discover' ); ?>"
      action="<?php echo esc_url(home_url('/')); ?>"
      data-limit="<?php echo esc_attr(posts_per_page_discover) ?>"
>
  <?php if ($terms) : ?>
    <div class="scroll-box">
      <div class="group-check custom-slick-carousel" data-config-slick='<?php echo wp_json_encode($data_config_slider); ?>'>
        <div class="group-check__item">
          <input type="radio" class="btn-check" name="cat" id="all-cat" value=""
                 autocomplete="off" <?php echo esc_attr(empty($cat) ? 'checked' : ''); ?>>
          <label class="btn btn-secondary" for="all-cat">
            <?php esc_html_e('Tất cả', 'paint'); ?>
          </label>
        </div>

        <?php foreach ($terms as $term) : ?>

          <div class="group-check__item">
            <input type="radio" class="btn-check" name="cat" id="<?php echo esc_attr($term->slug); ?>"
                   value="<?php echo esc_attr($term->slug); ?>"
                   autocomplete="off" <?php echo esc_attr(!empty($cat) && $cat == $term->slug ? 'checked' : ''); ?>>
            <label class="btn btn-secondary" for="<?php echo esc_attr($term->slug); ?>">
              <?php echo esc_html($term->name); ?>
            </label>
          </div>

        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>

  <div class="group-search">
    <input type="search" id="<?php echo $paint_unique_id; ?>" class="search-field"
           placeholder="<?php echo esc_attr_x('Nhập từ khóa...', 'placeholder', 'paint'); ?>"
           value="<?php echo get_search_query(); ?>" name="s" aria-label=""/>

    <button type="submit" class="search-submit">
      <i class="fa-solid fa-magnifying-glass"></i>
    </button>
  </div>

  <input type="hidden" readonly name="post_type" value="paint_discover">
</form>