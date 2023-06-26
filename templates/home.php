<?php
/*
 Template Name: Home Page
 */

get_header();
?>

<div class="content-warp">
    <!-- banner 1 -->
    <div class="element-section">
        <?php get_template_part( 'components/inc', 'banner', array('opt' => 'template_home_opt_banner_1') ); ?>
    </div>

    <!-- our maxim -->
    <section class="element-section element-spacer background-color-white">
        <div class="container">
	        <?php get_template_part( 'components/inc', 'our-maxim' ); ?>
        </div>
    </section>

    <!-- banner 2 -->
    <div class="element-section">
		<?php get_template_part( 'components/inc', 'banner', array('opt' => 'template_home_opt_banner_2') ); ?>
    </div>

    <!-- products add tool -->
    <section class="element-section element-spacer element-section-products element-background-image">
        <div class="container">
            <?php
            get_template_part('components/inc', 'heading', array('opt' => 'template_home_opt_product_heading'));
            get_template_part( 'components/inc', 'products' );

            get_template_part('components/inc', 'heading', array('opt' => 'template_home_opt_tool_heading'));
            get_template_part( 'components/inc', 'tool' );
            ?>
        </div>
    </section>

    <!-- count up -->
    <section class="element-section element-spacer background-color-white">
        <div class="container">
			<?php get_template_part( 'components/inc', 'count-up' ); ?>
        </div>
    </section>

    <!-- project -->
    <section class="element-section element-section-project element-background-image">
        <div class="container">
			<?php get_template_part( 'components/inc', 'project' ); ?>
        </div>
    </section>

    <!-- services -->
    <section class="element-section background-color-white">
        <div class="container">
			<?php get_template_part( 'components/inc', 'services' ); ?>
        </div>
    </section>

    <!-- testimonial -->
    <section class="element-section element-spacer element-background-image background-color-yellow">
        <div class="container">
			<?php get_template_part( 'components/inc', 'testimonial' ); ?>
        </div>
    </section>

    <!-- posts slider -->
    <section class="element-section element-spacer">
        <div class="container">
			<?php get_template_part( 'components/inc', 'post-slider'); ?>
        </div>
    </section>
</div>

<?php
get_footer();
