<?php
$opt_top = paint_get_option('our_maxim_opt_top', '');
$list = paint_get_option('our_maxim_opt_group', '');
?>

<div class="element-our-maxim">
    <?php if ( !empty( $opt_top ) ) : ?>
    <h2 class="heading text-<?php echo esc_attr( $opt_top['align'] ); ?>">
	    <?php echo esc_html( $opt_top['title'] ); ?>
    </h2>

    <div class="describe text-<?php echo esc_attr( $opt_top['align'] ); ?>">
        <?php echo wpautop( $opt_top['describe'] ); ?>
    </div>
    <?php endif; ?>

    <?php if ( $list ) : ?>
    <div class="list row row-cols-1 row-cols-sm-2 row-cols-lg-4">
        <?php foreach ( $list as $item) : ?>
        <div class="col">
            <div class="item">
                <?php if ( $item['image'] ) : ?>
                <div class="item__icon">
                    <?php echo wp_get_attachment_image( $item['image']['id'], 'full' ); ?>
                </div>
                <?php endif; ?>

                <h3 class="item__title">
	                <?php echo esc_html( $item['title'] ); ?>
                </h3>

                <p class="item__content">
                    <?php echo esc_textarea( $item['content'] ); ?>
                </p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
