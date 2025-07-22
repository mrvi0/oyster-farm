<?php
// Подключение стилей и скриптов
function oyster_farm_enqueue_scripts() {
    wp_enqueue_style('oyster-farm-style', get_stylesheet_uri());
    // wp_enqueue_style('oyster-farm-main', get_template_directory_uri() . '/assets/css/main.css', [], '1.1'); // отключено для устранения конфликтов
    wp_enqueue_script('oyster-farm-main', get_template_directory_uri() . '/assets/js/main.js', [], '1.1', true);
}
add_action('wp_enqueue_scripts', 'oyster_farm_enqueue_scripts');

// Подключение админских скриптов
function oyster_farm_admin_scripts($hook) {
    if ('post.php' == $hook || 'post-new.php' == $hook) {
        wp_enqueue_media();
        wp_enqueue_script('oyster-farm-admin', get_template_directory_uri() . '/assets/js/admin.js', ['jquery'], '1.1', true);
    }
}
add_action('admin_enqueue_scripts', 'oyster_farm_admin_scripts');

// Поддержка миниатюр, меню и т.д.
function oyster_farm_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus([
        'main_menu' => 'Главное меню',
        'footer_menu' => 'Меню в подвале',
        'footer_custom' => 'Меню в футере (кастом)',
    ]);
}
add_action('after_setup_theme', 'oyster_farm_theme_setup');

// Подключение кастомных полей
require_once get_template_directory() . '/inc/custom-fields.php';

// Регистрируем кастомный тип записи 'Услуги'
function oyster_farm_register_service_cpt() {
    $labels = [
        'name' => 'Услуги',
        'singular_name' => 'Услуга',
        'add_new' => 'Добавить услугу',
        'add_new_item' => 'Добавить новую услугу',
        'edit_item' => 'Редактировать услугу',
        'new_item' => 'Новая услуга',
        'view_item' => 'Просмотреть услугу',
        'search_items' => 'Искать услуги',
        'not_found' => 'Услуги не найдены',
        'not_found_in_trash' => 'В корзине услуг не найдено',
        'menu_name' => 'Услуги',
    ];
    $args = [
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-hammer',
        'supports' => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true,
    ];
    register_post_type('service', $args);
}
add_action('init', 'oyster_farm_register_service_cpt');

// Метаполя для услуги: иконка и цена
function oyster_farm_service_meta_boxes() {
    add_meta_box(
        'service_extra',
        'Дополнительные поля услуги',
        'oyster_farm_service_meta_callback',
        'service',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'oyster_farm_service_meta_boxes');

function oyster_farm_service_meta_callback($post) {
    $icon = get_post_meta($post->ID, '_service_icon', true);
    $price = get_post_meta($post->ID, '_service_price', true);
    echo '<p><label>Иконка (FontAwesome): <input type="text" name="service_icon" value="' . esc_attr($icon) . '" style="width: 100%;" /></label></p>';
    echo '<p><label>Цена: <input type="text" name="service_price" value="' . esc_attr($price) . '" style="width: 100%;" /></label></p>';
}

function oyster_farm_save_service_meta($post_id) {
    if (array_key_exists('service_icon', $_POST)) {
        update_post_meta($post_id, '_service_icon', sanitize_text_field($_POST['service_icon']));
    }
    if (array_key_exists('service_price', $_POST)) {
        update_post_meta($post_id, '_service_price', sanitize_text_field($_POST['service_price']));
    }
}
add_action('save_post_service', 'oyster_farm_save_service_meta');

// Добавляю секцию 'Контакты' в Customizer
function oyster_farm_customize_register($wp_customize) {
    $wp_customize->add_section('contacts_section', [
        'title' => 'Контакты',
        'priority' => 30,
    ]);
    $wp_customize->add_setting('contacts_address', ['default' => '']);
    $wp_customize->add_control('contacts_address', [
        'label' => 'Адрес',
        'section' => 'contacts_section',
        'type' => 'text',
    ]);
    $wp_customize->add_setting('contacts_phone', ['default' => '']);
    $wp_customize->add_control('contacts_phone', [
        'label' => 'Телефон',
        'section' => 'contacts_section',
        'type' => 'text',
    ]);
    $wp_customize->add_setting('contacts_email', ['default' => '']);
    $wp_customize->add_control('contacts_email', [
        'label' => 'Email',
        'section' => 'contacts_section',
        'type' => 'text',
    ]);
    // Соцсети (до 4)
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting("contacts_social_platform_$i", ['default' => '']);
        $wp_customize->add_control("contacts_social_platform_$i", [
            'label' => "Соцсеть $i — платформа (например, vk, telegram, instagram)",
            'section' => 'contacts_section',
            'type' => 'text',
        ]);
        $wp_customize->add_setting("contacts_social_url_$i", ['default' => '']);
        $wp_customize->add_control("contacts_social_url_$i", [
            'label' => "Соцсеть $i — ссылка",
            'section' => 'contacts_section',
            'type' => 'text',
        ]);
    }
    // В функцию oyster_farm_customize_register добавляю настройку для заголовка футер-меню
    $wp_customize->add_setting('footer_menu_title', ['default' => 'Меню']);
    $wp_customize->add_control('footer_menu_title', [
        'label' => 'Заголовок меню в футере',
        'section' => 'contacts_section',
        'type' => 'text',
    ]);
}
add_action('customize_register', 'oyster_farm_customize_register'); 