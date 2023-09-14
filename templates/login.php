<?php
/*
 Template Name: Login Page
 */

get_header();
?>
  <div class="site-container login-warp user-warp">
    <div class="container">
      <div class="grid">
        <div class="grid__item d-flex align-items-center">
          <h1 class="page-title text-uppercase m-0">
            <?php the_title(); ?>
          </h1>
        </div>

        <div class="grid__item">
          <?php wp_login_form(); ?>

        </div>
      </div>
    </div>
  </div>
<?php
get_footer();
