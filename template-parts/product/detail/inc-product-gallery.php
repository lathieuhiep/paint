<?php
$gallery = get_post_meta(get_the_ID(),'paint_cmb_product_gallery', true);
if ( !empty( $gallery ) ) :
?>

<div class="product-gallery-grid">
	<?php foreach ( $gallery as $item) : ?>

	<figure class="item grid-sizer-<?php echo esc_attr( $item['style'] ); ?>">
		<?php echo wp_get_attachment_image( $item['image_id'],'full' ); ?>
	</figure>

	<?php endforeach; ?>
</div>

<?php
endif;