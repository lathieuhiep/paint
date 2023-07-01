<?php
/**
 * Widget Name: Categories Tool Widget
 */

if (!defined('ABSPATH')) {
  exit;
}

class paint_cat_tool_widget extends WP_Widget
{

  /**
   * Widget setup.
   */

  public function __construct()
  {

    $widget_ops = array(
      'classname' => 'paint_cat_tool_widget',
      'description' => 'A widget categories tool',
    );

    parent::__construct('paint_cat_tool_widget', 'Paint: Categories Tool', $widget_ops);

  }

  /**
   * Outputs the content of the widget
   *
   * @param array $args
   * @param array $instance
   */
  function widget($args, $instance)
  {

    echo $args['before_widget'];

    if (!empty($instance['title'])) {
      echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
    }

    $taxonomies = get_terms(array(
      'taxonomy' => 'paint_tool_cat',
      'hide_empty' => false
    ));

    if ($taxonomies) :
      ?>

      <ul class="cat-tool-widget">
        <?php foreach ($taxonomies as $item) : ?>
          <li class="cat-tool-item">
            <a href="<?php echo esc_url(get_term_link($item->slug, 'paint_tool_cat')); ?>"
               title="<?php echo esc_attr($item->name); ?>">
              <?php echo esc_html($item->name); ?>
            </a>

            <span class="count">
                    (<?php echo esc_html($item->count); ?>)
                </span>
          </li>
        <?php endforeach; ?>
      </ul>

    <?php
    endif;

    echo $args['after_widget'];
  }

  /**
   * Outputs the options form on admin
   *
   * @param array $instance The widget options
   */
  function form($instance)
  {

    $defaults = array(
      'title' => '',
    );

    $instance = wp_parse_args((array)$instance, $defaults); ?>

    <!-- Widget Title: Text Input -->
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>">
        <?php esc_html_e('Title:', 'paint'); ?>
      </label>

      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
             name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>"/>
    </p>

    <?php

  }

  /**
   * Processing widget options on save
   *
   * @param array $new_instance The new options
   * @param array $old_instance The previous options
   *
   * @return array
   */
  function update($new_instance, $old_instance): array
  {
    $instance = array();

    $instance['title'] = strip_tags($new_instance['title']);

    return $instance;
  }

}

// Register social widget
function paint_cat_tool_widget_register(): void
{
  register_widget('paint_cat_tool_widget');
}

add_action('widgets_init', 'paint_cat_tool_widget_register');