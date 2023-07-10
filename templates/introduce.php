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

    <!-- our maxim -->
    <section class="element-section element-section-our-maxim">
      <div class="container">
        <?php get_template_part('components/inc', 'our-maxim'); ?>
      </div>
    </section>

    <!-- Technology -->
    <section class="element-section element-section-space-pt element-section-technology">
      <div class="container">
        <?php
        get_template_part('components/inc', 'heading-underline', array(
          'title' => esc_html__('Công nghệ', 'paint')
        ));

        get_template_part('template-parts/introduce/inc', 'technology');
        ?>
      </div>
    </section>

    <!-- include gallery -->
    <div class="element-section element-section-space-pt">
      <div class="container">
        <?php
        get_template_part('components/inc', 'heading-underline', array(
          'title' => esc_html__('Chứng nhận chất lượng', 'paint')
        ));

        get_template_part('template-parts/introduce/inc', 'certification');
        ?>
      </div>
    </div>

    <!-- include community -->
    <div class="element-section element-section-space element-section-community">
      <?php
      get_template_part('components/inc', 'heading-underline', array(
        'title' => esc_html__('Hoạt động vì cộng đồng', 'paint')
      ));

      get_template_part('template-parts/introduce/inc', 'community');
      ?>
    </div>

    <!-- newsletter -->
    <section class="element-section element-section-newsletter mb-5">
      <div class="container">
        <?php get_template_part('components/inc', 'newsletter'); ?>
      </div>
    </section>
  </div>

<?php
get_footer();