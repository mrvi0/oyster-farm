<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
$color_bg = get_theme_mod('color_bg', '#f4f4f6');
$color_block = get_theme_mod('color_block', '#fff');
$color_text = get_theme_mod('color_text', '#111');
$color_accent = get_theme_mod('color_accent', '#fff900');
?>
<style>:root {
  --color-bg: <?php echo esc_attr($color_bg); ?>;
  --color-block: <?php echo esc_attr($color_block); ?>;
  --color-text: <?php echo esc_attr($color_text); ?>;
  --color-accent: <?php echo esc_attr($color_accent); ?>;
}
</style>
<header class="site-header">
    <div class="container header-content">
        <a href="<?php echo home_url(); ?>" class="site-logo">
            <?php bloginfo('name'); ?>
        </a>
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