<?php

class Media_Uploader
{
    public static function enqueue_scripts(): void
    {
        wp_enqueue_media();
        wp_enqueue_style('media-uploader', get_theme_file_uri('/extension/assets/css/media-uploader.css'));
        wp_enqueue_script('media-uploader', get_theme_file_uri('/extension/assets/js/media-uploader.js'), array('jquery'), '', true);
    }

    public static function media_uploader_field($name, $value = ''): void
    {
        ?>
        <div class="media-uploader-wrapper">
            <img class="media-uploader-preview" src="<?php echo esc_url($value); ?>" style="max-width:100%; <?php echo empty($value) ? 'display:none;' : ''; ?>">
            <input class="widefat media-uploader-url" name="<?php echo esc_attr($name); ?>" type="hidden" value="<?php echo esc_attr($value); ?>" />
            <button class="button media-uploader-button"><?php _e('Select Image', 'text_domain'); ?></button>
            <button class="button media-uploader-remove" style="<?php echo empty($value) ? 'display:none;' : ''; ?>"><?php _e('Remove Image', 'text_domain'); ?></button>
        </div>
        <?php
    }
}

// Đăng ký script khi admin được tải
add_action('admin_enqueue_scripts', array('Media_Uploader', 'enqueue_scripts'));
