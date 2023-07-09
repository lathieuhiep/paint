<?php
/*
 Template Name: Introduce Page
 */

get_header();
?>

  <div class="content-warp">
    <!-- include about -->
    <div class="element-section element-spacer background-color-white">
      <div class="container">
        <?php get_template_part('template-parts/introduce/inc', 'about'); ?>
      </div>
    </div>

    <!-- About -->
    <section class="element-section element-spacer">
      <div class="container">
        <?php
        get_template_part('components/inc', 'heading-underline', array(
          'title' => esc_html__('Chúng tôi làm gì', 'paint')
        ));

        get_template_part('components/inc', 'services');
        ?>
      </div>
    </section>

    <!-- count up -->
    <div class="element-section element-section-introduce-count-up background-color-white">
      <div class="container">
        <?php get_template_part('components/inc', 'count-up'); ?>
      </div>
    </div>

    <!-- include gallery -->
    <div class="element-section">
      <?php get_template_part('template-parts/introduce/inc', 'gallery'); ?>
    </div>
  </div>

<?php
get_footer();