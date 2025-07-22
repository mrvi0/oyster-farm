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
$color_text_secondary = get_theme_mod('color_text_secondary', '#222');
$color_accent = get_theme_mod('color_accent', '#fff900');
$color_accent_hover = get_theme_mod('color_accent_hover', '#ffe600');
$color_border = get_theme_mod('color_border', '#e0e0e0');
$color_shadow = get_theme_mod('color_shadow', '0 2px 12px rgba(0,0,0,0.04)');
$radius = get_theme_mod('radius', '14px');
$transition = get_theme_mod('transition', '0.18s cubic-bezier(.4,0,.2,1)');
$font_main = get_theme_mod('font_main', "'Inter', Arial, 'Segoe UI', sans-serif");
?>
<style>:root {
  --color-bg: <?php echo esc_attr($color_bg); ?>;
  --color-block: <?php echo esc_attr($color_block); ?>;
  --color-text: <?php echo esc_attr($color_text); ?>;
  --color-text-secondary: <?php echo esc_attr($color_text_secondary); ?>;
  --color-accent: <?php echo esc_attr($color_accent); ?>;
  --color-accent-hover: <?php echo esc_attr($color_accent_hover); ?>;
  --color-border: <?php echo esc_attr($color_border); ?>;
  --color-shadow: <?php echo esc_attr($color_shadow); ?>;
  --radius: <?php echo esc_attr($radius); ?>;
  --transition: <?php echo esc_attr($transition); ?>;
  --font-main: <?php echo esc_attr($font_main); ?>;
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