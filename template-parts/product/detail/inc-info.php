<?php
$galleries = get_post_meta(get_the_ID(), 'paint_cmb_product_image_gallery', true);
$contact = paint_get_option('paint_opt_product_detail_contact');
?>

<div class="product-info-warp">
    <div class="thumbnail-box">
        <?php if ( $galleries ) : ?>
            <div class="slider-product-galleries owl-carousel">
                <?php
                $sttMain = 0;
                foreach ($galleries as $attachment_id => $attachment_url) :
                ?>
                    <div class="item d-flex align-items-center justify-content-center image-container" data-index="<?php echo esc_attr( $sttMain ); ?>">
                        <a class="item__thumbnail zoom-box" href="<?php echo esc_url( wp_get_attachment_url($attachment_id) ); ?>">
                            <?php echo wp_get_attachment_image( $attachment_id, 'large' ) ?>
                        </a>

                        <div class="zoom-overlay" data-zoom-src="<?php echo esc_url( wp_get_attachment_url($attachment_id) ); ?>"></div>
                    </div>
                <?php
                    $sttMain++;
                endforeach;
                ?>
            </div>

            <div class="slider-product-gallery-nav owl-carousel">
                <?php
                $sttNav = 0;
                foreach ($galleries as $attachment_id => $attachment_url) :
                ?>
                    <div class="item" data-index="<?php echo esc_attr( $sttNav ); ?>">
                        <?php echo wp_get_attachment_image( $attachment_id, 'medium' ) ?>
                    </div>
                <?php
                    $sttNav++;
                endforeach;
                ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="body-box">
        <div class="heading">
            <h1 class="product-title">
                <?php the_title() ?>
            </h1>

            <a href="#color-code" class="btn btn-global"><?php esc_html_e('Xem bảng màu', 'paint'); ?></a>
        </div>

        <div id="content-product-detail" class="content-product-detail">
            <?php the_content(); ?>
        </div>

        <div class="action-box">
            <?php if ( $contact ) : ?>
                <a class="btn-global link" href="<?php echo esc_url( $contact['url'] ) ?>" target="<?php echo esc_attr( $contact['target'] ) ?>" title="<?php echo esc_attr( $contact['text'] ) ?>">
                    <?php esc_html_e('Liên hệ', 'paint'); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>