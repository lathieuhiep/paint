<?php
$opt_gallery = paint_get_option('template_introduce_opt_gallery', '');

if ($opt_gallery) :
  $gallery_ids = explode(',', $opt_gallery);
  ?>

  <div class="element-about-gallery">
    <?php foreach ($gallery_ids as $item) : ?>
      <div class="item">
        <?php echo wp_get_attachment_image($item, 'full'); ?>
      </div>
    <?php endforeach; ?>
  </div>

<?php
endif;