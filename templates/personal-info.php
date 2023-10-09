<?php
/*
 Template Name: Thông tin cá nhân
 */

if (!is_user_logged_in()) {
  wp_redirect(home_url());
  exit;
}

global $current_user;

get_header();
?>

  <div class="site-container user-info-warp">
    <div class="container">
      <?php
      get_template_part('template-parts/account-management/inc', 'heading', [
        'title' => esc_html__('THÔNG TIN CÁ NHÂN')
      ]);
      ?>

      <div class="tab-user-info grid-info">
        <?php get_template_part('template-parts/account-management/inc', 'nav'); ?>

        <div class="tab-user-content">
          <form class="user-update-form">
            <div class="row columns-2">
              <div class="col">
                <div class="group-control">
                  <label for="user-name" class="form-label">
                    <?php esc_html_e('Tên đăng nhập', 'paint'); ?>
                  </label>

                  <input id="user-name" type="text" class="form-control" value="<?php echo esc_attr( $current_user->user_login ); ?>" aria-label="" readonly disabled>
                </div>

                <div class="group-control">
                  <label for="date-birth" class="form-label">
                    <?php esc_html_e('Ngày sinh', 'paint'); ?>
                  </label>

                  <input id="date-birth" type="date" class="form-control" value="" name="date-birth">
                </div>

                <div class="group-control">
                  <label for="email" class="form-label">
                    <?php esc_html_e('Email', 'paint'); ?>
                  </label>

                  <input id="email" type="email" class="form-control" value="<?php echo esc_attr( $current_user->user_email ); ?>" name="email">
                </div>

                <div class="group-control">
                  <label for="phone" class="form-label">
                    <?php esc_html_e('Số điện thoại', 'paint'); ?>
                  </label>

                  <input id="phone" type="tel" class="form-control" value="" name="phone">
                </div>
              </div>

              <div class="col">
                <div class="group-control">
                  <label class="form-label">
                    <?php esc_html_e('Địa chỉ', 'paint'); ?>
                  </label>

                  <input
                    id="province"
                    type="text"
                    class="form-control"
                    placeholder="<?php esc_attr_e('Tỉnh / Thành phố', 'paint'); ?>"
                    value=""
                    name="province"
                    aria-label=""
                  >

                  <input
                    id="district"
                    type="text"
                    class="form-control"
                    placeholder="<?php esc_attr_e('Quận / Huyện', 'paint'); ?>"
                    value=""
                    name="district"
                    aria-label=""
                  >

                  <input
                    id="wards"
                    type="text"
                    class="form-control"
                    placeholder="<?php esc_attr_e('Phường / Xã', 'paint'); ?>"
                    value=""
                    name="wards"
                    aria-label=""
                  >

                  <input
                    id="street"
                    type="text"
                    class="form-control"
                    placeholder="<?php esc_attr_e('Số nhà', 'paint'); ?>"
                    value=""
                    name="street"
                    aria-label=""
                  >
                </div>
              </div>
            </div>

            <div class="action-box text-center">
              <button type="submit" class="btn btn-submit">
                <?php esc_html_e('CẬP NHẬT THÔNG TIN', 'paint'); ?>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php
get_footer();
