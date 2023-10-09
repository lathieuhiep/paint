<?php
/*
 Template Name: Đổi mật khẩu
 */

if (!is_user_logged_in()) {
  wp_redirect(home_url());
  exit;
}

global $wpdb;
global $current_user;
$currentUserId = $current_user->id;

$old_password = $password = '';

$errors = new WP_Error();
$errorPassword = $errorPasswordConfirm = '';

if ( !empty($currentUserId) && isset($_POST['f-submit']) && isset( $_POST['formType'] ) && wp_verify_nonce( $_POST['formType'], 'changePassword' ) ) {
  $old_password = $wpdb->_escape($_POST['old_password']);
  $password = $wpdb->_escape($_POST['password']);
  $passwordConfirm = $wpdb->_escape($_POST['password_confirm']);

  // check validate password
  if ( strlen($password) < 8  ) {
    $errors->add('password', esc_html__('Độ dài tối thiểu của mật khẩu là 8 kí tự', 'paint'));
  }

  if ( strlen($password) > 32  ) {
    $errors->add('password', esc_html__('Độ dài tối đa của mật khẩu là 32 kí tự', 'paint'));
  }

  if ( strcmp($password, $passwordConfirm) !== 0 ) {
    $errors->add('password_confirm', esc_html__('Mật khẩu không khớp', 'paint'));
  }
}

get_header();
?>

<div class="site-container user-info-warp">
  <div class="container">
    <?php
    get_template_part('template-parts/account-management/inc', 'heading', [
      'title' => esc_html__('ĐỔI MẬT KHẨU')
    ]);
    ?>

    <div class="tab-user-info grid-info">
      <?php get_template_part('template-parts/account-management/inc', 'nav'); ?>

      <div class="tab-user-content">
        <form id="change-password-form" class="user-update-form change-password-form" method="post">
          <div class="group-control">
            <label for="old-password" class="form-label">
              <?php esc_html_e('Mật khẩu cũ', 'paint'); ?>
            </label>

            <input
              id="old-password"
              name="old_password"
              type="password"
              class="form-control"
              value=""
            >
          </div>

          <div class="group-control">
            <label for="password" class="form-label">
              <?php esc_html_e('Mật khẩu mới', 'paint'); ?>
            </label>

            <input
              id="password"
              name="password"
              type="password"
              class="form-control"
              value=""
            >
          </div>

          <div class="group-control">
            <label for="password-confirm" class="form-label">
              <?php esc_html_e('Nhập lại mật khẩu mới', 'paint'); ?>
            </label>

            <input
              id="password-confirm"
              type="password"
              class="form-control"
              name="password_confirm"
              value=""
            >
          </div>

          <div class="group-control action-box text-center">
            <?php wp_nonce_field( 'changePassword', 'formType' ); ?>

            <button type="submit" name="f-submit" class="btn btn-submit">
              <?php esc_html_e('ĐỔI MẬT KHẨU', 'paint'); ?>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
get_footer();