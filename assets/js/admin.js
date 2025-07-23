jQuery(document).ready(function($) {
    // Добавление услуги
    $('#add-service').on('click', function() {
        var index = $('.service-item').length;
        var newItem = `
            <div class="service-item" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px;">
                <h4>Услуга ${index + 1}</h4>
                <p><label>Название: <input type="text" name="services_items[${index}][title]" style="width: 100%;" /></label></p>
                <p><label>Описание: <textarea name="services_items[${index}][description]" style="width: 100%; height: 60px;"></textarea></label></p>
                <p><label>Иконка (FontAwesome): <input type="text" name="services_items[${index}][icon]" /></label></p>
                <p><label>Цена: <input type="text" name="services_items[${index}][price]" /></label></p>
                <button type="button" class="button remove-service">Удалить услугу</button>
            </div>
        `;
        $('#services-container').append(newItem);
    });
    
    // Удаление услуги
    $(document).on('click', '.remove-service', function() {
        $(this).closest('.service-item').remove();
        updateServiceNumbers();
    });
    
    function updateServiceNumbers() {
        $('.service-item').each(function(index) {
            $(this).find('h4').text('Услуга ' + (index + 1));
        });
    }
    
    // Добавление продукта
    $('#add-product').on('click', function() {
        var index = $('.product-item').length;
        var newItem = `
            <div class="product-item" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px;">
                <h4>Продукт ${index + 1}</h4>
                <p><label>Название: <input type="text" name="products_items[${index}][title]" style="width: 100%;" /></label></p>
                <p><label>Описание: <textarea name="products_items[${index}][description]" style="width: 100%; height: 60px;"></textarea></label></p>
                <p><label>Изображение: <input type="text" name="products_items[${index}][image]" style="width: 100%;" />
                <button type="button" class="button" onclick="selectImage('products_items[${index}][image]')">Выбрать</button></label></p>
                <p><label>Цена: <input type="text" name="products_items[${index}][price]" /></label></p>
                <button type="button" class="button remove-product">Удалить продукт</button>
            </div>
        `;
        $('#products-container').append(newItem);
    });
    
    // Удаление продукта
    $(document).on('click', '.remove-product', function() {
        $(this).closest('.product-item').remove();
        updateProductNumbers();
    });
    
    function updateProductNumbers() {
        $('.product-item').each(function(index) {
            $(this).find('h4').text('Продукт ' + (index + 1));
        });
    }

    
    // Галерея
    $('#add-gallery').on('click', function() {
        var index = $('.gallery-item').length;
        var newItem = `
            <div class="gallery-item" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px;">
                <h4>Изображение ${index + 1}</h4>
                <p><label>Изображение: <input type="text" name="gallery_items[${index}][image]" style="width: 100%;" />
                <button type="button" class="button" onclick="selectImage('gallery_items[${index}][image]')">Выбрать</button></label></p>
                <p><label>Название: <input type="text" name="gallery_items[${index}][title]" style="width: 100%;" /></label></p>
                <p><label>Описание: <textarea name="gallery_items[${index}][description]" style="width: 100%; height: 60px;"></textarea></label></p>
                <button type="button" class="button remove-gallery">Удалить изображение</button>
            </div>
        `;
        $('#gallery-container').append(newItem);
    });
    
    $(document).on('click', '.remove-gallery', function() {
        $(this).closest('.gallery-item').remove();
        updateGalleryNumbers();
    });
    
    function updateGalleryNumbers() {
        $('.gallery-item').each(function(index) {
            $(this).find('h4').text('Изображение ' + (index + 1));
        });
    }
});

// Функция для выбора изображения
function selectImage(fieldId) {
    var frame = wp.media({
        title: 'Выберите изображение',
        multiple: false
    });
    
    frame.on('select', function() {
        var attachment = frame.state().get('selection').first().toJSON();
        document.getElementById(fieldId).value = attachment.url;
    });
    
    frame.open();
} 