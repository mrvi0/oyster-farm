<?php
// Кастомные поля для главной страницы
function oyster_farm_add_meta_boxes() {
    add_meta_box(
        'hero_section',
        'Главный блок (Hero)',
        'oyster_farm_hero_callback',
        'page',
        'normal',
        'high'
    );
    
    add_meta_box(
        'services_section',
        'Блок услуг',
        'oyster_farm_services_callback',
        'page',
        'normal',
        'high'
    );
    
    add_meta_box(
        'products_section',
        'Блок продукции',
        'oyster_farm_products_callback',
        'page',
        'normal',
        'high'
    );
    
    add_meta_box(
        'reviews_section',
        'Блок отзывов',
        'oyster_farm_reviews_callback',
        'page',
        'normal',
        'high'
    );
    
    add_meta_box(
        'gallery_section',
        'Блок галереи',
        'oyster_farm_gallery_callback',
        'page',
        'normal',
        'high'
    );
    
    add_meta_box(
        'contacts_section',
        'Блок контактов',
        'oyster_farm_contacts_callback',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'oyster_farm_add_meta_boxes');

// Hero секция
function oyster_farm_hero_callback($post) {
    wp_nonce_field('oyster_farm_save_meta_box_data', 'oyster_farm_meta_box_nonce');
    
    $hero_title = get_post_meta($post->ID, '_hero_title', true);
    $hero_subtitle = get_post_meta($post->ID, '_hero_subtitle', true);
    $hero_button_text = get_post_meta($post->ID, '_hero_button_text', true);
    $hero_button_url = get_post_meta($post->ID, '_hero_button_url', true);
    $hero_background = get_post_meta($post->ID, '_hero_background', true);
    
    echo '<table class="form-table">';
    echo '<tr><th><label for="hero_title">Заголовок</label></th>';
    echo '<td><input type="text" id="hero_title" name="hero_title" value="' . esc_attr($hero_title) . '" style="width: 100%;" /></td></tr>';
    
    echo '<tr><th><label for="hero_subtitle">Подзаголовок</label></th>';
    echo '<td><textarea id="hero_subtitle" name="hero_subtitle" style="width: 100%; height: 80px;">' . esc_textarea($hero_subtitle) . '</textarea></td></tr>';
    
    echo '<tr><th><label for="hero_button_text">Текст кнопки</label></th>';
    echo '<td><input type="text" id="hero_button_text" name="hero_button_text" value="' . esc_attr($hero_button_text) . '" /></td></tr>';
    
    echo '<tr><th><label for="hero_button_url">Ссылка кнопки</label></th>';
    echo '<td><input type="text" id="hero_button_url" name="hero_button_url" value="' . esc_attr($hero_button_url) . '" style="width: 100%;" /></td></tr>';
    
    echo '<tr><th><label for="hero_background">Фоновая картинка</label></th>';
    echo '<td><input type="text" id="hero_background" name="hero_background" value="' . esc_attr($hero_background) . '" style="width: 100%;" />';
    echo '<button type="button" class="button" onclick="selectImage(\'hero_background\')">Выбрать изображение</button></td></tr>';
    echo '</table>';
}

// Услуги секция
function oyster_farm_services_callback($post) {
    wp_nonce_field('oyster_farm_save_meta_box_data', 'oyster_farm_meta_box_nonce');
    
    $services_title = get_post_meta($post->ID, '_services_title', true);
    $services_subtitle = get_post_meta($post->ID, '_services_subtitle', true);
    $services_items = get_post_meta($post->ID, '_services_items', true);
    
    if (!is_array($services_items)) {
        $services_items = [
            ['title' => '', 'description' => '', 'icon' => '', 'price' => '']
        ];
    }
    
    echo '<table class="form-table">';
    echo '<tr><th><label for="services_title">Заголовок секции</label></th>';
    echo '<td><input type="text" id="services_title" name="services_title" value="' . esc_attr($services_title) . '" style="width: 100%;" /></td></tr>';
    
    echo '<tr><th><label for="services_subtitle">Подзаголовок</label></th>';
    echo '<td><textarea id="services_subtitle" name="services_subtitle" style="width: 100%; height: 60px;">' . esc_textarea($services_subtitle) . '</textarea></td></tr>';
    
    echo '<tr><th><label>Услуги</label></th><td>';
    echo '<div id="services-container">';
    foreach ($services_items as $index => $item) {
        echo '<div class="service-item" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px;">';
        echo '<h4>Услуга ' . ($index + 1) . '</h4>';
        echo '<p><label>Название: <input type="text" name="services_items[' . $index . '][title]" value="' . esc_attr($item['title']) . '" style="width: 100%;" /></label></p>';
        echo '<p><label>Описание: <textarea name="services_items[' . $index . '][description]" style="width: 100%; height: 60px;">' . esc_textarea($item['description']) . '</textarea></label></p>';
        echo '<p><label>Иконка (FontAwesome): <input type="text" name="services_items[' . $index . '][icon]" value="' . esc_attr($item['icon']) . '" /></label></p>';
        echo '<p><label>Цена: <input type="text" name="services_items[' . $index . '][price]" value="' . esc_attr($item['price']) . '" /></label></p>';
        echo '<button type="button" class="button remove-service">Удалить услугу</button>';
        echo '</div>';
    }
    echo '</div>';
    echo '<button type="button" class="button" id="add-service">Добавить услугу</button>';
    echo '</td></tr>';
    echo '</table>';
}

// Продукция секция
function oyster_farm_products_callback($post) {
    wp_nonce_field('oyster_farm_save_meta_box_data', 'oyster_farm_meta_box_nonce');
    
    $products_title = get_post_meta($post->ID, '_products_title', true);
    $products_subtitle = get_post_meta($post->ID, '_products_subtitle', true);
    $products_items = get_post_meta($post->ID, '_products_items', true);
    
    if (!is_array($products_items)) {
        $products_items = [
            ['title' => '', 'description' => '', 'image' => '', 'price' => '']
        ];
    }
    
    echo '<table class="form-table">';
    echo '<tr><th><label for="products_title">Заголовок секции</label></th>';
    echo '<td><input type="text" id="products_title" name="products_title" value="' . esc_attr($products_title) . '" style="width: 100%;" /></td></tr>';
    
    echo '<tr><th><label for="products_subtitle">Подзаголовок</label></th>';
    echo '<td><textarea id="products_subtitle" name="products_subtitle" style="width: 100%; height: 60px;">' . esc_textarea($products_subtitle) . '</textarea></td></tr>';
    
    echo '<tr><th><label>Продукты</label></th><td>';
    echo '<div id="products-container">';
    foreach ($products_items as $index => $item) {
        echo '<div class="product-item" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px;">';
        echo '<h4>Продукт ' . ($index + 1) . '</h4>';
        echo '<p><label>Название: <input type="text" name="products_items[' . $index . '][title]" value="' . esc_attr($item['title']) . '" style="width: 100%;" /></label></p>';
        echo '<p><label>Описание: <textarea name="products_items[' . $index . '][description]" style="width: 100%; height: 60px;">' . esc_textarea($item['description']) . '</textarea></label></p>';
        echo '<p><label>Изображение: <input type="text" name="products_items[' . $index . '][image]" value="' . esc_attr($item['image']) . '" style="width: 100%;" />';
        echo '<button type="button" class="button" onclick="selectImage(\'products_items[' . $index . '][image]\')">Выбрать</button></label></p>';
        echo '<p><label>Цена: <input type="text" name="products_items[' . $index . '][price]" value="' . esc_attr($item['price']) . '" /></label></p>';
        echo '<button type="button" class="button remove-product">Удалить продукт</button>';
        echo '</div>';
    }
    echo '</div>';
    echo '<button type="button" class="button" id="add-product">Добавить продукт</button>';
    echo '</td></tr>';
    echo '</table>';
}

// Отзывы секция
function oyster_farm_reviews_callback($post) {
    wp_nonce_field('oyster_farm_save_meta_box_data', 'oyster_farm_meta_box_nonce');
    
    $reviews_title = get_post_meta($post->ID, '_reviews_title', true);
    $reviews_subtitle = get_post_meta($post->ID, '_reviews_subtitle', true);
    $reviews_items = get_post_meta($post->ID, '_reviews_items', true);
    
    if (!is_array($reviews_items)) {
        $reviews_items = [
            ['name' => '', 'text' => '', 'photo' => '', 'rating' => '5', 'date' => '']
        ];
    }
    
    echo '<table class="form-table">';
    echo '<tr><th><label for="reviews_title">Заголовок секции</label></th>';
    echo '<td><input type="text" id="reviews_title" name="reviews_title" value="' . esc_attr($reviews_title) . '" style="width: 100%;" /></td></tr>';
    
    echo '<tr><th><label for="reviews_subtitle">Подзаголовок</label></th>';
    echo '<td><textarea id="reviews_subtitle" name="reviews_subtitle" style="width: 100%; height: 60px;">' . esc_textarea($reviews_subtitle) . '</textarea></td></tr>';
    
    echo '<tr><th><label>Отзывы</label></th><td>';
    echo '<div id="reviews-container">';
    foreach ($reviews_items as $index => $item) {
        echo '<div class="review-item" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px;">';
        echo '<h4>Отзыв ' . ($index + 1) . '</h4>';
        echo '<p><label>Имя: <input type="text" name="reviews_items[' . $index . '][name]" value="' . esc_attr($item['name']) . '" style="width: 100%;" /></label></p>';
        echo '<p><label>Текст отзыва: <textarea name="reviews_items[' . $index . '][text]" style="width: 100%; height: 80px;">' . esc_textarea($item['text']) . '</textarea></label></p>';
        echo '<p><label>Фото: <input type="text" name="reviews_items[' . $index . '][photo]" value="' . esc_attr($item['photo']) . '" style="width: 100%;" />';
        echo '<button type="button" class="button" onclick="selectImage(\'reviews_items[' . $index . '][photo]\')">Выбрать</button></label></p>';
        echo '<p><label>Рейтинг (1-5): <select name="reviews_items[' . $index . '][rating]">';
        for ($i = 1; $i <= 5; $i++) {
            $selected = ($item['rating'] == $i) ? 'selected' : '';
            echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
        }
        echo '</select></label></p>';
        echo '<p><label>Дата: <input type="text" name="reviews_items[' . $index . '][date]" value="' . esc_attr($item['date']) . '" placeholder="01.01.2024" /></label></p>';
        echo '<button type="button" class="button remove-review">Удалить отзыв</button>';
        echo '</div>';
    }
    echo '</div>';
    echo '<button type="button" class="button" id="add-review">Добавить отзыв</button>';
    echo '</td></tr>';
    echo '</table>';
}

// Галерея секция
function oyster_farm_gallery_callback($post) {
    wp_nonce_field('oyster_farm_save_meta_box_data', 'oyster_farm_meta_box_nonce');
    
    $gallery_title = get_post_meta($post->ID, '_gallery_title', true);
    $gallery_subtitle = get_post_meta($post->ID, '_gallery_subtitle', true);
    $gallery_items = get_post_meta($post->ID, '_gallery_items', true);
    
    if (!is_array($gallery_items)) {
        $gallery_items = [
            ['image' => '', 'title' => '', 'description' => '']
        ];
    }
    
    echo '<table class="form-table">';
    echo '<tr><th><label for="gallery_title">Заголовок секции</label></th>';
    echo '<td><input type="text" id="gallery_title" name="gallery_title" value="' . esc_attr($gallery_title) . '" style="width: 100%;" /></td></tr>';
    
    echo '<tr><th><label for="gallery_subtitle">Подзаголовок</label></th>';
    echo '<td><textarea id="gallery_subtitle" name="gallery_subtitle" style="width: 100%; height: 60px;">' . esc_textarea($gallery_subtitle) . '</textarea></td></tr>';
    
    echo '<tr><th><label>Изображения галереи</label></th><td>';
    echo '<div id="gallery-container">';
    foreach ($gallery_items as $index => $item) {
        echo '<div class="gallery-item" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px;">';
        echo '<h4>Изображение ' . ($index + 1) . '</h4>';
        echo '<p><label>Изображение: <input type="text" name="gallery_items[' . $index . '][image]" value="' . esc_attr($item['image']) . '" style="width: 100%;" />';
        echo '<button type="button" class="button" onclick="selectImage(\'gallery_items[' . $index . '][image]\')">Выбрать</button></label></p>';
        echo '<p><label>Название: <input type="text" name="gallery_items[' . $index . '][title]" value="' . esc_attr($item['title']) . '" style="width: 100%;" /></label></p>';
        echo '<p><label>Описание: <textarea name="gallery_items[' . $index . '][description]" style="width: 100%; height: 60px;">' . esc_textarea($item['description']) . '</textarea></label></p>';
        echo '<button type="button" class="button remove-gallery">Удалить изображение</button>';
        echo '</div>';
    }
    echo '</div>';
    echo '<button type="button" class="button" id="add-gallery">Добавить изображение</button>';
    echo '</td></tr>';
    echo '</table>';
}

// Контакты секция
function oyster_farm_contacts_callback($post) {
    wp_nonce_field('oyster_farm_save_meta_box_data', 'oyster_farm_meta_box_nonce');
    
    $contacts_title = get_post_meta($post->ID, '_contacts_title', true);
    $contacts_subtitle = get_post_meta($post->ID, '_contacts_subtitle', true);
    $contacts_address = get_post_meta($post->ID, '_contacts_address', true);
    $contacts_phone = get_post_meta($post->ID, '_contacts_phone', true);
    $contacts_email = get_post_meta($post->ID, '_contacts_email', true);
    $contacts_social = get_post_meta($post->ID, '_contacts_social', true);
    
    if (!is_array($contacts_social)) {
        $contacts_social = [
            'instagram' => '',
            'vk' => '',
            'telegram' => ''
        ];
    }
    
    echo '<table class="form-table">';
    echo '<tr><th><label for="contacts_title">Заголовок секции</label></th>';
    echo '<td><input type="text" id="contacts_title" name="contacts_title" value="' . esc_attr($contacts_title) . '" style="width: 100%;" /></td></tr>';
    
    echo '<tr><th><label for="contacts_subtitle">Подзаголовок</label></th>';
    echo '<td><textarea id="contacts_subtitle" name="contacts_subtitle" style="width: 100%; height: 60px;">' . esc_textarea($contacts_subtitle) . '</textarea></td></tr>';
    
    echo '<tr><th><label for="contacts_address">Адрес</label></th>';
    echo '<td><input type="text" id="contacts_address" name="contacts_address" value="' . esc_attr($contacts_address) . '" style="width: 100%;" /></td></tr>';
    
    echo '<tr><th><label for="contacts_phone">Телефон</label></th>';
    echo '<td><input type="text" id="contacts_phone" name="contacts_phone" value="' . esc_attr($contacts_phone) . '" style="width: 100%;" /></td></tr>';
    
    echo '<tr><th><label for="contacts_email">Email</label></th>';
    echo '<td><input type="email" id="contacts_email" name="contacts_email" value="' . esc_attr($contacts_email) . '" style="width: 100%;" /></td></tr>';
    
    echo '<tr><th><label>Социальные сети</label></th><td>';
    echo '<p><label>Instagram: <input type="text" name="contacts_social[instagram]" value="' . esc_attr($contacts_social['instagram']) . '" style="width: 100%;" /></label></p>';
    echo '<p><label>VK: <input type="text" name="contacts_social[vk]" value="' . esc_attr($contacts_social['vk']) . '" style="width: 100%;" /></label></p>';
    echo '<p><label>Telegram: <input type="text" name="contacts_social[telegram]" value="' . esc_attr($contacts_social['telegram']) . '" style="width: 100%;" /></label></p>';
    echo '</td></tr>';
    echo '</table>';
}

// Сохранение данных
function oyster_farm_save_meta_box_data($post_id) {
    if (!isset($_POST['oyster_farm_meta_box_nonce'])) {
        return;
    }
    
    if (!wp_verify_nonce($_POST['oyster_farm_meta_box_nonce'], 'oyster_farm_save_meta_box_data')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Hero секция
    if (isset($_POST['hero_title'])) {
        update_post_meta($post_id, '_hero_title', sanitize_text_field($_POST['hero_title']));
    }
    if (isset($_POST['hero_subtitle'])) {
        update_post_meta($post_id, '_hero_subtitle', $_POST['hero_subtitle']);
    }
    if (isset($_POST['hero_button_text'])) {
        update_post_meta($post_id, '_hero_button_text', sanitize_text_field($_POST['hero_button_text']));
    }
    if (isset($_POST['hero_button_url'])) {
        update_post_meta($post_id, '_hero_button_url', esc_url_raw($_POST['hero_button_url']));
    }
    if (isset($_POST['hero_background'])) {
        update_post_meta($post_id, '_hero_background', esc_url_raw($_POST['hero_background']));
    }
    
    // Услуги
    if (isset($_POST['services_title'])) {
        update_post_meta($post_id, '_services_title', sanitize_text_field($_POST['services_title']));
    }
    if (isset($_POST['services_subtitle'])) {
        update_post_meta($post_id, '_services_subtitle', $_POST['services_subtitle']);
    }
    if (isset($_POST['services_items'])) {
        update_post_meta($post_id, '_services_items', $_POST['services_items']);
    }
    
    // Продукция
    if (isset($_POST['products_title'])) {
        update_post_meta($post_id, '_products_title', sanitize_text_field($_POST['products_title']));
    }
    if (isset($_POST['products_subtitle'])) {
        update_post_meta($post_id, '_products_subtitle', $_POST['products_subtitle']);
    }
    if (isset($_POST['products_items'])) {
        update_post_meta($post_id, '_products_items', $_POST['products_items']);
    }
    
    // Отзывы
    if (isset($_POST['reviews_title'])) {
        update_post_meta($post_id, '_reviews_title', sanitize_text_field($_POST['reviews_title']));
    }
    if (isset($_POST['reviews_subtitle'])) {
        update_post_meta($post_id, '_reviews_subtitle', $_POST['reviews_subtitle']);
    }
    if (isset($_POST['reviews_items'])) {
        update_post_meta($post_id, '_reviews_items', $_POST['reviews_items']);
    }
    
    // Галерея
    if (isset($_POST['gallery_title'])) {
        update_post_meta($post_id, '_gallery_title', sanitize_text_field($_POST['gallery_title']));
    }
    if (isset($_POST['gallery_subtitle'])) {
        update_post_meta($post_id, '_gallery_subtitle', $_POST['gallery_subtitle']);
    }
    if (isset($_POST['gallery_items'])) {
        update_post_meta($post_id, '_gallery_items', $_POST['gallery_items']);
    }
    
    // Контакты
    if (isset($_POST['contacts_title'])) {
        update_post_meta($post_id, '_contacts_title', sanitize_text_field($_POST['contacts_title']));
    }
    if (isset($_POST['contacts_subtitle'])) {
        update_post_meta($post_id, '_contacts_subtitle', $_POST['contacts_subtitle']);
    }
    if (isset($_POST['contacts_address'])) {
        update_post_meta($post_id, '_contacts_address', sanitize_text_field($_POST['contacts_address']));
    }
    if (isset($_POST['contacts_phone'])) {
        update_post_meta($post_id, '_contacts_phone', sanitize_text_field($_POST['contacts_phone']));
    }
    if (isset($_POST['contacts_email'])) {
        update_post_meta($post_id, '_contacts_email', sanitize_email($_POST['contacts_email']));
    }
    if (isset($_POST['contacts_social'])) {
        update_post_meta($post_id, '_contacts_social', $_POST['contacts_social']);
    }
}
add_action('save_post', 'oyster_farm_save_meta_box_data'); 