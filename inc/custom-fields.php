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
        'contacts_section',
        'Блок контактов',
        'oyster_farm_contacts_callback',
        'page',
        'normal',
        'high'
    );

    add_meta_box(
        'main_gallery_section',
        'Галерея (несколько фото)',
        'oyster_farm_main_gallery_callback',
        'page',
        'normal',
        'high'
    );

    add_meta_box(
        'contact_form_shortcode',
        'Код контактной формы (Contact Form 7)',
        function($post) {
            $shortcode = get_post_meta($post->ID, '_contact_form_shortcode', true);
            echo '<textarea name="contact_form_shortcode" style="width:100%;height:60px;">' . esc_textarea($shortcode) . '</textarea>';
        },
        'page',
        'normal',
        'default'
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
    echo '<td><textarea id="hero_subtitle" name="hero_subtitle" style="width: 100%; height: 80px;">' . $hero_subtitle . '</textarea></td></tr>';
    
    echo '<tr><th><label for="hero_button_text">Текст кнопки</label></th>';
    echo '<td><input type="text" id="hero_button_text" name="hero_button_text" value="' . esc_attr($hero_button_text) . '" /></td></tr>';
    
    echo '<tr><th><label for="hero_button_url">Ссылка кнопки</label></th>';
    echo '<td><input type="text" id="hero_button_url" name="hero_button_url" value="' . esc_attr($hero_button_url) . '" style="width: 100%;" /></td></tr>';
    
    echo '<tr><th><label for="hero_background">Фоновая картинка</label></th>';
    echo '<td><input type="text" id="hero_background" name="hero_background" value="' . esc_attr($hero_background) . '" style="width: 100%;" />';
    echo '<button type="button" class="button" onclick="selectImage(\'hero_background\')">Выбрать изображение</button></td></tr>';
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
    echo '<td><textarea id="contacts_subtitle" name="contacts_subtitle" style="width: 100%; height: 60px;">' . $contacts_subtitle . '</textarea></td></tr>';
    
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

// Галерея секция
function oyster_farm_main_gallery_callback($post) {
    $gallery = get_post_meta($post->ID, '_main_gallery', true);
    if (!is_array($gallery)) $gallery = [];
    echo '<div id="main-gallery-wrapper">';
    echo '<input type="hidden" id="main_gallery" name="main_gallery" value="' . esc_attr(implode(",", $gallery)) . '" />';
    echo '<button type="button" class="button" id="main_gallery_upload">Выбрать изображения</button>';
    echo '<div id="main_gallery_preview" style="margin-top:10px;display:flex;gap:10px;flex-wrap:wrap;">';
    foreach ($gallery as $img_id) {
        $img_url = wp_get_attachment_image_url($img_id, 'thumbnail');
        if ($img_url) echo '<img src="' . esc_url($img_url) . '" style="width:80px;height:80px;object-fit:cover;border-radius:6px;">';
    }
    echo '</div>';
    echo '</div>';
    ?>
    <script>
    jQuery(function($){
        var frame;
        $('#main_gallery_upload').on('click', function(e){
            e.preventDefault();
            if (frame) { frame.open(); return; }
            frame = wp.media({
                title: 'Выбрать изображения',
                button: { text: 'Добавить' },
                multiple: true
            });
            frame.on('select', function(){
                var ids = [];
                var preview = '';
                frame.state().get('selection').each(function(attachment){
                    ids.push(attachment.id);
                    preview += '<img src="'+attachment.attributes.sizes.thumbnail.url+'" style="width:80px;height:80px;object-fit:cover;border-radius:6px;">';
                });
                $('#main_gallery').val(ids.join(','));
                $('#main_gallery_preview').html(preview);
            });
            frame.open();
        });
    });
    </script>
    <?php
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

    if (isset($_POST['main_gallery'])) {
        $ids = array_filter(array_map('intval', explode(',', $_POST['main_gallery'])));
        update_post_meta($post_id, '_main_gallery', $ids);
    }

    if (isset($_POST['contact_form_shortcode'])) {
        update_post_meta($post_id, '_contact_form_shortcode', $_POST['contact_form_shortcode']);
    }
}
add_action('save_post', 'oyster_farm_save_meta_box_data'); 