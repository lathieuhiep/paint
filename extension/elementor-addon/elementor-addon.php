<?php
function paint_custom_elementor_content_width(): int
{
    return 1200;
}
add_filter( 'hello_elementor_content_width', 'paint_custom_elementor_content_width' );

// Register Category Elementor Addon
add_action( 'elementor/elements/categories_registered', 'paint_add_elementor_widget_categories' );
function paint_add_elementor_widget_categories( $elements_manager ): void {
	$elements_manager->add_category(
		'my-theme',
		[
			'title' => esc_html__( 'My Theme', 'paint' ),
			'icon'  => 'icon-goes-here',
		]
	);
}

// Register widgets
add_action( 'elementor/widgets/register', 'paint_register_widget_elementor_addon' );
function paint_register_widget_elementor_addon( $widgets_manager ): void {
	// include add on
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/slider.php' );
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/image-grid-box.php' );
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/gallery-grid-box.php' );
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/album-gallery.php' );
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/slider-carousel.php' );
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/post-carousel.php' );
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/contact-form-7.php' );
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/heading-between-line.php' );
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/about-slider.php' );


//    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/post-grid.php' );
//    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/banner.php' );
//    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/about-us.php' );
//    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/category-list.php' );

//    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/circular-progress.php' );

//    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/safety-principles.php' );
//    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/doctor-slider.php' );
//    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/step-list.php' );
//    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/testimonial-slider.php' );

//    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/list-image-content.php' );
//    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/list-content-number.php' );
//    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/contact-us.php' );

	// register add on
    $widgets_manager->register( new \Paint_Elementor_Slider() );
    $widgets_manager->register( new \Paint_Elementor_Image_Grid_Box() );
    $widgets_manager->register( new \Paint_Elementor_Gallery_Grid_Box() );
    $widgets_manager->register( new \Paint_Elementor_Album_Gallery() );
    $widgets_manager->register( new \Paint_Elementor_Slider_Carousel() );
    $widgets_manager->register( new \Paint_Elementor_Post_Carousel() );
    $widgets_manager->register( new \Paint_Elementor_Contact_Form_7() );
    $widgets_manager->register( new \Paint_Elementor_Heading_Between_Line() );
    $widgets_manager->register( new \Paint_Elementor_About_Slider() );

//    $widgets_manager->register( new \Paint_Elementor_Post_Grid() );
//    $widgets_manager->register( new \Paint_Elementor_Banner() );
//    $widgets_manager->register( new \Paint_Elementor_About_Us() );
//    $widgets_manager->register( new \Paint_Elementor_Category_List() );

//    $widgets_manager->register( new \Paint_Elementor_Circular_Progress() );

//    $widgets_manager->register( new \Paint_Elementor_Safety_Principles() );
//    $widgets_manager->register( new \Paint_Elementor_Doctor_Slider() );
//    $widgets_manager->register( new \Paint_Elementor_Step_List() );
//    $widgets_manager->register( new \Paint_Elementor_Testimonial_Slider() );

//    $widgets_manager->register( new \Paint_Elementor_List_image_Content() );
//    $widgets_manager->register( new \Paint_Elementor_List_Content_Number() );
//    $widgets_manager->register( new \Paint_Elementor_Contact_Us() );
}

// Register scripts lib
add_action( 'wp_enqueue_scripts', 'paint_load_script_libs', 10 );
function paint_load_script_libs(): void
{
    $paint_check_elementor = get_post_meta( get_the_ID(), '_elementor_edit_mode', true );

    if ( $paint_check_elementor == 'builder' ) {
        // owl carousel
        wp_enqueue_style( 'owl.carousel.min', get_theme_file_uri( '/assets/libs/owl.carousel/owl.carousel.min.css' ), array(), null );
        wp_enqueue_script( 'owl.carousel.min', get_theme_file_uri( '/assets/libs/owl.carousel/owl.carousel.min.js' ), array( 'jquery' ), '2.3.4', true );


    }
}

// Register scripts
add_action( 'wp_enqueue_scripts', 'paint_elementor_scripts', 11 );
function paint_elementor_scripts(): void {
	$paint_check_elementor = get_post_meta( get_the_ID(), '_elementor_edit_mode', true );

	if ( $paint_check_elementor == 'builder' ) {
        wp_enqueue_style( 'paint-elementor-style', get_theme_file_uri( '/extension/elementor-addon/css/elementor-addon.min.css' ), array(), paint_get_version_theme() );

		// script
        wp_enqueue_script( 'paint-elementor-script', get_theme_file_uri( '/extension/elementor-addon/js/elementor-addon.min.js' ), array( 'jquery' ), null, true );
	}
}

function addZeroBeforeNumber(int $number): int|string {
	if ( $number < 10 ) {
		return '0' . $number;
	}

	return $number;
}