<?php
// A Custom function for get an option
if (!function_exists('paint_get_option')) {
    function paint_get_option($option = '', $default = null)
    {
        $options = get_option('options'); // Attention: Set your unique id of the framework

        return (isset($options[$option])) ? $options[$option] : $default;
    }
}

// Control core classes for avoid errors
if (class_exists('CSF')) {
    // Set a unique slug-like ID
    $paint_prefix = 'options';
    $paint_my_theme = wp_get_theme();

    // Create options
    CSF::createOptions($paint_prefix, array(
        'menu_title' => esc_html__('Theme Options', 'paint'),
        'menu_slug' => 'theme-options',
        'menu_position' => 2,
        'admin_bar_menu_icon' => 'dashicons-admin-generic',
        'framework_title' => $paint_my_theme->get('Name') . ' ' . esc_html__('Options', 'paint'),
        'footer_text' => esc_html__('Thank you for using my theme', 'paint'),
        'footer_after' => '<pre>Contact me:<br />Zalo/Phone: 0975458209 - Skype: lathieuhiep - facebook: <a href="https://www.facebook.com/lathieuhiep" target="_blank">lathieuhiep</a></pre>',
    ));

    // Create a section general
    CSF::createSection($paint_prefix, array(
        'title' => esc_html__('Cài đặt chung', 'paint'),
        'icon' => 'fas fa-cog',
        'fields' => array(
            // favicon
            array(
                'id' => 'general_opt_favicon',
                'type' => 'media',
                'title' => esc_html__('Chọn ảnh favicon', 'paint'),
                'library' => 'image',
                'url' => false
            ),

            // logo
            array(
                'id' => 'general_opt_logo',
                'type' => 'media',
                'title' => esc_html__('Chọn ảnh logo', 'paint'),
                'library' => 'image',
                'url' => false
            ),

            // show loading
            array(
                'id' => 'general_opt_loading',
                'type' => 'switcher',
                'title' => esc_html__('Sử dụng chờ tài trang', 'paint'),
                'text_on' => esc_html__('Có', 'paint'),
                'text_off' => esc_html__('Không', 'paint'),
                'text_width' => 80,
                'default' => false
            ),

            array(
                'id' => 'general_opt_image_loading',
                'type' => 'media',
                'title' => esc_html__('Chọn ảnh chờ tài trang', 'paint'),
                'subtitle' => esc_html__('Sử dụng file .git', 'paint') . ' <a href="https://loading.io/" target="_blank">loading.io</a>',
                'dependency' => array('general_opt_loading', '==', 'true'),
                'url' => false
            ),

            // show back to top
            array(
                'id' => 'general_opt_back_to_top',
                'type' => 'switcher',
                'title' => esc_html__('Sử dụng nút về đầu trang', 'paint'),
                'text_on' => esc_html__('Có', 'paint'),
                'text_off' => esc_html__('Không', 'paint'),
                'text_width' => 80,
                'default' => true
            ),

        )
    ));

    // Create a section menu
    CSF::createSection($paint_prefix, array(
        'title' => esc_html__('Menu', 'paint'),
        'icon' => 'fas fa-bars',
        'fields' => array(
            // Sticky menu
            array(
                'id' => 'general_option_menu_sticky',
                'type' => 'switcher',
                'title' => esc_html__('Menu cố dịnh', 'paint'),
                'text_on' => esc_html__('Có', 'paint'),
                'text_off' => esc_html__('Không', 'paint'),
                'text_width' => 80,
                'default' => true
            ),
        )
    ));

    // -> Create a section template home
    CSF::createSection($paint_prefix, array(
        'id' => 'template_home_opt',
        'icon' => 'fas fa-home',
        'title' => esc_html__('Trang chủ', 'paint'),
    ));

    // Banner 1
    CSF::createSection($paint_prefix, array(
        'parent' => 'template_home_opt',
        'title' => esc_html__('Banner 1', 'paint'),
        'fields' => array(
            array(
                'id' => 'template_home_opt_short_code_slider',
                'type' => 'text',
                'title' => esc_attr__('Short code slider', 'paint')
            )
        )
    ));

    // About Us
    CSF::createSection($paint_prefix, array(
        'parent' => 'template_home_opt',
        'title' => esc_html__('Về chúng tôi', 'paint'),
        'fields' => array(
            // statistical
            array(
                'id' => 'template_home_opt_result_count_bottom',
                'type' => 'group',
                'title' => esc_html__('Chúng tôi có', 'paint'),
                'fields' => array(
                    array(
                        'id' => 'title',
                        'type' => 'text',
                        'title' => esc_html__('Tiêu đề', 'paint'),
                    ),

                    array(
                        'id' => 'image',
                        'type' => 'media',
                        'title' => esc_html__('Ảnh icon', 'paint'),
                        'library' => 'image',
                        'url' => false,
                    ),

                    array(
                        'id' => 'count',
                        'type' => 'number',
                        'title' => esc_html__('Nhập số', 'paint'),
                        'default' => '325'
                    ),

                    array(
                        'id' => 'show_icon',
                        'type' => 'switcher',
                        'title' => esc_html__('Hiển thị dấu (+)', 'paint'),
                        'text_on' => esc_html__('Có', 'paint'),
                        'text_off' => esc_html__('Không', 'paint'),
                        'default' => true,
                        'text_width' => 80
                    ),
                ),
            ),

            // Services
            array(
                'id' => 'template_home_opt_about_services',
                'type' => 'group',
                'title' => esc_html__('Dịch vụ', 'paint'),
                'fields' => array(
                    array(
                        'id' => 'title',
                        'type' => 'text',
                        'title' => esc_html__('Tiêu đề', 'paint'),
                    ),

                    // content
                    array(
                        'id' => 'describe',
                        'type' => 'textarea',
                        'title' => esc_html__('Mô tả', 'paint'),
                    ),
                ),
            ),
        )
    ));

    // Products
    CSF::createSection($paint_prefix, array(
        'parent' => 'template_home_opt',
        'title' => esc_html__('Sản phẩm', 'paint'),
        'fields' => array(
            // Select category
            array(
                'id' => 'template_home_opt_product_cat',
                'type' => 'select',
                'title' => esc_html__('Chọn danh mục dự án', 'paint'),
                'placeholder' => esc_html__('Chọn danh mục dự án', 'paint'),
                'options' => 'categories',
                'multiple' => true,
                'chosen' => true,
                'query_args' => array(
                    'taxonomy' => 'paint_product_cat',
                ),
            ),

            // Limit
            array(
                'id' => 'template_home_opt_product_limit',
                'type' => 'number',
                'title' => esc_html__('Số bài viêt cần lấy', 'paint'),
                'default' => 6,
            ),

            // order by
            array(
                'id' => 'template_home_opt_product_order_by',
                'type' => 'select',
                'title' => esc_html__('Lấy bài viết theo', 'paint'),
                'options' => array(
                    'id' => esc_html__('ID', 'beecolor'),
                    'title' => esc_html__('Tiêu đề', 'paint'),
                    'date' => esc_html__('Ngày tạo', 'paint'),
                ),
                'default' => 'id'
            ),

            // order
            array(
                'id' => 'template_home_opt_product_order',
                'type' => 'select',
                'title' => esc_html__('Sắp xếp bài viết', 'paint'),
                'options' => array(
                    'ASC' => esc_html__('Trên xuống dưới', 'paint'),
                    'DESC' => esc_html__('Dưới lên trên', 'paint'),
                ),
                'default' => 'DESC'
            )
        )
    ));


    // Project
    CSF::createSection($paint_prefix, array(
        'parent' => 'template_home_opt',
        'title' => esc_html__('Dự án', 'paint'),
        'fields' => array(
            // Desc
            array(
                'id' => 'template_home_opt_project_content',
                'type' => 'wp_editor',
                'title' => esc_html__('Nội dung', 'paint'),
            ),

            // Select category
            array(
                'id' => 'template_home_opt_project_cat',
                'type' => 'select',
                'title' => esc_html__('Chọn danh mục dự án', 'paint'),
                'placeholder' => esc_html__('Chọn danh mục dự án', 'paint'),
                'options' => 'categories',
                'multiple' => true,
                'chosen' => true,
                'query_args' => array(
                    'taxonomy' => 'paint_project_cat',
                ),
            ),

            // Limit
            array(
                'id' => 'template_home_opt_project_limit',
                'type' => 'number',
                'title' => esc_html__('Số bài viêt cần lấy', 'paint'),
                'default' => 6,
            ),

            // order by
            array(
                'id' => 'template_home_opt_project_order_by',
                'type' => 'select',
                'title' => esc_html__('Lấy bài viết theo', 'paint'),
                'options' => array(
                    'id' => esc_html__('ID', 'beecolor'),
                    'title' => esc_html__('Tiêu đề', 'paint'),
                    'date' => esc_html__('Ngày tạo', 'paint'),
                ),
                'default' => 'id'
            ),

            // order
            array(
                'id' => 'template_home_opt_project_order',
                'type' => 'select',
                'title' => esc_html__('Sắp xếp bài viết', 'paint'),
                'options' => array(
                    'ASC' => esc_html__('Trên xuống dưới', 'paint'),
                    'DESC' => esc_html__('Dưới lên trên', 'paint'),
                ),
                'default' => 'DESC'
            )
        )
    ));


    // Discover
    CSF::createSection($paint_prefix, array(
        'parent' => 'template_home_opt',
        'title' => esc_html__('Khám phá', 'paint'),
        'fields' => array(
            // Select category
            array(
                'id' => 'template_home_opt_discover_cat',
                'type' => 'select',
                'title' => esc_html__('Chọn danh mục khám phá', 'paint'),
                'placeholder' => esc_html__('Chọn danh mục khám phá', 'paint'),
                'options' => 'categories',
                'multiple' => true,
                'chosen' => true,
                'query_args' => array(
                    'taxonomy' => 'paint_discover_cat',
                ),
            ),

            // Limit
            array(
                'id' => 'template_home_opt_discover_limit',
                'type' => 'number',
                'title' => esc_html__('Số bài viêt cần lấy', 'paint'),
                'default' => 5,
            ),

            // order by
            array(
                'id' => 'template_home_opt_discover_order_by',
                'type' => 'select',
                'title' => esc_html__('Lấy bài viết theo', 'paint'),
                'options' => array(
                    'id' => esc_html__('ID', 'beecolor'),
                    'title' => esc_html__('Tiêu đề', 'paint'),
                    'date' => esc_html__('Ngày tạo', 'paint'),
                ),
                'default' => 'id'
            ),

            // order
            array(
                'id' => 'template_home_opt_discover_order',
                'type' => 'select',
                'title' => esc_html__('Sắp xếp bài viết', 'paint'),
                'options' => array(
                    'ASC' => esc_html__('Trên xuống dưới', 'paint'),
                    'DESC' => esc_html__('Dưới lên trên', 'paint'),
                ),
                'default' => 'DESC'
            )
        )
    ));

    // Post
    CSF::createSection($paint_prefix, array(
        'parent' => 'template_home_opt',
        'title' => esc_html__('Bài viết', 'paint'),
        'fields' => array(
            // Heading
            array(
                'id' => 'template_home_opt_post_heading',
                'type' => 'fieldset',
                'title' => esc_html__('Mục trên', 'paint'),
                'fields' => array(
                    array(
                        'id' => 'title',
                        'type' => 'text',
                        'title' => esc_html__('Tiêu đề', 'paint'),
                        'default' => esc_html__('BÀI VIẾT', 'paint')
                    ),

                    // align
                    array(
                        'id' => 'align',
                        'type' => 'select',
                        'title' => esc_html__('Căn chỉnh', 'paint'),
                        'options' => array(
                            'start' => esc_html__('Căn lề trái', 'paint'),
                            'center' => esc_html__('Căn giữa', 'paint'),
                            'end' => esc_html__('Căn phải', 'paint'),
                        ),
                        'default' => 'center'
                    ),
                ),
            ),

            // Select category
            array(
                'id' => 'template_home_opt_post_cat',
                'type' => 'select',
                'title' => esc_html__('Chọn danh mục', 'paint'),
                'placeholder' => esc_html__('Chọn danh mục', 'paint'),
                'options' => 'categories',
                'multiple' => true,
                'chosen' => true,
                'query_args' => array(
                    'taxonomy' => 'category',
                ),
            ),

            // Limit
            array(
                'id' => 'template_home_opt_post_limit',
                'type' => 'number',
                'title' => esc_html__('Số bài viêt cần lấy', 'paint'),
                'default' => 8,
            ),

            // order by
            array(
                'id' => 'template_home_opt_post_order_by',
                'type' => 'select',
                'title' => esc_html__('Lấy bài viết theo', 'paint'),
                'options' => array(
                    'id' => esc_html__('ID', 'beecolor'),
                    'title' => esc_html__('Tiêu đề', 'paint'),
                    'date' => esc_html__('Ngày tạo', 'paint'),
                ),
                'default' => 'id'
            ),

            // order
            array(
                'id' => 'template_home_opt_post_order',
                'type' => 'select',
                'title' => esc_html__('Sắp xếp bài viết', 'paint'),
                'options' => array(
                    'ASC' => esc_html__('Trên xuống dưới', 'paint'),
                    'DESC' => esc_html__('Dưới lên trên', 'paint'),
                ),
                'default' => 'ASC'
            )
        )
    ));

    // Newsletter
    CSF::createSection($paint_prefix, array(
        'parent' => 'template_home_opt',
        'title' => esc_html__('Đăng kí nhận tin', 'paint'),
        'fields' => array(
            // Desc
            array(
                'id' => 'template_home_opt_newsletter',
                'type' => 'textarea',
                'title' => esc_html__('Nội dung', 'paint'),
            ),

            // shortcode
            array(
                'id' => 'template_home_opt_newsletter_shortcode',
                'type' => 'textarea',
                'title' => esc_html__('Shortcode Newsletter', 'paint'),
            ),
        )
    ));

    // -> End section template home

    //
    // -> Create a section template introduce
    CSF::createSection($paint_prefix, array(
        'id' => 'template_introduce_opt',
        'icon' => 'fas fa-address-card',
        'title' => esc_html__('Trang Giới Thiệu', 'paint'),
    ));

    // About Us
    CSF::createSection($paint_prefix, array(
        'parent' => 'template_introduce_opt',
        'title' => esc_html__('Về chúng tôi', 'paint'),
        'fields' => array(
            array(
                'id' => 'template_introduce_opt_title',
                'type' => 'text',
                'title' => esc_html__('Tiêu đề', 'paint'),
                'default' => esc_html__('VỀ CHÚNG TÔI', 'paint')
            ),

            array(
                'id' => 'template_introduce_opt_image',
                'type' => 'media',
                'title' => esc_html__('Chọn ảnh', 'paint'),
                'library' => 'image',
                'url' => false,
            ),

            array(
                'id' => 'template_introduce_opt_desc',
                'type' => 'wp_editor',
                'title' => esc_html__('Nội dung', 'paint'),
            ),
        )
    ));

    // Our Maxim
    CSF::createSection($paint_prefix, array(
        'parent' => 'template_introduce_opt',
        'title' => esc_html__('Châm ngôn của chúng tôi', 'paint'),
        'fields' => array(
            array(
                'id' => 'tpl_introduce_opt_our_maxim_group',
                'type' => 'group',
                'fields' => array(
                    array(
                        'id' => 'title',
                        'type' => 'text',
                        'title' => esc_html__('Tiêu đề', 'paint'),
                    ),

                    array(
                        'id' => 'content',
                        'type' => 'wp_editor',
                        'title' => esc_html__('Nội dung', 'paint'),
                    ),
                ),
            ),
        )
    ));

    // Technology
    CSF::createSection($paint_prefix, array(
        'parent' => 'template_introduce_opt',
        'title' => esc_html__('Công nghệ', 'paint'),
        'fields' => array(
            array(
                'id' => 'tpl_introduce_opt_technology_group',
                'type' => 'group',
                'fields' => array(
                    array(
                        'id' => 'title',
                        'type' => 'text',
                        'title' => esc_html__('Tiêu đề', 'paint'),
                    ),

                    array(
                        'id' => 'color',
                        'type' => 'color',
                        'title' => esc_html__('Màu nền', 'paint'),
                    ),

                    array(
                        'title' => esc_html__('Ảnh', 'paint'),
                        'id' => 'image',
                        'type' => 'media',
                        'library' => 'image',
                        'url' => false,
                    ),

                    array(
                        'id' => 'content',
                        'type' => 'wp_editor',
                        'title' => esc_html__('Nội dung', 'paint'),
                    ),
                ),
            ),
        )
    ));

    // Certification
    CSF::createSection($paint_prefix, array(
        'parent' => 'template_introduce_opt',
        'title' => esc_html__('Chứng nhận', 'paint'),
        'fields' => array(
            array(
                'id' => 'template_introduce_opt_certification',
                'type' => 'gallery',
            ),

            array(
                'id' => 'template_introduce_opt_image_size',
                'type' => 'select',
                'title' => esc_html__('Kích cỡ', 'paint'),
                'options' => IMAGE_SIZES,
                'default' => 'thumbnail'
            ),

            array(
                'id' => 'template_introduce_opt_image_size_position',
                'type' => 'select',
                'title' => esc_html__('Vị trí', 'paint'),
                'options' => TEXT_ALIGNMENT,
                'default' => 'text-center'
            ),
        )
    ));

    // community
    CSF::createSection($paint_prefix, array(
        'parent' => 'template_introduce_opt',
        'title' => esc_html__('Hoạt động vì cộng đồng', 'paint'),
        'fields' => array(
            array(
                'id' => 'template_introduce_opt_community_image',
                'title' => esc_html__('Ảnh', 'paint'),
                'type' => 'media',
                'library' => 'image',
                'url' => false,
            ),

            array(
                'id' => 'template_introduce_opt_community_content',
                'type' => 'wp_editor',
                'title' => esc_html__('Nội dung', 'paint'),
            ),
        )
    ));

    // -> End section template introduce

    //
    // -> Create a section template faq
    CSF::createSection($paint_prefix, array(
        'id' => 'template_faq_opt',
        'icon' => 'fas fa-question-circle',
        'title' => esc_html__('Trang FAQ', 'paint'),
        'fields' => array(
            // Limit
            array(
                'id' => 'template_faq_opt_limit',
                'type' => 'number',
                'title' => esc_html__('Số bài viêt cần lấy', 'paint'),
                'default' => 10,
            ),

            // order by
            array(
                'id' => 'template_faq_opt_order_by',
                'type' => 'select',
                'title' => esc_html__('Lấy bài viết theo', 'paint'),
                'options' => array(
                    'id' => esc_html__('ID', 'beecolor'),
                    'title' => esc_html__('Tiêu đề', 'paint'),
                    'date' => esc_html__('Ngày tạo', 'paint'),
                ),
                'default' => 'id'
            ),

            // order
            array(
                'id' => 'template_faq_opt_order',
                'type' => 'select',
                'title' => esc_html__('Sắp xếp bài viết', 'paint'),
                'options' => array(
                    'ASC' => esc_html__('Trên xuống dưới', 'paint'),
                    'DESC' => esc_html__('Dưới lên trên', 'paint'),
                ),
                'default' => 'ASC'
            )
        )
    ));
    // -> End section template faq

    //
    // -> Create a section blog
    CSF::createSection($paint_prefix, array(
        'id' => 'paint_opt_blog',
        'icon' => 'fas fa-blog',
        'title' => esc_html__('Bài viết', 'paint'),
    ));

    // Category Post
    CSF::createSection($paint_prefix, array(
        'parent' => 'paint_opt_blog',
        'title' => esc_html__('Chuyên mục', 'paint'),
        'fields' => array(
            array(
                'id' => 'paint_opt_blog_cat_sidebar',
                'type' => 'select',
                'title' => esc_html__('Vị trí sidebar', 'paint'),
                'options' => array(
                    'hide' => esc_html__('Hide', 'paint'),
                    'left' => esc_html__('Left', 'paint'),
                    'right' => esc_html__('Right', 'paint'),
                ),
                'default' => 'right'
            ),

            array(
                'id' => 'paint_opt_blog_per_row',
                'type' => 'select',
                'title' => esc_html__('Bài viết trên 1 hàng', 'paint'),
                'options' => array(
                    '2' => esc_html__('2 Bài', 'paint'),
                    '3' => esc_html__('3 Bài', 'paint'),
                    '4' => esc_html__('4 Bài', 'paint'),
                ),
                'default' => '3'
            ),
        )
    ));

    // Single Post
    CSF::createSection($paint_prefix, array(
        'parent' => 'paint_opt_blog',
        'title' => esc_html__('Chi tiết', 'paint'),
        'fields' => array(
            array(
                'id' => 'paint_opt_single_sidebar',
                'type' => 'select',
                'title' => esc_html__('Vị trí sidebar', 'paint'),
                'options' => array(
                    'hide' => esc_html__('Hide', 'paint'),
                    'left' => esc_html__('Left', 'paint'),
                    'right' => esc_html__('Right', 'paint'),
                ),
                'default' => 'right'
            ),

            array(
                'id' => 'paint_opt_single_share',
                'type' => 'switcher',
                'title' => esc_html__('Chia sẻ bài viết', 'paint'),
                'text_on' => esc_html__('Có', 'paint'),
                'text_off' => esc_html__('Không', 'paint'),
                'default' => true,
                'text_width' => 80
            ),

            array(
                'id' => 'paint_opt_single_related',
                'type' => 'switcher',
                'title' => esc_html__('Hiển thị bài viết liên quan', 'paint'),
                'text_on' => esc_html__('Có', 'paint'),
                'text_off' => esc_html__('Không', 'paint'),
                'default' => true,
                'text_width' => 80
            ),
        )
    ));

    //
    // -> Create a section template project
    CSF::createSection($paint_prefix, array(
        'icon' => 'fas fa-folder-open',
        'title' => esc_html__('Dự Án', 'paint'),
        'description' => esc_html__('Thiết lập cho danh mục và lưu trữ'),
        'fields' => array(
            // Limit
            array(
                'id' => 'template_project_opt_limit',
                'type' => 'number',
                'title' => esc_html__('Số bài viêt cần lấy', 'paint'),
                'default' => 12,
            ),

            // order by
            array(
                'id' => 'template_project_opt_order_by',
                'type' => 'select',
                'title' => esc_html__('Lấy bài viết theo', 'paint'),
                'options' => array(
                    'id' => esc_html__('ID', 'beecolor'),
                    'title' => esc_html__('Tiêu đề', 'paint'),
                    'date' => esc_html__('Ngày tạo', 'paint'),
                ),
                'default' => 'id'
            ),

            // order
            array(
                'id' => 'template_project_opt_order',
                'type' => 'select',
                'title' => esc_html__('Sắp xếp bài viết', 'paint'),
                'options' => array(
                    'ASC' => esc_html__('Trên xuống dưới', 'paint'),
                    'DESC' => esc_html__('Dưới lên trên', 'paint'),
                ),
                'default' => 'ASC'
            )
        )
    ));
    // -> End section template project

    //
    // -> Create a section post type tool
    CSF::createSection($paint_prefix, array(
        'title' => esc_html__('Dụng cụ', 'paint'),
        'icon' => 'fas fa-tools',
        'fields' => array()
    ));

    //
    // -> Create a section post type discover
    CSF::createSection($paint_prefix, array(
        'title' => esc_html__('Khám phá', 'paint'),
        'id' => 'paint_opt_discover',
        'icon' => 'fas fa-images',
    ));

    // taxonomy discover
    CSF::createSection($paint_prefix, array(
        'parent' => 'paint_opt_discover',
        'title' => esc_html__('Chuyên mục', 'paint'),
        'fields' => array(
            // Limit
            array(
                'id' => 'discover_opt_limit',
                'type' => 'number',
                'title' => esc_html__('Số bài viêt cần lấy', 'paint'),
                'default' => 12,
            ),
        )
    ));

    // Single discover
    CSF::createSection($paint_prefix, array(
        'parent' => 'paint_opt_discover',
        'title' => esc_html__('Chi tiết', 'paint'),
        'fields' => array(
            array(
                'id' => 'paint_opt_discover_single',
                'type' => 'text',
                'title' => esc_html__('Link tư vấn', 'paint'),
            ),
        )
    ));

    //
    // -> Create a section post type product
    CSF::createSection($paint_prefix, array(
        'title' => esc_html__('Sản phẩm', 'paint'),
        'id' => 'paint_opt_product',
        'icon' => 'fas fa-shopping-cart',
    ));

    // taxonomy product
    CSF::createSection($paint_prefix, array(
        'parent' => 'paint_opt_product',
        'title' => esc_html__('Chuyên mục', 'paint'),
        'fields' => array(
            // Limit
            array(
                'id' => 'paint_opt_product_cat_limit',
                'type' => 'number',
                'title' => esc_html__('Số sản phẩm cần lấy', 'paint'),
                'default' => 8,
            ),
        )
    ));

    //
    // Create a section social network
    CSF::createSection($paint_prefix, array(
        'title' => esc_html__('Mạng xã hội', 'paint'),
        'icon' => 'fab fa-hive',
        'fields' => array(
            array(
                'id' => 'paint_opt_social_network',
                'type' => 'repeater',
                'title' => esc_html__('Social Network', 'paint'),
                'fields' => array(
                    array(
                        'id' => 'icon',
                        'type' => 'icon',
                        'title' => esc_html__('Chọn icon', 'paint'),
                        'default' => 'fab fa-facebook-f'
                    ),

                    array(
                        'id' => 'link',
                        'type' => 'text',
                        'title' => 'Link',
                        'default' => '#',
                    ),

                ),
                'default' => array(
                    array(
                        'icon' => 'fab fa-facebook-f',
                        'link' => '#',
                    ),

                    array(
                        'icon' => 'fab fa-youtube',
                        'link' => '#',
                    ),
                )
            ),
        )
    ));

    // Create a section social sharing
    CSF::createSection($paint_prefix, array(
        'title' => esc_html__('Chia sẻ mạng xã hội', 'paint'),
        'icon' => 'fab fa-hive',
        'fields' => array(
            array(
                'id' => 'social_sharing_facebook_app_id',
                'type' => 'text',
                'title' => esc_html__('Facebook App Id', 'paint'),
            ),
        )
    ));

    //
    // -> Create a section footer
    CSF::createSection($paint_prefix, array(
        'id' => 'parent_footer',
        'icon' => 'fas fa-stream',
        'title' => esc_html__('Chân trang', 'paint'),
    ));

    // footer columns
    CSF::createSection( $paint_prefix, array(
        'parent' => 'parent_footer',
        'title'  => esc_html__( 'Thiết lâp cột', 'paint' ),
        'fields' => array(
            // select columns
            array(
                'id'      => 'paint_opt_footer_columns',
                'type'    => 'select',
                'title'   => esc_html__( 'Number of footer columns', 'paint' ),
                'options' => array(
                    '0' => esc_html__( 'Hide', 'paint' ),
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                ),
                'default' => '4'
            ),

            // column width 1
            array(
                'id'        => 'paint_opt_footer_column_width_1',
                'type'      => 'fieldset',
                'title'     => esc_html__( 'Column width 1', 'paint' ),
                'fields'    => array(
                    array(
                        'id'         => 'sm',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'sm: ≥576px', 'paint' ),
                        'default'    => 12,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'md',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'md: ≥768px', 'paint' ),
                        'default'    => 6,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'lg',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'lg: ≥992px', 'paint' ),
                        'default'    => 3,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'xl',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'xl: ≥1200px', 'paint' ),
                        'default'    => 3,
                        'min'        => 1,
                        'max'        => 12,
                    ),
                ),
                'dependency' => array( 'paint_opt_footer_columns', '!=', '0' )
            ),

            // column width 2
            array(
                'id'        => 'paint_opt_footer_column_width_2',
                'type'      => 'fieldset',
                'title'     => esc_html__( 'Column width 2', 'paint' ),
                'fields'    => array(
                    array(
                        'id'         => 'sm',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'sm: ≥576px', 'paint' ),
                        'default'    => 12,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'md',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'md: ≥768px', 'paint' ),
                        'default'    => 6,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'lg',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'lg: ≥992px', 'paint' ),
                        'default'    => 3,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'xl',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'xl: ≥1200px', 'paint' ),
                        'default'    => 3,
                        'min'        => 1,
                        'max'        => 12,
                    ),
                ),
                'dependency' => array( 'paint_opt_footer_columns', 'not-any', '0,1' )
            ),

            // column width 3
            array(
                'id'        => 'paint_opt_footer_column_width_3',
                'type'      => 'fieldset',
                'title'     => esc_html__( 'Column width 3', 'paint' ),
                'fields'    => array(
                    array(
                        'id'         => 'sm',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'sm: ≥576px', 'paint' ),
                        'default'    => 12,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'md',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'md: ≥768px', 'paint' ),
                        'default'    => 6,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'lg',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'lg: ≥992px', 'paint' ),
                        'default'    => 3,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'xl',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'xl: ≥1200px', 'paint' ),
                        'default'    => 3,
                        'min'        => 1,
                        'max'        => 12,
                    ),
                ),
                'dependency' => array( 'paint_opt_footer_columns', 'not-any', '0,1,2' )
            ),

            // column width 4
            array(
                'id'        => 'paint_opt_footer_column_width_4',
                'type'      => 'fieldset',
                'title'     => esc_html__( 'Column width 3', 'paint' ),
                'fields'    => array(
                    array(
                        'id'         => 'sm',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'sm: ≥576px', 'paint' ),
                        'default'    => 12,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'md',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'md: ≥768px', 'paint' ),
                        'default'    => 6,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'lg',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'lg: ≥992px', 'paint' ),
                        'default'    => 3,
                        'min'        => 1,
                        'max'        => 12,
                    ),

                    array(
                        'id'         => 'xl',
                        'type'       => 'slider',
                        'title'      => esc_html__( 'xl: ≥1200px', 'paint' ),
                        'default'    => 3,
                        'min'        => 1,
                        'max'        => 12,
                    ),
                ),
                'dependency' => array( 'paint_opt_footer_columns', 'not-any', '0,1,2,3' )
            ),
        )
    ) );

    // -> End create a section footer

}

