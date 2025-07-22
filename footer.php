</main>
<footer class="site-footer">
    <?php
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
    ?>
    <div class="container footer-content">
        <div class="footer-section">
            <h3>Контакты</h3>
            <p>Адрес: <?php echo esc_html($contacts_address); ?></p>
            <?php if ($contacts_phone) : ?>
                <p>Телефон: <a href="tel:<?php echo esc_attr($contacts_phone); ?>"><?php echo esc_html($contacts_phone); ?></a></p>
            <?php endif; ?>
            <?php if ($contacts_email) : ?>
                <p>Email: <a href="mailto:<?php echo esc_attr($contacts_email); ?>"><?php echo esc_html($contacts_email); ?></a></p>
            <?php endif; ?>
        </div>
        <?php if (!empty($contacts_social)) : ?>
        <div class="footer-section">
            <h3>Мы в соцсетях</h3>
            <?php foreach ($contacts_social as $social) {
                echo '<a href="' . esc_url($social['url']) . '">' . esc_html($social['platform']) . '</a><br>';
            } ?>
        </div>
        <?php endif; ?>
        <div class="footer-section">
            <h3><?php echo get_theme_mod('footer_menu_title', 'Меню'); ?></h3>
            <?php
            wp_nav_menu([
                'theme_location' => 'footer_custom',
                'menu_class' => 'footer-menu',
                'container' => false
            ]);
            ?>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Все права защищены.
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html> 