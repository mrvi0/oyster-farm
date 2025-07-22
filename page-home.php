<?php
/*
Template Name: Главная страница
*/

get_header();

// Получаем данные из кастомных полей
$hero_title = get_post_meta(get_the_ID(), '_hero_title', true) ?: 'Гастроэкскурсии на устричную ферму';
$hero_subtitle = get_post_meta(get_the_ID(), '_hero_subtitle', true) ?: 'Погрузитесь в мир свежих морепродуктов, экскурсий и незабываемых впечатлений!';
$hero_button_text = get_post_meta(get_the_ID(), '_hero_button_text', true) ?: 'Подробнее';
$hero_button_url = get_post_meta(get_the_ID(), '_hero_button_url', true) ?: '#services';
$hero_background = get_post_meta(get_the_ID(), '_hero_background', true);

$products_title = get_post_meta(get_the_ID(), '_products_title', true) ?: 'Продукция';
$products_subtitle = get_post_meta(get_the_ID(), '_products_subtitle', true) ?: 'Устрицы, моллюски, рыба и другие морепродукты';
$products_items = get_post_meta(get_the_ID(), '_products_items', true);

$contacts_title = get_post_meta(get_the_ID(), '_contacts_title', true) ?: 'Контакты';
$contacts_subtitle = get_post_meta(get_the_ID(), '_contacts_subtitle', true) ?: 'Свяжитесь с нами для заказа или консультации';
$contacts_address = get_theme_mod('contacts_address');
$contacts_phone = get_theme_mod('contacts_phone');
$contacts_email = get_theme_mod('contacts_email');
$contacts_social = [];
for ($i = 1; $i <= 4; $i++) {
    $platform = get_theme_mod("contacts_social_platform_$i");
    $url = get_theme_mod("contacts_social_url_$i");
    if ($platform && $url) {
        $contacts_social[] = ['platform' => $platform, 'url' => $url];
    }
}

// Получаем услуги из CPT
$services_query = new WP_Query([
    'post_type' => 'service',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'menu_order',
    'order' => 'ASC',
]);
?>

<main id="main" class="site-main">
    <!-- Hero Section -->
    <section class="hero-section" style="background-image: url('<?php echo esc_url($hero_background); ?>');">
        <div class="container">
            <div class="hero-content">
                <h1><?php echo esc_html($hero_title); ?></h1>
                <p><?php echo wp_kses_post($hero_subtitle); ?></p>
                <?php 
                if ($hero_button_text && $hero_button_url) : ?>
                    <a href="<?php echo esc_url($hero_button_url); ?>" class="cta-button"><?php echo esc_html($hero_button_text); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <?php 
    if ($services_query->have_posts()) : ?>
    <section class="services-section">
        <div class="container">
            <div class="section-header">
                <h2>Наши услуги</h2>
                <p>Гастроэкскурсии, дегустации, прокат лодок, рыбалка на катере</p>
            </div>
            <div class="services-grid">
                <?php while ($services_query->have_posts()) : $services_query->the_post(); ?>
                    <div class="service-card">
                        <?php $icon = get_post_meta(get_the_ID(), '_service_icon', true); ?>
                        <?php if ($icon) : ?>
                            <div class="service-icon"><i class="<?php echo esc_attr($icon); ?>"></i></div>
                        <?php endif; ?>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="service-image">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>
                        <h3><?php the_title(); ?></h3>
                        <?php the_content(); ?>
                        <?php $price = get_post_meta(get_the_ID(), '_service_price', true); ?>
                        <?php if ($price) : ?>
                            <div class="service-price"><?php echo esc_html($price); ?> ₽</div>
                        <?php endif; ?>
                        <a href="#contacts" class="btn">Записаться</a>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Products Section -->
    <?php 
    if ($products_title && is_array($products_items) && !empty($products_items)) : ?>
    <section class="products-section">
        <div class="container">
            <div class="section-header">
                <h2><?php echo esc_html($products_title); ?></h2>
                <?php if ($products_subtitle) : ?>
                    <p><?php echo wp_kses_post($products_subtitle); ?></p>
                <?php endif; ?>
            </div>
            <div class="products-grid">
                <?php foreach ($products_items as $product) : ?>
                    <?php if (!empty($product['title'])) : ?>
                    <div class="product-card">
                        <?php if (!empty($product['image'])) : ?>
                            <div class="product-image">
                                <img src="<?php echo esc_url($product['image']); ?>" alt="<?php echo esc_attr($product['title']); ?>">
                            </div>
                        <?php endif; ?>
                        <div class="product-content">
                            <h3><?php echo esc_html($product['title']); ?></h3>
                            <p><?php echo esc_html($product['description']); ?></p>
                            <?php if (!empty($product['price'])) : ?>
                                <div class="product-price"><?php echo esc_html($product['price']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Reviews Section -->
    <?php 
    $reviews_title = get_post_meta(get_the_ID(), '_reviews_title', true);
    $reviews_subtitle = get_post_meta(get_the_ID(), '_reviews_subtitle', true);
    $reviews_items = get_post_meta(get_the_ID(), '_reviews_items', true);
    
    if ($reviews_title && is_array($reviews_items) && !empty($reviews_items)) : ?>
    <section class="reviews-section">
        <div class="container">
            <div class="section-header">
                <h2><?php echo esc_html($reviews_title); ?></h2>
                <?php if ($reviews_subtitle) : ?>
                    <p><?php echo wp_kses_post($reviews_subtitle); ?></p>
                <?php endif; ?>
            </div>
            <div class="reviews-grid">
                <?php foreach ($reviews_items as $review) : ?>
                    <?php if (!empty($review['name']) && !empty($review['text'])) : ?>
                    <div class="review-card">
                        <div class="review-header">
                            <?php if (!empty($review['photo'])) : ?>
                                <div class="review-photo">
                                    <img src="<?php echo esc_url($review['photo']); ?>" alt="<?php echo esc_attr($review['name']); ?>">
                                </div>
                            <?php endif; ?>
                            <div class="review-info">
                                <h4><?php echo esc_html($review['name']); ?></h4>
                                <?php if (!empty($review['rating'])) : ?>
                                    <div class="review-rating">
                                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                                            <span class="star <?php echo ($i <= $review['rating']) ? 'filled' : ''; ?>">★</span>
                                        <?php endfor; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($review['date'])) : ?>
                                    <div class="review-date"><?php echo esc_html($review['date']); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="review-text">
                            <p><?php echo esc_html($review['text']); ?></p>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Gallery Section -->
    <?php 
    $gallery_title = get_post_meta(get_the_ID(), '_gallery_title', true);
    $gallery_subtitle = get_post_meta(get_the_ID(), '_gallery_subtitle', true);
    $gallery_items = get_post_meta(get_the_ID(), '_gallery_items', true);
    
    if ($gallery_title && is_array($gallery_items) && !empty($gallery_items)) : ?>
    <section class="gallery-section">
        <div class="container">
            <div class="section-header">
                <h2><?php echo esc_html($gallery_title); ?></h2>
                <?php if ($gallery_subtitle) : ?>
                    <p><?php echo wp_kses_post($gallery_subtitle); ?></p>
                <?php endif; ?>
            </div>
            <div class="gallery-grid">
                <?php foreach ($gallery_items as $item) : ?>
                    <?php if (!empty($item['image'])) : ?>
                    <div class="gallery-item">
                        <img src="<?php echo esc_url($item['image']); ?>" alt="<?php echo esc_attr($item['title']); ?>">
                        <?php if (!empty($item['title']) || !empty($item['description'])) : ?>
                            <div class="gallery-overlay">
                                <?php if (!empty($item['title'])) : ?>
                                    <h4><?php echo esc_html($item['title']); ?></h4>
                                <?php endif; ?>
                                <?php if (!empty($item['description'])) : ?>
                                    <p><?php echo esc_html($item['description']); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Contacts Section -->
    <?php 
    if ($contacts_title) : ?>
    <section class="contacts-section">
        <div class="container">
            <div class="section-header">
                <h2><?php echo esc_html($contacts_title); ?></h2>
                <?php if ($contacts_subtitle) : ?>
                    <p><?php echo wp_kses_post($contacts_subtitle); ?></p>
                <?php endif; ?>
            </div>
            <div class="contacts-content">
                <div class="contact-info">
                    <?php if ($contacts_address) : ?>
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <h4>Адрес</h4>
                                <p><?php echo esc_html($contacts_address); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($contacts_phone) : ?>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <h4>Телефон</h4>
                                <p><a href="tel:<?php echo esc_attr($contacts_phone); ?>"><?php echo esc_html($contacts_phone); ?></a></p>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($contacts_email) : ?>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <h4>Email</h4>
                                <p><a href="mailto:<?php echo esc_attr($contacts_email); ?>"><?php echo esc_html($contacts_email); ?></a></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                
                <?php if ($contacts_social) : ?>
                    <div class="social-links">
                        <h4>Мы в социальных сетях</h4>
                        <div class="social-icons">
                            <?php foreach ($contacts_social as $social) : ?>
                                <?php if (!empty($social['platform']) && !empty($social['url'])) : ?>
                                    <a href="<?php echo esc_url($social['url']); ?>" target="_blank" rel="noopener">
                                        <i class="fab fa-<?php echo esc_attr($social['platform']); ?>"></i>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
</main>

<?php
get_footer();
?> 