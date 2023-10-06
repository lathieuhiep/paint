<?php
/*
 Template Name: Thông tin tài khoản
 */

if (!is_user_logged_in()) {
  wp_redirect(home_url());
  exit;
}

get_header();

$current_user = wp_get_current_user();
$first_name = get_user_meta($current_user->ID, 'first_name');
$last_name = get_user_meta($current_user->ID, 'last_name');
?>

  <div class="site-container user-info-warp">
    <div class="container">
      <div class="heading grid-info mb-5">
        <div class="heading__left"></div>

        <div class="heading__right text-center">
          <div class="avatar">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 64 ); ?>
          </div>

          <h4 class="name mt-3 mb-0 fw-normal">
            <?php echo esc_html($first_name[0] . ' ' . $last_name[0]) ?>
          </h4>
        </div>
      </div>

      <div class="tab-user-info grid-info">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <button class="nav-link active" id="v-pills-info-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home"
                  type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
            <?php esc_html_e('Thông tin cá nhân', 'paint'); ?>
          </button>

          <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile"
                  type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">
            <?php esc_html_e('Đã lưu', 'paint'); ?>
          </button>

          <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages"
                  type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">
            <?php esc_html_e('Đổi mật khẩu', 'paint'); ?>
          </button>

          <a class="nav-link" href="<?php echo wp_logout_url(home_url()); ?>">
            <?php esc_html_e('Đăng xuất', 'paint'); ?>
          </a>
        </div>

        <div class="tab-content" id="v-pills-tabContent">
          <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-info-tab">
            ...
          </div>
          <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...
          </div>
          <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...
          </div>
          <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...
          </div>
        </div>
      </div>
    </div>
  </div>

<?php
get_footer();
