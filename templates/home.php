<?php
/*
 Template Name: Home Page
 */

get_header();
?>

  <div class="content-warp">
    <!-- Slider -->
    <div class="element-section">
      <?php get_template_part('components/inc', 'short-code-slider', array('opt' => 'template_home_opt_short_code_slider')); ?>
    </div>

    <!-- count up -->
    <section class="element-section element-spacer element-section-about background-color-white">
      <div class="container">
        <?php
          get_template_part('components/inc', 'heading-line', array(
           'title' => esc_html__('Về Chúng Tôi', 'paint')
          ));
        ?>

        <div class="row">
          <div class="col-12 col-md-4 mb-5 mb-md-0">
            <?php get_template_part('components/inc', 'count-up'); ?>
          </div>

          <div class="col-12 col-md-8">
            <?php get_template_part('components/inc', 'services'); ?>
          </div>
        </div>

      </div>
    </section>

    <!-- products -->
    <section class="element-section element-spacer element-section-products">
      <div class="container">
        <?php
        get_template_part('components/inc', 'heading-line', array(
          'title' => esc_html__('Sản phẩm', 'paint')
        ));

        get_template_part('components/inc', 'products');
        ?>
      </div>
    </section>

    <!-- project -->
    <section class="element-section element-section-project background-color-white">
      <div class="container">
        <?php
        get_template_part('components/inc', 'heading-line', array(
          'title' => esc_html__('Dự án', 'paint')
        ));

        get_template_part('components/inc', 'project');
        ?>
      </div>
    </section>

    <!-- discover -->
    <div class="element-section element-spacer element-section-discover">
      <div class="container">
        <?php
        get_template_part('components/inc', 'heading-line', array(
          'title' => esc_html__('Khám phá', 'paint')
        ));

        get_template_part('components/inc', 'discover');
        ?>
      </div>
    </div>

    <!-- posts slider -->
    <section class="element-section element-spacer background-color-white">
      <div class="container">
        <?php
        get_template_part('components/inc', 'heading-line', array(
          'title' => esc_html__('Bài viết', 'paint')
        ));

        get_template_part('components/inc', 'post-slider');
        ?>
      </div>
    </section>

    <!-- newsletter -->
    <section class="element-section element-section-newsletter mb-5">
      <div class="container">
        <?php get_template_part('components/inc', 'newsletter'); ?>
      </div>
    </section>
  </div>

<?php
get_footer();
