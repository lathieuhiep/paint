<?php
if (have_posts()) :
  ?>
  <div class="element-products">
    <?php
    while (have_posts()) :
      the_post();

      $image_hover = get_post_meta(get_the_ID(), 'paint_cmb_product_image_feature_hover_id', true);
      $color_board = (int) get_post_meta(get_the_ID(), 'paint_cmb_options_product_color', true);
    ?>
      <div class="item">
        <div class="thumbnail">
          <a class="link-image" href="<?php the_permalink(); ?>">
            <?php
            the_post_thumbnail('large', ['class' => 'img-feature']);
            echo wp_get_attachment_image($image_hover, 'large', '', array("class" => "img-feature-hover"));
            ?>
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

            <?php if ( $color_board ) : ?>
              <a href="<?php echo esc_url(get_term_link($color_board, 'paint_color_code_cat')) ?>" class="box-group__link">
                <?php esc_html_e('Bảng màu', 'paint'); ?>
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php
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