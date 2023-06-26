<?php
$opt_title = paint_get_option('template_introduce_opt_title', '');
$opt_image = paint_get_option('template_introduce_opt_image', '');
$opt_link = paint_get_option('template_introduce_opt_link', '');
$opt_desc = paint_get_option('template_introduce_opt_desc', '');
?>

<div class="element-about">
    <h2 class="title text-center">
        <?php echo esc_html( $opt_title ); ?>
    </h2>

    <div class="row row-cols-1 row-cols-md-2">
        <div class="col">
            <div class="box-image">
	            <?php
	            if ( $opt_image ) :
		            echo wp_get_attachment_image( $opt_image['id'], 'full' );
	            endif;

                if ( !empty( $opt_link['url'] ) ) :
                    $target = $opt_link['target'];
	            ?>
                    <div class="link">
                        <a href="<?php echo esc_url( $opt_link['url'] ); ?>" target="<?php echo esc_attr( !empty( $target ) ? $target : '_self' ); ?>">
	                        <?php echo esc_html( $opt_link['text'] ); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col desc">
            <?php echo wpautop( $opt_desc ); ?>
        </div>
    </div>
</div>
