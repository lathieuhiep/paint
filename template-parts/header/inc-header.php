<?php
$sticky_menu = paint_get_option('general_option_menu_sticky', true);
$logo = paint_get_option('general_opt_logo', '');
?>

<header class="site-header<?php echo esc_attr($sticky_menu ? ' active-sticky-nav' : ''); ?>">
  <nav class="main-navigation container">
    <div class="site-navbar">
      <div class="site-logo d-lg-flex align-items-lg-center">
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

        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#site-menu"
                aria-controls="site-menu" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars" aria-hidden="true"></i>
        </button>
      </div>

      <div id="site-menu" class="site-menu collapse navbar-collapse d-lg-flex justify-content-lg-end">
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

        <div class="site-user">
          <div class="site-user__box text-lg-end">
            <i class="fa-regular fa-circle-user"></i>

            <?php
            if ( is_user_logged_in() ) :
              $current_user = wp_get_current_user();
              ?>

              <span class="user-name"><?php echo esc_html($current_user->user_nicename); ?></span>

              <button class="btn btn-collapse-user d-lg-none p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#userManagerBox" aria-expanded="false" aria-controls="collapseExample">
                <i class="fa-solid fa-angle-down"></i>
              </button>

            <?php else: ?>
              <a class="txt-login" href="<?php echo esc_url( paint_get_tpl_url('templates/login.php') ) ?>">
                <?php esc_html_e('Đăng nhập', 'paint'); ?>
              </a>
            <?php endif; ?>
          </div>

          <?php if (is_user_logged_in()) : ?>
            <ul id="userManagerBox" class="site-user__manager collapse">
              <li>
                <a href="<?php echo esc_url( paint_get_tpl_url('templates/personal-info.php') ); ?>">
                  <?php esc_html_e('Thông tin tài khoản', 'paint'); ?>
                </a>
              </li>

              <li>
                <a href="<?php echo esc_url( paint_get_tpl_url('templates/saved.php') ); ?>">
                  <?php esc_html_e('Đã lưu', 'paint'); ?>
                </a>
              </li>

              <li>
                <a href="<?php echo esc_url( paint_get_tpl_url('templates/change-password.php') ); ?>">
                  <?php esc_html_e('Đổi mật khẩu', 'paint'); ?>
                </a>
              </li>

              <li>
                <a href="<?php echo wp_logout_url( home_url() ); ?>">
                  <?php esc_html_e('Đăng xuất', 'paint'); ?>
                </a>
              </li>
            </ul>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>
</header>