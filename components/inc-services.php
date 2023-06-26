<?php
$opt_service_image = paint_get_option('template_home_opt_service_image', '');
$opt_service_list = paint_get_option('template_home_opt_service_list', '');
?>
<div class="element-service">
    <div class="box-warp">
        <div class="left-box">
            <?php if ( !empty( $opt_service_image ) ) : ?>
                <?php echo wp_get_attachment_image( $opt_service_image['id'], 'full' ); ?>
            <?php endif; ?>
        </div>

        <?php if ( !empty( $opt_service_list ) ) : ?>

        <div class="right-box">
            <?php foreach ( $opt_service_list as $item ) : ?>

            <div class="item">
                <div class="item__left">
                    <div class="icon-box">
                        <?php echo wp_get_attachment_image( $item['image']['id'], 'full' ); ?>
                    </div>
                </div>

                <div class="item__right">
                    <h3 class="title">
                        <?php echo esc_html( $item['title'] ); ?>
                    </h3>

                    <p class="content">
                        <?php echo esc_textarea( $item['content'] ); ?>
                    </p>
                </div>
            </div>

            <?php endforeach; ?>
        </div>

        <?php endif; ?>
    </div>
</div>
