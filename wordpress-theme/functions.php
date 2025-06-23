<?php
// Подключение стилей и скриптов
function oyster_farm_enqueue_scripts() {
    wp_enqueue_style('oyster-farm-style', get_stylesheet_uri());
    wp_enqueue_style('oyster-farm-main', get_template_directory_uri() . '/assets/css/main.css', [], '1.0');
    wp_enqueue_script('oyster-farm-main', get_template_directory_uri() . '/assets/js/main.js', [], '1.0', true);
}
add_action('wp_enqueue_scripts', 'oyster_farm_enqueue_scripts');

// Поддержка миниатюр, меню и т.д.
function oyster_farm_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus([
        'main_menu' => 'Главное меню',
        'footer_menu' => 'Меню в подвале',
    ]);
}
add_action('after_setup_theme', 'oyster_farm_theme_setup'); 