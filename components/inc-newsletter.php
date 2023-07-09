<?php
$desc = paint_get_option('template_home_opt_newsletter');
$shortcode = paint_get_option('template_home_opt_newsletter_shortcode');

if ( function_exists('newsletter_form') && $shortcode ) :
?>
<div class="element-newsletter">
  <div class="element-newsletter__desc">
    <?php echo esc_html( $desc ); ?>
  </div>

  <div class="element-newsletter__shortcode">
    <?php echo do_shortcode($shortcode); ?>
  </div>
</div>
<?php
endif;
