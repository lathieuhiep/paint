<div class="entry-post">
	<div class="left-box">
		<a href="#" class="history-back-discover">
			<i class="fa-solid fa-arrow-left-long"></i>
		</a>
	</div>

	<div class="right-box">
        <?php while ( have_posts() ) : the_post(); ?>
        <div class="entry-content">
            <div class="thumbnail-image">
                <?php the_post_thumbnail('full'); ?>
            </div>

            <div class="post-info">
                <div class="post-info__left">
                    <h1 class="title">
		                <?php the_title(); ?>
                    </h1>

                    <div class="desc">
                        <?php the_content(); ?>
                    </div>
                </div>

                <div class="post-info__right">
                    <div class="fb-share-button" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>

                    <div class="fb-save" data-uri="<?php the_permalink(); ?>" data-size="large" data-lazy="true"></div>
                </div>
            </div>
        </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
</div>