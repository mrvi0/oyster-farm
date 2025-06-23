</main>
<footer class="site-footer">
    <div class="container footer-content">
        <div class="footer-section">
            <h3>Контакты</h3>
            <p>Адрес: ...</p>
            <p>Телефон: ...</p>
            <p>Email: ...</p>
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
            <a href="#">Instagram</a><br>
            <a href="#">VK</a><br>
            <a href="#">Telegram</a>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Все права защищены.
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html> 