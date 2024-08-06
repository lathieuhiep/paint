<?php
class Logo_And_Slogan_Widget extends WP_Widget {
    // Khởi tạo widget
    public function __construct() {
        parent::__construct(
            'logo_and_slogan_widget',
            __('My Theme: Logo And Slogan', 'paint'),
            array('description' => __('A widget that displays your logo and slogan', 'paint'))
        );
    }

    // Form hiển thị trong admin
    public function form($instance): void
    {
        $image = !empty($instance['image']) ? $instance['image'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('image')); ?>"><?php _e('Image:', 'paint'); ?></label>
            <?php Media_Uploader::media_uploader_field($this->get_field_name('image'), $image); ?>
        </p>
        <?php
    }

    // Lưu trữ dữ liệu widget
    public function update($new_instance, $old_instance): array
    {
        $instance = array();
        $instance['image'] = (!empty($new_instance['image'])) ? strip_tags($new_instance['image']) : '';
        return $instance;
    }

    // Hiển thị widget ngoài front-end
    public function widget($args, $instance): void
    {
        echo $args['before_widget'];
        if (!empty($instance['image'])) {
            echo '<img src="' . esc_url($instance['image']) . '" alt="">';
        }
        echo $args['after_widget'];
    }
}

// Đăng ký widget
function paint_register_logo_and_slogan_widget(): void
{
    register_widget('Logo_And_Slogan_Widget');
}
add_action('widgets_init', 'paint_register_logo_and_slogan_widget');
