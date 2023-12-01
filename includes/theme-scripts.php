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
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap', array(), null);

    // get style bootstrap
    wp_enqueue_style('bootstrap', get_theme_file_uri('/assets/libs/bootstrap/css/bootstrap.min.css'), array(), '5.2.3');

    // get style lib slick
    if (is_page_template('templates/home.php') || is_singular('paint_project') || is_singular('paint_tool') || is_singular('paint_discover') || is_singular('post') || is_tax('paint_project_cat') || is_post_type_archive('paint_project') || is_tax('paint_discover_cat') || is_post_type_archive('paint_discover')) {
        wp_enqueue_style('slick-carousel', get_theme_file_uri('/assets/libs/slick-carousel/css/slick.min.css'), array(), '1.8.1');
    }

    if (is_singular('paint_discover')) {
        wp_enqueue_style('lity', get_theme_file_uri('/assets/libs/lity/lity.min.css'), array(), '');
    }

    /* Start main Css */
    wp_enqueue_style('fontawesome', get_theme_file_uri('/assets/fonts/fontawesome/css/all.min.css'), array(), '5.12.1');
    /* End main Css */

    /*  Start Style Css   */
    wp_enqueue_style('paint-style', get_stylesheet_uri());
    /*  Start Style Css   */

    // get style template home
    if (is_page_template('templates/home.php')) {
        wp_enqueue_style('template_home', get_theme_file_uri('/assets/css/templates/template_home.css'), array(), '');
    }

    // get style template introduce
    if (is_page_template('templates/introduce.php')) {
        wp_enqueue_style('template_introduce', get_theme_file_uri('/assets/css/templates/template_introduce.css'), array(), '');
    }

    // get style template FAQ
    if (is_page_template('templates/faq.php')) {
        wp_enqueue_style('template_faq', get_theme_file_uri('/assets/css/templates/template_faq.css'), array(), '');
    }

    // get style archive product
    if (is_tax('paint_product_cat') || is_post_type_archive('paint_product')) {
        wp_enqueue_style('archive-product', get_theme_file_uri('/assets/css/post-type/product/archive.css'), array(), '');
    }

    if (is_singular('paint_product')) {
        wp_enqueue_style('single-product', get_theme_file_uri('/assets/css/post-type/product/single.css'), array(), '');
    }

    // get style post type project
    if (is_tax('paint_project_cat') || is_post_type_archive('paint_project') || (is_search() && $_GET['post_type'] == 'paint_project')) {
        wp_enqueue_style('archive-project', get_theme_file_uri('/assets/css/post-type/project/archive.css'), array(), '');
    }

    if (is_singular('paint_project')) {
        wp_enqueue_style('single-project', get_theme_file_uri('/assets/css/post-type/project/single.css'), array(), '');
    }

    // get style post type tool
    if (is_tax('paint_tool_cat') || is_post_type_archive('paint_tool')) {
        wp_enqueue_style('archive-tool', get_theme_file_uri('/assets/css/post-type/tool/archive.css'), array(), '');
    }

    if (is_singular('paint_tool')) {
        wp_enqueue_style('single-tool', get_theme_file_uri('/assets/css/post-type/tool/single.css'), array(), '');
    }

    // get style post type discover
    if (is_tax('paint_discover_cat') || is_post_type_archive('paint_discover') || (is_search() && $_GET['post_type'] == 'paint_discover')) {
        wp_enqueue_style('archive-discover', get_theme_file_uri('/assets/css/post-type/discover/archive.css'), array(), '');
    }

    if (is_singular('paint_discover')) {
        wp_enqueue_style('single-discover', get_theme_file_uri('/assets/css/post-type/discover/single.css'), array(), '');
    }

    // get style post
    if (paint_is_blog()) {
        wp_enqueue_style('archive-post', get_theme_file_uri('/assets/css/post-type/post/archive.css'), array(), '');
    }

    if (is_singular('post')) {
        wp_enqueue_style('single-post', get_theme_file_uri('/assets/css/post-type/post/single.css'), array(), '');
    }

    // get style template register, login
    if (is_page_template('templates/register.php') || is_page_template('templates/login.php') || is_page_template('templates/saved.php') || is_page_template('templates/change-password.php') || is_page_template('templates/personal-info.php')) {
        wp_enqueue_style('template_user', get_theme_file_uri('/assets/css/templates/template_user.css'), array(), '');
    }

    // get style template personal-info
    if (is_page_template('templates/personal-info.php') || is_page_template('templates/saved.php') || is_page_template('templates/change-password.php')) {
        wp_enqueue_style('template_acc_info', get_theme_file_uri('/assets/css/templates/template_acc_info.css'), array(), '');
    }

    /*
    * End Get Css Front End
    * */

    /*
    * Start Get Js Front End
    * */
    // url ajax
    $paint_admin_url_ajax = admin_url('admin-ajax.php');

    // get bootstrap js
    wp_enqueue_script('bootstrap', get_theme_file_uri('/assets/libs/bootstrap/js/bootstrap.bundle.min.js'), array('jquery'), '5.2.3', true);

    // get lib slick
    if (is_page_template('templates/home.php') || is_singular('paint_project') || is_singular('paint_tool') || is_singular('paint_discover') || is_singular('post') || is_tax('paint_project_cat') || is_post_type_archive('paint_project') || is_tax('paint_discover_cat') || is_post_type_archive('paint_discover')) {
        wp_enqueue_script('slick-carousel', get_theme_file_uri('/assets/libs/slick-carousel/js/slick.min.js'), array('jquery'), '1.8.1', true);
    }

    // get lib lity
    if (is_singular('paint_discover')) {
        wp_enqueue_script('lity', get_theme_file_uri('/assets/libs/lity/lity.min.js'), array('jquery'), '', true);
    }

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_enqueue_script('paint-custom', get_theme_file_uri('/assets/js/custom.js'), array(), '1.0.0', true);

    // get js template
    if (is_page_template('templates/home.php') || is_page_template('templates/introduce.php')) {
        wp_enqueue_script('count-up-scroll', get_theme_file_uri('/assets/js/components/count-up-scroll.js'), array('jquery'), '', true);
    }

    if (is_singular('paint_product')) {
        wp_enqueue_script('masonry.min', get_theme_file_uri('/assets/libs/masonry/masonry.min.js'), array('jquery'), '', true);
        wp_enqueue_script('product-detail', get_theme_file_uri('/assets/js/product-detail.js'), array(), '1.0.0', true);
        wp_localize_script('product-detail', 'productDetailAjax', array('url' => $paint_admin_url_ajax));
    }

    // template discover
    if (is_tax('paint_discover_cat') || is_post_type_archive('paint_discover') || is_singular('paint_discover') || (is_search() && $_GET['post_type'] == 'paint_discover')) {
        wp_enqueue_script('masonry.min', get_theme_file_uri('/assets/libs/masonry/masonry.min.js'), array('jquery'), '', true);
        wp_enqueue_script('discover', get_theme_file_uri('/assets/js/discover.js'), array(), '1.0.0', true);
        wp_localize_script('discover', 'discoverAjax', array('url' => $paint_admin_url_ajax));
    }

    if (is_singular(array('paint_discover', 'paint_project'))) {
        wp_enqueue_script('user-save', get_theme_file_uri('/assets/js/user-save.js'), array(), '1.0.0', true);
        wp_localize_script('user-save', 'userSaveAjax', array('url' => $paint_admin_url_ajax));
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

    // template change password
    if (is_page_template('templates/change-password.php')) {
        wp_enqueue_script('jquery.validate.min', get_theme_file_uri('/assets/libs/validate/jquery.validate.min.js'), array(), '1.19.5', true);
        wp_enqueue_script('template-change-password', get_theme_file_uri('/assets/js/template-change-password.js'), array(), '1.0.0', true);
        wp_localize_script('template-change-password', 'changePasswordAjax', array('url' => $paint_admin_url_ajax));
    }

    // template user saved
    if (is_page_template('templates/saved.php')) {
        wp_enqueue_script('masonry.min', get_theme_file_uri('/assets/libs/masonry/masonry.min.js'), array('jquery'), '', true);
        wp_enqueue_script('template-user-saved', get_theme_file_uri('/assets/js/template-user-saved.js'), array(), '1.0.0', true);
        wp_localize_script('template-user-saved', 'templateUserSaveAjax', array('url' => $paint_admin_url_ajax));
    }

    /*
   * End Get Js Front End
   * */

}