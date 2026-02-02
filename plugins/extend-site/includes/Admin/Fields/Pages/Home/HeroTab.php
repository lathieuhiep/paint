<?php
namespace ExtendSite\Admin\Fields\Pages\Home;


use ExtendSite\Admin\Fields\FieldTabIF;

class HeroTab implements FieldTabIF
{
    public static function fields(): array
    {
        return [];
    }

    public static function get_data(int $post_id): array
    {
        return [];
    }
}