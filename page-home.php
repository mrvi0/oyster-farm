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
    <section class="services-section" id="service">
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
                                <?php the_post_thumbnail('large'); ?>
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
    <section class="products-section" id="items">
        <div class="container">
            <div class="section-header">
                <h2>Продукция</h2>
            </div>
            <div class="products-grid">
                <?php
                $products_query = new WP_Query([
                    'post_type' => 'product',
                    'posts_per_page' => -1,
                    'orderby' => 'menu_order',
                    'order' => 'ASC',
                ]);
                if ($products_query->have_posts()) :
                    while ($products_query->have_posts()) : $products_query->the_post();
                        $price = get_post_meta(get_the_ID(), '_product_price', true);
                ?>
                <div class="product-card">
                    <div class="product-image-bg" style="background-image:url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>');">
                        <div class="product-image-overlay"></div>
                        <div class="product-content-center">
                            <h3><?php the_title(); ?></h3>
                            <div class="product-desc"><?php the_content(); ?></div>
                            <?php if ($price) : ?><div class="product-price"><?php echo esc_html($price); ?> ₽</div><?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endwhile; wp_reset_postdata(); endif; ?>
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
    <section class="gallery-section" id="galery">
        <div class="container">
            <div class="section-header">
                <h2>Галерея</h2>
            </div>
            <div class="gallery-grid-custom">
                <?php
                $gallery_query = new WP_Query([
                    'post_type' => 'gallery',
                    'posts_per_page' => 3,
                    'orderby' => 'menu_order',
                    'order' => 'ASC',
                ]);
                $images = [];
                if ($gallery_query->have_posts()) :
                    while ($gallery_query->have_posts()) : $gallery_query->the_post();
                        $images[] = get_the_post_thumbnail_url(get_the_ID(), 'large');
                    endwhile; wp_reset_postdata();
                endif;
                // Выводим 3 картинки в нужной сетке
                ?>
                <div class="gallery-col gallery-col-left">
                    <?php if (!empty($images[0])) : ?>
                        <div class="gallery-img gallery-img-top" style="background-image:url('<?php echo esc_url($images[0]); ?>');"></div>
                    <?php endif; ?>
                    <?php if (!empty($images[1])) : ?>
                        <div class="gallery-img gallery-img-bottom" style="background-image:url('<?php echo esc_url($images[1]); ?>');"></div>
                    <?php endif; ?>
                </div>
                <div class="gallery-col gallery-col-right">
                    <?php if (!empty($images[2])) : ?>
                        <div class="gallery-img gallery-img-large" style="background-image:url('<?php echo esc_url($images[2]); ?>');"></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Contacts Section -->
    <?php 
    if ($contacts_title) : ?>
    <section class="contacts-section" id="book">
        <div class="container">
            <div class="section-header">
                <h2>Запись</h2>
            </div>
            <?php 
            $contact_form_shortcode = get_post_meta(get_the_ID(), '_contact_form_shortcode', true);
            if ($contact_form_shortcode) : ?>
                <?php echo do_shortcode($contact_form_shortcode); ?>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>
</main>

<?php
get_footer();
?> 