<div class="info-product">
	<div class="item">
		<h3 class="title">
			<i class="fa-solid fa-minus"></i>
			<?php esc_html_e('Mô tả sản phẩm', 'paint'); ?>
		</h3>

		<div class="content">
			<?php the_content(); ?>
		</div>
	</div>

	<div class="item">
		<h3 class="title">
			<i class="fa-solid fa-minus"></i>
			<?php esc_html_e('Quy trình thi công', 'paint'); ?>
		</h3>

		<div class="content">
			<?php echo wpautop( get_post_meta(get_the_ID(), 'paint_cmb_product_procedure', true) ); ?>
		</div>
	</div>
</div>