<?php

// Remove jquery migrate
add_action('wp_default_scripts', 'paint_remove_jquery_migrate');
function paint_remove_jquery_migrate($scripts): void
{
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        if ($script->deps) {
            $script->deps = array_diff($script->deps, array('jquery-migrate'));
        }
    }
}

//Register Back-End script
add_action('admin_enqueue_scripts', 'paint_register_back_end_scripts');

function paint_register_back_end_scripts(): void
{
    
    /* Start Get CSS Admin */
    wp_enqueue_style('paint-admin-styles', get_theme_file_uri('/extension/assets/css/admin-styles.css'));
    
    /* Start Get Js Admin */
    wp_enqueue_script('admin', get_theme_file_uri('/extension/assets/js/admin.js'), array('jquery'), '', true);
}

//Register Front-End Styles
add_action('wp_enqueue_scripts', 'paint_register_front_end');

function paint_register_front_end(): void
{
    
    if (is_singular('paint_product')) {
        wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap', array(), null);
    }
    
    /* Start main Css */
    wp_enqueue_style('paint-library', get_theme_file_uri('/assets/css/library.min.css'), array(), '');
    /* End main Css */
    
    /* Start main Css */
    wp_enqueue_style('fontawesome', get_theme_file_uri('/assets/fonts/fontawesome/css/all.min.css'), array(), '5.12.1');
    /* End main Css */
    
    /*  Start Style Css   */
    wp_enqueue_style('paint-style', get_stylesheet_uri());
    /*  Start Style Css   */
    
    /*
    * End Get Css Front End
    * */
    
    /*
    * Start Get Js Front End
    * */
    // url ajax
    $paint_admin_url_ajax = admin_url('admin-ajax.php');
    
    wp_enqueue_script('paint-library', get_theme_file_uri('/assets/js/library.min.js'), array('jquery'), '', true);
    
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    
    wp_enqueue_script('paint-custom', get_theme_file_uri('/assets/js/custom.js'), array(), '1.0.0', true);
    
    if (is_singular('paint_product')) {
        wp_enqueue_script('product-detail', get_theme_file_uri('/assets/js/product-detail.js'), array(), '1.0.0', true);
        wp_localize_script('product-detail', 'productDetailAjax', array('url' => $paint_admin_url_ajax));
    }
    
    // template discover
    if (is_post_type_archive('paint_discover') || is_singular('paint_discover') || (is_search() && $_GET['post_type'] == 'paint_discover')) {
        wp_enqueue_script('discover', get_theme_file_uri('/assets/js/discover.js'), array(), '1.0.0', true);
        wp_localize_script('discover', 'discoverAjax', array('url' => $paint_admin_url_ajax));
    }
    
    // template register
    if (is_page_template('templates/register.php')) {
        wp_enqueue_script('cleave.min', get_theme_file_uri('/assets/libs/cleave/cleave.min.js'), array(), '1.6.0', true);
        wp_enqueue_script('jquery.validate.min', get_theme_file_uri('/assets/libs/validate/jquery.validate.min.js'), array(), '1.19.5', true);
        wp_enqueue_script('template-register', get_theme_file_uri('/assets/js/template-register.js'), array(), '', true);
    }
    
    // template login
    if (is_page_template('templates/login.php')) {
        wp_enqueue_script('jquery.validate.min', get_theme_file_uri('/assets/libs/validate/jquery.validate.min.js'), array(), '1.19.5', true);
        wp_enqueue_script('template-login', get_theme_file_uri('/assets/js/template-login.js'), array(), '1.0.0', true);
        wp_localize_script('template-login', 'loginAjax', array('url' => $paint_admin_url_ajax));
    }
    
    // template personal info
    if (is_page_template('templates/personal-info.php')) {
        wp_enqueue_script('cleave.min', get_theme_file_uri('/assets/libs/cleave/cleave.min.js'), array(), '1.6.0', true);
        wp_enqueue_script('jquery.validate.min', get_theme_file_uri('/assets/libs/validate/jquery.validate.min.js'), array(), '1.19.5', true);
        wp_enqueue_script('template-personal-info', get_theme_file_uri('/assets/js/template-personal-info.js'), array(), '', true);
    }
    
    /*
   * End Get Js Front End
   * */
   
}