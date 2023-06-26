<div class="site-tool-warp site-tool-cat element-spacer-pb">
	<?php get_template_part( 'components/inc', 'banner', array('opt' => 'paint_opt_tool_banner') ); ?>

	<div class="container">
		<div class="spacer-pt-breadcrumbs">
			<?php get_template_part( 'components/inc', 'breadcrumbs' ); ?>
		</div>

		<div class="grid-warp <?php echo esc_attr( is_active_sidebar( 'paint-sidebar-tool' ) ? 'active-sidebar' : '' ); ?>">
			<?php if ( is_active_sidebar( 'paint-sidebar-tool' ) ) : ?>
				<div class="sidebar">
					<?php dynamic_sidebar( 'paint-sidebar-tool' ); ?>
				</div>
			<?php
			endif;

			get_template_part( 'template-parts/tool/inc', 'tax-tool' );
			?>
		</div>
	</div>
</div>