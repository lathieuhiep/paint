<?php
namespace ExtendSite\Admin\Fields\Pages;

use Carbon_Fields\Container;
use ExtendSite\Admin\Fields\Pages\Home\HeroTab;

defined('ABSPATH') || exit;

class HomeFields {

    public static function register(): void
    {
        Container::make('post_meta', esc_html__('Thiết lập trang chủ', 'extend-site'))
            ->where('post_type', '=', 'page')
            ->where('post_template', '=', 'templates/home.php')
            ->add_tab(
                esc_html__('Hero', 'extend-site'),
                HeroTab::fields()
            );
    }
}
