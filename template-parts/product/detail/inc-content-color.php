<?php
$color_code_name = get_post_meta(get_the_ID(), 'paint_cmb_color_code_name', true);
$color_code_list = get_post_meta(get_the_ID(), 'paint_cmb_color_code_standard', true);

if ( !empty( $color_code_list ) ) :
    $items_per_load = 6;
    $group_data = array_slice($color_code_list, 0, $items_per_load);
?>
    <div class="group-color__grid" data-color-code-id="<?php echo esc_attr( get_the_ID() ); ?>" data-items-per="<?php echo esc_attr( $items_per_load ); ?>">
        <?php
        $args = [
            'color_code_name' => $color_code_name,
            'color_code_list' => $group_data
        ];

        get_template_part('template-parts/product/detail/components/inc', 'item-color-code', $args);
        ?>
    </div>
<?php
endif;