<?php
if (have_posts()) :
  ?>
  <div class="element-products">
    <div class="row row-cols-2 row-cols-md-3">
      <?php
      while (have_posts()) :
        the_post();

        $image_hover = get_post_meta(get_the_ID(), 'paint_cmb_product_image_feature_hover_id', true);
        ?>
        <div class="col item">
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
          </div>
        </div>
      <?php
      endwhile;
      wp_reset_postdata();
      ?>
    </div>
  </div>
  <?php
  paint_pagination();
endif;
?>