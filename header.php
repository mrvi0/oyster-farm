<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="site-header">
    <div class="container header-content header-flex">
        <div class="header-address">
            <?php $address = get_theme_mod('contacts_address'); if ($address) echo esc_html($address); ?>
        </div>
        <div class="header-logo">
            <?php if (has_custom_logo()) {
                the_custom_logo();
            } else { ?>
                <a href="<?php echo home_url(); ?>" class="site-logo-text"><?php bloginfo('name'); ?></a>
            <?php } ?>
        </div>
        <div class="header-phone">
            <?php $phone = get_theme_mod('contacts_phone'); if ($phone) echo esc_html($phone); ?>
        </div>
    </div>
    <div class="container header-menu">
        <nav>
            <?php
            wp_nav_menu([
                'theme_location' => 'main_menu',
                'menu_class' => 'nav-menu',
                'container' => false
            ]);
            ?>
        </nav>
    </div>
</header>
<main> 