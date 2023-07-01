<?php
$color_code_name = get_post_meta(get_the_ID(), 'paint_cmb_color_code_name', true);
$color_code_list = get_post_meta(get_the_ID(), 'paint_cmb_color_code_standard', true);

if (!empty($color_code_list)) :
  foreach ($color_code_list as $color_code_item) :
    ?>
    <div class="item">
      <figure class="item__thumbnail">
        <?php echo wp_get_attachment_image($color_code_item['image_id'], 'large'); ?>
      </figure>

      <div class="info">
        <p class="name">
          <?php echo esc_html($color_code_name); ?>
        </p>

        <p class="paint-number">
          <?php echo esc_html($color_code_item['paint_number']) ?>
        </p>
      </div>

      <?php if (!empty($color_code_item['color_mix'])) : ?>
        <div class="color-mix">
          <?php foreach ($color_code_item['color_mix'] as $itemColorMix) : ?>
            <div class="color-mix__item">
                        <span style="background-color: <?php echo esc_attr($itemColorMix['color']); ?>">
                            <?php echo esc_html($itemColorMix['name']); ?>
                        </span>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  <?php
  endforeach;
endif;