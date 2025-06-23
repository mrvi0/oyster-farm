<?php
get_header();

// Получаем данные из кастомных полей
$hero_title = get_post_meta(get_the_ID(), '_hero_title', true) ?: 'Гастроэкскурсии на устричную ферму';
$hero_subtitle = get_post_meta(get_the_ID(), '_hero_subtitle', true) ?: 'Погрузитесь в мир свежих морепродуктов, экскурсий и незабываемых впечатлений!';
$hero_button_text = get_post_meta(get_the_ID(), '_hero_button_text', true) ?: 'Подробнее';
$hero_button_url = get_post_meta(get_the_ID(), '_hero_button_url', true) ?: '#services';
$hero_background = get_post_meta(get_the_ID(), '_hero_background', true);

$services_title = get_post_meta(get_the_ID(), '_services_title', true) ?: 'Наши услуги';
$services_subtitle = get_post_meta(get_the_ID(), '_services_subtitle', true) ?: 'Гастроэкскурсии, дегустации, прокат лодок, рыбалка на катере';
$services_items = get_post_meta(get_the_ID(), '_services_items', true);

$products_title = get_post_meta(get_the_ID(), '_products_title', true) ?: 'Продукция';
$products_subtitle = get_post_meta(get_the_ID(), '_products_subtitle', true) ?: 'Устрицы, моллюски, рыба и другие морепродукты';
$products_items = get_post_meta(get_the_ID(), '_products_items', true);

$contacts_title = get_post_meta(get_the_ID(), '_contacts_title', true) ?: 'Контакты';
$contacts_subtitle = get_post_meta(get_the_ID(), '_contacts_subtitle', true) ?: 'Свяжитесь с нами для заказа или консультации';
$contacts_address = get_post_meta(get_the_ID(), '_contacts_address', true);
$contacts_phone = get_post_meta(get_the_ID(), '_contacts_phone', true);
$contacts_email = get_post_meta(get_the_ID(), '_contacts_email', true);
$contacts_social = get_post_meta(get_the_ID(), '_contacts_social', true);
?>

<section class="hero" <?php if ($hero_background): ?>style="background-image: url('<?php echo esc_url($hero_background); ?>');"<?php endif; ?>>
    <div class="container hero-content">
        <h1><?php echo esc_html($hero_title); ?></h1>
        <p><?php echo esc_html($hero_subtitle); ?></p>
        <a href="<?php echo esc_url($hero_button_url); ?>" class="btn btn-primary"><?php echo esc_html($hero_button_text); ?></a>
    </div>
</section>

<section class="section" id="services">
    <div class="container">
        <div class="section-title">
            <h2><?php echo esc_html($services_title); ?></h2>
            <p><?php echo esc_html($services_subtitle); ?></p>
        </div>
        
        <?php if (is_array($services_items) && !empty($services_items)): ?>
        <div class="services-grid">
            <?php foreach ($services_items as $service): ?>
            <div class="service-card">
                <?php if (!empty($service['icon'])): ?>
                <div class="service-icon">
                    <i class="<?php echo esc_attr($service['icon']); ?>"></i>
                </div>
                <?php endif; ?>
                <h3><?php echo esc_html($service['title']); ?></h3>
                <p><?php echo esc_html($service['description']); ?></p>
                <?php if (!empty($service['price'])): ?>
                <div class="service-price"><?php echo esc_html($service['price']); ?></div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<section class="section" id="products">
    <div class="container">
        <div class="section-title">
            <h2><?php echo esc_html($products_title); ?></h2>
            <p><?php echo esc_html($products_subtitle); ?></p>
        </div>
        
        <?php if (is_array($products_items) && !empty($products_items)): ?>
        <div class="products-grid">
            <?php foreach ($products_items as $product): ?>
            <div class="product-card">
                <?php if (!empty($product['image'])): ?>
                <div class="product-image">
                    <img src="<?php echo esc_url($product['image']); ?>" alt="<?php echo esc_attr($product['title']); ?>">
                </div>
                <?php endif; ?>
                <div class="product-content">
                    <h3><?php echo esc_html($product['title']); ?></h3>
                    <p><?php echo esc_html($product['description']); ?></p>
                    <?php if (!empty($product['price'])): ?>
                    <div class="product-price"><?php echo esc_html($product['price']); ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<section class="section" id="contacts">
    <div class="container">
        <div class="section-title">
            <h2><?php echo esc_html($contacts_title); ?></h2>
            <p><?php echo esc_html($contacts_subtitle); ?></p>
        </div>
        
        <div class="contact-content">
            <div class="contact-info">
                <?php if ($contacts_address): ?>
                <div class="contact-item">
                    <h4>Адрес</h4>
                    <p><?php echo esc_html($contacts_address); ?></p>
                </div>
                <?php endif; ?>
                
                <?php if ($contacts_phone): ?>
                <div class="contact-item">
                    <h4>Телефон</h4>
                    <p><a href="tel:<?php echo esc_attr($contacts_phone); ?>"><?php echo esc_html($contacts_phone); ?></a></p>
                </div>
                <?php endif; ?>
                
                <?php if ($contacts_email): ?>
                <div class="contact-item">
                    <h4>Email</h4>
                    <p><a href="mailto:<?php echo esc_attr($contacts_email); ?>"><?php echo esc_html($contacts_email); ?></a></p>
                </div>
                <?php endif; ?>
                
                <?php if (is_array($contacts_social) && !empty($contacts_social)): ?>
                <div class="contact-item">
                    <h4>Социальные сети</h4>
                    <div class="social-links">
                        <?php if (!empty($contacts_social['instagram'])): ?>
                        <a href="<?php echo esc_url($contacts_social['instagram']); ?>" target="_blank">Instagram</a>
                        <?php endif; ?>
                        <?php if (!empty($contacts_social['vk'])): ?>
                        <a href="<?php echo esc_url($contacts_social['vk']); ?>" target="_blank">VK</a>
                        <?php endif; ?>
                        <?php if (!empty($contacts_social['telegram'])): ?>
                        <a href="<?php echo esc_url($contacts_social['telegram']); ?>" target="_blank">Telegram</a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="contact-form">
                <h3>Форма обратной связи</h3>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Телефон</label>
                        <input type="tel" id="phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="message">Сообщение</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
get_footer(); 