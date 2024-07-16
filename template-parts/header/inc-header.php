<?php
$sticky_menu = paint_get_option('general_option_menu_sticky', true);
$logo = paint_get_option('general_opt_logo', '');
?>

<header class="site-header<?php echo esc_attr($sticky_menu ? ' active-sticky-nav' : ''); ?>">
    <div class="top-box">
        <div class="container">
            <div class="grid-content">
                <div class="search-form-warp">
                    <?php get_search_form(); ?>
                </div>

                <div class="social-warp">
                    <?php paint_get_social_url(); ?>
                </div>
            </div>
        </div>
    </div>

    <nav class="main-navigation">
        <div class="container">
            <div class="site-navbar">
                <div class="site-logo d-flex align-items-lg-center">
                    <a href="<?php echo esc_url(get_home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
                        <?php
                        if (!empty($logo['id'])) :
                            echo wp_get_attachment_image($logo['id'], 'full');
                        else :
                            ?>
                            <img class="logo-default"
                                 src="<?php echo esc_url(get_theme_file_uri('/assets/images/logo.png')) ?>"
                                 alt="<?php echo esc_attr(get_bloginfo('title')); ?>" width="auto" height="auto"/>

                        <?php endif; ?>
                    </a>

                    <button class="btn btn-primary btn-close-canvas d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </button>
                </div>

                <div id="site-menu" class="site-menu collapse navbar-collapse d-lg-flex">
                    <?php
                    if (has_nav_menu('primary')) :

                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_class' => 'navbar-nav flex-lg-row',
                            'container' => false,
                        ));

                    else:
                        ?>
                        <ul class="main-menu">
                            <li>
                                <a href="<?php echo get_admin_url() . '/nav-menus.php'; ?>">
                                    <?php esc_html_e('ADD TO MENU', 'paint'); ?>
                                </a>
                            </li>
                        </ul>
                    <?php endif; ?>

                    <?php get_template_part('template-parts/header/inc','user'); ?>
                </div>
            </div>
        </div>
    </nav>
</header>