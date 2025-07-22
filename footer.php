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
            <p>Адрес: <?php echo $contacts_address; ?></p>
            <p>Телефон: <?php echo $contacts_phone; ?></p>
            <p>Email: <?php echo $contacts_email; ?></p>
        </div>
        <div class="footer-section">
            <h3>Меню</h3>
            <?php
            wp_nav_menu([
                'theme_location' => 'footer_menu',
                'menu_class' => 'footer-menu',
                'container' => false
            ]);
            ?>
        </div>
        <div class="footer-section">
            <h3>Мы в соцсетях</h3>
            <?php
            foreach ($contacts_social as $social) {
                echo '<a href="' . esc_url($social['url']) . '">' . esc_html($social['platform']) . '</a><br>';
            }
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