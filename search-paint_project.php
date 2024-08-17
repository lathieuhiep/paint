<?php
get_header();

$search_query = get_search_query();
?>

<div class="site-container site-result-project">
  <div class="container">
    <?php
    get_template_part('template-parts/project/inc', 'search-cat');

    if ($search_query) :
    ?>
      <header class="heading">
        <h1 class="page-title">
          <?php _e('Kết quả tìm kiếm cho', 'paint'); ?>: "<?php echo esc_html($search_query); ?>"
        </h1>
      </header>
    <?php
    endif;

    if (have_posts()) :
    ?>
      <div class="project-grid project-layout">
        <?php
        while (have_posts()) : the_post();

          get_template_part('template-parts/project/inc', 'item');

        endwhile;
        wp_reset_postdata();
        ?>
      </div>
    <?php
        paint_pagination();
    else:
    ?>
    <p class="text-note">
      <?php esc_html_e('Không có kết quả phù hợp', 'paint'); ?>
    </p>
    <?php endif; ?>
  </div>
</div>

<?php
get_footer();
