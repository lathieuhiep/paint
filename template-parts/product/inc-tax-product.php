<?php
$image_hover = get_post_meta(get_the_ID(), 'paint_cmb_product_image_feature_hover', true);
$color_board = (int)get_post_meta(get_the_ID(), 'paint_cmb_options_product_color', true);
?>

<div class="item">
  <div class="thumbnail">
    <a class="link-image" href="<?php the_permalink(); ?>">
      <?php the_post_thumbnail('medium_large', ['class' => 'img-feature']); ?>
      <img src="<?php echo esc_url( $image_hover ) ?>" alt="<?php the_title() ?>" class="img-feature-hover">
    </a>

    <h2 class="title">
      <a href="<?php the_permalink(); ?>">
        <?php the_title() ?>
      </a>
    </h2>

    <div class="box-group">
      <h2 class="box-group__title m-0">
        <a href="<?php the_permalink(); ?>">
          <?php the_title() ?>
        </a>
      </h2>

      <?php if ($color_board) : ?>
        <a href="<?php the_permalink(); ?>" class="box-group__link">
          <?php esc_html_e('Bảng màu', 'paint'); ?>
        </a>
      <?php endif; ?>
    </div>
  </div>
</div>