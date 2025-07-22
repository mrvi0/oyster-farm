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
            <?php 
            $address = get_theme_mod('contacts_address'); 
            $address_url = get_theme_mod('contacts_address_url');
            if ($address) {
                if ($address_url) {
                    echo '<a href="' . esc_url($address_url) . '" target="_blank" rel="noopener" class="header-address-link">' . esc_html($address) . '</a>';
                } else {
                    echo esc_html($address);
                }
            }
            ?>
        </div>
        <div class="header-logo">
            <?php if (has_custom_logo()) {
                the_custom_logo();
            } else { ?>
                <a href="<?php echo home_url(); ?>" class="site-logo-text"><?php bloginfo('name'); ?></a>
            <?php } ?>
        </div>
        <div class="header-phone">
            <?php 
            $phone = get_theme_mod('contacts_phone'); 
            if ($phone) {
                echo '<a href="tel:' . esc_attr($phone) . '" class="header-phone-link">' . esc_html($phone) . '</a>';
            }
            ?>
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