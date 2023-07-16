<?php
$term = [];

if (is_post_type_archive('paint_project')) {
  $title = get_the_archive_title();
} else {
  $term = get_queried_object();
  $title = $term->name;
}
?>
<div class="site-container site-project-cat">
  <div class="container">
    <h1 class="heading text-center text-uppercase">
      <?php echo esc_html($title); ?>
    </h1>

    <?php
    if (have_posts()) :
      $taxonomies = get_terms(array(
        'taxonomy' => 'paint_project_cat',
        'hide_empty' => false
      ));
    ?>
      <div class="top-action">
        <ul class="list-cat d-flex align-items-center justify-content-center flex-wrap">
          <li class="list-cat__item<?php echo esc_attr( is_post_type_archive('paint_project') ? ' active' : '' ); ?>">
            <a href="<?php echo esc_url(get_post_type_archive_link('paint_project')); ?>">
              <?php esc_html_e('Tất cả', 'paint'); ?>
            </a>
          </li>

          <?php
          if ($taxonomies) :
            foreach ($taxonomies as $taxonomy):
          ?>
            <li class="list-cat__item<?php echo esc_attr( !empty($term) && $term->term_id == $taxonomy->term_id ? ' active' : '' ); ?>">
              <a href="<?php echo esc_url(get_term_link($taxonomy->slug, 'paint_project_cat')); ?>"
                 title="<?php echo esc_attr($taxonomy->name); ?>">
                <?php echo esc_html($taxonomy->name); ?>
              </a>
            </li>
          <?php
            endforeach;
          endif;
          ?>
        </ul>

        <?php get_template_part('template-parts/project/inc', 'search'); ?>
      </div>

      <div class="project-grid">
        <?php
        while (have_posts()) : the_post();

          get_template_part('template-parts/project/inc', 'item');

        endwhile;
        wp_reset_postdata();
        ?>
      </div>
      <?php
      paint_pagination();
    endif;
    ?>
  </div>

  <!-- newsletter -->
  <section class="element-section element-section-newsletter">
    <div class="container">
      <?php get_template_part('components/inc', 'newsletter'); ?>
    </div>
  </section>
</div>