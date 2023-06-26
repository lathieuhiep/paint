<?php
add_action( 'cmb2_admin_init', 'paint_cmb_project' );

function paint_cmb_project(): void {
    $cmb = new_cmb2_box( array(
        'id'            => 'paint_cmb_project',
        'title'         => esc_html__( 'Ảnh dự án', 'paint' ),
        'object_types'  => array( 'paint_project', ),
        'context'       => 'side',
        'priority'      => 'low',
        'show_names'    => true,
    ) );

    $cmb->add_field( array(
        'id'   => 'paint_cmb_project_gallery',
        'type' => 'file_list',
        'text' => array(
            'add_upload_files_text' => esc_html__('Thêm ảnh', 'paint')
        ),
    ) );
}