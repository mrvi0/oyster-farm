jQuery(document).ready(function($) {
    // Добавление услуги
    $('#add-service').on('click', function() {
        var container = $('#services-container');
        var index = container.children().length;
        
        var newService = `
            <div class="service-item" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px;">
                <h4>Услуга ${index + 1}</h4>
                <p><label>Название: <input type="text" name="services_items[${index}][title]" style="width: 100%;" /></label></p>
                <p><label>Описание: <textarea name="services_items[${index}][description]" style="width: 100%; height: 60px;"></textarea></label></p>
                <p><label>Иконка (FontAwesome): <input type="text" name="services_items[${index}][icon]" /></label></p>
                <p><label>Цена: <input type="text" name="services_items[${index}][price]" /></label></p>
                <button type="button" class="button remove-service">Удалить услугу</button>
            </div>
        `;
        
        container.append(newService);
    });
    
    // Удаление услуги
    $(document).on('click', '.remove-service', function() {
        $(this).closest('.service-item').remove();
        // Переиндексируем оставшиеся элементы
        $('#services-container .service-item').each(function(index) {
            $(this).find('h4').text('Услуга ' + (index + 1));
            $(this).find('input, textarea').each(function() {
                var name = $(this).attr('name');
                if (name) {
                    var newName = name.replace(/\[\d+\]/, '[' + index + ']');
                    $(this).attr('name', newName);
                }
            });
        });
    });
    
    // Добавление продукта
    $('#add-product').on('click', function() {
        var container = $('#products-container');
        var index = container.children().length;
        
        var newProduct = `
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
        
        container.append(newProduct);
    });
    
    // Удаление продукта
    $(document).on('click', '.remove-product', function() {
        $(this).closest('.product-item').remove();
        // Переиндексируем оставшиеся элементы
        $('#products-container .product-item').each(function(index) {
            $(this).find('h4').text('Продукт ' + (index + 1));
            $(this).find('input, textarea').each(function() {
                var name = $(this).attr('name');
                if (name) {
                    var newName = name.replace(/\[\d+\]/, '[' + index + ']');
                    $(this).attr('name', newName);
                }
            });
        });
    });
});

// Функция для выбора изображения
function selectImage(inputId) {
    var frame = wp.media({
        title: 'Выберите изображение',
        multiple: false
    });
    
    frame.on('select', function() {
        var attachment = frame.state().get('selection').first().toJSON();
        document.getElementById(inputId).value = attachment.url;
    });
    
    frame.open();
} 