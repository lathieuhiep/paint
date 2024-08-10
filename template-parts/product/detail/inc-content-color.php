<?php
$color_code_name = get_post_meta(get_the_ID(), 'paint_cmb_color_code_name', true);
$color_code_list = get_post_meta(get_the_ID(), 'paint_cmb_color_code_standard', true);

if (!empty($color_code_list)) :
    $i = 1;
    ?>

    <div class="group-color">
        <?php
        foreach ($color_code_list as $color_code_item) :
            if ($i == 1 || $i % 3 == 1) :
                ?>
                <div class="list-color">


            <?php endif; ?>

            <div class="item">
                <figure class="item__thumbnail"
                        data-image-feature="<?php echo wp_get_attachment_image_url($color_code_item['image_id'], 'full') ?>">
                    <?php echo wp_get_attachment_image($color_code_item['image_id'], 'medium_large'); ?>
                </figure>

                <div class="info">
                    <?php if (!empty($color_code_name)) : ?>
                        <p class="name">
                            <?php echo esc_html($color_code_name); ?>
                        </p>
                    <?php endif; ?>

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

            <?php if ($i % 3 == 0 || $i == count($color_code_list)) : ?>
            </div>
        <?php
        endif;

            $i++;
        endforeach;
        ?>
    </div>

<?php
endif;