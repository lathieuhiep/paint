<?php
$color_code_name = !empty( $args ) ? $args['color_code_name'] : '';
$color_code_list = !empty( $args ) ? $args['color_code_list'] : '';

if ( empty( $color_code_list ) ) :
    return;
endif;

foreach ($color_code_list as $key => $color_code_item) :
?>
    <div class="item">
        <figure class="item__thumbnail">
            <?php echo wp_get_attachment_image($color_code_item['image_id'], 'medium_large'); ?>
        </figure>

        <div class="info text-center">
            <?php if (!empty($color_code_name)) : ?>
                <span class="name"><?php echo esc_html($color_code_name); ?></span>
            <?php endif; ?>

            <span class="paint-number"><?php echo esc_html($color_code_item['paint_number']) ?></span>
        </div>
    </div>
<?php endforeach; ?>