<?php
$list_cate = get_the_terms(get_the_ID(), 'category');

$term_ids = wp_get_post_terms(get_the_ID(), 'category', array('fields' => 'ids'));

if (!empty($term_ids)):
  $arg = array(
    'post_type' => 'post',
    'cat' => $term_ids,
    'post__not_in' => array(get_the_ID()),
    'posts_per_page' => 3,
  );

  $query = new WP_Query($arg);

  if ($query->have_posts()) :
    ?>
    <div class="site-single-post-related">
      <h3 class="title">
        <?php esc_html_e('Bài viết liên quan', 'paint'); ?>
      </h3>

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
        <?php
        while ($query->have_posts()) :
          $query->the_post();
          ?>
          <div class="col item">
            <div class="related-post-item">
              <?php if (has_post_thumbnail()) : ?>
                <figure class="post-image mb-2">
                  <?php the_post_thumbnail('large'); ?>
                </figure>
              <?php endif; ?>

              <h4 class="title-post">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                  <?php the_title(); ?>
                </a>
              </h4>

              <div class="excerpt-post">
                <p>
                  <?php
                  if (has_excerpt()) :
                    echo wp_trim_words(get_the_excerpt(), 15, '...');
                  else:
                    echo wp_trim_words(get_the_content(), 15, '...');
                  endif;
                  ?>
                </p>
              </div>
            </div>
          </div>
        <?php
        endwhile;

        wp_reset_postdata();
        ?>
      </div>
    </div>
  <?php
  endif;
endif;