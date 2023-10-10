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
$errorOldPassword = $errorPassword = $errorPasswordConfirm = '';

if ( !empty($currentUserId) && isset($_POST['f-submit']) && isset( $_POST['security'] ) && wp_verify_nonce( $_POST['security'], 'changePassword' ) ) {
  $old_password = $wpdb->_escape($_POST['old_password']);
  $password = $wpdb->_escape($_POST['password']);
  $passwordConfirm = $wpdb->_escape($_POST['password_confirm']);

  // check old password
  if ( empty($old_password) ) {
    $errors->add('old_password', esc_html__('Mật khẩu cũ không được để trống', 'paint'));
  }

  if ( !empty($old_password) && !wp_check_password( $old_password, $current_user->user_pass, $currentUserId ) ) {
    $errors->add('old_password', esc_html__('Mật khẩu cũ không đúng', 'paint'));
  }

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

  // error message
  if ( $errors->errors ) {
    $errorOldPassword = $errors->errors['old_password'][0] ?? '';
    $errorPassword = $errors->errors['password'][0] ?? '';
    $errorPasswordConfirm = $errors->errors['password_confirm'][0] ?? '';
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

            <?php if ( $errorOldPassword ) : ?>
              <p class="error">
                <?php echo esc_html($errorOldPassword); ?>
              </p>
            <?php endif; ?>
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

            <?php if ( $errorPassword ) : ?>
              <p class="error">
                <?php echo esc_html($errorPassword); ?>
              </p>
            <?php endif; ?>
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

            <?php if ( $errorPasswordConfirm ) : ?>
              <p class="error">
                <?php echo esc_html($errorPasswordConfirm); ?>
              </p>
            <?php endif; ?>
          </div>

          <div class="group-control action-box text-center">
            <button type="submit" name="f-submit" class="btn btn-submit">
              <?php esc_html_e('ĐỔI MẬT KHẨU', 'paint'); ?>
            </button>
          </div>

          <?php wp_nonce_field( 'changePassword', 'security' ); ?>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
get_footer();