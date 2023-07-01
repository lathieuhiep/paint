<?php
add_action('cmb2_admin_init', 'paint_cmb_product');

function paint_cmb_product(): void
{
  // --> options side
  $cmb_image_hover = new_cmb2_box(array(
    'id' => 'paint_cmb_product_image_hover',
    'title' => esc_html__('Ảnh thay đổi', 'paint'),
    'object_types' => array('paint_product'),
    'context' => 'side',
    'priority' => 'low',
    'show_names' => true
  ));

  $cmb_image_hover->add_field(array(
    'id' => 'paint_cmb_product_image_feature_hover',
    'type' => 'file',
    'options' => array(
      'url' => false,
    ),
    'text' => array(
      'add_upload_file_text' => esc_html__('Đặt ảnh thay đổi', 'paint')
    ),
    'query_args' => array(
      'type' => array(
        'image/gif',
        'image/jpeg',
        'image/png',
      ),
    ),
    'preview_size' => 'large',
    'escape_cb' => false,
    'sanitization_cb' => false
  ));

  // --> options product info
  $cmb_options = new_cmb2_box(array(
    'id' => 'paint_cmb_options_product',
    'title' => esc_html__('Thông tin bổ sung', 'paint'),
    'object_types' => array('paint_product'),
    'context' => 'normal',
    'priority' => 'high',
    'show_names' => true
  ));

  $cmb_options->add_field(array(
    'id' => 'paint_cmb_product_banner',
    'name' => esc_html__('Banner', 'paint'),
    'type' => 'file',
    'options' => array(
      'url' => false,
    ),
    'text' => array(
      'add_upload_file_text' => esc_html__('Chọn ảnh', 'paint')
    ),
    'query_args' => array(
      'type' => array(
        'image/gif',
        'image/jpeg',
        'image/png',
      ),
    ),
    'preview_size' => 'large'
  ));

  $cmb_options->add_field(array(
    'name' => esc_html__('Chọn bảng màu', 'paint'),
    'desc' => esc_html__('Chọn danh mục chứa bảng màu, nếu danh mục nhiều hơn 1 bảng màu trở lên sẽ hiển thị dạng kiểu vân. Bảng màu được tạo ở mục "Mã màu sơn"', 'paint'),
    'id' => 'paint_cmb_options_product_color',
    'type' => 'select',
    'remove_default' => 'true',
    'options' => paint_check_get_cat('paint_color_code_cat')
  ));

  $cmb_options->add_field(array(
    'name' => esc_html__('Quy trình thi công', 'paint'),
    'id' => 'paint_cmb_product_procedure',
    'type' => 'wysiwyg',
    'options' => array(
      'textarea_rows' => 11,
    )
  ));

  // group field
  $gallery_field = $cmb_options->add_field(array(
    'id' => 'paint_cmb_product_gallery',
    'type' => 'group',
    'description' => esc_html__('Hình ảnh thực tế', 'paint'),
    'options' => array(
      'group_title' => esc_html__('Ảnh {#}', 'paint'),
      'add_button' => esc_html__('Thêm', 'paint'),
      'remove_button' => esc_html__('Xoá', 'paint'),
      'sortable' => true,
      'closed' => false,
      'remove_confirm' => esc_html__('Bạn thật sự muốn xoá?', 'paint'),
    ),
  ));

  $cmb_options->add_group_field($gallery_field, array(
    'name' => esc_html__('Kiểu hiển thị', 'paint'),
    'id' => 'style',
    'type' => 'select',
    'default' => 'custom',
    'options' => array(
      'normal' => __('Bình thường', 'paint'),
      'full' => __('Full', 'paint'),
    ),
  ));

  $cmb_options->add_group_field($gallery_field, array(
    'name' => esc_html__('Chọn ảnh', 'paint'),
    'id' => 'image',
    'type' => 'file',
    'options' => array(
      'url' => false,
    ),
    'text' => array(
      'add_upload_file_text' => esc_html__('Đặt ảnh thay đổi')
    ),
    'query_args' => array(
      'type' => array(
        'image/gif',
        'image/jpeg',
        'image/png',
      ),
    ),
    'preview_size' => 'large',
  ));

  // options suggestion tool
  $cmb_suggestion_tool = new_cmb2_box(array(
    'id' => 'paint_cmb_product_suggestion_tool',
    'title' => esc_html__('Dụng cụ gợi ý', 'paint'),
    'object_types' => array('paint_product'),
    'context' => 'normal',
    'priority' => 'high',
    'show_names' => true
  ));

  $cmb_suggestion_tool->add_field(array(
    'id' => 'paint_cmb_product_suggestion_tool_title',
    'name' => esc_html__('Tiêu đề', 'paint'),
    'default' => esc_html__('Dụng cụ thi công liên quan', 'paint'),
    'type' => 'text',
  ));

  $cmb_suggestion_tool->add_field(array(
    'name' => esc_html__('Chọn dụng đi kèm', 'paint'),
    'id' => 'paint_cmb_product_suggestion_tool_check',
    'type' => 'multicheck',
    'options' => paint_get_post_types('paint_tool'),
  ));

}