<?php
/*
 Template Name: Đã lưu
 */

if (!is_user_logged_in()) {
  wp_redirect(home_url());
  exit;
}

get_header();
?>

<?php
get_footer();
