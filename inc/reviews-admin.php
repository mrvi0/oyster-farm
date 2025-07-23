<?php
// Создаем отдельную страницу для управления отзывами в админке

// Добавляем пункт меню для отзывов
function oyster_farm_reviews_admin_menu() {
    add_menu_page(
        'Отзывы', 
        'Отзывы', 
        'manage_options', 
        'oyster-farm-reviews', 
        'oyster_farm_reviews_admin_page',
        'dashicons-testimonial',
        30
    );
}
add_action('admin_menu', 'oyster_farm_reviews_admin_menu');

// Подключаем скрипты для страницы отзывов
function oyster_farm_reviews_admin_scripts($hook) {
    if ($hook == 'toplevel_page_oyster-farm-reviews') {
        wp_enqueue_media();
        wp_enqueue_script('jquery');
    }
}
add_action('admin_enqueue_scripts', 'oyster_farm_reviews_admin_scripts');

// Страница настроек отзывов
function oyster_farm_reviews_admin_page() {
    if (isset($_POST['submit'])) {
        $reviews_settings = [
            'title' => sanitize_text_field($_POST['reviews_title'] ?? ''),
            'subtitle' => wp_kses_post($_POST['reviews_subtitle'] ?? ''),
            'items' => $_POST['reviews_items'] ?? []
        ];
        update_option('oyster_farm_reviews_settings', $reviews_settings);
        echo '<div class="notice notice-success"><p>Настройки отзывов сохранены!</p></div>';
    }

    $reviews_settings = get_option('oyster_farm_reviews_settings', []);
    $reviews_title = $reviews_settings['title'] ?? 'Отзывы клиентов';
    $reviews_subtitle = $reviews_settings['subtitle'] ?? '';
    $reviews_items = $reviews_settings['items'] ?? [
        ['name' => '', 'text' => '', 'photo' => '', 'rating' => '5', 'date' => '']
    ];
    ?>
    <div class="wrap">
        <h1>Управление отзывами</h1>
        <form method="post" action="">
            <table class="form-table">
                <tr>
                    <th><label for="reviews_title">Заголовок секции</label></th>
                    <td><input type="text" id="reviews_title" name="reviews_title" value="<?php echo esc_attr($reviews_title); ?>" class="regular-text" /></td>
                </tr>
                <tr>
                    <th><label for="reviews_subtitle">Подзаголовок</label></th>
                    <td><textarea id="reviews_subtitle" name="reviews_subtitle" rows="3" class="large-text"><?php echo esc_textarea($reviews_subtitle); ?></textarea></td>
                </tr>
                <tr>
                    <th><label>Отзывы</label></th>
                    <td>
                        <div id="reviews-container">
                            <?php foreach ($reviews_items as $index => $item) : ?>
                                <div class="review-item" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; background: #fff;">
                                    <h4>Отзыв <?php echo ($index + 1); ?></h4>
                                    <p>
                                        <label>Имя:
                                            <input type="text" name="reviews_items[<?php echo $index; ?>][name]" value="<?php echo esc_attr($item['name'] ?? ''); ?>" class="regular-text" />
                                        </label>
                                    </p>
                                    <p>
                                        <label>Текст отзыва:
                                            <textarea name="reviews_items[<?php echo $index; ?>][text]" rows="4" class="large-text"><?php echo esc_textarea($item['text'] ?? ''); ?></textarea>
                                        </label>
                                    </p>
                                    <p>
                                        <label>Фото:
                                            <input type="text" name="reviews_items[<?php echo $index; ?>][photo]" value="<?php echo esc_attr($item['photo'] ?? ''); ?>" class="regular-text" />
                                            <button type="button" class="button" onclick="selectImage('reviews_items[<?php echo $index; ?>][photo]')">Выбрать</button>
                                        </label>
                                    </p>
                                    <p>
                                        <label>Рейтинг (1-5):
                                            <select name="reviews_items[<?php echo $index; ?>][rating]">
                                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                    <option value="<?php echo $i; ?>" <?php selected($item['rating'] ?? '5', $i); ?>><?php echo $i; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </label>
                                    </p>
                                    <p>
                                        <label>Дата:
                                            <input type="text" name="reviews_items[<?php echo $index; ?>][date]" value="<?php echo esc_attr($item['date'] ?? ''); ?>" placeholder="01.01.2024" class="regular-text" />
                                        </label>
                                    </p>
                                    <button type="button" class="button remove-review">Удалить отзыв</button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button type="button" class="button" id="add-review">Добавить отзыв</button>
                    </td>
                </tr>
            </table>
            <?php submit_button('Сохранить отзывы'); ?>
        </form>
    </div>

    <script>
    jQuery(function($) {
        // Добавление нового отзыва
        $('#add-review').on('click', function() {
            var index = $('.review-item').length;
            var newItem = `
                <div class="review-item" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; background: #fff;">
                    <h4>Отзыв ${index + 1}</h4>
                    <p><label>Имя: <input type="text" name="reviews_items[${index}][name]" class="regular-text" /></label></p>
                    <p><label>Текст отзыва: <textarea name="reviews_items[${index}][text]" rows="4" class="large-text"></textarea></label></p>
                    <p><label>Фото: <input type="text" name="reviews_items[${index}][photo]" class="regular-text" />
                    <button type="button" class="button" onclick="selectImage('reviews_items[${index}][photo]')">Выбрать</button></label></p>
                    <p><label>Рейтинг (1-5): <select name="reviews_items[${index}][rating]">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5" selected>5</option>
                    </select></label></p>
                    <p><label>Дата: <input type="text" name="reviews_items[${index}][date]" placeholder="01.01.2024" class="regular-text" /></label></p>
                    <button type="button" class="button remove-review">Удалить отзыв</button>
                </div>
            `;
            $('#reviews-container').append(newItem);
        });
        
        // Удаление отзыва
        $(document).on('click', '.remove-review', function() {
            $(this).closest('.review-item').remove();
            updateReviewNumbers();
        });
        
        function updateReviewNumbers() {
            $('.review-item').each(function(index) {
                $(this).find('h4').text('Отзыв ' + (index + 1));
            });
        }
    });

    // Функция выбора изображения
    function selectImage(inputName) {
        var frame = wp.media({
            title: 'Выбрать изображение',
            button: { text: 'Использовать' },
            multiple: false
        });
        
        frame.on('select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            document.querySelector('input[name="' + inputName + '"]').value = attachment.url;
        });
        
        frame.open();
    }
    </script>
    <?php
}