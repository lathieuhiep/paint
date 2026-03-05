<?php

use ExtendSite\Admin\Fields\Pages\Home\ProductTab;

$data = paint_get_field_tab_data(ProductTab::class);

if (!empty($data['items'])) :
?>
    <section class="element-product">
        <?php if (!empty($data['heading'])) : ?>
            <div class="element-product__heading mb-19">
                <div class="container">
                    <h2 class="element-page-heading mb-0 text-center">
                        <?php echo esc_html($data['heading']); ?>
                    </h2>
                </div>
            </div>
        <?php endif; ?>

        <div class="element-product__decor position-relative">
            <?php if (!empty($data['bg_image'])) : ?>
                <div class="bg-box">
                    <?php echo wp_get_attachment_image(
                        (int) $data['bg_image'],
                        'full',
                        false,
                        ['class' => 'element-product__bg-image']
                    ); ?>
                </div>
            <?php endif; ?>

            <div class="element-product__stack position-relative">
                <div class="container">
                    <div class="card-warp">
                        <?php
                        $total = count( $data['items']) ;

                        foreach ($data['items'] as $index => $item) :
                            $num = $data['order'] === 'desc'
                                ? $total - $index
                                : $index + 1;

                            $number = str_pad((string)$num, 2, '0', STR_PAD_LEFT);
                        ?>

                            <article class="card-box" data-index="<?php echo esc_attr($index); ?>">
                                <div class="card-box__content">
                                    <span class="number"><?php echo esc_html($number); ?></span>

                                    <div class="title-wrap">
                                        <?php if (!empty($item['title'])) : ?>
                                            <h3 class="title mb-3">
                                                <span><?php echo esc_html($item['title']); ?></span>

                                                <?php if (!empty($item['icon'])) : ?>
                                                    <?php echo wp_get_attachment_image((int) $item['icon']); ?>
                                                <?php endif; ?>
                                            </h3>
                                        <?php endif; ?>

                                        <?php if (!empty($item['sub_title'])) : ?>
                                            <p class="subtitle">
                                                <?php echo esc_html($item['sub_title']); ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>

                                    <?php if ( !empty( $item['color_code'][0] && !empty( $item['color_code'][0]['id'] ) ) ) : ?>
                                        <a href="<?php echo esc_url(get_permalink( $item['color_code'][0]['id'] )); ?>"
                                           class="btn-view-color">
                                            <?php esc_html_e('Xem bảng màu', 'extend-site'); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <div class="card-box__media">
                                    <div class="item-box item-secondary">
                                        <?php if (!empty($item['product_image'])) : ?>
                                            <div class="card__product">
                                                <?php echo wp_get_attachment_image(
                                                    (int) $item['product_image'],
                                                    'medium'
                                                ); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($item['color_image'])) : ?>
                                            <div class="card__color">
                                                <?php echo wp_get_attachment_image(
                                                    (int) $item['color_image'],
                                                    'medium'
                                                ); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <?php if (!empty($item['real_image'])) : ?>
                                        <div class="item-box item-real">
                                            <?php echo wp_get_attachment_image(
                                                (int) $item['real_image'],
                                                'large'
                                            ); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </article>

                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>