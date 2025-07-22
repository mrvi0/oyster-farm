</main>
<footer class="site-footer">
    <?php
    $contacts_address = get_theme_mod('contacts_address');
    $contacts_address_url = get_theme_mod('contacts_address_url');
    $contacts_phone = get_theme_mod('contacts_phone');
    $contacts_social = [];
    for ($i = 1; $i <= 4; $i++) {
        $platform = get_theme_mod("contacts_social_platform_$i");
        $url = get_theme_mod("contacts_social_url_$i");
        if ($platform && $url) {
            $contacts_social[] = ['platform' => $platform, 'url' => $url];
        }
    }
    ?>
    <div class="footer-main">
        <?php if ($contacts_phone) : ?>
            <div class="footer-phone"><a href="tel:<?php echo esc_attr($contacts_phone); ?>" class="footer-phone-link"><?php echo esc_html($contacts_phone); ?></a></div>
        <?php endif; ?>
        <?php if ($contacts_address) : ?>
            <div class="footer-address">
                <?php if ($contacts_address_url) : ?>
                    <a href="<?php echo esc_url($contacts_address_url); ?>" target="_blank" rel="noopener" class="footer-address-link"><?php echo esc_html($contacts_address); ?></a>
                <?php else : ?>
                    <?php echo esc_html($contacts_address); ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div class="footer-social">
            <?php if (get_theme_mod('contacts_vk')) : ?>
                <a href="<?php echo esc_url(get_theme_mod('contacts_vk')); ?>" target="_blank" rel="noopener" class="footer-social-link"><i class="fab fa-vk"></i></a>
            <?php endif; ?>
            <?php if (get_theme_mod('contacts_telegram')) : ?>
                <a href="<?php echo esc_url(get_theme_mod('contacts_telegram')); ?>" target="_blank" rel="noopener" class="footer-social-link"><i class="fab fa-telegram-plane"></i></a>
            <?php endif; ?>
            <?php if (get_theme_mod('contacts_instagram')) : ?>
                <a href="<?php echo esc_url(get_theme_mod('contacts_instagram')); ?>" target="_blank" rel="noopener" class="footer-social-link"><i class="fab fa-instagram"></i></a>
            <?php endif; ?>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="footer-copyright">
            <?php
            $year = date('Y');
            if ($year == '2025') {
                echo '&copy; Вкус побережья. 2025';
            } else {
                echo '&copy; Вкус побережья. 2025 - ' . $year;
            }
            ?>
        </div>
        <div class="footer-author-terminal">
            <span class="footer-terminal-icon">&gt;_</span>
            <span class="typewriter">Made by <a href="https://t.me/b4dcat" target="_blank" rel="noopener">Mr Vi</a></span>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html> 