<?php
$sidebar = paint_get_option('paint_opt_blog_cat_sidebar', 'right');
$per_row = paint_get_option('paint_opt_blog_per_row', '2');

$class_col_content = paint_col_use_sidebar($sidebar, 'paint-sidebar-main');
?>

<div class="site-blog">
  <div class="container">
    <div class="grid">
      <?php
      if (have_posts()) :
      $i = 1;
      while (have_posts()) : the_post();
        ?>
        <div id="post-<?php the_ID(); ?>" class="item">
          <figure class="item__image">
            <?php the_post_thumbnail('large'); ?>
          </figure>

          <div class="item__entry">
            <h2 class="item__title">
              <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
              </a>
            </h2>

            <?php if ($i == 1 || $i > 3) : ?>
              <p class="item__date">
                <?php echo get_the_date(); ?>
              </p>

              <div class="item__excerpt">
                <p>
                  <?php
                  if (has_excerpt()) :
                    echo esc_html(get_the_excerpt());
                  else:
                    echo wp_trim_words(get_the_content(), 20, '...');
                  endif;
                  ?>
                </p>

                <?php paint_link_page(); ?>
              </div>
            <?php
            endif;

            if ($i > 3) :
              ?>
              <a href="<?php the_permalink(); ?>" class="text-read-more">
                <span><?php esc_html_e('Xem bài viết', 'paint'); ?></span>

                <i class="fa-solid fa-arrow-right"></i>
              </a>
            <?php endif; ?>
          </div>
        </div>
        <?php
        $i++;
      endwhile;

      wp_reset_postdata();
      ?>
    </div>

    <?php
    paint_pagination();
    else:
      if (is_search()) :
        get_template_part('template-parts/search/content', 'no-data');
      endif;
    endif;
    ?>
  </div>
</div>