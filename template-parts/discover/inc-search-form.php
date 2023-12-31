<?php
$paint_unique_id = esc_attr( uniqid( 'search-form-' ) );

$terms = get_terms( array(
	'taxonomy' => 'paint_discover_cat',
	'hide_empty' => false,
) );

$cat = $_GET['cat'];

if ( is_singular('paint_discover') ) {
    $get_terms_post = wp_get_post_terms( get_the_ID(), 'paint_discover_cat', array( 'fields' => 'slugs' ) );

    if ( $get_terms_post ) {
	    $cat = $get_terms_post[0];
    }
}
?>

<form role="search" method="get" class="search-form search-form-discover" action="<?php echo esc_url( home_url( '/' ) ); ?>" data-limit="<?php echo esc_attr(posts_per_page_discover) ?>">
    <div class="group-search">
        <input type="search" id="<?php echo $paint_unique_id; ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Tìm kiếm', 'placeholder', 'paint' ); ?>" value="<?php echo get_search_query(); ?>" name="s" aria-label="" />

        <button type="submit" class="search-submit">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </div>

	<?php if ( $terms ) :?>
        <div class="group-check">
            <input type="radio" class="btn-check" name="cat" id="all-cat" value="" autocomplete="off" <?php echo esc_attr( empty( $cat ) ? 'checked' : '' ); ?>>
            <label class="btn btn-secondary" for="all-cat">
                <?php esc_html_e('Tất cả', 'paint'); ?>
            </label>

            <?php foreach ( $terms as $term ) : ?>
                <input type="radio" class="btn-check" name="cat" id="<?php echo esc_attr( $term->slug ); ?>" value="<?php echo esc_attr( $term->slug ); ?>" autocomplete="off" <?php echo esc_attr( !empty( $cat ) && $cat == $term->slug ? 'checked' : '' ); ?>>
                <label class="btn btn-secondary" for="<?php echo esc_attr( $term->slug ); ?>">
                    <?php echo esc_html( $term->name ); ?>
                </label>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <input type="hidden" readonly name="post_type" value="paint_discover">
</form>