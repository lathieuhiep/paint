<div class="tabs-warp">
  <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="color-code-tab" data-bs-toggle="pill" data-bs-target="#color-code"
              type="button" role="tab" aria-controls="color-code" aria-selected="true">
        <?php esc_html_e('Mã màu', 'paint'); ?>
      </button>
    </li>

    <li class="nav-item" role="presentation">
      <button class="nav-link" id="gallery-tab" data-bs-toggle="pill" data-bs-target="#gallery" type="button"
              role="tab"
              aria-controls="gallery" aria-selected="false">
        <?php esc_html_e('Hình ảnh thực tế', 'paint'); ?>
      </button>
    </li>

    <li class="nav-item" role="presentation">
      <button class="nav-link" id="product-info-tab" data-bs-toggle="pill" data-bs-target="#product-info"
              type="button"
              role="tab" aria-controls="product-info" aria-selected="false">
        <?php esc_html_e('Thông tin sản phẩm', 'paint'); ?>
      </button>
    </li>
  </ul>

  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="color-code" role="tabpanel" aria-labelledby="color-code-tab"
         tabindex="0">
      <?php get_template_part('template-parts/product/detail/inc', 'product-color'); ?>
    </div>

    <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab" tabindex="0">
      <?php get_template_part('template-parts/product/detail/inc', 'product-gallery'); ?>
    </div>

    <div class="tab-pane fade" id="product-info" role="tabpanel" aria-labelledby="product-info-tab" tabindex="0">
      <?php get_template_part('template-parts/product/detail/inc', 'product-info'); ?>
    </div>
  </div>
</div>