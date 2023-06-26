<?php
/*
 Template Name: Introduce Page
 */

get_header();
?>

<div class="content-warp">
    <div class="element-section spacer-pt-breadcrumbs">
        <div class="container">
            <?php get_template_part( 'components/inc', 'breadcrumbs' ); ?>
        </div>
    </div>
    <!-- include about -->
    <div class="element-section element-spacer-pb">
        <div class="container">
		    <?php get_template_part( 'template-parts/introduce/inc', 'about' ); ?>
        </div>
    </div>

    <!-- our maxim -->
    <section class="element-section element-spacer background-color-white">
        <div class="container">
			<?php get_template_part( 'components/inc', 'our-maxim' ); ?>
        </div>
    </section>

    <!-- include gallery -->
    <div class="element-section">
	    <?php get_template_part( 'template-parts/introduce/inc', 'gallery' ); ?>
    </div>
</div>

<?php
get_footer();