<?php if ( have_posts() ) :  ?>

<div class="tools-warp">
    <div class="tool-list-grid">
	    <?php
        while ( have_posts() ) :
            the_post();

	        $url_product = get_post_meta(get_the_ID(), 'paint_cmb_tool_specifications_url', true);
	        $price = get_post_meta(get_the_ID(), 'paint_cmb_tool_specifications_price', true);
        ?>
            <div class="item">
                <div class="item__thumbnail">
                    <a class="icon-image" href="<?php echo esc_url( $url_product ); ?>" target="_blank">
                        <img src="<?php echo esc_url( get_theme_file_uri('/assets/images/icon-shopee.png') ); ?>" alt="shopee">
                    </a>

				    <?php the_post_thumbnail('large'); ?>
                </div>

                <div class="item__info<?php echo esc_attr( has_term('' , 'paint_tool_tag' ) ? ' align-items-center' : '' ); ?>">
                    <div class="left-box">
                        <h2 class="title">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title() ?>">
							    <?php the_title(); ?>
                            </a>
                        </h2>

                        <?php if ( has_term('' , 'paint_tool_tag' ) ) : ?>
                        <div class="meta">
						    <?php the_terms( get_the_ID(), 'paint_tool_tag', '', ', ' ); ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="right-box">
                        <span class="price"><?php echo esc_html( number_format( $price, 0, '', '.' ) ); ?></span>
                        <span class="currency">đ</span>
                    </div>
                </div>
            </div>
	    <?php
        endwhile;
        wp_reset_postdata();
        ?>
    </div>

    <?php paint_pagination(); ?>
</div>

<?php
endif;