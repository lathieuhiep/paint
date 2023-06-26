<?php
$opt_result_count_top = paint_get_option('template_home_opt_result_count_top', '');
$opt_result_count_bottom = paint_get_option('template_home_opt_result_count_bottom', '');
?>

<div class="element-count-up">
    <?php if ( !empty( $opt_result_count_top ) ) : ?>

    <h2 class="heading text-<?php echo esc_attr( $opt_result_count_top['align'] ); ?>">
        <?php echo esc_html( $opt_result_count_top['title'] ); ?>
    </h2>

    <div class="describe text-<?php echo esc_attr( $opt_result_count_top['align'] ); ?>">
        <?php echo wpautop( $opt_result_count_top['describe'] ); ?>
    </div>

    <?php
    endif;

    if ( $opt_result_count_bottom ) :
    ?>

    <div class="content-warp row row-cols-1 row-cols-sm-3 row-cols-lg-3">
        <?php foreach ( $opt_result_count_bottom as $item) : ?>
        <div class="col">
            <div class="item">
                <div class="item__icon">
                    <?php echo wp_get_attachment_image( $item['image']['id'], 'full' ); ?>
                </div>

                <div class="item__content">
                    <div class="count-box">
                        <span class="number-counter" data-number="<?php echo esc_attr( $item['count'] ); ?>"></span>
                        <span class="symbol">+</span>
                    </div>

                    <p class="text">
                        <?php echo esc_html( $item['title'] ); ?>
                    </p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <?php endif; ?>
</div>