</main>
<footer class="site-footer">
    <?php
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
    <div class="footer-main">
        <?php if ($contacts_phone) : ?>
            <div class="footer-phone"><?php echo esc_html($contacts_phone); ?></div>
        <?php endif; ?>
        <?php if ($contacts_email) : ?>
            <div class="footer-email"><?php echo esc_html($contacts_email); ?></div>
        <?php endif; ?>
        <?php if (!empty($contacts_social)) : ?>
            <div class="footer-social">
                <?php foreach ($contacts_social as $social) {
                    echo '<a href="' . esc_url($social['url']) . '" target="_blank" rel="noopener" class="footer-social-link">' . esc_html($social['platform']) . '</a>';
                } ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="footer-bottom">
        <div class="footer-copyright">&copy; <?php echo date('Y'); ?> Oyster Farm</div>
        <div class="footer-author">
            <span class="footer-author-icon">&#9679;</span>
            <span>Made by <a href="https://t.me/b4dcat" target="_blank" rel="noopener">Mr Vi</a></span>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html> 