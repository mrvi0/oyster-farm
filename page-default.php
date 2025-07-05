<?php
/*
Template Name: Обычная страница
*/

get_header();
?>

<main id="main" class="site-main">
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="page-header-content">
                <h1><?php echo get_the_title(); ?></h1>
                <?php if (get_post_meta(get_the_ID(), '_page_subtitle', true)) : ?>
                    <p><?php echo esc_html(get_post_meta(get_the_ID(), '_page_subtitle', true)); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Page Content -->
    <section class="page-content">
        <div class="container">
            <div class="content-wrapper">
                <?php
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        ?>
                        <article class="page-article">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="page-featured-image">
                                    <?php the_post_thumbnail('large'); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="page-content-text">
                                <?php the_content(); ?>
                            </div>
                        </article>
                        <?php
                    endwhile;
                else :
                    ?>
                    <div class="no-content">
                        <h3>Контент не найден</h3>
                        <p>Запрашиваемая страница не содержит контента.</p>
                    </div>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
?> 