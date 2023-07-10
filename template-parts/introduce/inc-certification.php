<?php
$opt_certification= paint_get_option('template_introduce_opt_certification');

if ($opt_certification) :
  $gallery_ids = explode(',', $opt_certification);
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