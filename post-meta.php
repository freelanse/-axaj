<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;
Container::make( 'post_meta', 'Дополнительные поля' )
    ->show_on_post_type('review')

    ->add_tab( 'Информация товара', [
        Field::make('text', 'review_author_name', 'Имя')
            ->set_required(true),
        Field::make('text', 'review_author_email', 'Email')
            ->set_required(true),

        Field::make('select', 'review_rating', 'Рейтинг')
            ->set_options(array(
                5 => '5 звезд',
                4 => '4 звезды',
                3 => '3 звезды',
                2 => '2 звезды',
                1 => '1 звезда'
            ))
    ]);
