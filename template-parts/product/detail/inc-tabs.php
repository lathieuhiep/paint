<?php
$code_product = get_post_meta(get_the_ID(), 'paint_cmb_product_code', true);
?>

<?php if ($code_product) : ?>
    <div class="product-code d-flex align-items-center justify-content-center">
        <span class="product-code__line d-inline-flex flex-grow-0"></span>
        <strong class="product-code__text d-inline-flex"><?php echo esc_html($code_product); ?></strong>
        <span class="product-code__line d-inline-flex flex-grow-0"></span>
    </div>
<?php endif; ?>

<div class="tabs-warp" data-id="<?php get_the_ID() ?>">
    <div class="nav-tab-box">
        <button type="button" class="btn btn-dropdown-menu-tabs d-sm-none">
            <span><?php esc_html_e('Xem thêm về sản phẩm', 'paint'); ?></span>
            <i class="fa-solid fa-chevron-down"></i>
        </button>

        <ul class="nav nav-pills justify-content-center gap-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active success-loading" id="color-code-tab" data-bs-toggle="pill"
                        data-bs-target="#color-code"
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
                <button class="nav-link" id="product-construction-process-tab" data-bs-toggle="pill"
                        data-bs-target="#product-construction-process"
                        type="button"
                        role="tab" aria-controls="construction-process" aria-selected="false">
                    <?php esc_html_e('Quy trình thi công', 'paint'); ?>
                </button>
            </li>
        </ul>
    </div>

    <div class="spinner-warp text-center d-none">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="tab-content" id="pills-tabContent">
        <div class="color-code-tab tab-pane fade show active" id="color-code" role="tabpanel" aria-labelledby="color-code-tab" tabindex="0">
            <div class="product-color">
                <?php get_template_part('template-parts/product/detail/inc', 'product-color'); ?>
            </div>

            <div class="color-code-load more-data">
                <div class="box-load">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="gallery-tab tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab" tabindex="0"></div>

        <div class="product-construction-process-tab tab-pane fade" id="product-construction-process" role="tabpanel" aria-labelledby="product-construction-process-tab" tabindex="0"></div>
    </div>
</div>

<!-- canvas tabs -->
<button class="btn btn-primary btn-tab-canvas" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTabs">
    <i class="fa-solid fa-list-check"></i>
</button>

<div class="offcanvas offcanvas-end offcanvas-list-tabs" tabindex="-1" id="offcanvasTabs">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">
            <?php esc_html_e('Xem thêm về sản phẩm', 'paint'); ?>
        </h5>

        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <div class="offcanvas-body">
        <ul class="list-tabs">
            <li class="item-tab">
                <button class="btn-canvas-nav-tab" data-id="color-code-tab">
                    <?php esc_html_e('Mã màu', 'paint'); ?>
                </button>
            </li>

            <li class="item-tab">
                <button class="btn-canvas-nav-tab" data-id="gallery-tab">
                    <?php esc_html_e('Hình ảnh thực tế', 'paint'); ?>
                </button>
            </li>

            <li class="item-tab">
                <button class="btn-canvas-nav-tab" data-id="product-construction-process-tab">
                    <?php esc_html_e('Quy trình thi công', 'paint'); ?>
                </button>
            </li>
        </ul>
    </div>
</div>