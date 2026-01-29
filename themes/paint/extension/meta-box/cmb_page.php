<?php
add_action('cmb2_admin_init', 'paint_page_metaboxes');

function paint_page_metaboxes(): void
{
    $prefix = 'paint_cmb_';

    $cmb = new_cmb2_box(array(
        'id' => 'paint_cmb_page',
        'title' => esc_html__('Cài đặt trang', 'paint'),
        'object_types' => array('page'),
        'context' => 'normal',
        'priority' => 'low',
        'show_names' => true,
    ));

    $cmb->add_field([
        'name' => esc_html__('Kiểu menu', 'paint'),
        'id' => 'paint_cmb_page_menu_style',
        'type' => 'select',
        'options' => [
            '' => esc_html__('Mặc định', 'paint'),
            'v-1' => esc_html__('Kiểu 1', 'paint'),
        ],
        'default' => '',
    ]);
}