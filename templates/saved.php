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

<div class="site-container user-info-warp user-saved-warp">
  <div class="container">
    <?php
    get_template_part('template-parts/account-management/inc', 'heading');
    ?>
    
    <div class="tab-user-info grid-info">
      <?php get_template_part('template-parts/account-management/inc', 'nav'); ?>
      
      <div class="tab-user-content"></div>
    </div>
  </div>
</div>

<?php
get_footer();
